@extends('master')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<title>Hamro Departmental Store</title>

<div>
    <h1 class="text-center text-4xl">About Us</h1>
</div>

<div class="flex flex-wrap items-center justify-center mb-8">
    <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\logo.png') }}" alt="Store Logo">
    <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\products.png') }}" alt="Product Photos">
</div>

<div class="mt-5 ml-10 max-w-sm grid grid-cols-1">
    <p class="text-lg text-gray-700 mb-8">
        Welcome to Hamro Departmental Store, your one-stop shop for all your daily essentials! From grocery and kitchen supplies to electronics, household products, and more, we provide a wide range of high-quality items to make your shopping experience smooth and enjoyable.
    </p>
</div>

<div class="mt-5 ml-10 grid grid-cols-2 justify-items-center">
    <div>
        <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
        <p class="text-lg text-gray-700 mb-8">
            Our mission is to provide everything you need under one roof, whether it's fresh grocery items, top-notch electronic devices, or durable household products. We aim to enhance your shopping experience by offering convenience, quality, and affordability.
        </p>
    </div>
    <div>
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\about.jpg') }}" alt="Hamro Store Logo">
    </div>
</div>

<div class="mt-5 ml-10 justify-items-center grid grid-cols-2">
    <div>
        <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\cart.jpg') }}" alt="Our Team">
    </div>
    <div>
        <h2 class="text-2xl font-bold mb-4">Why Choose Us?</h2>
        <ul class="list-disc list-inside text-lg text-gray-700 mb-8">
            <li>Extensive range of products from groceries to electronics and more</li>
            <li>High-quality items at affordable prices</li>
            <li>Fast and reliable home delivery</li>
            <li>Secure and easy-to-use online shopping platform</li>
            <li>Dedicated customer service team</li>
        </ul>
    </div>
</div>

<div class="flex flex-wrap items-center justify-center mb-8">
    <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\about1.jpg') }}" alt="Team at Work">
    <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\all.jpg') }}" alt="Our Products">
    <img class="w-48 h-48 mx-4 my-2" src="{{ asset('images\instant.png') }}" alt="Customer Service">
</div>

<p class="text-lg text-gray-700"><b>Thank you for shopping with Hamro Departmental Store. We are committed to serving you with excellence!</b></p>

@endsection
