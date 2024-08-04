@extends('layouts.app')
@section('content')


@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Orders</h2>
    <hr class="h-1 bg-blue-200">

    

    <table id="mytable" class="display">
        <thead>
            <th>Order Date</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($orders as $order )
            <tr>
                <td>{{$order->order_date}}</td>
                <td>{{$order->person_name}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->shipping_address}}</td>
                <td>{{$order->amount}}</td>
                <td>{{$order->payment_method}}</td>
                <td>{{$order->status}}</td>
                <td>
                    <a href="{{route('order.details',$order->id)}}" class="bg-amber-600 text-black px-4 py-2 rounded-lg shadow-md text-white  hover:shadow-blue-400 hover:text-black">View Details</a>
                    @if ($order->status=='Pending')
                        
                    
                    <a onclick="return confirm('Are you sure to change status?')" href="{{route('order.status',[$order->id,'Processing'])}}" class="bg-blue-600 text-black px-4 py-2 rounded-lg shadow-md text-white px-2 py-1 rounded hover:shadow-blue-400 hover:text-black">Processing</a>
                    

                    <a onclick="return confirm('Are you sure to change status?')" href="{{route('order.status',[$order->id,'Cancel'])}}" class="bg-red-600 text-black px-4 py-2 rounded-lg shadow-md text-white px-2 py-1 rounded hover:shadow-red-400 hover:text-black">Cancel</a>
                    @endif
                    @if ($order->status=='Processing')
                        
                   

                    <a onclick="return confirm('Are you sure to change status?')" href="{{route('order.status',[$order->id,'Completed'])}}" class="bg-green-600 text-black px-4 py-2 rounded-lg shadow-md text-white px-2 py-1 rounded hover:shadow-blue-400 hover:text-black">Completed</a>
                    @endif
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    