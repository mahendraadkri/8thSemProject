@extends('layouts.app')

@section('content')
@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Dashbord</h2>
<hr class="h-1 bg-blue-200">

<div class="mt-4 grid grid-cols-3 gap-10">

    <div class="px-4 py-8 rounded-lg bg-amber-500 text-white flex justice-between">
        <p class="font-bold text-lg">Total Contact</p>
        <p class="font-bold text-5xl">{{$contacts}}</p>
    </div>

    <div class="px-4 py-8 rounded-lg bg-red-600 text-white flex justice-between">
        <p class="font-bold text-lg">Total Categories</p>
        <p class="font-bold text-5xl">{{$categories}}</p>
    </div>

    <div class="px-4 py-8 rounded-lg bg-green-600 text-white flex justice-between">
        <p class="font-bold text-lg">Pending Order</p>
        <p class="font-bold text-5xl">{{$orders}}</p>
    </div>

    <div class="px-4 py-8 rounded-lg bg-blue-600 text-white flex justice-between">
        <p class="font-bold text-lg">Total Users</p></p>
        <p class="font-bold text-5xl">{{$users}}</p>
    </div>

@endsection