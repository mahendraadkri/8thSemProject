@extends('layouts.app')

@section('content')
@include('layouts.message')
<div class=" min-h-screen text-gray-800">
    <h2 class="font-bold text-4xl">Dashboard</h2>
    <hr class="h-1 bg-gray-600">

    <div class="mt-4 grid grid-cols-3 gap-10 text-gray-400">
        <a href="{{ route('contact.index') }}">
            <div class="px-4 py-8 rounded-lg bg-amber-600  flex justify-between hover:bg-amber-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <p class="font-bold text-lg">Total Contacts</p>
                <p class="font-bold text-5xl">{{$contacts}}</p>
            </div>
        </a>

        <a href="{{ route('category.index') }}">
            <div class="px-4 py-8 rounded-lg bg-red-600  flex justify-between  hover:bg-red-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
            <p class="font-bold text-lg">Total Categories</p>
            <p class="font-bold text-5xl">{{$categories}}</p>
            </div>
        </a>

        <a href="{{ route('product.index') }}">
            <div class="px-4 py-8 rounded-lg bg-teal-600 flex justify-between hover:bg-teal-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <p class="font-bold text-lg">Total Products</p>
                <p class="font-bold text-5xl">{{$products}}</p>
            </div>
        </a>
        

        <a href="{{ route('order.index') }}">
            <div class="px-4 py-8 rounded-lg bg-green-600  flex justify-between  hover:bg-green-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <p class="font-bold text-lg">Pending Orders</p>
                <p class="font-bold text-5xl">{{$orders}}</p>
            </div>
        </a>

        <a href="{{ route('user.index') }}">
            <div class="px-4 py-8 rounded-lg bg-blue-600  flex justify-between  hover:bg-blue-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <p class="font-bold text-lg">Total Users</p>
                <p class="font-bold text-5xl">{{$users}}</p>
            </div>
        </a>

    </div>

    <div class="min-h-screen text-gray-800">
        <h2 class="font-bold text-4xl">Sells Record</h2>
        <hr class="h-1 bg-gray-600">
    </div>
</div>
@endsection
