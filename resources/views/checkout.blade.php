@extends('master')
@section('content')
@include('layouts.message')

<h1 class="text-center font-bold text-3xl mt-10">Place Orders</h1>

{{-- Show error message for out of stock products --}}
@if(session('error'))
    <div id="error-message" class="bg-red-500 text-white p-4 rounded-lg my-4 text-center">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('order.store') }}" method="POST" class="w-1/2 mx-auto my-10" id="order-form">
    @csrf
    <input type="text" class="p-4 rounded-lg w-full my-2" name="person_name" placeholder="Full Name" value="{{ auth()->user()->name }}">

    <input type="text" class="p-4 rounded-lg w-full my-2" name="shipping_address" placeholder="Address" value="{{ auth()->user()->address }}">

    <input type="text" class="p-4 rounded-lg w-full my-2" name="phone" placeholder="Phone number" value="{{ auth()->user()->phone }}">

    <!-- Hidden input for payment method -->
    <input type="hidden" name="payment_method" id="payment-method">

    <!-- Payment buttons -->
    <button type="button" class="bg-blue-600 text-white p-5 rounded w-1/3 mx-auto block mt-5 cursor-pointer hover:bg-blue-900" onclick="setPaymentMethod('COD')">Cash On Delivery</button>

    <button type="button" id="payment-button" class="bg-teal-700 text-white p-5 rounded w-1/3 mx-auto block mt-5 cursor-pointer hover:bg-blue-900" onclick="setPaymentMethod('Khalti_Pay')">Khalti Pay</button>
</form>

<script>
    function setPaymentMethod(method) {
        // Set the payment method in the hidden input
        document.getElementById('payment-method').value = method;

        // Submit the form
        document.getElementById('order-form').submit();
    }
</script>

    

{{-- JavaScript to hide error message after 3 seconds --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000); // 3 seconds
        }
    });
</script>

    {{-- khalti Script --}}
  <script>
   var config = {
    "publicKey": "test_public_key_7db4a6a1d086486899475b6537e318e7", // Replace with your actual public key
    "productIdentity": "{{ auth()->user()->id }}",
    "productName": "Order from {{ auth()->user()->name }}",
    "productUrl": "http://127.0.0.1:8000/mycart",
    "paymentPreference": [
        "KHALTI",
        "EBANKING",
        "MOBILE_BANKING",
        "CONNECT_IPS",
        "SCT",
    ],
    "eventHandler": {
        onSuccess (payload) {
            console.log(payload);

            $.ajax({
                url: "{{ route('khaltiverified') }}",
                data: {
                    data: payload,
                    _token: "{{ csrf_token() }}"
                },
                type: "POST",
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            });
        },
        onError (error) {
            console.log(error);
        },
        onClose () {
            console.log('widget is closing');
        }

        }
    };

    var checkout = new KhaltiCheckout(config);
    var btn = document.getElementById("payment-button");
    btn.onclick = function () {
        // minimum transaction amount must be 10, i.e 1000 in paisa.
        checkout.show({amount: 1000});
    }
</script> 


@endsection