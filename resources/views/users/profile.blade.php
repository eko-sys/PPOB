	@extends('layout.dashboard')
	@section('title', 'My Profile')

	@section('content')

	<div class="card card-profile">
    <img src="{{ asset('img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a href="#">
                    <img src="{{ asset('img/profile/'. Auth::user()->image .'') }}" class="rounded-circle">
                </a>
            </div>
        </div>
    </div>

    @if( session('message') )
    <div class="row">
        <div class="col-sm-6 pt-6">
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

    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
        <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#exampleModal">Edit</a>
            <a href="#" class="btn btn-sm btn-default float-right">Message</a>
        </div>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                        <span class="heading">{{ count($trx) }}</span>
                        <span class="description">History Transaki</span>
                    </div>
                    <div>
                        <span class="heading">0</span>
                        <span class="description">Message</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <h5 class="h3">
                {{ Auth::user()->name }}<span class="font-weight-light"></span>
            </h5>
            <div class="h5 font-weight-300">
                Join At<i class="ni location_pin mr-2"></i>{{ Auth::user()->created_at }}
            </div>            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/profile" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="p-3 bg-secondary">
                <input name="name" type="input" value=" {{Auth::user()->name}} " class="form-control form-control-alternative" placeholder="Name">
            </div>
            @error('name')
                <h5 class="text-center">{{$message}}</h5>
            @enderror
            <div class="p-3 bg-secondary">
                <input name="email" type="email" value=" {{Auth::user()->email}}" class="form-control form-control-alternative disabled" placeholder="Email">
            </div>
            <div class="p-3 bg-secondary">
                <input name="password" type="password" class="form-control form-control-alternative disabled" placeholder="New Password">
            </div>
            @error('password')
                <h5 class="text-center">{{$message}}</h5>
            @enderror
            <div class="p-3 bg-secondary">
                <input name="password_confirmation" type="password" class="form-control form-control-alternative disabled" placeholder="Confirm Password">
            </div>
            <div class="p-3 bg-secondary">
                <div class="custom-file col-sm">
                    <input id="avatar" name="avatar" type="file" class="custom-file-input" id="customFileLang" lang="en">
                    <label id="label" class="custom-file-label" for="customFileLang">Profile</label>
                </div>
            </div>
            @error('avatar')
                <h5 class="text-center">{{$message}}</h5>
            @enderror
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
            $( "input[name='email']" ).prop('disabled', 'disabled');
            
            $('#avatar').on('change', function(){
                let avatar = $(this).val();
                $('#label').text(avatar);
            });
        });
    </script>

	@endsection