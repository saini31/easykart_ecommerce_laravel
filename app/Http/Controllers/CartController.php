<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $product_id = $request->product_id;
        $qty = $request->qty;

        // Check if the product already exists in the cart for the authenticated user
        $existingCartItem = Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
           // dd($existingCartItem);

        if ($existingCartItem) {
            // If the product exists, increase the quantity by the requested quantity
            $existingCartItem->update([
                'qty' => $existingCartItem->qty + $qty,
                'price' => $existingCartItem->price + ($qty * $existingCartItem->product->price)
            ]);
        } else {
            // If the product does not exist, add it to the cart with the requested quantity
            $product = Product::find($product_id);
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found.');
            }
            $totalPrice = $product->price * $qty;

            $data = [
                'product_id' => $product_id,
                'qty' => $qty,
                'price' => $totalPrice,
                'user_id' => $user_id,
            ];

            // Create cart item
            Cart::create($data);
        }

        return redirect()->route('cart');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart, Request $request)
    {
        $product_id = $request->product_id;
        $id = $request->id;
        $count = Cart::count($product_id);
        return view('cart', compact('count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart, Request $request)
    {

        $id = $request->id;
        $cart = Cart::where('id', $id)->first();
        $cart->delete();
    }
    public function updateCart(Request $request) {
        $cartId = $request->input('cart_id');
        $newQuantity = $request->input('quantity');
    
        // Update the quantity in your database or wherever your cart data is stored
        $cart = Cart::find($cartId);
        $cart->qty = $newQuantity;
        $cart->save();
    
        // Calculate new total price
        $totalPrice = $cart->product->price * $newQuantity;
    
        return response()->json(['total_price' => $totalPrice]);
    }
    
}
