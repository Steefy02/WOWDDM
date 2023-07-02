<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Auth;
use App\Http\Controllers\ProductsAlgorithmController;

class ClientPagesController extends Controller {

    public $pages = array(
                        'root' => true, 
                        'favorites' => false, 
                        'cart' => false, 
                        'contact' => false, 
                        'terms' => false
                    );

    public function root() {
        return view('landing');
    }

    public function favorites() {
        return view('favorites');
    }

    public function cart() {
        return view('cart');
    }

    public function contact() {
        return view('contact');
    }

    public function terms() {
        return view('termeni-conditii');
    }

    public function account() {
        return view('contul-meu')->with('user', Auth::user());
    }

    public function generate_launch_page() {
        return view('launch');
    }

    public function orders_page() {
        return view('orders');
    }

    public function checkout_page() {
        return view('checkout')->with('user', Auth::user());
    }

    public function get_gateway() {
        if(Auth::check()) {
            if(Auth::user()->is_admin) {
                return view('gateway');
            }
            return redirect()->route('home');
        }else {
            return redirect()->route('home');
        }
    }

    public function get_men_page() {
        $products = ProductsAlgorithmController::get_men_products()->paginate(12);

        return view('womenshop', compact('products'));
    }

    public function get_kid_page() {
        $products = ProductsAlgorithmController::get_kid_products()->paginate(12);

        return view('womenshop', compact('products'));
    }

    public function get_women_page() {
        $products = ProductsAlgorithmController::get_women_products()->paginate(12);

        return view('womenshop', compact('products'));
    }

    public function get_all_prod_page() {
        $products = ProductsAlgorithmController::get_all_products()->paginate(12);

        return view('womenshop', compact('products'));
    }

    public function get_anpc() {
        return view('anpc');
    }

}

?>