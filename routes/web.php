<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserRatingController;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Application;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[PagesController::class,'home'])->name('home');

Route::get('/contactus',[PagesController::class,'contactus'])->name('contactus');

Route::get('/viewproduct/{product}',[PagesController::class,'viewproduct'])->name('viewproduct');

Route::get('/userlogin',[PagesController::class,'userlogin'])->name('userlogin');

Route::get('/categoryproduct/{id}',[PagesController::class,'categoryproduct'])->name('categoryproduct');

Route::get('/userregister',[UserController::class,'userregister'])->name('user.register');

Route::post('/userregister',[UserController::class,'userstore'])->name('user.store');

Route::post('/product/orderby',[ProductController::class,'orderby'])->name('product.orderby');

Route::get('search',[PagesController::class,'searchProduct']);

Route::get('/aboutus',[AboutUsController::class,'index'])->name('aboutus');

//shorting Products
Route::get('/products/{category}/{orderBy}', [ProductController::class, 'sortProducts'])->name('sortProducts');





// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/dashboard', function () {

    $categories = Category::count();
    $orders = Order::where('status','Pending')->count();
    $contacts = Contact::count();
    $users = User::count();
    return view('dashboard',compact('categories','orders','contacts','users'));
})->middleware(['auth', 'verified','isadmin'])->name('dashboard');





Route::middleware(['auth'])->group(function(){
    Route::get('/mycart',[CartController::class,'index'])->name('cart.index');
    Route::post('/mycart/store',[CartController::class,'store'])->name('cart.store');
    Route::post('/order/store',[OrderController::class,'store'])->name('order.store');
    Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
    Route::get('/myorders',[PagesController::class,'orders'])->name('user.order');
    Route::get('/mywishlist',[WishlistController::class,'index'])->name('wishlist.index');
    Route::post('/mywishlist/store',[WishlistController::class,'store'])->name('wishlist.store');

    //route for contact admin
    Route::post('/contact/store',[ContactController::class,'store'])->name('contact.store');

    //route for rating & review
   Route::post('/add-rating', [UserRatingController::class, 'addRating']);

     
        

        // Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

        // Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
        // Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


    // route for user profile edit
    Route::get('/myprofile', [UserController::class, 'profile'])->name('myprofile');
    Route::get('/profileedit/{id}', [UserController::class, 'edit'])->name('profileedit');
    Route::post('/profileedit/{id}/update', [UserController::class, 'update'])->name('profileedit.update');

    //khalti
    Route::post('/khaltiverified',[OrderController::class,'khaltiverified'])->name('khaltiverified');
});

Route::middleware(['auth','isadmin'])->group(function () {
    //route of category
    Route::get('/category',[CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('/category/{id}/update',[CategoryController::class,'update'])->name('category.update');
    // Route::get('/category/{id}/destroy',[CategoryController::class,'destroy'])->name('category.destroy');
    Route::post('/category/destroy',[CategoryController::class,'destroy'])->name('category.destroy');


     //notice
     Route::get('/notice',[NoticeController::class,'index'])->name('notice.index');
     Route::get('/notice/create',[NoticeController::class,'create'])->name('notice.create');
     Route::post('/notice/store',[NoticeController::class,'store'])->name('notice.store');
     Route::get('/notice/{id}/edit',[NoticeController::class,'edit'])->name('notice.edit');
     Route::post('/notice/{id}/update',[NoticeController::class,'update'])->name('notice.update');
     Route::get('/notice/{id}/destroy',[NoticeController::class,'destroy'])->name('notice.destroy');

     //contact
     Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
     
     Route::get('/contact/destroy',[ContactController::class,'destroy'])->name('contact.destroy');

     
   //product
    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/store',[ProductController::class,'store'])->name('product.store');
    Route::get('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/{id}/update',[ProductController::class,'update'])->name('product.update');
    Route::get('/product/{id}/destroy',[ProductController::class,'destroy'])->name('product.destroy');


    //ratings
    Route::get('/rating',[UserRatingController::class,'ratings'])->name('rating.index');




     //orders
     Route::get('/order',[OrderController::class,'index'])->name('order.index');
     Route::get('/order/{id}/edit',[OrderController::class,'edit'])->name('order.edit');
     Route::post('/order/{id}/update',[OrderController::class,'update'])->name('order.update');
     Route::get('/order/status/{id}/{status}',[OrderController::class,'status'])->name('order.status');
     Route::get('/order/{id}/details',[OrderController::class,'details'])->name('order.details');

     //Users
    Route::get('/user',[UserController::class,'index'])->name('user.index');
    Route::post('update-rating-status','RatingController@updateRatingStatus');
    



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
