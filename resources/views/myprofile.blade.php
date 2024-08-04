    
@extends('master')
@section('content')
@include('layouts.message')

    <div class="grid grid-cols-2">
        <img src="https://play-lh.googleusercontent.com/dij0oU7JFwwSMQAgR3wpQHerTMG1mECpm6BdUYKSyCalYZM3dbMgNrHgJ-krY_i7hwIJ ">
        <div class="flex justify-center items-center">
            <div class="text-center w-full">
                <h2 class="font-bold text-4xl">My Profile</h2>
                <img src="https://thumbs.dreamstime.com/z/login-icon-button-vector-illustration-isolated-white-background-126999474.jpg" alt="" class="mx-auto my-4 h-32">
                <form action="{{route('profileedit.update',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="text" class="block border border-grey-ligh t w-full p-3 rounded mb-4"
                                name="name" placeholder="Full Name" value="{{ auth()->user()->name }}" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="email" placeholder="Email" value="{{ auth()->user()->email }}" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="address" placeholder="Address" value="{{ auth()->user()->address }}" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />

                            <input type="text" class="block border border-grey-light w-full p-3 rounded mb-4"
                                name="phone" placeholder="Phone" value="{{ auth()->user()->phone }}" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                           <a href="{{ route('profileedit', auth()->user()->id) }}" type="submit"
                                class="text-center ml-24 px-2 py-3 bg-yellow-500 rounded bg-green text-black hover:bg-green-dark focus:outline-none my-1">Edit Account</a>

                    
                </form>
             

            </div>
        </div>
    </div>
    @endsection
