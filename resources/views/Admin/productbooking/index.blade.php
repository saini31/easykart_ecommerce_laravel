
@extends('Admin.layout.layout')
@section('content')
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th> S.no</th>
            <th> Product Name</th>
            <th> User Name</th>
            <th> Qty</th>
            <th> Total Amount</th>
            <th>Payment Status</th>
            <th>Booking Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
       @foreach($booking_products as $key=>$booking_product)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$booking_product->product->name}}</td>
            <td>{{$booking_product->user->name}}</td>
            <td>{{$booking_product->qty}}</td>
            <td>{{$booking_product->qty*$booking_product->product->price}}</td>
            <td>{{$booking_product->payment_status}}</td>
            <td>
                <select name="" id="" class="book_status" data-id="{{$booking_product->id}}">
                @php $book_status=$booking_product->booking_status; @endphp
                    <option value="0" @if($book_status=='0') selected @endif >InProgress</option>
                    <option value="1" @if($book_status=='1') selected @endif>Booking Cancel</option>
                    <option value="2" @if($book_status=='2') selected @endif>Booked</option>
                </select>
            </td>
            <td><form id="delete-form" action="{{ route('prdt_delete', ['id' => $booking_product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fa fa-trash"></button>
                </form>  </td>
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
@push('footer-script')
<script>
    $('.book_status').on('change',function(){
        var booking_status=$(this).val();
        var id=$(this).data('id');
        $.ajax({
           url:'{{route("booking.product.status")}}' ,
           data:{
            'booking_status':booking_status,
            'id':id,
           }
        });
});
</script>

@endpush