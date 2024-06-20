<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
//use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BaseController extends Controller
{
    //
    public function Home()
    {
        // dd('hello');
        $categories = Category::whereNull('category_id')->get();
        $products = Product::get();
        $new_products = Product::limit(6)->latest()->get();
        $uniqueProductCount = 0;

        // Check if the user is authenticated
        if (auth()->check()) {
            // Retrieve the user's cart items
            $user_id = auth()->user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }
        return view('FrontEnd.Home', compact('products', 'new_products', 'uniqueProductCount', 'categories'));
    }
    //     public function index()
    // {
    //     $categories = Category::all();
    //     return view('FrontEnd.Home', compact('categories'));
    // }
    public function specialOffer()
    {
        $uniqueProductCount = 0;
        if (Auth::user()) {
            // Retrieve the user's cart items
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }

        return view('FrontEnd.specialOffer', compact('uniqueProductCount'));
    }
    public function delivery()
    {
        return view('FrontEnd.delivery');
    }
    public function contact()
    {
        $uniqueProductCount = 0;
        if (Auth::user()) {

            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
            $uniqueProductCount = $carts->unique('product_id')->count();
        }
        return view('FrontEnd.contact', compact('uniqueProductCount'));
    }
    //     use App\Models\Cart;
    // use Illuminate\Support\Facades\Auth;

    public function cart()
    {
        $categories = Category::whereNull('category_id')->get();
        $uniqueProductCount = 0; // Initialize unique product count
        $carts = []; // Initialize variable to hold cart items

        // Check if the user is authenticated
        if (Auth::user()) {
            // Retrieve the user's cart items
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }
        $user_id = Auth::user()->id;

             $cart=Cart::where('product_id',$user_id)->get();

        return view('FrontEnd.cart', compact('carts', 'uniqueProductCount', 'categories','cart'));
    }

    public function productview($id)
    {
        // dd($id);
        $categories = Category::whereNull('category_id')->get();
        $product = Product::where('id', $id)->with('ProductDetail', 'category')->first();
        // dd($product);


        $category_id = $product->category_id;
        $related_products = Product::where('category_id', $category_id)->get();
        $uniqueProductCount = 0;
        if (auth()->check()) {
            // Retrieve the user's cart items
            $user_id = auth()->user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }
        return view('FrontEnd.productview', compact('product', 'related_products', 'uniqueProductCount', 'categories'));
    }
    public function user_login()
    {
        $uniqueProductCount = 0;
        $categories = Category::whereNull('category_id')->get();
        if (auth()->check()) {
            // Retrieve the user's cart items
            $user_id = auth()->user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }
        return view('FrontEnd.login', compact('uniqueProductCount', 'categories'));
    }
    public function login_check(Request $request)
    {

        $data = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::attempt($data)) {
            return redirect()->route('home');
        } else {

            dd('hii');
        }
    }
    // public function productByCategory()
    // {
    //     // Retrieve top-level categories that don't have a parent category
    //     $categories = Category::whereNull('category_id')->get();

    //     // Initialize an array to store products associated with each category
    //     $productsByCategory = [];

    //     foreach ($categories as $category) {
    //         // Retrieve associated products for each category
    //         $products = $category->products()->get();

    //         // Store products in the array using category ID as key
    //         $productsByCategory[$category->id] = $products;
    //     }

    //     $uniqueProductCount = 0;
    //     if (auth()->check()) {
    //         // Retrieve the user's cart items
    //         $user_id = auth()->user()->id;
    //         $carts = Cart::where('user_id', $user_id)->get();

    //         // Count the number of unique products in the cart
    //         $uniqueProductCount = $carts->unique('product_id')->count();
    //     }

    //     return view('FrontEnd.layout.filteredproducts', compact('uniqueProductCount', 'productsByCategory'));
    // }
    //     public function productsByCategory(Request $request)
    // {
    //     $categoryId=$request->categoryId;
    //     //dd($categoryId);


    //     $category=Category::findOrFail($categoryId);

    //     //$products = $category->products;
    //     $products=Category::where('category_id',$categoryId)->get();


    //     // $products=Product::where('id',$categoryId)->get();
    //    // dd($products);
    //    // $products = $category->products;// Fetch all products
    //    //dd( $subcategory);
    //    $products=Product::where('category_id','id')->get();
    //     $uniqueProductCount = 0;
    //         if (auth()->check()) {
    //              // Retrieve the user's cart items
    //             $user_id = auth()->user()->id;
    //             $carts = Cart::where('user_id', $user_id)->get();

    //             // Count the number of unique products in the cart
    //             $uniqueProductCount = $carts->unique('product_id')->count();
    //         }
    //         $categories = Category::whereNull('category_id')->get();
    //     return view('FrontEnd.layout.filteredproducts', compact('products','uniqueProductCount','categories','category'));
    // }
    public function productsByCategory(Request $request)
    {
        $categoryId = $request->categoryId;

        // Find the main category by its ID
        $mainCategory = Category::findOrFail($categoryId);

        // Retrieve subcategories whose category_id matches the ID of the main category
        $subcategories = Category::where('category_id', $categoryId)->get();

        // Initialize an empty collection for products
        $products = collect();

        // Check if there are subcategories
        if ($subcategories->isNotEmpty()) {
            // Retrieve products that belong to subcategories of the main category
            foreach ($subcategories as $subcategory) {
                $products = $products->merge($subcategory->products);
            }
        }
        // dd($products);

        $uniqueProductCount = 0;
        if (auth()->check()) {
            // Retrieve the user's cart items
            $user_id = auth()->user()->id;
            $carts = Cart::where('user_id', $user_id)->get();

            // Count the number of unique products in the cart
            $uniqueProductCount = $carts->unique('product_id')->count();
        }

        $categories = Category::whereNull('category_id')->get();

        return view('FrontEnd.layout.filteredproducts', compact('products', 'uniqueProductCount', 'categories'));
    }


    public function storeProductDetails(Request $request)
    {
        // Store product details in session
        session(['productDetails' => $request->productDetails]);

        return response()->json(['message' => 'Product details stored successfully']);
    }


    public function user_store(Request $request)
    {

        $data = array(
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        );
        //    dd($data);
        $user = User::create($data);
        return redirect()->route('user_login');
    }
    public function user_logout()
    {
        Auth::logout();
        return redirect()->route('user_login');
    }
}
