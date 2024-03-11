<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        return view('cart.index');
    }

    public function addProducttoCart($id, request $request) {
        $product = Products::findOrFail($id);
        $cart = session()->get('cart', []);
        // var_dump($cart); die;
        if(isset($cart[$id])) {
            $cart[$id]['qty'] += $request->quantity;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "qty" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }

    public function updateCart(Request $request)
    {
        // var_dump(intval($request->id),intval($request->qty)); die;
        $idProduct = intval($request->id);
        $qtyProduct = intval($request->qty);
        if($idProduct && $qtyProduct){
            $cart = session()->get('cart');
            $cart[$idProduct]["qty"] = $qtyProduct;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Update has been added to cart!');
        }
        // $sessionId = $request->session()->getId();
        // $input = $request->all();
        // var_dump($input);

        // foreach($request->all() as $item) {
        //         var_dump($item); die; 

        // }
        // if($request->id){
        //     $cart = session()->get('cart');

        //     foreach($request->all() as $item) {
        //         var_dump($item); die; 
        //     //         $cart[$request->id]["qty"] = $request->qty; 
                    
        //     //         session()->put('cart', $cart);
        //     // session()->flash('success', 'Product updated to cart.');
        //     }
            // $idProduct = Session::get('cart');
            // var_dump($cart['idProduct']); die;
            // var_dump($cart[$request->id]["qty"]); die; // 1 (one data)
            // foreach($cart[$request->id] as $id) {
            //     var_dump($id, $request->all); die; 
            //         $cart[$request->id]["qty"] = $request->qty; 
                    
            //         session()->put('cart', $cart);
            // session()->flash('success', 'Product updated to cart.');
            // }
            // $cart[$request->id]["qty"] = $request->qty;
            // session()->put('cart', $cart);
            // session()->flash('success', 'Product updated to cart.');
        // }
        // if($request->ajax()) {
        //     var_dump($request->qty); die;
        // }
    }

    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }

    public function checkout(Request $request) {
        // dd($request->all());
        $order = Order::create([
            'fullname' => $request->name,
            'total_price' => $request->total,
            'payment_status' => 1,
        ]);
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->total,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('cart.checkout', compact('order', 'snapToken'));
    }

    public function callback(Request $request) {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", rand().$request->status_code.$request->total.$serverKey);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture') {
                $order = Order::find($request->order_id);
                $order->update(['payment_status' => 2]);
            }
        }
    }
}
