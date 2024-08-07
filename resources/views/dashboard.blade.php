@extends('layouts.app')

@section('content')
@include('layouts.message')
<div class=" min-h-screen text-gray-300">
    <h2 class="font-bold text-4xl">Dashboard</h2>
    <hr class="h-1 bg-gray-600">

    <div class="mt-4 grid grid-cols-3 gap-10 text-gray-400">

        <div class="px-4 py-8 rounded-lg bg-amber-800  flex justify-between hover:bg-amber-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
            <p class="font-bold text-lg">Total Contacts</p>
            <p class="font-bold text-5xl">{{$contacts}}</p>
        </div>

        <div class="px-4 py-8 rounded-lg bg-red-800  flex justify-between  hover:bg-red-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
            <p class="font-bold text-lg">Total Categories</p>
            <p class="font-bold text-5xl">{{$categories}}</p>
        </div>

        <div class="px-4 py-8 rounded-lg bg-green-800  flex justify-between  hover:bg-green-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
            <p class="font-bold text-lg">Pending Orders</p>
            <p class="font-bold text-5xl">{{$orders}}</p>
        </div>

        <div class="px-4 py-8 rounded-lg bg-blue-800  flex justify-between  hover:bg-blue-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
            <p class="font-bold text-lg">Total Users</p>
            <p class="font-bold text-5xl">{{$users}}</p>
        </div>

    </div>
</div>
@endsection
