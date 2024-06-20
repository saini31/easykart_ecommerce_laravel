<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkout-header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .checkout-header h1 {
            font-size: 24px;
            font-weight: 400;
        }

        .checkout-products img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }

        .checkout-products .product {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkout-products .product-details {
            flex: 1;
        }

        .checkout-products .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .checkout-summary {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 20px;
        }

        .checkout-summary .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .checkout-summary .summary-item .label {
            font-weight: 600;
        }

        .checkout-summary .total {
            font-size: 20px;
            font-weight: 600;
        }

        .payNowButton {
            background-color: #ff9900;
            border: none;
            padding: 10px 20px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
            text-align: center;
        }

        .payNowButton:hover {
            background-color: #e68a00;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <div class="checkout-header">
            <h1>Checkout</h1>
        </div>
        <div id="productDetails" class="checkout-products"></div>
        <input type="hidden" class="authid" value="{{Auth::id()}}">
        <div class="checkout-summary">
            <div class="summary-item">
                <span class="label">Total Price:</span>
                <span id="totalPrice" class="price"></span>
            </div>
        </div>
        <button class="payNowButton">Pay Now</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const products = urlParams.get('products');

            if (products) {
                try {
                    var productDetails = Array.isArray(JSON.parse(products)) ? JSON.parse(products) : [];

                    if (Array.isArray(productDetails)) {
                        var html = '';
                        var totalPrice = 0;
                        productDetails.forEach(function(product) {
                            html += '<div class="product"><img src="' + product.image + '" alt="' + product.name + '"><div class="product-details"><div>' + product.name + '</div><div class="product-price">$' + product.price.toFixed(2) + '</div></div></div>';
                            totalPrice += product.price;
                        });
                        $('#productDetails').html(html);
                        $('#totalPrice').text('$' + totalPrice.toFixed(2));
                    } else {
                        $('#productDetails').html('<p>No product details available</p>');
                    }
                } catch (error) {
                    console.error('Error parsing product details:', error);
                    $('#productDetails').html('<p>Error parsing product details</p>');
                }
            } else {
                $('#productDetails').html('<p>No products found in the URL</p>');
            }

            $('.payNowButton').click(function() {
                if (Array.isArray(productDetails)) {
                    var totalPrice = 0;
                    productDetails.forEach(function(product) {
                        totalPrice += product.price;
                    });

                    var options = {
                        "key": "rzp_test_Z8c9bLPwXmNQTy",
                        "amount": totalPrice * 100,
                        "currency": "INR",
                        "name": "Your Store Name",
                        "description": "Payment for Products",
                        "handler": function(response) {
                            alert("Payment successful. Payment ID: " + response.razorpay_payment_id);
                            saveOrder(response.razorpay_payment_id);
                        }
                    };

                    var razorpayInstance = new Razorpay(options);
                    razorpayInstance.open();
                } else {
                    console.error('productDetails is not an array');
                }
            });

            function saveOrder(paymentId) {
                var userId = $('.authid').val();
                var orderDetails = {
                    user_id: userId,
                    productDetails: productDetails,
                    payment_id: paymentId
                };
                console.log(orderDetails);

                $.ajax({
                    url: '{{ route("save") }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: 'application/json',
                    data: JSON.stringify(orderDetails),
                    success: function(response) {
                        console.log('Order saved successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving order:', error);
                    }
                });
            }
        });
    </script>
</body>

</html>