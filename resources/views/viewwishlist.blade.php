@extends('master')
@section('content')
@include('layouts.message')

<h1 class="text-center font-bold text-3xl">Items in Wish</h1>

<div class="grid grid-cols-2 gap-5 px-24">
@foreach ($carts as $cart)
    <a href="{{route('viewproduct',$cart->product->id)}}" class="flex bg-gray-100 my-5 rounded shadow hover:bg-gray-200">
        <img src="{{asset('images/products/'.$cart->product->photopath)}}" class="h-32 w-44 object-cover shadow-lg my-2">
        <div class="px-4 py-1">
            <h2 class="text-2xl font-bold">{{$cart->product->name}}</h2>
        </div>
    </a>
@endforeach
</div>

@endsection