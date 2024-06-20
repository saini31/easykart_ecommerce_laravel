<a class="btn like-btn" data-product-id="{{ $product->id }}">Like</a>
<!-- Rating button -->
<a class="btn rate-btn" data-product-id="{{ $product->id }}">Rating</a>
<!-- Feedback form -->
<form action="#" method="POST" class="feedback-form">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <textarea name="feedback" placeholder="Enter your feedback"></textarea>
    <input type="number" name="rating" min="1" max="5" placeholder="Enter rating (1-5)">
    <button type="submit" class="btn btn-primary">Submit Feedback</button>
</form>