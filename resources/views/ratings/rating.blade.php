@extends('layouts.app')
@section('content')
@include('layouts.message')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Add this to the head section of your HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2 class="font-bold text-4xl text-blue-700">Users Ratings & Reviews</h2>
    <hr class="h-1 bg-blue-200">

    <table id="mytable" class="display">
        <thead>
            <th>ID</th>
            <th>Product Name</th>
            <th>User Email</th>
            <th>Review</th>
            <th>Rating</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($rating as $rating)
            <tr>
                <td>{{$rating['id']}}</td>
                <td>{{$rating['product']['name'] }}</td>
                <td>{{$rating['user']['email'] }}</td>
                <td>{{$rating['review']}}</td>
                <td>{{$rating['rating']}}</td>
                <td>
                    @if($rating['status']==1)
                    <a class="updateRatingStatus" id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}" href="javascript:void(0)"><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>
                    @else
                    <a class="updateRatingStatus" id="rating-{{$rating['id']}}" rating_id="{{$rating['id']}}" href="javascript:void(0)"><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>
                        
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).on("click", ".updateRatingStatus", function () {
            var status = $(this).children("i").attr("status");
            var rating_id = $(this).attr("rating_id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: 'post',
                url: '/update-rating-status',
                data: { status: status, rating_id: rating_id },
                success: function (resp) {
                    if (resp['status'] === 0) { 
                        $("#rating-" + rating_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>"); 
                    } else if (resp['status'] === 1) { 
                        $("#rating-" + rating_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>"); 
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        </script>
        


    <script>
        let table = new DataTable('#mytable');
    </script>

    @endsection
    