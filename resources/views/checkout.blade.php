@extends('master')
@section('content')
@include('layouts.message')

<h1 class="text-center font-bold text-3xl mt-10">Orders</h1>

<form action="{{route('order.store')}}" method="POST" class="w-1/2 mx-auto my-10">
    @csrf
    <input type="text" class="p-4 rounded-lg w-full my-2" name="person_name" placeholder="Full Name" value="{{auth()->user()->name}}">

    <input type="text" class="p-4 rounded-lg w-full my-2" name="shipping_address" placeholder="Address" value="{{auth()->user()->address}}">

    <input type="text" class="p-4 rounded-lg w-full my-2" name="phone" placeholder="Phone number " value="{{auth()->user()->phone}}">

    <select class="p-4 rounded-lg w-full my-2" name="payment_method">
        <option value="COD">Cash On Delivery</option>
        <option value="COD">E-sewa</option>
        <option value="COD">Khalti</option>
    </select>


    <input type="submit" class="bg-blue-600 text-white p-5 rounded w-1/3 mx-auto block mt-5 cursor-pointer hover:bg-blue-900" value="Place Order">
</form>

@endsection