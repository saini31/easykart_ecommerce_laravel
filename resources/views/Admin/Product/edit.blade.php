@extends('Admin.layout.layout')
@section('content')
<!-- <h1>hii</h1> -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Design <small>different from elements</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form id="demo-form2" action="{{route('product.update',$product->id)}}" method="post" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Category Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="category_id" class="form-control col-md-7 col-xs-12" required="">
                                <option value="">Category Name</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($product->category_id==$category->id) selected @endif>{{$category->name}}</option>

                                @endforeach
                            </select>
                            <!-- <input id="name" class="form-control col-md-7 col-xs-12" name="name" required type="text"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control col-md-7 col-xs-12" value="{{$product->name}}" name="name" required=" ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Price <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" class="form-control col-md-7 col-xs-12" value="{{$product->price}}" name="price" required=" ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Image <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" class="form-control col-md-7 col-xs-12" name="image" required=" ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-6 col-sm-6 col-xs-12"></div>

                                <img style="height:20px;width:20px;" src="{{asset('uploads/'.$product->image)}}">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"></div>
                            <input type="submit" class="btn btn-success" value="">
                        </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection