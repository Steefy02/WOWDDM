<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsAlgorithmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientPagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\OrderController;

// fjib-wmqr-jovo-iuec-uwpq stripe
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

//Client pages
Route::get('/', [ClientPagesController::class, 'root'])->name('home');
Route::get('/favorites', [ClientPagesController::class, 'favorites'])->name('favorites')->middleware('auth');
Route::get('/cart', [ClientPagesController::class, 'cart'])->name('cart');
Route::get('/contact', [ClientPagesController::class, 'contact'])->name('contact');
Route::get('/tc', [ClientPagesController::class, 'terms'])->name('tc');
Route::get('/contul-meu', [ClientPagesController::class, 'account'])->name('account')->middleware('auth');
Route::get('/produs/{id}', [ProductController::class, 'generate_product_page'])->name('product-single');
Route::get('/comenzi', [ClientPagesController::class, 'orders_page'])->name('orders-client')->middleware('auth');
Route::get('/checkout', [ClientPagesController::class, 'checkout_page'])->name('checkout')->middleware('auth');
Route::get('/login', [ClientPagesController::class, 'root']);
Route::get('/gateway', [ClientPagesController::class, 'get_gateway'])->name('gateway')->middleware('auth');
Route::post('stripe', [StripeController::class, 'store'])->name('stripe.store');

//shop
Route::get('/barbati', [ClientPagesController::class, 'get_men_page'])->name('men-shop');
Route::get('/femei', [ClientPagesController::class, 'get_women_page'])->name('women-shop');
Route::get('/copii', [ClientPagesController::class, 'get_kid_page'])->name('kid-shop');
Route::get('/magazin', [ClientPagesController::class, 'get_all_prod_page'])->name('all-shop');

//Auth
Route::post('login',[CustomAuthController::class,'process_login'])->name('login');
Route::post('register',[CustomAuthController::class,'process_registration'])->name('register');
Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout')->middleware('auth');

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/utilizatori', [AdminController::class, 'clients_page'])->name('admin-users');
Route::get('/admin/produse', [AdminController::class, 'products_page'])->name('admin-products');
Route::get('/admin/comenzi', [AdminController::class, 'orders_page'])->name('admin-orders');
Route::get('/admin/utilizatori/{id}', [AdminController::class, 'display_user']);
Route::post('/admin/utilizatori/update/{id}', [AdminController::class, 'edit_user'])->name('admin-update-user');
Route::get('/admin/produse/{id}', [AdminController::class, 'display_product'])->name('admin-product-single');
Route::post('/admin/produse/update/{id}', [AdminController::class, 'edit_product'])->name('admin-update-product');
Route::get('/admin/adauga-produs', [AdminController::class, 'get_add_product_page'])->name('admin-add-product');
Route::post('/admin/adauga-produs-nou', [AdminController::class, 'addProduct'])->name('admin-add-product-post');
Route::post('/admin/sterge-produs/{id}', [AdminController::class, 'deleteProduct'])->name('admin-delete-product');
Route::get('/admin/categorii', [AdminController::class, 'get_categories_page'])->name('admin-categories');
Route::get('/admin/outfituri', [AdminController::class, 'get_outfits_page'])->name('admin-outfits');
Route::get('/admin/promotii', [AdminController::class, 'get_promotions_page'])->name('admin-promotions');
Route::get('/admin/categorii/{id}', [AdminController::class, 'get_single_category'])->name('admin-single-category');
Route::post('/admin/categories/update/{id}', [AdminController::class, 'editCategory'])->name('admin-update-category');
Route::get('admin/adauga-categorie', [AdminController::class, 'get_add_category'])->name('admin-add-category');
Route::post('/admin/adauga-categorie-noua', [AdminController::class, 'admin_add_category_post'])->name('admin-add-category-post');
Route::post('/admin/produs/visibility', [AdminController::class, 'change_product_visibility'])->name('admin-change-product-visibility');

//Microservices
Route::get('/launch', [ClientPagesController::class, 'generate_launch_page'])->name('launch');
Route::get('/delete-item/{id}', [ProductController::class, 'delete_from_cart'])->name('deleteCartItem');
Route::get('/add-item/{id}', [ProductController::class, 'add_to_cart'])->name('addCartItem');
Route::post('/contul-meu/edit/{id}', [UserController::class, 'edit_user_data'])->name('update-user');
Route::get('/add-fav/{id}', [FavoritesController::class, 'add_product_to_fav'])->name('add-prod-fav');
Route::get('/del-fav/{id}', [FavoritesController::class, 'delete_product_from_fav'])->name('delete_product_from_fav');
Route::post('/set-ord', [ProductsAlgorithmController::class, 'set_order'])->name('set-ord');
Route::post('/set-price', [ProductsAlgorithmController::class, 'set_price'])->name('set-price');
Route::post('/set-type', [ProductsAlgorithmController::class, 'set_category'])->name('set_category');
Route::post('/unset-pref', [ProductsAlgorithmController::class, 'del_pref'])->name('del_pref');
Route::post('/create-order', [OrderController::class, 'process_order'])->name('process-order');

//Testing | Artisan commands
Route::post('/update-cart', [ProductController::class, 'update_cart'])->name('testUpd');
Route::get('/create-order', [OrderController::class, 'process_order'])->name('process-order-get');

//Legal
Route::get('/anpc', [ClientPagesController::class, 'get_anpc']);
Route::get('/retur', [ClientPagesController::class, 'get_retur']);