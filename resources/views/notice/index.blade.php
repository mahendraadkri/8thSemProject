@extends('layouts.app')
@section('content')

@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Notices</h2> 
<hr class="h-1 bg-blue-200">
<div class="my-4 text-right px-10">
    <a href="{{route('notice.create')}}" class="bg-amber-400 text-black px-4 py-2 rounded-lg shadow-md hover:shadow-amber-300">Add Notice</a>
</div>
<table id="mytable">
    <thead>
        <th>S.N</th>
        <th>Categories</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach($notices as $notice)
        <tr>
            <td>{{$notice->priority}}</td>
            <td>{{$notice->notice}}</td>
            <td>
                <a href="{{route('notice.edit',$notice->id)}}" class="bg-blue-600 px-2 py-1 rounded text-white">Edit</a>
                <a onclick="return confirm('Are you sure want to delete ?')" href="{{route('notice.destroy',$notice->id)}}" class="bg-red-600 px-2 py-1 rounded text-white">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

        


<script>
    let table= new DataTable('#mytable');
</script>

@endsection
