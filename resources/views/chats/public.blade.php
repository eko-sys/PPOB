	@extends('layout.dashboard')

	@section('title', 'Chats')
	@section('header')
	<meta http-equiv="refresh" content="300">
	@endsection
	@section('content')

	<div class="card-header">
        <h3 id="aku" class="mb-0">Status Users</h3>
        <p class="text-sm mb-0">
        Online User : ?? Peoples
       	</p>
       	<p class="text-sm mb-0">
        	<a href="#" onclick="alert('belum buat :v')">Join Whatsapp Group</a>
       	</p>
    </div>

	<div class="pb-8">
		<div class="overflow-scroll card card-frame">
			<div id="show_message" class="card-body">
				<h5 class="user-name">LOADING...</h5>
				<p class="user-message">Harap Hati-hati Jika Mengetik :)</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 pb-2">
				<input id="message" type="input" class=" form-control" placeholder="Input Your Message. . ." required="">
			</div>
			<div id="send" class="col-sm">
				<button id="send" type="button" class="btn btn-outline-success">Send</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#send').prop('disabled', true);

			let user = '{{ Auth::user()->name }}';
			let id = '{{ Auth::user()->id }}';


			$('#message').change(function(){
				if($(this).val() == ''){
					$('#send').prop('disabled', true);
				}else{
					$('#send').prop('disabled', false);
				}


				});

			$('#send').on('click', function(){
				let message = $('#message').val();
					$.ajaxSetup({
						headers:{
						'X-CSRF-TOKEN' : "{{ csrf_token() }}"
					}
				});

				$.ajax({
					url: "{{ url('/sendMessage') }}",
					method: "post",
					data: { id : id, user : user, message : message },
					dataType: "json",
					success: function(data){
						$('#message').val('');
						alert('Sukses Send! :)');
					}
				});

			});
			
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
		    setInterval(function() {
		       $("#show_message").load("{{ route('showPublic') }}");
		       	
		    }, 2000);
		});
	</script>

	@endsection