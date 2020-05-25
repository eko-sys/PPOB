 @extends('layout.datatables')
 @section('title', 'History Transksi')

 @section('content')
  <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-0">Datatable</h3>
              <p class="text-sm text-center mb-0">
                Lists Transaksi
              </p>
 	    </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                  	<th>Order Id</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
            @foreach($history as $hs)
                <tr>
                	<td>{{ $hs->order_id }}</td>
                    <td>{{ $hs->code }}</td>
                    <td>{{ $hs->name }}</td>
                    <td>{{ $hs->type }}</td>
                    <td>{{ $hs->price }}</td>
                    <td>
                      <button type="button" class="btn btn-primary trigger" data-type="{{ $hs->type }}" data-id="{{ $hs->order_id }}" data-toggle="modal" data-target="#cekStatus">Check Status</button>
                      <a href="">
                      	<button type="button" class="btn btn-primary trigger">Delete</button>
                      </a>
                    </td>
                  </tr>
  			@endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
</div>

 <!-- Modal -->
  <div class="modal fade" id="cekStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Status Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<h4 id="trxid"></h4>
        	<h4 id="service"></h4>
        	<h4 id="message"></h4>
        	<h4 id="status"></h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  	$(document).ready(function(){
  		$('.trigger').on('click', function(){
  			const trx = $(this).data('id');
        const type = $(this).data('type');

			$.ajaxSetup({
				headers:{
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});

  			$.ajax({
				url: '{{ url("statusOrder") }}',
				method: 'post',
				data: {trx:trx, type:type},
				dataType: 'json',
				beforeSend: function(){
				    $('#trxid').text('Please Wait...!');
				    $('#service').text('');
					$('#message').text('');
					$('#status').text('');
				},
				success: function(result){
          
					$('#trxid').text(`Id Order: ${result.msg.data.trxid}`);
					$('#service').text(`Product: ${result.msg.data.service}`);
					$('#message').text(`Message: ${result.msg.data.message}`);
					$('#status').text(`Status: ${result.msg.data.status}`);
				}
			});
  		});
  	});
  </script>


 @endsection()