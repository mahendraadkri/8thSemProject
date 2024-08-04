<?php

namespace App\Http\Controllers;

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
}


