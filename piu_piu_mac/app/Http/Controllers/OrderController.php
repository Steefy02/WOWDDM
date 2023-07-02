<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use App\Models\OrderDetails;
use App\Models\Product;
use Session;

class OrderController extends Controller
{
    public function index()
        {
            return response()->json(Order::with(['product'])->get(),200);
        }

        public function deliverOrder(Order $order)
        {
            $order->is_delivered = true;
            $status = $order->save();

            return response()->json([
                'status'    => $status,
                'data'      => $order,
                'message'   => $status ? 'Order Delivered!' : 'Error Delivering Order'
            ]);
        }

        public function store(Request $request)
        {
            $order = Order::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
                'address' => $request->address
            ]);

            return response()->json([
                'status' => (bool) $order,
                'data'   => $order,
                'message' => $order ? 'Order Created!' : 'Error Creating Order'
            ]);
        }

        public function show(Order $order)
        {
            return response()->json($order,200);
        }

        public function update(Request $request, Order $order)
        {
            $status = $order->update(
                $request->only(['quantity'])
            );

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Updated!' : 'Error Updating Order'
            ]);
        }

        public function destroy(Order $order)
        {
            $status = $order->delete();

            return response()->json([
                'status' => $status,
                'message' => $status ? 'Order Deleted!' : 'Error Deleting Order'
            ]);
        }

        public function process_order(Request $request) {
            $user = Auth::user();
            $order = new Order;

            $order->user_id = $user->id;
            $order->status = "Comanda plasata";
            $address = $request->billing_address . ", " . $request->billing_city . ", " . $request->billing_county . ", " . $request->billing_zip;
            $order->address = $address;
            $order->type = "ramburs";
            $order->price = intval($request->price);
            $order->save();

            $cart = Session::get('cart');
            
            foreach($cart as $id => $details) {
                $det = new OrderDetails;
                $det->id_Order = $order->id;
                $det->id_Product = $id;
                $det->quantity = intval($details['quantity']);
                $det->save();
            }

            Session::forget('cart');

            return 200;
            
        }
}
