@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quên mật khẩu</div>

                <div class="card-body">
                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">{{ $message }}</div>
                    @endif

                    <form method="POST" action="{{ route('profile.perform.forgot.password')}}">
                        @csrf
<!-- route('password.email') -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email truy cập</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Gửi 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
