<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function include()
    {
        if(!auth()->user())
        {
            return 0;
        }
        else
        {
            return Cart::where('user_id',auth()->user()->id)->where('is_ordered',false)->count();
        }
    }
    public function home()
    {
        $itemsincart = $this->include();
        $products = Product::paginate(8);
        $categories = Category::orderBy('priority')->get();
        return view('welcome',compact('products','categories','itemsincart'));
    }

    public function about()
    {
        return view('about');
    }

    public function viewproduct(Product $product)
    {
        $itemsincart = $this->include();
        // $product = Product::find($id);
        $relatedproducts = Product::where('category_id',$product->category_id)->whereNot('id',$product->id)->get();
        $categories = Category::orderBy('priority')->get();
        return view('viewproduct',compact('product','categories','itemsincart','relatedproducts'));
    }


    public function userlogin()
    {
        $itemsincart = $this->include();
        $categories = Category::orderBy('priority')->get();
        // dd($categories);
        return view('userlogin',compact('categories','itemsincart'));
    }

    public function categoryproduct($id)
    {
        $category = Category::find($id);
        $itemsincart = $this->include();

        if(request()->get('sort') == 'price_asc') {
            $products = Product::where('category_id', $id)->paginate(16);
            $categories = Category::orderBy('price','asc')->get();
        }
        elseif(request()->get('sort') == 'price_desc')
        {
            $products = Product::where('category_id', $id)->paginate(16);
            $categories = Category::orderBy('price','desc')->get();
        }
        elseif(request()->get('sort') == 'newest')
        {
            $products = Product::where('category_id', $id)->paginate(16);
            $categories = Category::orderBy('created_at','desc')->get();
        }
       

        $products = Product::where('category_id',$id)->paginate(16);
        $categories = Category::orderBy('priority')->get();
        return view('categoryproduct',compact('products','categories','itemsincart','category'));
    }

    public function orders()
    {
        $categories = Category::orderBy('priority')->get();
        $itemsincart = $this->include();
        $orders = Order::where('user_id',auth()->user()->id)->get();
        foreach($orders as $order)
        {
            $cartids = explode(',',$order->cart_id);
            $carts = [];
            foreach($cartids as $cartid)
            {
                $cart = Cart::find($cartid);
                array_push($carts,$cart);
            }
            $order->carts = $carts;
        }

        return view('userorder',compact('orders','categories','itemsincart'));
    }

    public function contactus()
    {
        $categories = Category::all();

        return view('contactus',compact('categories'));
    }

    public function searchProduct(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        


        if($request->search){

            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(16);
            // dd($searchProducts);
            return view('search',compact('searchProducts','categories'));

        }else{
            return redirect()->back()->with('messsage','No Products Found');

        }
        
    }





}