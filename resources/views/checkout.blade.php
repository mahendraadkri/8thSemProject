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
    <input id="pname" type="text" class="p-4 rounded-lg w-full my-2" name="person_name" placeholder="Full Name" value="{{ auth()->user()->name }}">

    <input id="paddress" type="text" class="p-4 rounded-lg w-full my-2" name="shipping_address" placeholder="Address" value="{{ auth()->user()->address }}">

    <input id="pphone" type="text" class="p-4 rounded-lg w-full my-2" name="phone" placeholder="Phone number" value="{{ auth()->user()->phone }}">

    <!-- Hidden input for payment method -->
    <input type="hidden" name="payment_method" id="payment-method">

    <!-- Payment buttons -->
    <button type="button" class="bg-blue-600 text-white p-5 rounded w-1/3 mx-auto block mt-5 cursor-pointer hover:bg-blue-900" onclick="setPaymentMethod('COD')">Order Now</button>
    {{-- <button type="button" id="payment-button" class="bg-teal-700 text-white p-5 rounded w-1/3 mx-auto block mt-5 cursor-pointer hover:bg-blue-900">
        Khalti Pay
    </button> --}}
</form>
<script src="https://khalti.com/static/khalti-checkout.js"></script>
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
    <<script>
        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        
        btn.onclick = function () {
            const pname = document.getElementById("pname").value;  // Get input value
            const paddress = document.getElementById("paddress").value;  // Get input value
            const pphone = document.getElementById("pphone").value;  // Get input value
            const amount = 1300;  // Example amount in paisa (for 13 rupees)
     
            if (pname && paddress && pphone) {
                // Make an AJAX POST request to your server which will communicate with the Khalti API
                $.ajax({
                    url: "https://a.khalti.com/api/v2/epayment/initiate/",  // Route to your Laravel controller method
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",  // Laravel CSRF protection
                        return_url: "http://127.0.0.1:8000/payment_success",  // Your success URL
                        website_url: "http://127.0.0.1:8000",  // Your website URL
                        amount: amount,  // Amount in paisa
                        purchase_order_id: "test123",  // Your unique purchase order ID
                        purchase_order_name: "Order from " + pname,  // Name of the order
                        customer_info: {
                            name: pname,
                            email: "example@gmail.com",  // Replace with the actual email if available
                            phone: pphone
                        },
                        product_details: [
                            {
                                identity: "1234567890",
                                name: "Product Name",
                                total_price: amount,
                                quantity: 1,
                                unit_price: amount
                            }
                        ]
                    },
                    success: function(response) {
                        console.log('Payment initiated successfully:', response);
                        if (response.pidx) {
                            checkout.show({amount: amount});  // Proceed with Khalti payment widget
                        } else {
                            alert('Failed to initiate payment.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error occurred:', error);
                        alert('Error occurred while initiating payment.');
                    }
                });
            } else {
                alert('Please fill all the fields');
            }
        }
     </script>
     
     


@endsection