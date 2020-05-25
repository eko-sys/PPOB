	@extends('layout.dashboard')

	@section('title', 'PPOB')

	@section('content')


	<div class="card card-frame">
  		<div class="card-body">
	    	<div class="row">
	    	<h4>Saldo {{ number_format(Auth::user()->saldo) }}</h4>
	    		<div class="col-sm-5">
	    		<h3 class="text-center">Products</h3>
	    		
	    		@if(Auth::user()->is_active != 3)
	    		<div>
	    			<a href="/verifyEmail"><button type="button" class="btn btn-warning text-center">Verify My Email</button></a>
	    		</div>
	    		@endif
	    		<br>

	    		@if(session('failed'))
	    		<div class="alert alert-danger pb-2" role="alert">
				    <strong>Danger!</strong> {{ session('failed') }}
				</div>
				@endif

				@if(session('message'))
				<div class="alert alert-success" role="alert">
				    <strong>Success!</strong> {{session('message')}}
				</div>
				@endif

		    		<div class="d-flex justify-content-center pb-2">

						<button id="pulsa"  data-toggle="modal" data-target="#buyModal" class="btn btn-icon btn-secondary" type="button">
						<span class="btn-inner--icon"><i class="ni ni-mobile-button"></i></span>
					    <span class="btn-inner--text d-block">Pulsa</span>
						</button>

						<button id="kuota" data-toggle="modal" data-target="#buyModal" class="btn btn-icon btn-secondary" type="button">
						<span class="btn-inner--icon"><i class="ni ni-planet"></i></span>
					    <span class="btn-inner--text d-block ">Data</span>
						</button>

						<button id="voucher" data-toggle="modal" data-target="#buyModal" class="btn btn-icon btn-secondary" type="button">
						<span class="btn-inner--icon"><i class="ni ni-world-2"></i></span>
					    <span class="btn-inner--text d-block ">Voucher Data</span>
						</button>

					</div>

					<div class="d-flex justify-content-center pb-2">

						<button data-toggle="modal" id="e-money" data-target="#buyMoney" class="btn btn-icon btn-secondary" type="button">
						<span class="btn-inner--icon"><i class="ni ni-credit-card"></i></span>
					    <span class="btn-inner--text d-block ">E-money</span>
						</button>

						<button class="btn btn-icon btn-secondary" type="button" data-toggle="modal" data-target="#gameProduct">
						<span class="btn-inner--icon"><i class="ni ni-controller"></i></span>
					    <span class="btn-inner--text d-block ">Game</span>
						</button>

						<button class="btn btn-icon btn-secondary" type="button">
						<span class="btn-inner--icon"><i class="ni ni-sound-wave"></i></span>
					    <span class="btn-inner--text d-block ">Token Pln</span>
						</button>
						<br>
					</div>

	    		</div>

	    		<div class="col-sm-6 mt-4">
		    		<div class="text-center">
		    			<h2>###</h2>
		    			<h4>Jika Gagal Saldo Akan Refund Otomatis</h4>
		    		</div>
		    	</div>

			</div>
	  	</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="type"> </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="post" action="{{ route('userBuy') }}">
	      <div class="modal-body">
	      	<div class="pb-3 bg-secondary">
	        	<input type="number" name="number" id="number" class="form-control" placeholder="Masukkan nomor">
	        	<input type="hidden" id="type_product">
	        	@csrf
	    	</div>

	    	<div class="pb-4 bg-secondary">
	    		<h3 id="load" class="pl-2"></h3>
		        <select name="product" id="select" class="form-control">
				  
				</select>
			</div>

			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text" id="basic-addon1">Price</span>
			  </div>
			  <input type="text" class="form-control" id="price" aria-label="Username" aria-describedby="basic-addon1">
			</div>
			<div class="text-center">
				<h4 id="note"></h4>
				<h4 id="category"></h4>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" id="buy" class="btn btn-primary">Buy</button>
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>


		<!-- Modal e-money -->
	<div class="modal fade" id="buyMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Saldo E-Money</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="post" action="{{ route('userBuy') }}">
	      <div class="modal-body">

	      	<div class="pb-4 bg-secondary">
		        <select id="category_money" class="form-control">
		        	<option>Select Category</option>
		        @foreach($emoney as $money)
				 	<option value="{{ $money->id }}">{{ $money->name }}</option>
				 @endforeach
				</select>
			</div>

			<div class="pb-4 bg-secondary">
	    		<h3 id="load" class="pl-2"></h3>
				<select name="product" id="select_money" class="form-control">
					<option>Uncategorized</option>
				</select>
			</div>

	      	<div class="pb-3 bg-secondary">
	        	<input type="number" name="number" id="numberEmoney" class="form-control" placeholder="Masukkan nomor" required="">
	        	<input type="hidden" id="type_product">
	        	@csrf
	    	</div>

			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text"  id="basic-addon1">Price</span>
			  </div>

			  <input type="text" class="form-control" id="priceMoney" aria-describedby="basic-addon1">
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" id="buyEmoney" class="btn btn-primary">Buy</button>
	    	</form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Game -->
	<div class="modal fade" id="gameProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Top Up Game</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       	
	    <form action="{{ route('userBuyGame') }}" method="post">
	       	<div class="pb-2 bg-secondary">
	    		<h3 id="load" class="pl-2"></h3>

	    		@csrf
				<select name="product" id="select_game" class="form-control">
					<option>Select</option>
				@foreach($game as $games)
					<option value="{{ $games->id }}" >{{ $games->name }}</option>
				@endforeach
				</select>

			<div class="pb-2 bg-secondary">
	    		<h3 id="load" class="pl-2"></h3>
				<select name="game" id="game" class="form-control">
					<option>Uncategorized</option>
				</select>
			</div>

	      	<div class="pb-2 bg-secondary">
	        	<input type="input" name="id" id="idUser" class="form-control" placeholder="Id Game User" required="">
	        	<input type="hidden" id="type_product">
	    	</div>
			</div>

			<div class="input-group mb-3">
			  <div class="input-group-prepend">
			    <span class="input-group-text"  id="basic-addon1">Price</span>
			  </div>

			  <input type="text" class="form-control" id="priceGame" aria-describedby="basic-addon1">
			</div>
			<div class="text-center">
				<h4 id="server"></h4>
				<h4 id="status"></h4>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Buy</button>
	    </form>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript" src="{{ asset('js/selection.js') }}">
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN' : '{{ csrf_token() }}'
				}
			});

			$('#number').on('keyup', function(){
				let type = $('#type_product').val();
				let number = $('#number').val()
				
				if(!number){
					$('#buy').prop('disabled', true);
				}else{
					$('#buy').prop('disabled', false);
				}

				$.ajax({
					url: '{{ route("userSelect") }}',
					method: 'post',
					data: {number:number, type:type},
					dataType: 'json',
					success: function(data){
						console.log(data);
						var load = `<option>Loading...!</option>`;
						$('#select').html(load);
						if(data.msg){
							let url = `{{ url("/showSelect") }}/${data.msg}/${data.type}`;
							$( "#select" ).load( `${url}`, function() {
							 
							});
						}
					}
				});
			});
			
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#price').prop('disabled', true);
			$('#buy').prop('disabled', true);

			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				}
			});

			$('#select').on('change', function(){
				let code = $(this).val();
				let number = $('#number').val();

				$.ajax({
					url: "{{ route('showPrice') }}",
					data: {code : code},
					method: 'post',
					beforeSend: function() {
				        $('#price').val('Loading...!');
				    },
					dataType: 'json',
					success : function(data){
						let price = data.msg.map((result) => result.price);
						let note = data.msg.map((result) => result.note);
						let category = data.msg.map((result) => result.category);
						let rp = new Intl.NumberFormat('id-RP', { maximumSignificantDigits: 3 }).format(price);
						$('#price').val(rp);
						$('#note').text(`note: ${note}`);
						$('#category').text(`category: ${category}`);

					}
				});
			});
		});
	</script>

	<script type="text/javascript" >
		$(document).ready(function(){
			$('#numberEmoney').on('keyup', function(){
				if($(this).val() == ''){
					$('#buyEmoney').prop('disabled', true);
				}else{
					$('#buyEmoney').prop('disabled', false);
				}
			});

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});

			$('#category_money').on('change', function(){
				let product = $(this).val();
				$.ajax({
					url: '{{ route("eMoney") }}',
					method: 'post',
					data: {product:product},
					beforeSend: function(){
						var select = `<option>Select Product!</option>`;
						$('#select_money').html(select);
					},
					dataType: 'json',
					success: function(data){
						data.msg.forEach(function(result){
							var product = `<option value="${result.product_code}" >${result.product_name}</option>`;
							$('#select_money').append(product);

						});
					}
				})
			})
		});

	</script>

	<script type="text/javascript">
		
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#select_money').on('change', function(){
				var id = $(this).val();

				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN': "{{ csrf_token() }}"
					}
				});

				$.ajax({
					url: "{{ route('showPriceMoney') }}",
					method: 'post',
					dataType: 'json',
					data: {id:id},
					success: function(data){
						let price = data.msg.map((result) => result.price);
						let rp = new Intl.NumberFormat('id-RP', { maximumSignificantDigits: 3 }).format(price);
						$('#priceMoney').val(rp);

					}
				})
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#select_game').on('change', function(){
				let game = $(this).val();
				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN' : '{{ csrf_token() }}'
					}
				});

				$.ajax({
					url: '{{ route("showGame") }}',
					method: 'post',
					data: {game:game},
					dataType: 'json',
					beforeSend: function(){
						var html = `<option>Select</option>`;
						$('#game').html(html);
					},
					success: function(data){

						data.msg.forEach((result) => {
							var html = `<option value="${result.code}">${result.name}</option>`;
							$('#game').append(html);
						})
						
					}
				})
			})
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#priceGame').prop('disabled', true);
			
			$('#game').on('change', function(){
				let code = $(this).val();
				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN' : '{{ csrf_token() }}'
					}
				});

				$.ajax({
					url: '{{ route("showPriceGame") }}',
					method: 'post',
					data: {code:code},
					dataType: 'json',
					beforeSend: function(){
						$('#priceGame').val('Loading...!');
					},
					success: function(data){
						data.msg.forEach((result) => {
							$('#priceGame').prop('disabled', true);
							let rp = new Intl.NumberFormat('id-RP', { maximumSignificantDigits: 3 }).format(result.price);
							$('#priceGame').val(rp);
							const server = `Server: ${result.server}`;
							const status = `status: ${result.status}`;
							$('#status').text(status);
							$('#server').text(server);
						});
					}
				})
			})
		});
	</script>
	@endsection