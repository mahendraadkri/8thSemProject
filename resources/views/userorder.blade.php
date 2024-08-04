@extends('master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<h2 class="font-bold text-4xl text-center">My Orders</h2>
<table id="mytable" class="display bg-inherit">
    <thead>
        <th>Product Image</th>
        <th>Product Name</th>
        <th>Order Date</th>
        <th>Price</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        @foreach ($order->carts as $cart )
    <tr>
        <td><img class="w-16" src="{{asset('images/products/'.$cart->product->photopath)}}" alt=""></td>
        <td>
            {{$cart->product->name}}
        </td>
        <td>
            {{$order->order_date}}
        </td>
        <td>
            {{$order->amount}}
        </td>
        <td>
            {{$order->status}}
        </td>
        
    </tr>
        
    @endforeach
        
    @endforeach
    </tbody>
    
</table>
<script>
    let table = new DataTable('#mytable');
</script>
@endsection
