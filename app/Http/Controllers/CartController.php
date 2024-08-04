<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user())
        {
            $itemsincart = 0;
        }
        else
        {
            
        $itemsincart = Cart::where('user_id',auth()->user()->id)->where('is_ordered',false)->count();
        }

        $categories = Category::orderBy('priority')->get();
        $carts =Cart::where('user_id',auth()->user()->id)->where('is_ordered',false)->get();
        $totalamount = 0;
        foreach($carts as $cart)
        {
            $total = $cart->qty * $cart->product->price;
            $cart->subtotal = $total;
            $totalamount += $total;
        }
        return view('viewcart',compact('carts','categories','itemsincart','totalamount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'qty' =>'required',
            'product_id'=>'required',
        ]);
        $data['user_id'] = auth()->user()->id;

        
         //check if already exist
        $check = Cart::where('product_id',$data['product_id'])->where('user_id',$data
        ['user_id'])->where('is_ordered',false)->count();
        if($check > 0)
        {
            return back()->with('success','item already in Cart');
        }

        Cart::create($data);
        return back()->with('success','item added to cart');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function checkout()
    {
        if(!auth()->user())
        {
            $itemsincart = 0;
        }
        else
       {
        $itemsincart = Cart::where('user_id',auth()->user()->id)->count();

       }
       $categories = Category::orderBy('priority')->get();
       return view('checkout',compact('categories','itemsincart'));
    }
}