	<option>Select Product</option>
@foreach($products as $product)
	<option id="product" value="{{ $product->product_code }}" data-price="{{ $product->price }}" >{{ $product->product_name }}</option>
@endforeach