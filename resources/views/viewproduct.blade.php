@extends('master')
@section('content')
@include('layouts.message')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
  </div>

    <div class="grid grid-cols-3 px-44 gap-10 my-10">
        <div>
            <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="w-full h-96 object-cover rounded-lg">
        </div>
        <div class="border-l-2 px-2 col-span-2">
            <h2 class="text-3xl">{{$product->name}}</h2>
            @if($product->oldprice != '')
            <p class="text-red-700 line-through text-lg">Rs. {{$product->oldprice}}/-</p>
            @endif
            <p class="text-red-700 text-2xl font-bold">Rs. {{$product->price}}/-</p>
            <p>Quantity</p>
            <form action="{{route('cart.store')}}" method="POST">
                @csrf
                <div class="mt-4 flex items-center">
                    <span class="bg-gray-200 px-4 py-2 font-bold text-xl decrease-quantity">-</span>
                    <input class="h-11 w-12 px-0 text-center border-0 bg-gray-100" type="number" name="qty" value="1" readonly>
                    <span class="bg-gray-200 px-4 py-2 font-bold text-xl increase-quantity">+</span>
                </div>
                <p><b>In Stock:</b> {{$product->stock}}</p>
            
                <div class="mt-14">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="bg-indigo-700 text-white px-6 py-2 rounded-lg shadow hover:text-black rounded">Add to Cart</button>
                    <button type="button" class="bg-red-600 text-white px-6 py-2 rounded-lg shadow hover:text-black rounded" onclick="wishlist({{$product->id}})">Add to Wishlist</button>
                </div>
            </form>
            
            {{-- Products decrease or increase Script --}}
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const decreaseBtn = document.querySelector(".decrease-quantity");
                    const increaseBtn = document.querySelector(".increase-quantity");
                    const quantityInput = document.querySelector("input[name='qty']");
                    
                    // Decrease the quantity
                    decreaseBtn.addEventListener("click", function() {
                        let currentValue = parseInt(quantityInput.value);
                        if (currentValue > 1) {
                            quantityInput.value = currentValue - 1;
                        }
                    });
            
                    // Increase the quantity
                    increaseBtn.addEventListener("click", function() {
                        let currentValue = parseInt(quantityInput.value);
                        let stock = parseInt("{{$product->stock}}");
                        if (currentValue < stock) {
                            quantityInput.value = currentValue + 1;
                        }
                    });
                });
            </script>
            
            
        </div>
    </div>
    <script> 
    function wishlist(product_id){
        const url = "{{route('wishlist.store')}}";
const data = { data:{
product_id:product_id

}, _token:"{{csrf_token()}}" };

$.ajax({
  url: url,
  type: 'POST',
  dataType: 'json',

  data: data,
  success: function(responseData) {
    // Handle the response data
    console.log(responseData);



    window.location.href = "{{route('wishlist.index')}}";
  },
  error: function(xhr, status, error) {
    // Handle any errors
    console.error('Error:', error);
  }
});
    }


    </script>

    <div class="px-44 my-10">
        <h2 class="font-bold text-2xl">About this product</h2>
        <p>{{$product->description}}</p>
    </div>
    {{-- Rating & Review --}}
    <div class="px-44 my-10">
        <h2 class="font-bold text-2xl">Product Reviews</h2>
        <div class="row">
            <div class="span4">
                <h3><b>Write a Review</b></h3>
                <form method="POST" action="{{url('/add-rating')}}" name="formRating" id="ratingForm">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id }}">
                    <div class="rate">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1 star</label>
                      </div>
                      <br><br>
                      <div class="form-group">
                        <label><b>Your Review:</b></label><br>
                        <textarea name="review" style="width: 300px; height: 50ox;" required=""></textarea>
                      </div>
                      <div>&nbsp;</div>
                      <div class="form-group">
                        <input type="submit" name="Submit" class="bg-blue-600 text-black px-5 py-2 rounded-lg shadow-md hover:shadow-blue-300 hover:text-white">
                      </div>

                </form>
            </div>
            <div class="span4">
                <h3><b>Users Review</b></h3>
                {{-- <div>

                    @foreach ($product->ratings as $rating )
                    <div>
                        rating: {{$rating->rating}}
                        review: {{$rating->review}}
                        User: {{$rating->user->name}}
                    </div>
                        
                    @endforeach

                </div> --}}
               
            </div>
        </div>
    </div>
   
    {{-- Related Products --}}
    <div class="px-44 my-10">
        <h2 class="font-bold text-2xl">Related Product</h2>

        <div class="grid grid-cols-4 gap-10 px-24 mb-10">

            @foreach($relatedproducts as $relatedproduct)
            <a href="{{route('viewproduct',$relatedproduct->id)}}">
                <div class="bg-gray-100 rounded-lg shadow-lg relative">
                    <img src="{{asset('images/products/'.$relatedproduct->photopath)}}" alt="" class="w-full h-72 object-cover rounded-t-lg">
                    <div class="p-2">
                        <p class="font-bold text-2xl">{{$relatedproduct->name}}</p>
                        <p class="font-bold text-2xl">
                            @if($relatedproduct->oldprice != '')
                            <span class="line-through text-gray-500 text-xl">{{$relatedproduct->oldprice}}/-</span> 
                            @endif
                            Rs. {{$relatedproduct->price}}/-</p>
                    </div>
                    @if($relatedproduct->oldprice != '')
                    @php
                        $discount = ($relatedproduct->oldprice - $relatedproduct->price) / $relatedproduct->oldprice * 100;
                        $discount = round($discount);
                    @endphp
                    <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-4 py-1">{{$discount}}% off</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>

        
    </div>

    {{-- css for rating --}}
    <style>
        *{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

    </style>

@endsection