<!-- <h1>contact</h1> -->

@extends('FrontEnd.layout.layout2')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img style="width:100%;" src="https://rukminim1.flixcart.com/fk-p-flap/1600/270/image/39e0ff6c696ced29.png?q=20" alt="" />
        </div>
        <div class="carousel-item">
            <img style="width:100%;max-height:300px;" src="https://rukminim2.flixcart.com/fk-p-flap/1600/270/image/1f25201ced5d720d.jpg?q=20" alt="special offers" />
        </div>
        <div class="carousel-item">
            <img style="width:100%;max-height:300px;" src="https://rukminim1.flixcart.com/fk-p-flap/1600/270/image/49859b265f9f4b50.png?q=20" alt="special offers" />
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="mt-5">

    <div class="well well-small">
        <h4>Featured Products <small class="pull-right"></small></h4>
        <div class="row">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">
                    @php $i=0; @endphp
                    @foreach($products->chunk(4) as $productChunk)
                    <div class="carousel-item @if($i==0) active @endif">
                        @php $i=1; @endphp
                        <div class="row">
                            @foreach($productChunk as $product)
                            <div class="col-md-3">
                                <div class="thumbnail card">
                                    <a href="{{ route('productview', $product->id) }}"><img src="{{ asset('uploads/'.$product->image) }}" class="card-img-top" alt=""></a>
                                    <div class="caption card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">${{ $product->price }}</p>


                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#featured" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


    </div>
    <h4>Latest Products </h4>
    <div class="container">
        <div class="row">
            @foreach($new_products as $new_product)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <a href="{{ route('productview', $new_product->id) }}">
                        <img src="{{ asset('uploads/'.$new_product->image) }}" class="card-img-top" alt="" />
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $new_product->name }}</h5>
                        <div class="card-text">
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="qty" placeholder="Qty." value="1" required>
                                    <input type="hidden" value="{{ $new_product->id }}" name="product_id" required>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                </div>
                            </form>
                            <p class="card-text">${{ $new_product->price }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
</div>
<style>
    .card-img-top {
        height: 200px;
        width: 200px;
    }
</style>
@endsection