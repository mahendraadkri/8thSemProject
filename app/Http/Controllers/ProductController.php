<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Rating;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products',
            'price' => 'numeric|required',
            'oldprice' => 'numeric|nullable',
            'stock' => 'numeric|required',
            'description' => 'required|string',
            'photopath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('photopath')){
            $image = $request->file('photopath');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath,$name);
            $data['photopath'] = $name;
        }

        Product::create($data);
        return redirect(route('product.index'))->with('success','Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $data = $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products,name,'.$product->id,
            'price' => 'numeric|required',
            'oldprice' => 'numeric|nullable',
            'stock' => 'numeric|required',
            'description' => 'required',
            'photopath' => 'nullable'
        ]);

        if($request->hasFile('photopath')){
            $image = $request->file('photopath');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/products');
            $image->move($destinationPath,$name);
            File::delete(public_path('images/products/'.$product->photopath));
            $data['photopath'] = $name;
        }

        $product->update($data);
        return redirect(route('product.index'))->with('success','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->dataid);
        File::delete(public_path('images/products/'.$product->photopath));
        $product->delete();
        return redirect(route('product.index'))->with('success','Product Deleted Successfully');
    }

    public function orderby(Request $request)
    {
        $data = $request->toArray();
        $products = Product::orderby('price',$data['data'])->get();

        return  response()->json($products);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function sortProducts(Request $request, $category, $orderBy)
    {
        // Validate the orderBy value to avoid any potential security issues
        $validOrderBy = ['asc', 'desc', 'new', 'old'];
        if (!in_array($orderBy, $validOrderBy)) {
            abort(400, 'Invalid sorting order.');
        }

        // Get the products for the specified category and apply sorting based on the orderBy value
        $products = Product::where('category_id', $category);

        switch ($orderBy) {
            case 'asc':
                $products->orderBy('price', 'asc');
                break;
            case 'desc':
                $products->orderBy('price', 'desc');
                break;
            case 'new':
                $products->orderBy('created_at', 'desc');
                break;
            case 'old':
                $products->orderBy('created_at', 'asc');
                break;
            default:
                // Handle any other cases if needed
                break;
        }

        $products = $products->paginate(12); // Assuming 12 products per page, you can adjust this value as needed

        // Assuming you have a 'products' view to display the sorted products
        return view('categoryproduct', ['products' => $products, 'category' => $category]);
    }
}