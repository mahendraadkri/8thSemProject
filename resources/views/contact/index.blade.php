@extends('layouts.app')
@section('content')


@include('layouts.message')
<h2 class="font-bold text-4xl text-blue-700">Contact</h2>
    <hr class="h-1 bg-blue-200">

    

    <table id="mytable" class="display">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Text</th>
            <th>Time</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($contacts as $contact )
            <tr>
                <td>{{$contact->id}}</td>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>{{$contact->text}}</td>
                <td>{{$contact->created_at}}</td>
                <td>
                    <a onclick="return confirm('Are you sure you want to delete!!')" href="{{Route('contact.destroy',$contact->id)}}" class="bg-red-600 text-white px-2 py-1 rounded hover:shadow-red-400">Delete</a>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    