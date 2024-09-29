<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
     
        @vite(['resources/js/app.js', 'resources/css/app.css'])
        <script src="{{asset('datatable/jquery-3.6.0.js')}}"></script>
        <link rel = "stylesheet" href="{{asset('datatable/datatables.css')}}">
        <script src = "{{asset('datatable/datatables.js')}}"></script>
        {{-- to show chart --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    </head>
    <body class="font-sans antialiased bg-gray-300">
        <div class="flex  ">
            <div class="w-56 fixed top-0 left-0 bottom-0 shadow-lg shadow-red-300 bg-gray-600">
                <div class="flex items-center justify-center h-15 mt-5">
                    <img class="h-20 mt-4 rounded-full" src="images\logo.jpg" alt="">
                </div>
                
                

                {{-- <h3 class="text-gray-300">Hello, {{auth()->user()->role}}</h3> --}}

           
                <a href="dashboard" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 18V10m-4 4h6v6H5v-6z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('category.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    <span>Category</span>
                </a>
                
                <a href="{{ route('contact.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12V7a4 4 0 00-8 0v5M5 20h14M7 16h10" />
                    </svg>
                    <span>Contact</span>
                </a>
                
                <a href="{{ route('product.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span>Product</span>
                </a>
                
                <a href="{{ route('user.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a5 5 0 100-10 5 5 0 000 10z" />
                    </svg>
                    <span>Users</span>
                </a>
                
                <a href="{{ route('order.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M9 14h6M5 21h14v-8H5v8z" />
                    </svg>
                    <span>Order</span>
                </a>
                
                <a href="{{ route('rating.index') }}" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-green-700 hover:text-white flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l2.11 6.506a1 1 0 00.95.69h6.908c.97 0 1.371 1.24.588 1.81l-5.588 4.06a1 1 0 00-.364 1.118l2.11 6.507c.3.921-.755 1.688-1.54 1.118l-5.589-4.06a1 1 0 00-1.176 0l-5.589 4.06c-.785.57-1.839-.197-1.54-1.118l2.11-6.507a1 1 0 00-.364-1.118l-5.588-4.06c-.783-.57-.382-1.81.588-1.81h6.908a1 1 0 00.95-.69l2.11-6.506z" />
                    </svg>
                    <span>Ratings</span>
                </a>
                
                

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xl text-gray-300 font-bold border-b-2 border-gray-500  ml-4 px-2 py-1 hover:bg-red-700 hover:text-white flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-10V5a2 2 0 114 0v1" />
                        </svg>
                        <span>LogOut</span>
                    </button>
                </form>
                

            
        </div>
           

        <div class="p-4 flex-1 pl-56">
            @yield('content')
        </div>
    </div>
    </body>
</html>
