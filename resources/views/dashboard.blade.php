@extends('layouts.app')

@section('content')
@include('layouts.message')
<div class="min-h-screen text-gray-800">
    <h2 class="font-bold text-4xl">Dashboard</h2>
    <hr class="h-1 bg-gray-600">

    <div class="mt-4 grid grid-cols-3 gap-10 text-gray-400">
        <a href="{{ route('contact.index') }}">
            <div class="px-4 py-8 rounded-lg bg-amber-600 flex justify-between items-center hover:bg-amber-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 14a5 5 0 100-10 5 5 0 000 10z" />
                    </svg>
                    <p class="font-bold text-lg">Total Contacts</p>
                </div>
                <p class="font-bold text-5xl">{{$contacts}}</p>
            </div>
        </a>

        <a href="{{ route('category.index') }}">
            <div class="px-4 py-8 rounded-lg bg-red-600 flex justify-between items-center hover:bg-red-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <p class="font-bold text-lg">Total Categories</p>
                </div>
                <p class="font-bold text-5xl">{{$categories}}</p>
            </div>
        </a>

        <a href="{{ route('product.index') }}">
            <div class="px-4 py-8 rounded-lg bg-teal-600 flex justify-between items-center hover:bg-teal-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-5a2 2 0 00-2 2v6a2 2 0 00-2 2v4h12v-4a2 2 0 00-2-2z" />
                    </svg>
                    <p class="font-bold text-lg">Total Products</p>
                </div>
                <p class="font-bold text-5xl">{{$products}}</p>
            </div>
        </a>

        <a href="{{ route('order.index') }}">
            <div class="px-4 py-8 rounded-lg bg-green-600 flex justify-between items-center hover:bg-green-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4" />
                    </svg>
                    <p class="font-bold text-lg">Pending Orders</p>
                </div>
                <p class="font-bold text-5xl">{{$orders}}</p>
            </div>
        </a>

        <a href="{{ route('user.index') }}">
            <div class="px-4 py-8 rounded-lg bg-blue-600 flex justify-between items-center hover:bg-blue-700 hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out cursor-pointer hover:text-gray-200">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="font-bold text-lg">Total Users</p>
                </div>
                <p class="font-bold text-5xl">{{$users}}</p>
            </div>
        </a>

    </div>

    <div class="min-h-screen text-gray-800 mt-8">
        <h2 class="font-bold text-4xl">Sells Record</h2>
        <hr class="h-1 bg-gray-600">
        <canvas id="salesPieChart" width="400" height="400" style="width: 100px; height: 100px;"></canvas>
    </div>
    
    
</div>
{{-- pass $salesByCategory data to JavaScript --}}
<script>
    var salesData = @json($salesByCategory);
</script>

{{-- Include Chart.js library --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>
    var ctx = document.getElementById('salesPieChart').getContext('2d');
    var categories = salesData.map(function(item) { return item.category_name; });
    var totalSales = salesData.map(function(item) { return item.total_sales; });

    var salesPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                label: 'Sales by Category',
                data: totalSales,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>


@endsection
