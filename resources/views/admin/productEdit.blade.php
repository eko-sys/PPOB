	@extends('layout.datatables')
	@section('title', 'Products Management')

	@section('content')
        <!-- Page content -->
    <div class="container-fluid mt--6">
      <!-- Table -->
	      <div class="row">
	        <div class="col">
	          <div class="card">
		           <!-- Card header -->
	            <div class="card-header">
	              <h3 class="mb-0">Datatable</h3>
	              <p class="text-sm text-center mb-2">
					Products Management
	              </p>
	                <!-- Button trigger modal -->
					<button type="button" class="btn btn-primary text-right"  data-toggle="modal" data-target="#edituser">
					  Edit Product
					</button>
					<a href="/updatePulsa">
						<button type="button" class="btn btn-primary text-right">
						  Update Pulsa
						</button>
					</a>
					<a href="/updateData">
						<button type="button" class="btn btn-primary text-right">
						  Update Paket Data
						</button>
					</a>
					<a href="/updateVData">
						<button type="button" class="btn btn-primary text-right">
						  Update Voucher Data
						</button>
					</a>

					<button type="button" class="btn btn-primary text-right"  data-toggle="modal" data-target="#addProduct">
						Add Product
					</button>

			@if(session('message'))
				<div class="row pt-3">
					<div class="col-sm-7 d-flex">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
					    <span class="alert-text"><strong>Success!</strong> {{ session('message') }}</span>
					    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					        <span aria-hidden="true">&times;</span>
					    </button>
					</div>
					</div>
				</div>
			@endif
	            </div>
	            <div class="table-responsive py-4">
	              <table class="table table-flush" id="datatable-basic">
	                <thead class="thead-light">
	                  <tr>
	                    <th>Product Code</th>
	                    <th>Product Name</th>
	                    <th>Type</th>
	                    <th>Price</th>
	                    <th>Provaider</th>
	                  </tr>
	                </thead>
	                <tfoot>
	                  <tr>
	                   <th>Product Code</th>
	                    <th>Product Name</th>
	                    <th>Type</th>
	                    <th>Price</th>
	                    <th>Provaider</th>
	                  </tr>
	                </tfoot>
	                <tbody>
	            @foreach( $products as $product )
	                <tr>
	                    <td>{{ $product->product_code }}</td>
	                    <td>{{ $product->product_name }}</td>
	                    <td>{{ $product->type }}</td>
	                    <td>{{ $product->price }}</td>
	                    <td>{{ $product->provaider_id }}</td>
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
  <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form method="post" action="{{ route('updatingProduct') }}">
            @method('put')
            @csrf
        <div class="p-2 bg-secondary">
		    <input id="code" name="code" type="input" class="form-control form-control-alternative" placeholder="Product Code" required="">
		</div>
        <div class="p-2 bg-secondary">
           	<input type="hidden" name="id" id="idProduct" required="">
	    <input id="name" name="name" type="input" class="form-control form-control-alternative" placeholder="Product Name">
		</div>
		<div class="p-2 bg-secondary">
		    <input id="price" name="price" type="number" class="form-control form-control-alternative" placeholder="Product Price" required="">
		</div>
		<div class="p-2 bg-secondary">
			<select name="type" class="form-control">
			  <option value="pulsa">Pulsa</option>
			  <option value="data">Data</option>
			  <option value="vdata">Voucher Data</option>
			  <option value="e-money">E-money</option>
			</select>
		</div>
		<div class="p-2 bg-secondary">
			<select name="provaider" class="form-control">
			  <option value="1">Telkomsel</option>
			  <option value="2">Indosat</option>
			  <option value="3">Three</option>
			  <option value="4">Axis</option>
			  <option value="5">Smartfren</option>
			  <option value="6">XL</option>
			  <option value="7">BY.U</option>
			  <option value="10">Gopay</option>
			  <option value="11">Ovo</option>
			  <option value="12">Dana</option>
			</select>
		</div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  	<!-- Modal Add Product-->
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        <form method="post" action="{{ route('addProduct') }}">
            @csrf
        <div class="p-2 bg-secondary">
		    <input id="code" name="code" type="input" class="form-control form-control-alternative" placeholder="Product Code" required="">
		</div>
        <div class="p-2 bg-secondary">
	    <input id="name" name="name" type="input" class="form-control form-control-alternative" placeholder="Product Name" required="">
		</div>
		<div class="p-2 bg-secondary">
		    <input id="price" name="price" type="number" class="form-control form-control-alternative" placeholder="Product Price" required="">
		</div>
		<div class="p-2 bg-secondary">
			<select name="type" class="form-control">
			  <option value="pulsa">Pulsa</option>
			  <option value="data">Data</option>
			  <option value="vdata">Voucher Data</option>
			  <option value="e-money">E-money</option>
			</select>
		</div>
		<div class="p-2 bg-secondary">
			<select name="provaider" class="form-control">
			  <option value="1">Telkomsel</option>
			  <option value="2">Indosat</option>
			  <option value="3">Three</option>
			  <option value="4">Axis</option>
			  <option value="5">Smartfren</option>
			  <option value="6">XL</option>
			  <option value="10">Gopay</option>
			  <option value="11">Ovo</option>
			  <option value="12">Dana</option>
			</select>
		</div>

        <div class="p-2 bg-secondary">
		    <input  name="note" type="input" class="form-control form-control-alternative" placeholder="Add Note" required="">
		</div>
		<div class="p-2 bg-secondary">
		    <input  name="category" type="input" class="form-control form-control-alternative" placeholder="Add Category" required="">
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

	@endsection