<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
     
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <script src="{{asset('datatable/jquery-3.6.0.js')}}"></script>
        <link rel = "stylesheet" href="{{asset('datatable/datatables.css')}}">
        <script src = "{{asset('datatable/datatables.js')}}"></script>
    
    </head>
    <body class="font-sans antialiased">
        <div class="flex">
            <div class="w-56 fixed top-0 left-0 bottom-0 bg-gray-200 shadow-lg shadow-red-300">
                <img class="h-20 inline" src="images\logo.png">

                <h3>Hello, {{auth()->user()->role}}</h3>

           
            <a href="dashboard" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Dashbord</a>

            <a href="{{route('category.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Category</a>

            <a href="{{route('contact.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Contact</a>

            <a href="{{route('product.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Product</a>

            <a href="{{route('user.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Users</a>

            <a href="{{route('order.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Order</a>

            <a href="{{route('rating.index')}}" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-blue-500 hover:text-white">Ratings</a>

            <form action="{{route('logout')}}" method="POST">
                @csrf
                <input type="submit" value="LogOut" class="text-x1 font-bold border-b-2 border-blue-500 block ml-4 px-2 py-1 hover:bg-red-600 hover:text-white">
            </form>

            
        </div>
           

        <div class="p-4 flex-1 pl-56">
            @yield('content')
        </div>
    </div>
    </body>
</html>
