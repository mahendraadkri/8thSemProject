@extends('master')
@section('content')
@include('layouts.message')

<h1 class="text-center font-bold text-3xl">Items in Wishlist</h1>

<div class="grid grid-cols-2 gap-5 px-24">
@foreach ($carts as $cart)
    <a href="{{route('viewproduct',$cart->product->id)}}" class="flex bg-gray-100 my-5 rounded shadow hover:bg-gray-200">
        <img src="{{asset('images/products/'.$cart->product->photopath)}}" class="h-32 w-44 object-cover shadow-lg my-2">
        <div class="px-4 py-1">
            <h2 class="text-2xl font-bold">{{$cart->product->name}}</h2>

            <div class="mt-3 flex space-x-3">
                <!-- Delete Button -->
                <form action="{{ route('wishlist.delete', $cart->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                        Delete
                    </button>
                </form>
                
                <!-- Checkout Button -->
                {{-- <a href="{{ route('checkout', $cart->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                    Checkout
                </a> --}}
            </div>
        </div>
    </a>
@endforeach
</div>

@endsection