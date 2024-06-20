@extends('Admin.layout.layout')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>SNo.</th>
            <th>Product Name</th>
            <th>Category Name</th>
            <th>Price</th>
            <th>Extra Details</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $key=>$product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$product->name}}</td>
            <td>@if($product->category_id)
                {{$product->category->name}}
                @endif
            </td>
            <td>{{$product->price}}</td>
            <td><button><a href="{{route('product.extraDetails',$product->id)}}">Add</a></button></td>
            <td><img src="{{asset('uploads/'.$product->image)}}" alt="Product Image" style="width:20px;"></td>
            <td>
                <a href="{{route('product.edit',$product->id)}}" style="font-size:17px;padding:5px;"><i class="fa fa-edit"></i></a>
                <!-- <form id="delete-form" action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fa fa-trash"></button>
                </form> -->
                <form id="delete-form" action="{{ route('product.delete', ['id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fa fa-trash"></button>
                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
<script>
    // Submit the form asynchronously
    $('#delete-form').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');

        $.ajax({
            url: url,
            method: method,
            data: form.serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
</script>