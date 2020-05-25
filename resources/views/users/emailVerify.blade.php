	@extends('layout.dashboard')
	@section('title', 'Verify Email')

	@section('content')

    <div class="card card-frame">
      <div class="card-body">
        <form action="/verify" method="post">
        @csrf
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{ '</>' }}</span>
                </div>
                @error('code')
                    {{$message}}
                @enderror
                <input name="code" type="number" class="form-control" placeholder="Verification Code" aria-label="Username" aria-describedby="basic-addon1" required="">
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-default">Verify Code</button>
        </div>       
        </form>

        <div class="pt-5">
        @if(session('failed'))
            <div class="alert alert-danger" role="alert">
                <strong>Danger!</strong> {{ session('failed') }}
            </div>
        @endif
        @if(session('message'))
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> {{session('message')}}
        </div>
        @endif
            <h3>Kode Belum Terkirim?</h3>
        </div>
        <form action="/getCode" method="post">
        @csrf
        <div>
            <button type="submit" class="btn btn-info">Get Code</button>
        </div>     
        </form>
      </div>
    </div>

	@endsection