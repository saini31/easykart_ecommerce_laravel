@extends('FrontEnd.layout.layout')

@section('content')
<div class="span9 mt-5">
	<ul class="breadcrumb">
		<li class="active"> SHOPPING CART</li>
		<a href="{{ route('orders.product', ['id' => Auth::id()]) }}">View Orders</a>
	</ul>

	<hr class="soft" />
	<style>
		.buyNowButton {
			background-color: blue;
			border: 5px solid white;
			padding: 10px;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
			display: block;
			margin: auto;
			text-align: center;
		}

		.buyNowButton:hover {
			text-shadow: 0 0 8px blue;
		}

		.btnn {
			background-image: url(https://m.media-amazon.com/images/S/sash/fo5c7019B0Hy4wH.png);
		}
	</style>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Product</th>
				<th>Name</th>
				<th>Qty/Remove</th>
				<th>Select</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@php $sum = 0; @endphp
			@foreach($carts as $cart)
			@php $sum += $cart->product->price * $cart->qty; @endphp
			<tr>
				<td><img height="88" width="60" src="{{ asset('uploads/'.$cart->product->image) }}" alt="" /></td>
				<td>{{ $cart->product->name }}</td>
				<td>
					<div class="input-append">
						<input class="span1" style="height:36px;width:36px;" placeholder="1" value="{{ $cart->qty }}" id="appendedInputButtons" size="16" type="number">
						<button class="btn btn-primary btn_close" data-id="{{ $cart->id }}" type="button"><i class="icon-remove icon-white"></i></button>
					</div>
				</td>
				<td><input type="checkbox" style="height:16px;width:16px;color:blue;vertical-align: middle; " class="btnn" name="select_product[]" cart-id="{{ $cart->id }}"></td>
				<td>${{ $cart->product->price * $cart->qty }}</td>
				@csrf
				<input class="productid" type="hidden" value="{{ $cart->product->id }}">
				<td><button class="buyNowButton">Buy Now</button></td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4" style="text-align:right">Total Price:</td>
				<td>$ {{ $sum }}</td>
			</tr>
		</tbody>
	</table>
</div>
@endsection

@push('footer-script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
	// Set up CSRF token for AJAX requests
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// Handle deletion of items from the cart
	$('.btn_close').on('click', function() {
		if (confirm('Are you sure?')) {
			var id = $(this).data('id');

			$.ajax({
				url: '{{ route("cart.delete") }}',
				method: 'DELETE',
				data: {
					id: id
				},
				success: function(data) {
					location.reload();
				},
				error: function(xhr, status, error) {
					console.error('Error deleting product from cart:', error);
				}
			});
		}
	});

	var productDetails = [];

	// Handle purchase of selected items
	$('.buyNowButton').click(function() {
		productDetails = []; // Array to store selected product details

		// Iterate through each checked checkbox to get the product details
		$('input[name="select_product[]"]:checkbox:checked').each(function(i) {
			var row = $(this).closest('tr');
			var product = {
				name: row.find('td:eq(1)').text(), // Get product name
				price: parseFloat(row.find('td:eq(4)').text().replace('$', '')), // Get product price
				image: row.find('img').attr('src'), // Get product image URL
				product_id: row.find('.productid').val() // Get product ID
			};
			productDetails.push(product); // Push product details to array
		});

		// Check if any product is selected
		if (productDetails.length === 0) {
			alert('Please add at least one product');
		} else {
			// Convert the product details array to a JSON string
			const serializedProductDetails = encodeURIComponent(JSON.stringify(productDetails));
			console.log(serializedProductDetails);
			// Redirect to the checkout page with product details as a query parameter
			window.location.href = '{{ route("user.checkout") }}?products=' + serializedProductDetails;
		}
	});
</script>
@endpush