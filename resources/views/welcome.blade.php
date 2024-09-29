@extends('master')
@section('content')

<h2 class="font-bold text-4xl text-center my-5">Our Category</h2>
<!-- Slider container -->
<div class="swiper-container relative"> <!-- Add relative positioning to the container -->
    <div class="swiper-wrapper">
        @foreach($categories as $category)
        <div class="swiper-slide">
            <a href="{{ route('categoryproduct', $category->id) }}">
                <div class="bg-gray-100 rounded-lg shadow-lg flex flex-col justify-between min-h-full transition-transform duration-300 hover:scale-105 hover:bg-gradient-to-r hover:from-blue-400 hover:to-green-400 hover:shadow-lg">
                    @if($category->picture)
                        <img src="{{ asset('images/category/' . $category->picture) }}" alt="{{ $category->name }}" class="w-full h-32 sm:h-36 md:h-40 lg:h-44 object-contain rounded-t-lg">
                    @endif
                    <div class="p-2 flex-grow">
                        <p class="font-bold text-lg sm:text-xl md:text-2xl text-center">{{ $category->name }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <!-- Add navigation buttons -->
    <div class="swiper-button-next absolute right-0 top-1/2 transform -translate-y-1/2 z-10"></div>
    <div class="swiper-button-prev absolute left-0 top-1/2 transform -translate-y-1/2 z-10"></div>
</div>

<!-- Add pagination if needed -->
{{-- <div class="swiper-pagination"></div> --}}

{{-- script for category slide view --}}
<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 2, // Number of visible slides
      spaceBetween: 20, // Space between slides
      breakpoints: {
        // Adjust number of slides per view based on screen size
        640: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 6,
          spaceBetween: 50,
        },
        1280: {
          slidesPerView: 8,
          spaceBetween: 60,
        },
      },
      loop: true, // Optional: loop through the slides
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>



<h2 class="font-bold text-4xl text-center my-5">Just For You</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8 lg:gap-10 px-4 sm:px-8 md:px-16 lg:px-24 mb-10">
    @foreach($products as $product)
    <a href="{{route('viewproduct',$product->id)}}">
        <div class="bg-gray-100 rounded-lg shadow-lg relative hover:bg-blue-50 transition-colors duration-300">
            <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="w-full h-48 sm:h-56 md:h-64 lg:h-72 object-content rounded-t-lg transform hover:-rotate-3 transition-transform duration-300">
            <div class="p-2">
                <p class="font-bold text-lg sm:text-xl md:text-2xl">{{$product->name}}</p>
                <p class="font-bold text-lg sm:text-xl md:text-2xl">
                    @if($product->oldprice != '')
                    <span class="line-through text-gray-500 text-base sm:text-lg md:text-xl">{{$product->oldprice}}/-</span> 
                    @endif
                    Rs. {{$product->price}}/-
                </p>
                <p><b>In Stock:</b> {{$product->stock}}</p>
            </div>
            @if($product->oldprice != '')
            @php
                $discount = ($product->oldprice - $product->price) / $product->oldprice * 100;
                $discount = round($discount);
            @endphp
            <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-2 py-1 text-xs sm:text-sm md:text-base">{{$discount}}% off</p>
            @endif
        </div>
    </a>
    @endforeach
</div>

<div class="mx-4 sm:mx-8 md:mx-16 lg:mx-24 my-10">
    {{$products->links()}}
</div>

@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded">
        {{ session('success') }}
    </div>
@endif



  

@endsection
