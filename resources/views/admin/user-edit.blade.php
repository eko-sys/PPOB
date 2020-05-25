  @extends('layout.datatables')

  @section('title', 'List Users')

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
                Lists Users
              </p>

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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Saldo</th>
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
                    <td>{{ $user->saldo }}</td>
                    <td>{{ $user->image }}</td>
                    <td>{{ $user->is_active }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                      <button type="button" class="btn btn-primary trigger" data-id="{{ $user->id }}" data-toggle="modal" data-target="#edituser">Edit</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <form method="post" action="/user-management">
            @method('put')
            @csrf
            <div class="pb-3">
              <input name="name" type="input" id="name" class="form-control" placeholder="Name">
              <input name="id" type="hidden" id="id">
            </div>
            <div class="pb-3">
              <input name="email" type="input" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="pb-3">
              <input name="saldo" type="number" id="saldo" class="form-control" placeholder="Saldo">
            </div>
            <div class="pb-3">
              <select name="active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Nonaktif</option>
              </select>
            </div>
            <select name="role_id" class="form-control">
              <option value="2">Member</option>
              <option value="1">Admin</option>
            </select>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
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
              $('#name').val(user.msg.name);
              $('#email').val(user.msg.email);
              $('#id').val(user.msg.id);
              $('#saldo').val(user.msg.saldo);
            }
          });
          
        });
      });
    </script>
        @endsection