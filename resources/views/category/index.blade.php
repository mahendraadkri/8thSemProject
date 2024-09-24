@extends('layouts.app')
@section('content')


@include('layouts.message')
<h2 class="font-bold text-4xl text-green-700">Categories</h2>
    <hr class="h-1 bg-blue-200">

    <div class="my-4 text-right px-10 text-gray-200">
        <a href="{{route('category.create')}}" class="bg-amber-400 text-black px-4 py-2 rounded-lg shadow-md hover:shadow-amber-300 ">Add Category</a>
    </div>

    <table id="mytable" class="display text-gray-900">
        <thead>
            <th>Order</th>
            <th>Catrgory Name</th>
            <th>Picture</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($categories as $category )
            <tr>
                <td>{{$category->priority}}</td>
                <td>{{$category->name}}</td>
                <td><img class= "w-44" src="{{asset('images/category/'.$category->picture)}}" alt=""></td>
                <td>
                    <a href="{{Route('category.edit',$category->id)}}" class="bg-blue-600 text-white px-2 py-1 rounded hover:shadow-blue-400 ">Edit</a>

                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded hover:shadow-red-400">Delete</button>
                    </form>
                    

                    {{-- <a onclick="return confirm('Are you sure you want to delete!!')" href="{{Route('category.destroy',$category->id)}}" class="bg-red-600 text-white px-2 py-1 rounded hover:shadow-red-400">Delete</a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    