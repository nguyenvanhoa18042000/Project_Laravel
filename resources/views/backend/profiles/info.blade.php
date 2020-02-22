@extends('backend.profiles.layout')
@section('title')
Cài đặt tài khoản
@endsection
@section('script')
<script>
  @if(Session::has('message'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "timeOut": "3000",
  }
  var type="{{Session::get('alert-type')}}"
  switch(type){
    case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
    case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
  }
  @endif
</script>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#out_img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#inp_img").change(function() {
    readURL(this);
  });
</script>
@endsection
@section('content-header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Cài đặt tài khoản</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Cài đặt tài khoản</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')
<section class="content">
  <!-- Content -->
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <div class="col-sm-12 col-lg-12 col-12">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cài đặt tài khoản</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{route('profile.perform.setting.user')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">             
              <div class="row">
                <div class="col-3">
                  <div style="text-align: center;margin: 7% 0 23% 0">
                    <img id="out_img" src="{{ asset($user->avatar) }}" style="width:170px;height: 170px;border-radius: 50%">
                  </div>
                  <div class="form-group">
                    <label for="image">Ảnh đại diện</label>
                    <input id="inp_img" type="file" class="form-control" name="avatar">
                    @if($errors->has('avatar'))
                    <div class="error">{{ $errors->first('avatar') }}</div>
                    @endif
                  </div>
                </div>
                <div class="col-9">
                  <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <p>{{ $user->email }}</p>
                @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                @endif
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Tên người dùng</label>
                <input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name" value="{{ $user->name }}">
                @if($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
                @endif
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="number" class="form-control" id="" name="phone" placeholder="Số điện thoại của người dùng" value="{{ $user->phone }}">
                @if($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
                @endif
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Địa chỉ</label>
                <input type="text" class="form-control" id="" name="address" placeholder="Địa chỉ của người dùng" value="{{ $user->address }}">
                @if($errors->has('address'))
                <div class="error">{{ $errors->first('address') }}</div>
                @endif
              </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mb-4"><i class="fas fa-save"></i> Lưu thông tin</button>
          <a href="{{ route('profile.index') }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
        </form>
        <!-- end form -->
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
@endsection