@extends('layouts.app')
@section('content')


@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Order Details</h2>
    <hr class="h-1 bg-blue-200">

    

    <table id="mytable" class="display">
        <thead>
            <th>Product</th>
            <th>Product Name</th>
            <th>Rate</th>
            <th>Qty</th>
            <th>Total</th>
        </thead>
        <tbody>
            @foreach ($carts as $cart )
            <tr>
                <td><img class="w-12" src="{{asset('images/products/'.$cart->product->photopath)}}" alt=""></td>
                <td>{{$cart->product->name}}</td>
                <td>{{$cart->product->price}}</td>
                <td>{{$cart->qty}}</td>
                <td>{{$cart->qty * $cart->product->price}}</td>
               
            </tr>
            @endforeach
        </tbody>
        Grand total : {{$order->amount}}
    </table>


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    