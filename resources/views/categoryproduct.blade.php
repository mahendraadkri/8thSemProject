@extends('master')
@section('content')
    

<h2 class="font-bold text-4xl text-center my-5">{{$category->name}}</h2>
<div class="col-md-12 md-3">
<div class="flex items-center m-3 gap-3">
    <p class="font-weight-bold sort-font">Sort By :</p>
<select id="orderby" class="block appearance-none  bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
    <option value="asc">Assending Order</option>
    <option value="desc">Descinding Order</option>
    <option value="new">New to Old</option>
    <option value="old">Old to New</option>
</select>
</div>
</div>



<div id="productscontainer"  class="grid grid-cols-4 gap-10 px-24 mb-10">

    @foreach($products as $product)
    <a href="{{route('viewproduct',$product->id)}}">
        <div class="bg-gray-100 rounded-lg shadow-lg relative">
            <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="w-full h-72 object-cover rounded-t-lg">
            <div class="p-2">
                <p class="font-bold text-2xl">{{$product->name}}</p>
                <p class="font-bold text-2xl">
                    @if($product->oldprice != '')
                    <span class="line-through text-gray-500 text-xl">{{$product->oldprice}}/-</span> 
                    @endif
                    Rs. {{$product->price}}/-</p>
            </div>
            @if($product->oldprice != '')
            @php
                $discount = ($product->oldprice - $product->price) / $product->oldprice * 100;
                $discount = round($discount);
            @endphp
            <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-4 py-1">{{$discount}}% off</p>
            @endif
        </div>
    </a>
    @endforeach
</div>
    <div class="mx-24 my-10">
        {{$products->links()}}
    </div>

    <script>
      // JavaScript code for handling product sorting
      document.getElementById("orderby").addEventListener("change", function() {
          var orderBy = this.value; // Get the selected sorting option
          var url = '{{ route("sortProducts", ["category" => $category->id, "orderBy" => ":orderBy"]) }}';
          url = url.replace(":orderBy", orderBy); // Replace the placeholder with the selected value
          window.location.href = url; // Redirect to the sorted URL
      });
  </script>
@endsection