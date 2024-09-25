<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;


class UserRatingController extends Controller
{
    //admin
    public function ratings()
    {
        Session()->put('page','rating');
        $rating = Rating::with(['user','product'])->get()->toArray();
        //dd($rating);
        return view('ratings.rating',compact('rating'));
    
    }
     public function updateRatingStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Rating::where('id',$data['rating_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'rating_id'=>$data['rating_id']]);
        }

    }




    //user
    public function addRating(Request $request)
    {
       if($request->isMethod('POST')){
        $data = $request->all();
        // dd($data); die;
        if(!Auth::check()){
            $message = "Login to rate this product";
            session()->flash('error_message',$message);
            return redirect()->back();
        }

        if(!isset($data['rating'])){
            $message = "Add stars rating for the product";
            session()->flash('error_message',$message);
            return redirect()->back();
        }
        // die;

        $ratingCount = Rating::where(['user_id'=>Auth::user()->id,'product_id'=>$data['product_id']])->count();
        if($ratingCount>0)
        {
            $message = "Your rating already exists for this Product";
            session()->flash('error_message',$message);
            return redirect()->back();
        }else{
            $rating = new Rating();
            $rating->user_id = Auth::user()->id;
            $rating->product_id = $data['product_id'];
            $rating->review = $data['review'];
            $rating->rating = $data['rating'];
            $rating->status = 0;
            $rating->save();
            $message = "Thanks for rating this Product! It will be shown once approved.";
            session()->flash('success_message',$message);
            return redirect()->back();
        }

        $message = "Your rating already exists for this Product";
       
       }
    }

    public function viewProduct($id)
    {
        $product = Product::with('ratings.user')->find($id);
        $relatedproducts = Product::where('category_id',$product->category_id)->where('id', '!=', $product->id)->get();

        //calculate average rating
        $averageRating = $product->ratings()->avg('rating');

        return view('viewproduct',compact('product','relatedproducts','averageRating'));
    }

    public function show($id)
{
    // Find the product by ID
    $product = Product::with('ratings')->find($id);

    // Check if product has ratings
    if ($product->ratings->count() > 0) {
        // Calculate the average rating
        $averageRating = $product->ratings->avg('rating');
    } else {
        $averageRating = null; // No ratings yet
    }

    // Fetch related products if necessary
    $relatedproducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $id)
                            ->get();

    // Return the view with product, averageRating, and related products
    return view('viewproduct', compact('product', 'averageRating', 'relatedproducts'));
}

}


