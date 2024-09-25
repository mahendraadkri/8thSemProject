@extends('layouts.app')
@section('content')
@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Edit Category</h2>
<hr class="h-1 bg-gray-600">

<form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data" class="mt-5">
    @csrf
    @method('PUT')
    <input type="text" placeholder="Category Name" name="name" class="w-full rounded-lg border-gray-300 my-2" value="{{$category->name}}">
    @error('name')
    <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
    @enderror
        
    <input type="text" placeholder="Priority" name="priority" class="w-full rounded-lg border-gray-300 my-2" value="{{$category->priority}}">
    @error('priority')
    <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
    @enderror

    <p class="text-gray-300">Current Image</p>
        <img src="{{asset('images/category/'.$category->picture)}}" class="w-24" alt="">
        <input type="file" name="picture" class="w-full rounded-lg border-gray-300 my-2">
        @error('picture')
            <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
        @enderror

    <div class="flex">
        <input type="submit" class="bg-green-600 text-white px-4 py-2 mx-2 rounded-lg" value="Update">
        <a href="{{route('category.index')}}" class="bg-blue-600 text-white px-10 py-2 mx-2 rounded-lg">Exit</a>
    </div>
</form>

@endsection
