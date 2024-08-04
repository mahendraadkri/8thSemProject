
@extends('master')
@section('content')

    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <title>Online Electronic Store</title>
    <div>
        <h1 class="text-center text-4xl">About Us</h1>
    </div>
    <div class="flex flex-wrap items-center justify-center mb-8">
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\logo.png') }}" alt="Store Logo">
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\products.png') }}" alt="Product Photos">
    </div>
    <div class="mt-5 ml-10 max-w-sm grid grid-cols-1">
        <p class="text-lg text-gray-700 mb-8">We are a leading ecommerce store dedicated to providing high-quality
            products
            and exceptional customer service. With years of experience in the industry, we strive to be your go-to
            online
            destination for all your shopping needs.</p>
    </div>

    <div class="mt-5 ml-10  grid grid-cols-2 justify-items-center">
        <div>
            <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
            <p class="text-lg text-gray-700 mb-8">At our store, our mission is to deliver top-notch products that
                enhance
                your lifestyle and bring you joy. We carefully curate our collection to ensure that you find exactly
                what
                you're looking for, whether it's the latest fashion trends, home decor items, or unique gifts.</p>
        </div>
        <div>
            <img class="w-48 h-48 mx-4 my-2 " src="{{ asset('images\logo.png') }}" alt="">

        </div>

    </div>

    <div class="mt-5 ml-10 justify-items-center grid grid-cols-2">
        <div>
            <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\logo.png') }}" alt="Team Photo 1">

        </div>
        <div>
            <h2 class="text-2xl font-bold mb-4">Why Choose Us?</h2>
            <ul class="list-disc list-inside text-lg text-gray-700 mb-8">
                <li>Wide selection of high-quality products</li>
                <li>Fast and reliable shipping</li>
                <li>Secure and convenient online shopping experience</li>
                <li>Exceptional customer support</li>
                <li>Competitive prices</li>
            </ul>

        </div>



    </div>


    <div class="flex flex-wrap items-center justify-center mb-8">
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\about1.jpg') }}" alt="Team Photo 1">
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\about2.jpg') }}" alt="Team Photo 2">
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\about3.jpg') }}" alt="Team Photo 3">
    </div>

    <p class="text-lg text-gray-700"><b>Thank you for choosing our store. We look forward to serving you!</b></p>

    </div>
    @endsection






