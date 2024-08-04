<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $categories= Category::all();
        return view('myprofile',compact('categories'));
    }
    public function userregister()
    {
        $categories = Category::orderBy('priority')->get();
        return view('userregister',compact('categories'));

       

       
         
    }
    public function userstore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|alpha|max:255',
            'phone' => 'required|string|digits:10|starts_with:9',
            'email' => 'required|email:filter|unique:users,email|max:255',
            'address' => 'required',
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';
        
        User::create($data);

       
        return redirect(route('home'));
        //mail after registration
        $data = [
            'name' => auth()->user()->name,
            'mailmessage' => 'You have been successfully register',
    			];
 		Mail::send('email.register',$data, function ($message){
 			$message->to(auth()->user()->email)
 			->subject('You have been successfully register');
 		});

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|max:20',
            'address' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        $data['password'] = Hash::make($data['password']);


       

        $user = User::find($id);
        $user->update($data);
       

        return redirect(route('myprofile'))->with('success', 'Profile updated successfully!');
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        $categories = Category::all();
        return view('profileedit',compact('user','categories'));
    }

    public function index()
    {
        $users = User::all();
        return view('user.index',compact('users'));
    }
}
