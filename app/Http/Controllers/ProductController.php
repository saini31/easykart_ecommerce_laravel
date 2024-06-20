<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        // return view('Admin.Product.index', compact('products'));
        return view('Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('category_id')->get();
        return view('Admin.Product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            //  'image'=>$request->image

        );
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = date('dmY') . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("/uploads"), $fileName);
            $data['image'] = $fileName;
        }
        $products = Product::create($data);
        //    dd($data);
        return redirect()->route('product.list', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $categories = Category::whereNotNull('category_id')->get();

        return view('Admin.Product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $data = array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = date('dmY') . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("/uploads"), $fileName);
            $data['image'] = $fileName;
        }
        $create = Product::find($id);
        $create->update($data);
        // dd($data);
        return redirect()->route('product.list', compact('create'));
    }
    public function storeProductDetails(Request $request)
    {
        // Store product details in session
        session(['productDetails' => $request->productDetails]);

        return response()->json(['message' => 'Product details stored successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();
        return redirect()->route('product.list');
    }
    public function extraDetails(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id', $id)->with('ProductDetail')->first();
        return view('Admin.Product.extraDetails', compact('id', 'product'));
    }
    public function extraDetailsStore(Request $request)
    {
        $id = $request->id;

        $data = array(
            'title' => $request->title,
            'product_id' => $request->product_id,
            'total_items' => $request->total_items,
            'description' => $request->description
        );
        // dd($data);
        $productDeatails = ProductDetail::updateOrCreate(['product_id' => $id], $data);
        return redirect()->route('product.list');
    }
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    //     $products = Product::where('name', 'like', "%$query%")->get();
    //     dd($products);
    //     return view('partials.product_search_results', ['products' => $products]);
    // }
    // public function search(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Product::where('name', 'LIKE', '%' . $request->name . $request->id . '%')->get();
    //         $output = '';
    //         if (count($data) > 0) {
    //             $output = '<ul class="list-group" style="display:block;position:relative;z-index:1">';
    //             foreach ($data as $row) {
    //                 $output .= '<li class="list-group-item" id="searchproduct" data-id="' . $row->id . '" data-name="' . $row->name . '">';

    //                 // Wrap the product name in an anchor tag
    //                 $output .= '<a href="' . route('productview', ['id' => $row->id]) . '" style="text-decoration: none; color: inherit;">';
    //                 $output .= '<div class="d-flex justify-content-between align-items-center">';
    //                 $output .= '<div style="cursor:pointer;">' . $row->name . '</div>';
    //                 $output .= '<div>Price: $' . $row->price . '</div>';
    //                 $output .= '</div>';
    //                 $output .= '<div class="d-flex justify-content-between align-items-center">';
    //                 $output .= '<div><img src="' . asset('uploads/' . $row->image) . '" alt="' . $row->name . '" style="max-width: 100px; max-height: 100px;"></div>';
    //                 $output .= '</div>';
    //                 $output .= '</a>'; // Close the anchor tag
    //                 $output .= '</li>';
    //             }

    //             $output .= '</ul>'; // Close the ul tag
    //         } else {
    //             $output .= '<li class="list-group-item">No results found</li>'; // Add a message for no results
    //         }
    //         return $output; // Return the output
    //     }
    // }
    public function search(Request $request)
    {
        // Log the search query
        $query = $request->get('q');
        Log::info('Search query: ' . $query);

        // Fetch products matching the query
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        // Prepare the search results
        $results = [];
        foreach ($products as $product) {
            $results[] = [
                'id' => $product->id,
                'text' => $product->name,
                'price' => $product->price,
                'imageUrl' => asset('uploads/' . $product->image) // Ensure your Product model has image_url attribute
            ];
        }

        // Return the search results as JSON
        return response()->json(['results' => $results]);
    }
}
