<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('priority')->get();
        $carts = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('viewwishlist',compact('carts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    $data = $request->data;
    $product_id = $data['product_id'];
    $wishlist = [ 
        'user_id' => auth()->user()->id,
        'product_id' => $product_id
    ];

    Wishlist::create($wishlist);
        return response()->json("successfully added to Wishlist");


        // $data = $request->validate([
        //     'qty' => 'required',
        //     'product_id' => 'required',
        // ]);

        // $data['user_id'] = auth()->user()->id;

        // //check if already exist
        // $check = Wishlist::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->count();
        // if($check > 0)
        // {
        //     return back()->with('success','Item already in Cart');
        // }

        // Wishlist::create($data);
        // return back()->with('success','Item added to Cart');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     */
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
