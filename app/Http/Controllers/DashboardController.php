<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $salesByCategory = $this->getSalesByCategory();


        $contacts = Contact::count();
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::count();
        $users = User::count();

        return view('dashboard', compact('salesByCategory', 'contacts', 'categories', 'products', 'orders', 'users'));
    }

    private function getSalesByCategory()
    {
        return Order::join('carts', 'orders.cart_id', '=', 'carts.id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category_name, SUM(carts.qty * products.price) as total_sales')
            ->groupBy('categories.name')
            ->get();
    }
}
