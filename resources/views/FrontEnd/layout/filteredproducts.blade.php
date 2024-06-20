@extends('FrontEnd.layout.layout')

@section('content')
<style>
    /* Add this to your CSS file */
    .products-box {
        overflow-x: auto;
        /* Enable horizontal scrolling */
        white-space: nowrap;
        /* Prevent line breaks */
    }

    .Product {
        display: inline-block;
        /* Display products inline */
        margin-right: 20px;
        /* Add margin between products */
    }
</style>
<div class="container mt-5">
    
    <div class="products-box d-flex flex-row">
        <!-- Use flexbox to display items horizontally -->
        @foreach($products as $product)
        <div class="Product">
            <div class="product-container">
                <div class="product-img">
                    <div class="img-container">

                    </div>
                </div>
                <div class="product-info">
                <a href="{{ route('productview', $product->id) }}"><img style="height:280px;width:17pc"src="{{ asset('uploads/'.$product->image) }}" class="card-img-top" alt=""></a>
                    <p class="title">{{ $product->name }}</p>
                    <p class="price">₹ {{ $product->price }}</p>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection