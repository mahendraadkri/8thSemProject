@extends('master')
@section('content')
@include('layouts.message')

<style>
    @layer utilities {
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  }
</style>

<body>
  <div class="h-screen bg-gray-100 pt-20">
    <h1 class="mb-10 text-center text-2xl font-bold">Items in Cart</h1>
    <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
      <div class="rounded-lg md:w-2/3">
        <div class="grid grid-cols-2 gap-5 px-24">
            @foreach ($carts as $cart)
            <div class="flex bg-gray-100 my-5 rounded shadow">
              <a href="{{route('viewproduct',$cart->product->id)}}"><img src="{{asset('images/products/'.$cart->product->photopath)}}" class="h-32 w-44 object-cover shadow-lg my-2"></a>
                <div class="px-4 py-1">
                    <h2 class="text-2xl font-bold">{{$cart->product->name}}</h2>
                </div>
            </div>
            @endforeach
            </div>
      </div>
      <!-- Sub total -->
      <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
        <div class="mb-2 flex justify-between">
          <p class="text-gray-700">Subtotal</p>
          <p class="text-gray-700">$129.99</p>
        </div>
        <div class="flex justify-between">
          <p class="text-gray-700">Shipping</p>
          <p class="text-gray-700">$4.99</p>
        </div>
        <hr class="my-4" />
        <div class="flex justify-between">
          <p class="text-lg font-bold">Total</p>
          <div class="">
            <p class="mb-1 text-lg font-bold">$134.98 USD</p>
            <p class="text-sm text-gray-700">including VAT</p>
          </div>
        </div>
        <div class="mx-24 my-20">
            <a href="{{route('cart.checkout')}}" class="bg-blue-600 text-white px-10 py-5 rounded text-lg">Checkout</a>
        </div>
      </div>
    </div>
  </div>
  <button type="button" id="payment-button">Pay with Khalti</button>
  <script>
    var config = {
        // replace the publicKey with yours
        "publicKey": "test_public_key_7db4a6a1d086486899475b6537e318e7",
        "productIdentity": "{{auth()->user()->id}}",
        "productName": "Names",
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
                // hit merchant api for initiating verfication
                console.log(payload);

                $.ajax({
          url: "{{route('khaltiverified')}}",
          data:{
            data:payload,
            _token:"{{ csrf_token()}}"
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

</body>

@endsection