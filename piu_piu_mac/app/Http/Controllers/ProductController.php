<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Session;

class ProductController extends Controller
{
    public function index()
        {
            return response()->json(Product::all(),200);
        }

        public function store(Request $request)
        {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'brand' => $request->brand,
                'type' => $request->type,
                'category' => $request->category,
                'units' => $request->units,
                'price' => $request->price,
                'discount' => $request->discount,
                'image' => $request->image
            ]);

            return response()->json([
                'status' => (bool) $product,
                'data'   => $product,
                'message' => $product ? 'Product Created!' : 'Error Creating Product'
            ]);
        }

        public function show(Product $product)
        {
            return response()->json($product,200); 
        }

        public function uploadFile(Request $request)
        {
            if($request->hasFile('image')){
                $name = time()."_".$request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('images'), $name);
            }
            return response()->json(asset("images/$name"),201);
        }

        public function update(Request $request, Product $product)
        {
            $status = $product->update(
                $request->only(['name', 'description', 'brand', 'type', 'category', 'units', 'price', 'discount', 'image'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Product Updated!' : 'Error Updating Product'
            ]);
        }

        public function updateUnits(Request $request, Product $product)
        {
            $product->units = $product->units + $request->get('units');
            $status = $product->save();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
            ]);
        }

        public function destroy(Product $product)
        {
            $status = $product->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Product Deleted!' : 'Error Deleting Product'
            ]);
        }

        public function generate_product_page($id) {
            $product = Product::find($id);
    
            return view('product')->with('product', $product);
        }

        public function apply_discount($price, $discount) {
            return $price - ($price * ($discount / 100));
        }

        public function add_to_cart($id) {

            $product = Product::find($id);
            $cart = session()->get('cart', []);

            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }else {

                if($product->discount != 0) {
                    $price = $this->apply_discount($product->price, $product->discount);
                }else {
                    $price = $product->price;
                }

                $cart[$id] = [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $price,
                    'image' => $product->image
                ];
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'added');
        }

        public function delete_from_cart($id) {
            
            $cart = session()->get('cart');

            if(isset($cart[$id])) {
                unset($cart[$id]);

                if(sizeof($cart) == 0) {
                    session()->forget('cart');
                }else {
                    session()->put('cart', $cart);
                }
            }

            //session()->flash('succes', 'yes');
            return redirect()->back()->with('success', 'succes');
        }

        public function update_cart(Request $request) {
            $id = $request->get('id');
            $cart = session()->get('cart', []);

            if($request->get('met') == 'inc') {
                $cart[$id]['quantity']++;
            }else {
                $cart[$id]['quantity']--;
            }
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'added');
        }

        public static function get_type(Product $prod) {
            return DB::select("SELECT * FROM categories WHERE id = " . $prod->type);
        }

        public static function get_types(Product $prod) {
            return DB::select("SELECT * FROM categories WHERE gen = " . $prod->category . " OR gen = 4");
        }

        
}
