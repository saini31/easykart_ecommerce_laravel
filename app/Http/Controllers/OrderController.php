<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;


class OrderController extends Controller
{


    // public function storeOrder(Request $request)
    // {
    //     // Retrieve data from the request
    //     $userId = auth()->id();
    //     $productId = $request->input('productId');
    //     $paymentId = $request->input('paymentId');
    //     $paymentMethod = 'Razorpay';
    //     $orderId = generateOrderId();

    //     // Retrieve price from the Cart model
    //     $cartItem = Cart::where('user_id', $userId)
    //         ->where('product_id', $productId)
    //         ->firstOrFail(); // Assuming there's only one cart item per user-product combination
    //     $price = $cartItem->product->price;

    //     // Store the data in the database
    //     $order = new Order();
    //     $order->user_id = $userId;
    //     $order->product_id = $productId;
    //     $order->order_id = $orderId;
    //     $order->price = $price;
    //     $order->payment_method = $paymentMethod;
    //     $order->razorpay_payment_id = $paymentId;
    //     $order->save();

    //     // Optionally, you can delete the item from the cart after placing the order
    //     $cartItem->delete();

    //     // Return a response, redirect, or perform any other actions as needed
    //     return response()->json(['success' => true, 'message' => 'Order placed successfully.']);
    // }
    // public function generateOrderId()
    // {
    //     $randomString = Str::random(6);

    //     // Generate a unique order ID using timestamp and random string
    //     $orderId = 'ORD_' . time() . '_' . $randomString;

    //     return $orderId;
    // }
    //  // Import your Payment model
    public function storeProductDetails(Request $request)
    {
        $productDetails = $request->input('productDetails');
        session(['productDetails' => $productDetails]);

        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $uniqueProductCount = 0;
        if (auth()->check()) {
            // Retrieve the authenticated user's payments
            $user_id = auth()->user()->id;
            $payments = Payment::where('user_id', $user_id)->get();

            // Optionally, you can also count the number of unique products in the payments
            $uniqueProductCount = $payments->unique('product_id')->count();
        }
        $categories = Category::whereNull('category_id')->get();

        $productDetails = session('productDetails', []);
        return view('FrontEnd.checkout', compact('productDetails', 'uniqueProductCount', 'categories'));
    }

    // use App\Models\Payment; // Assuming Payment model namespace

    public function savePaymentDetails(Request $request)
    {
        // Validate the request data if needed
        $orderId = 'ORDER_' . strtoupper(Str::random(8));
        $payment = new Payment();
        $payment->user_id = $request->input('user_id');

        // Access product_id from productDetails array
        $productDetails = $request->input('productDetails');
        if (!empty($productDetails) && is_array($productDetails)) {
            // Assuming there's only one product in the array, you may need to loop through if there are multiple products
            $payment->product_id = $productDetails[0]['product_id'];
            $payment->price = $productDetails[0]['price'];
        }

        $payment->payment_id = $request->input('payment_id');
        $payment->order_id = $orderId;

        // dd($payment);
        $payment->save();

        return response()->json(['success' => true]);
    }

    public function deletePayment(Request $request)
    {
        $payment = Payment::find($request->id);
        if ($payment) {
            $payment->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function showhistory()
    {
        // Initialize variables
        $payments = [];
        $uniqueProductCount = 0;
        $categories = Category::whereNull('category_id')->get();

        // Check if the user is authenticated
        if (auth()->check()) {
            // Retrieve the authenticated user's payments
            $user_id = auth()->user()->id;
            $payments = Payment::where('user_id', $user_id)->get();

            // Optionally, you can also count the number of unique products in the payments
            $uniqueProductCount = $payments->unique('product_id')->count();
        }

        // Return the view with the payments and unique product count
        return view('FrontEnd.orderhistory', compact('payments', 'uniqueProductCount', 'categories'));
    }
    // public function checkout(Request $request)
    // {



    //     return view('FrontEnd.checkout');
    // }
}
