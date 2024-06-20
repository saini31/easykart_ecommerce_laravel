<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Exception;

class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
             dd("hii");
        return view('FrontEnd.razorpay');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function store(Request $request)
    // {    


    //     // $razorpayPaymentId = $request->input('razorpay_payment_id');
    //     // dd( $razorpayPaymentId ); 
    //     // dd( $razorpayPaymentId );
    //     // dd($razorpayPaymentId);

    //     $input = $request->all();



    //     $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));


    //     $payment = $api->payment->fetch($input['razorpay_payment_id']);

    //            dd($payment);
    //     if (count($input) && !empty($input['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

    //             // Store payment information into the database
    //             $order_id = 'ORD' . uniqid();
    //             $data = Payment::create([
    //                 'payment_id' => $input['razorpay_payment_id'],
    //                 'user_id' => auth()->id(), // assuming you're using authentication
    //                 'product_id' => $request->product_id, // assuming you pass product_id in the request
    //                 'order_id' => $order_id,
    //                 'amount' => $payment['amount'],
    //             ]);
    //             dd($data);


    //             // Redirect back to the cart or any other page
    //             Session::put('success', 'Payment successful');
    //             return redirect()->route('cart.index'); // Adjust route according to your application
    //         } catch (Exception $e) {
    //             Session::put('error', $e->getMessage());
    //             return redirect()->back();
    //         }
    //     }
    // }
    public function store(Request $request)
    {

        // Retrieve all input data from the request
        $input = $request->all();

        dd($input);
        // Check if 'razorpay_payment_id' exists in the input data
        if (isset($input['razorpay_payment_id'])) {
            // Get Razorpay API credentials from environment variables
            $keyId = env('RAZORPAY_KEY_ID');
            dd($keyId);
            $keySecret = env('RAZORPAY_KEY_SECRET');

            // Initialize Razorpay API with credentials
            $api = new Api($keyId, $keySecret);

            try {
                // Fetch payment details from Razorpay API
                $payment = $api->payment->fetch($input['razorpay_payment_id']);

                // Capture payment
                $response = $api->payment->capture([
                    'payment_id' => $input['razorpay_payment_id'],
                    'amount' => $payment['amount'],
                ]);

                // Store payment information into the database
                $order_id = 'ORD' . uniqid();
                $data = Payment::create([
                    'payment_id' => $input['razorpay_payment_id'],
                    'user_id' => auth()->id(), // Assuming you're using authentication
                    'product_id' => $request->product_id, // Assuming you pass product_id in the request
                    'order_id' => $order_id,
                    'amount' => $payment['amount'],
                ]);

                // Redirect back to the cart or any other page
                Session::flash('success', 'Payment successful');
                return redirect()->route('cart.index'); // Adjust route according to your application
            } catch (Exception $e) {
                // Handle any errors that occur during the payment process
                Session::flash('error', $e->getMessage());
                return redirect()->back();
            }
        } else {
            // If 'razorpay_payment_id' is not found in the input data
            Session::flash('error', 'Payment ID not found');
            return redirect()->back();
        }
    }

    // public function store(Request $request)
    // {
    //     // Handle payment response from Razorpay
    //     dd($request);
    //     $input = $request->all();
    //     $razorpay_payment_id = $input['razorpay_payment_id'];
    //         dd($razorpay_payment_id);
    //     // Save payment details in your database
    //     // Example: Payment::create([...]);

    //     // Redirect the user or show a success message
    //     return redirect()->route('payment.success');
    // }
}
