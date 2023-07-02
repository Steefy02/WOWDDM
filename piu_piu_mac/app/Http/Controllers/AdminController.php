<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Categories;
use Auth;
use DB;
use Storage;
use App\Http\Controllers\UserController;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(Auth::user()->is_admin) {
            return view('Admin.main');
        }else {
            return redirect()->route('home');
        }
    }

    public function clients_page() {
        if(Auth::user()->is_admin) {
            return view('Admin.users');
        }else {
            return redirect()->route('home');
        }
    }

    public function products_page() {
        if(Auth::user()->is_admin) {
            return view('Admin.products');
        }else {
            return redirect()->route('home');
        }
    }

    public function orders_page() {
        if(Auth::user()->is_admin) {
            return view('Admin.orders');
        }else {
            return redirect()->route('home');
        }
    }

    public function display_user($id) {
        $user = User::find($id);
        return view('Admin.singleuser')->with('user', $user);
    }

    public function display_product($id) {
        $product = Product::find($id);
        return view('Admin.singleproduct')->with('product', $product);
    }

    public function edit_user(Request $request, $id) {
        $user = User::find($id);
        $user->update(
            ['email' => $request->get('email')]
        );

        //return response()->json(['is_admin' => $request->get('admin')]);

        if($request->get('admin') === 'on') {
            $user->update(['is_admin' => true]);
            //return response()->json(['is_admin' => 'should be admin']);
        }else {
            $user->update(['is_admin' => false]); //@FIXME
            //return response()->json(['is_admin' => 'nop']);
        }


        return redirect()->back()->with('message', 'Userul a fost actualizat cu succes!');
    }

    public function edit_product(Request $request, $id) {
        $product = Product::find($id);
        if($request->checkVal == "ok") {

            $type = "";

            if($request->category == "1") {
                $type = "typefemei";
            }else if($request->category == '2') {
                $type = "typebarbati";
            }else if($request->category == '3') {
                $type = "typecopii";
            }

            //dd($request);

            $product->update(['name' => $request->get('name'), 'description' => $request->get('description'), 'brand' => $request->get('brand'), 'full_description' => $request->get('full_description'), 'units' => $request->get('units'), 'price' => $request->get('price'), 'discount' => $request->get('discount'), 'size' => $request->get('size'), 'material' => $request->get('material') ,'type' => $request->get($type), 'category' => $request->get('category')]);
            
            if($request->visible == 'yes') {
                $product->update(['visible' => '1']);
            }else {
                $product->update(['visible' => '0']);
            }
            
            return redirect()->back()->with('message', 'uploaded');
        }else if($request->checkVal == 'no'){
            self::deleteProduct($product->id);
            return redirect()->route('admin-products');
        }else if($request->checkVal == 'go') {
            return redirect()->route('product-single', ['id'=>$product->id]);
        }
    }

    public function get_add_product_page() {
        return view("Admin.addproduct");
    }

    public static function get_all_categories() {
        return DB::select("SELECT * FROM categories");
    }

    public function addProduct(Request $request) {

        $visible = "";
            $xs = "";
            $s = "";
            $m = "";
            $l = "";
            $xl = "";

            if($request->visible == 'yes') {
                $visible = "1";
            }else {
                $visible = "0";
            }

            if($request->has('xs')) {
                $xs = "1";
            }else {
                $xs = "0";
            }
            if($request->has('s')) {
                $s  ="1";
            }else {
                $s = "0";
            }
            if($request->has('m')) {
                $m = "1";
            }else {
                $m = '0';
            }
            if($request->has('l')) {
                $l = "1";
            }else {
                $l = "0";
            }
            if($request->has('xl')) {
                $xl = "1";
            }else {
                $xl = "0";
            }

        if($request->category == '1') {

            if($request->hasFile('upFile')) {
                $file = $request->file('upFile');
                $filename = $file->getClientOriginalName();
                $file->move("uploads/", $filename);



                $product = Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'full_description' => $request->full_description,
                    'brand' => $request->brand,
                    'type' => $request->typefemei,
                    'category' => $request->category,
                    'units' => $request->units,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'visible' => $visible,
                    'XS' => $xs,
                    'S' => $s,
                    'M' => $m,
                    'L' => $l,
                    'XL' => $xl,
                    'image' => $filename
                ]);
            }
        }else if($request->category == '2') {
            if($request->hasFile('upFile')) {
                $file = $request->file('upFile');
                $filename = $file->getClientOriginalName();
                $file->move("uploads/", $filename);

                $product = Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'full_description' => $request->full_description,
                    'brand' => $request->brand,
                    'type' => $request->typebarbati,
                    'category' => $request->category,
                    'units' => $request->units,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'visible' => $visible,
                    'XS' => $xs,
                    'S' => $s,
                    'M' => $m,
                    'L' => $l,
                    'XL' => $xl,
                    'image' => $filename
                ]);
            }
        }else if($request->category == '3'){
            if($request->hasFile('upFile')) {
                $file = $request->file('upFile');
                $filename = $file->getClientOriginalName();
                $file->move("uploads/", $filename);

                $product = Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'full_description' => $request->full_description,
                    'brand' => $request->brand,
                    'type' => $request->typecopii,
                    'category' => $request->category,
                    'units' => $request->units,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'visible' => $visible,
                    'XS' => $xs,
                    'S' => $s,
                    'M' => $m,
                    'L' => $l,
                    'XL' => $xl,
                    'image' => $filename
                ]);
                
            }
        }else {
            return redirect()->back()->with('errMsg', 'date gresite');
        }

        return redirect()->back()->with('message', 'uploaded');

    }

    public function deleteProduct( $id) {
        $product = Product::find($id);
        //dd($product);
        $product->delete();
        //return redirect()->route('admin-products');
    }

    public function get_categories_page() {
        return view("Admin.categories");
    }

    public function get_single_category($id) {
        $category = Categories::find($id);
        return view('Admin.singlecategory')->with('category', $category);
    }

    public function editCategory(Request $request, $id) {
        $category = Categories::find($id);

        if($request->checkVal == "ok") {
            $category->update(['name' => $request->name, 'gen' => $request->gen]);
            return redirect()->back()->with('message', 'updated');
        }else{
            $category->delete();
            return redirect()->route('admin-categories');
        }
    }

    public function get_add_category() {
        return view('Admin.addcategory');
    }

    public function admin_add_category_post(Request $request) {
        Categories::create(['name' => $request->name, 'gen' => $request->gen]);
        return redirect()->route('admin-categories');
    }

    public function get_outfits_page() {
        return view('Admin.outfits');
    }

    public function get_promotions_page() {
        return view('Admin.promotions');
    }

    public function change_product_visibility(Request $request) {
        $product = Product::find($request->id);

        if($request->state == '1') {
            $product->update(['visible' => '0']);
        }else if($request->state == '0') {
            $product->update(['visible' => '1']);
            //echo $product;
        }

        //return redirect()->back();
    }

}
