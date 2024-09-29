<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'payment_method' => 'required',
            'shipping_address' => 'required',
            'phone' => 'required',
            'person_name' => 'required',
        ]);

        //add user information
        $data['user_id'] = auth()->user()->id;
        $data['order_date'] = date('Y-m-d');
        $data['status'] = 'Pending';

        //retrieve the user's cart items
        $carts = Cart::where('user_id', auth()->user()->id)->where('is_ordered',false)->get();
        $totalamount = 0;
        $outOfStockProducrs = [];

        foreach($carts as $cart) {
            $product = $cart->product;

            //check if product is in stock
            if($product->stock >= $cart->qty){
                $total = $product->price * $cart->qty;
                $totalamount += $total;
            } else {
                $outOfStockProducrs[] = $product->name;
            }

            if(!empty($outOfStockProducrs)){
                $message = 'The following products are out of stock, we will restock soon:' .implode(', ', $outOfStockProducrs);
                return redirect()->back()->with('error', $message);
            }


            // decrease product stocks
            $product = $cart->product;
            if ($product->stock >= $cart->qty) {
                $product->stock -= $cart->qty;
                $product->save();
            } else { 
                return redirect()->back()->with('error', 'Insufficient stocks of respective product: '.$product->name);


        }
        //set total order amount
        $data['amount'] = $totalamount;


        // save carts id in the order data
        $ids = $carts->pluck('id')->toArray();
        $data['cart_id'] = implode(',', $ids);
         
        $order = Order::create($data);
        Cart::whereIn('id', $ids)->update(['is_ordered' => true]);
        
      // Send mail when order is placed
    $mailData = [
        'name' => auth()->user()->name,
        'mailmessage' => 'Your order has been successfully placed. Thank you for shopping with us!',
        'order_id' => $order->id,
        'total_amount' => $totalamount,
    ];

     // Use a view for the email
     Mail::send('email.order', $mailData, function ($message) {
        $message->to(auth()->user()->email)
                ->subject('Order Confirmation');
    });


        return redirect()->route('home')->with('success', 'Order has been placed successfully');
        
    }}

    public function index()
    {
        
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }


    public function details($orderid)
    {
        $order = Order::find($orderid);
        $carts = Cart::whereIn('id', explode(',', $order->cart_id))->get();
        return view('orders.details', compact('carts','order'));
    }


    public function viewCart()
        {
            // Retrieve the user's cart items
            $carts = Cart::where('user_id', auth()->user()->id)->where('is_ordered', false)->get();

            // Calculate the total amount
            $totalamount = 0;
            foreach($carts as $cart) {
                $totalamount += $cart->product->price * $cart->qty;
            }

            // Pass total amount to the view
            return view('viewcart', compact('carts', 'totalamount'));
        }



    public function status($id,$status)
    {
        $order = Order::find($id);
        // update order status
        $order->status = $status;
        $order->save();

        //email to the user about the status change
        $user = $order->user;
         $mailData = [
            'name' => $user->name,
            'order_id' => $order->id,
            'status' => $status
        ];

        //use a blade view for the email
        Mail::send('email.orderstatus', $mailData, function ($message) use ($user, $status) {
            $message->to($user->email)
                    ->subject('your Order Status Change to ' . $status);
        });


        return redirect(route('order.index'))->with('success','Status changed to '.$status);
    }

    public function khaltiverify(Request $request)
    {

        $args = http_build_query(array(
            'token' => $request->_token,
            'amount'  => 1000
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_56ee94c2db46440a9340fb8ec45cccc0'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status_code == 200) {
            return response()->json(([
                'success' => 1,
                'redirectto' => $request,
            ]));
        } else {
            return response()->json([
                'message' => 'Something Went Wrong',
                'response' => $response
            ]);
        }
    }

    public function testpay(Request $request){

        print_r($request);
    }


    public function getSalesByCategory()
        {
            $salesByCategory = Order::join('carts', 'orders.cart_id', '=', 'carts.id')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->selectRaw('categories.name as category_name, SUM(carts.qty * products.price) as total_sales')
                ->groupBy('categories.name')
                ->get();

            return view('dashboard', compact('salesByCategory'));
        }


}