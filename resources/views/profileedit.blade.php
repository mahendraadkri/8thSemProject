    
@extends('master')
@section('content')
@include('layouts.message')

    <div class="grid grid-cols-2">
        <img src="https://icon-library.com/images/profile-icon/profile-icon-17.jpg ">
        <div class="flex justify-center items-center">
            <div class="text-center w-full">
                <h2 class="font-bold text-4xl">Edit Profile</h2>
                
                <form action="{{ route('profileedit.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <h1 class="mb-8 text-3xl text-center">Edit Profile</h1>
    
                
    
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="name"
                        placeholder="Full Name"  value="{{auth()->user()->name}}" />
    
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="phone"
                        placeholder="Phone" value="{{auth()->user()->phone}}"/>
    
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="address"
                        placeholder="Address" value="{{auth()->user()->address}}" />
                    <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4" name="email"
                        placeholder="Email" value="{{auth()->user()->email}}"/>
    
                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4" name="password"
                        placeholder="Password" />
                    <input type="password" class="block border border-grey-light w-full p-3 rounded mb-4"
                        name="password_confirmation" placeholder="Confirm Password" />
    
                    <button type="submit" class="text-center  ml-24 px-2 py-3 bg-blue-700 rounded bg-green text-black hover:bg-green-dark focus:outline-none my-1">Update Account</button>
                 
            </div>
            </form>
    
             

            </div>
        </div>
    </div>
    @endsection
