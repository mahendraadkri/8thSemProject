@extends('layouts.app')
@section('content')
@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Add Notice</h2>
<hr class="h-1 bg-blue-200">

<form action="{{route('notice.store')}}" method="POST" class="mt-5" >
    @csrf
    <input type="text" placeholder="Enter Notice" name="notice" class="w-full rounded-lg border-gray-300 my-2" value="{{old('notice')}}">
    @error('notice')
    <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
    @enderror
        
    
    <input type="text" placeholder="Priority" name="priority" class="w-full rounded-lg border-gray-300 my-2" value="{{old('priority')}}">
    @error('priority')
    <p class="text-red-600 text-xs -mt-2">{{$message}}</p>
    @enderror

    <div class="flex">
        <input type="submit" class="bg-blue-600 text-white px-4 py-2 mx-2 rounded-lg" value="Add Notice">
        <a href="{{route('notice.index')}}" class="bg-red-600 text-white px-10 py-2 mx-2 rounded-lg">Exit</a>
    </div>
</form>

@endsection