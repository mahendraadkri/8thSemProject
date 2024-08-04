@extends('layouts.app')
@section('content')
@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Product</h2>
    <hr class="h-1 bg-blue-200">

    <div class="my-4 text-right px-10">
        <a href="{{route('product.create')}}" class="bg-amber-400 text-black px-4 py-2 rounded-lg shadow-md hover:shadow-amber-300">Add Product</a>
    </div>

    <table id="mytable" class="display">
        <thead>
            <th>ID</th>
            <th>Product Name</th>
            <th>Picture</th>
            <th>Description</th>
            <th>Old Price</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td><img class= "w-44" src="{{asset('images/products/'.$product->photopath)}}" alt=""></td>
                <td>{{$product->description}}</td>
                <td>{{$product->oldprice}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->category->name}}</td>
                <td>
                    <a href="{{route('product.edit',$product->id)}}" class="bg-blue-600 text-white px-2 py-1 rounded hover:shadow-blue-400">Edit</a>

                    <a onclick="return confirm('Are you sure you want to delete!!')" href="{{Route('product.destroy',$product->id)}}" class="bg-red-600 text-white px-2 py-1 rounded hover:shadow-red-400">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    