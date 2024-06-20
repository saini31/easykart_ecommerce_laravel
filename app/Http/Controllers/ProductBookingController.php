<?php

namespace App\Http\Controllers;
use App\Models\Order; 
use App\Models\ProductBooking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\DB;

class ProductBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_products = ProductBooking::get();
        return view('admin.productbooking.index', compact('booking_products'));
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

        $cart_id = $request->cart_id;

        $data = array();
        // dd($data);

        $amount = 0;
        foreach ($cart_id as $i => $value) {
            //             DB::enableQueryLog("hiii");
            // $cart = Cart::find(intval($value));
            // Log::info(DB::getQueryLog());

            $cart = Cart::find(36);
            // dd($cart);
            // $cart = Cart::find(intval($value));
            // dd($cart);
            $amount = $amount + $cart->product->price;
            $data[$i]['user_id'] = $cart->user_id;
            $data[$i]['product_id'] = $cart->product_id;
            $data[$i]['qty'] = $cart->qty;
            $data[$i]['payment_status'] = '0';
        }
        $ProductBooking = ProductBooking::insert($data);
        $bookIds = ProductBooking::orderBy('id', 'desc')->take(count($data))->pluck('id');

        if ($ProductBooking) {
            $request['razorpay_payment_id'] = '87788945543';
            dd($request);
            Cart::destroy($cart_id);
            if ($request->payment_type == 'eway') {
                Session::put('bookIds', $bookIds);
                $url = $this->ewayPayment($amount);
                return response()->json(['type' => 'eway', 'url' => $url]);
            } else if ($request->payment_type == 'razorpay') {


                $Controller = new RazorpayPaymentController;
                $data = $Controller->store($request);
                //dd($data);
                 return redirect()->route('razorpay');
            } else {
                return response()->json(['type' => 'pay_person']);
            }
        }
    }
    public function razorpayStore(Request $request)
    {
        dd("hii");

        // Process Razorpay payment here
        $cart = Cart::find(69);

        $cart_id = $request->cart_id;


        $payment_type = $request->payment_type;

        // Use Razorpay API keys
        $keyId = config('services.razorpay.key');
        $keySecret = config('services.razorpay.secret');

        $api = new Api($keyId, $keySecret);

        // Calculate the total amount based on cart items
        $total_amount = 0;
        foreach ($cart_id as $value) {
            $cart = Cart::find($value);
            $total_amount += $cart->product->price;
        }

        // Create order
        $orderData = [
            'receipt' => 'order_receipt_' . time(),
            'amount' => $total_amount * 100, // Convert amount to paise
            'currency' => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        $order = $api->order->create($orderData);

        // Get payment URL
        $paymentUrl = $order->short_url;

        // Assuming successful order creation, you can now redirect to the payment URL
        return response()->json(['type' => 'razorpay', 'url' => $paymentUrl]);
    }

    public function ewayPayment($amount)
    {
        $total_amount = $amount;
        $apiKey = '60CF3Csu4YKjfmngBSRYGw/LmXERlAuGM1cYM+BRWJP5TSoAGrp7lf4sDDWTXvKw5ghQrG';
        $apiPassword = 'aAggxi0I';
        $apiEndpoint = 'Sandbox';
        $client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);
        $transaction = [
            'RedirectUrl' => route('product.bookingSuccess'),
            'CancelUrl' => route('product.bookingFail'),
            'TransactionType' => \Eway\Rapid\Enum\TransactionType::PURCHASE,
            'Payment' => [
                'TotalAmount' => $total_amount * 100,
            ]
        ];
        //submit datge to eway
        $response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::RESPONSIVE_SHARED, $transaction);
        //check for any errors
        $sharedURL = '';
        if (!$response->getErrors()) {
            $sharedURL = $response->SharedPaymentUrl;
        }
        return  $sharedURL;
    }
    public function bookingFail()
    {
        Session::forget('bookIds');
        return redirect()->route('cart');
    }
    public function bookingSuccess()
    {
        $bookIds = Session::get('bookIds');
        ProductBooking::whereIn('id', $bookIds)->update(['payment_status' => '1']);
        Session::forget('bookIds');
        return redirect()->route('cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductBooking $productBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductBooking $productBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBooking  $productBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductBooking $productBooking, Request $request)
    {
        $id = $request->id;
        $bookedProduct = ProductBooking::find($id);
        $bookedProduct->delete();
        return redirect()->route('booking.products');
    }
    public function change_productbooking_status(Request $request)
    {
        $id = $request->id;
        $booking_status = $request->booking_status;
        $booking_product = ProductBooking::where('id', $id)->update([
            'booking_status' => $booking_status
        ]);
    }
    // Assuming you have an Order model

public function handlePaymentSuccess(Request $request)
{
    // Retrieve data from the request
    $productId = $request->input('productId');
    $paymentId = $request->input('paymentId');
    $userId = auth()->id(); // Assuming you're using Laravel's built-in authentication
    $paymentMethod = 'Razorpay'; // Assuming you're using Razorpay
    $orderId = generateOrderId(); // You can generate order ID based on your system's logic
    
    // Store the data in your database
    $order = new Order();
    $order->user_id = $userId;
    $order->product_id = $productId;
    $order->payment_id = $paymentId;
    $order->payment_method = $paymentMethod;
    $order->order_id = $orderId;
    $order->save();

    // You may also want to update the status of the product, mark it as sold or update its inventory, etc.

    // Return a response, redirect, or perform any other actions as needed
    return response()->json(['success' => true, 'message' => 'Payment successful.']);
}

 public function generateOrderId(){
    $randomString = Str::random(6);

    // Generate a unique order ID using timestamp and random string
    $orderId = 'ORD_' . time() . '_' . $randomString;

    return $orderId;
 }

}
