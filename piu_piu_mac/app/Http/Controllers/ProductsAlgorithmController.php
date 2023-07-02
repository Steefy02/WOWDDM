<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Session;

class ProductsAlgorithmController extends Controller {

    public static function get_newest_products() {
        $products_all = Product::all();

        $length = sizeof($products_all);

        for($i = 0; $i < $length; $i++) {
            if($products_all[$i]->visible == '0') {
                for($j = $i; $j < sizeof($products_all) - 1; $j++) {
                    $products_all[$j] = $products_all[$j + 1];
                }
                $i--;
                $length--;
                unset($products_all[$length]);
            }
        }

        $products_new = null;

        if($length <= 4) {
            $products_new = $products_all;
            //dd($products_all);
        }else {
            $k = $length - 4;
            $i = 0;
            while($k < $length) {
                $products_new[$i] = $products_all[$k];
                $i++;
                $k++;
            }
        }

        return $products_new;
    }

    public static function get_on_sale_products() {
        $products_all = Product::all();

        $length = sizeof($products_all);

        for($i = 0; $i < $length; $i++) {
            if($products_all[$i]->visible == '0' || $products_all[$i]->discount == 0) {
                for($j = $i; $j < sizeof($products_all) - 1; $j++) {
                    $products_all[$j] = $products_all[$j + 1];
                }
                $i--;
                $length--;
                unset($products_all[$length]);
            }
        }

        $products_sale = null;

        if($length <= 8) {
            $products_sale = $products_all;
            //dd($products_all);
        }else {
            $k = $length - 8;
            $i = 0;
            while($k < $length) {
                $products_sale[$i] = $products_all[$k];
                $i++;
                $k++;
            }
        }

        return $products_sale;
    }

    public static function get_women_product_number() {
        $products_all = self::get_women_products()->get();

        return sizeof($products_all);
    }

    public static function get_women_products() {
        $products_all = Product::where(['category' => 1, 'visible' => 1]);
        $ok = false;
        if(isset(Session::get('pref')['order'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->orderBy('price', $pref['order']);
            $ok = true;
        }
        if(isset(Session::get('pref')['price'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->whereBetween('price', [$pref['price']['start'], $pref['price']['end']]);
            $ok = true;
        }
        if(isset(Session::get('pref')['categories'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->where('type', $pref['categories']);
            $ok = true;
        }

        if(!$ok) {
            $products_all = $products_all->orderBy('price', 'asc');
        }
        
        return $products_all;
    }

    public static function get_men_products() {
        $products_all = Product::where(['category' => 2, 'visible' => 1]);
        $ok = false;
        if(isset(Session::get('pref')['order'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->orderBy('price', $pref['order']);
            $ok = true;
        }
        if(isset(Session::get('pref')['price'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->whereBetween('price', [$pref['price']['start'], $pref['price']['end']]);
            $ok = true;
        }
        if(isset(Session::get('pref')['categories'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->where('type', $pref['categories']);
            $ok = true;
        }

        if(!$ok) {
            $products_all = $products_all->orderBy('price', 'asc');
        }
        
        return $products_all;
    }

    public static function get_kid_products() {
        $products_all = Product::where(['category' => 3, 'visible' => 1]);
        $ok = false;
        if(isset(Session::get('pref')['order'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->orderBy('price', $pref['order']);
            $ok = true;
        }
        if(isset(Session::get('pref')['price'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->whereBetween('price', [$pref['price']['start'], $pref['price']['end']]);
            $ok = true;
        }
        if(isset(Session::get('pref')['categories'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->where('type', $pref['categories']);
            $ok = true;
        }

        if(!$ok) {
            $products_all = $products_all->orderBy('price', 'asc');
        }
        
        return $products_all;
    }

    public static function get_all_products() {
        $products_all = Product::where(['visible' => 1]);
        $ok = false;
        if(isset(Session::get('pref')['order'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->orderBy('price', $pref['order']);
            $ok = true;
        }
        if(isset(Session::get('pref')['price'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->whereBetween('price', [$pref['price']['start'], $pref['price']['end']]);
            $ok = true;
        }
        if(isset(Session::get('pref')['categories'])) {
            $pref = Session::get('pref');
            $products_all = $products_all->where('type', $pref['categories']);
            $ok = true;
        }

        if(!$ok) {
            $products_all = $products_all->orderBy('price', 'asc');
        }
        
        return $products_all;
    }

    public static function get_landing_women() {
        $products_all = Product::where(['category' => 1, 'visible' => 1])->get();

        for($i = 0; $i < 8; $i++) {
            $prof_fin[$i] = $products_all[$i];
        }

        return $prof_fin;
    }

    public static function get_landing_love() {
        $products_all = Product::where(['category' => 1, 'visible' => 1]);

        $products_all = $products_all->where('brand', 'Calvin Klein')->get();

        for($i = 0; $i < 4; $i++) {
            $prof_fin[$i] = $products_all[$i];
        }

        return $prof_fin;
    }

    public static function get_landing_yes() {
        $products_all = Product::where(['category' => 1, 'visible' => 1]);

        $products_all = $products_all->where('brand', 'Desigual')->get();

        for($i = 0; $i < 4; $i++) {
            $prof_fin[$i] = $products_all[$i];
        }

        return $prof_fin;
    }

    public function set_order(Request $request) {
        if(Session::has('pref')) {
            $pref = Session::get('pref');

            $pref['order'] = $request->order;
            Session::put('pref', $pref);
        }else {
            $pref = array();
            $pref['order'] = $request->order;
            Session::put('pref', $pref);
        }
    }

    public function set_price(Request $request) {
        if(Session::has('pref')) {
            $pref = Session::get('pref');

            $pref['price'] = array('start' => intval($request->price) * 200 - 200, 'end' => intval($request->price) * 200);
            Session::put('pref', $pref);
        }else {
            $pref = array();
            $pref['price'] = array('start' => intval($request->price) * 200 - 200, 'end' => intval($request->price) * 200);
            Session::put('pref', $pref);
        }

        return redirect()->route('women-shop');
    }

    public function set_category(Request $request) {
        if(Session::has('pref')) {
            $pref = Session::get('pref');

            $pref['categories'] = $request->type;
            Session::put('pref', $pref);
        }else {
            $pref = array();
            $pref['categories'] = $request->type;
            Session::put('pref', $pref);
        }

        return redirect()->route('women-shop');
    }

    public function del_pref(Request $request) {
        Session::forget('pref');
    }

}

?>