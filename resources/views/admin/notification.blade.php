	@extends('layout.datatables')
	@section('title', 'Send User Notification')

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
              <p class="text-sm text-center mb-0">
                Daftar Users
              </p>
            </div>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Join</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Join</th>
                  </tr>
                </tfoot>
                <tbody>
              @foreach($users as $user)
                @if(Auth::user()->id != $user->id)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role_id }}</td>
                    <td>{{ $user->image }}</td>
                    <td>{{ $user->is_active }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                      <button type="button" class="btn btn-primary trigger" data-id="{{ $user->id }}" data-toggle="modal" data-target="#edituser">Send Notif</button>
                    </td>
                  </tr>
                @endif                 
              @endforeach
                </tbody>
              </table>
            </div>
          </div>

  <!-- Modal -->
  <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Notification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form method="post" action="/sendNotif">
            @csrf
            <div class="form-group">
              <div class="form-group">
			    <label for="exampleFormControlTextarea1">Input Message </label>
			    <textarea name="notif" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			  </div>
			  <input name="user_id" type="hidden" id="user_id" \>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <script type="text/javascript">
      $(document).ready(function(){
        $('.trigger').on('click', function(){
          var id = $(this).data('id');

          $.ajaxSetup({
            headers:{
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          });

          $.ajax({
            url: '{{ route("show") }}',
            method: 'post',
            dataType: 'json',
            data: {id : id},
            success: function(user){
              $('#user_id').val(user.msg.id);
            }
          });
          
        });
      });
    </script>

	@endsection