@extends('backend.layouts.master')
@section('title')
Cập nhật mật khẩu
@endsection
@section('script')
<script>
$(function(){
  $(".form-group a").click(function(){
    let $this = $(this);
    if ($this.hasClass('fa-eye')) {
      $this.parents('.form-group').find('input').attr('type','password');
      $this.addClass('fa-eye-slash');
      $this.removeClass('fa-eye');
    }else{
      $this.parents('.form-group').find('input').attr('type','text'); 
      $this.removeClass('fa-eye-slash');
      $this.addClass('fa-eye');
    }
  });
});
</script>
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
@endsection
@section('content-header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Cập nhật mật khẩu</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Cập nhật mật khẩu</li>
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
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cập nhật mật khẩu</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{route('backend.user.perform.change.password')}}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group" style="position: relative;margin-bottom: 1%;">
                <label for="exampleInputEmail1"><i class="fas fa-key"></i> Mật khẩu cũ : <span style="color: red">*</span></label>
                <input type="password" class="form-control" id="" name="password_old" placeholder="Nhập mật khẩu mới...">
              </div>
              @if($errors->has('password_old'))
              <div class="error" style="margin-bottom: 5px;">{{ $errors->first('password_old') }}</div>
              @endif
              <div class="form-group" style="position: relative;margin-bottom: 1%;">
                <label for="exampleInputEmail1"><i class="fas fa-key"></i> Mật khẩu mới : <span style="color: red">*</span></label>
                <input type="password" class="form-control" id="" name="password" placeholder="Nhập mật khẩu mới...">
                <a style="position: absolute;top: 60%;right: 10px;" href="javascript::void(0)" class="fa fa-eye-slash"></a>
              </div>
              @if($errors->has('password'))
              <div class="error" style="margin-bottom: 5px;">{{ $errors->first('password') }}</div>
              @endif
              <div class="form-group" style="position: relative;margin-bottom: 1%;">
                <label for="exampleInputEmail1"><i class="fas fa-key"></i> Xác nhận mật khẩu mới : <span style="color: red">*</span></label>
                <input type="password" class="form-control" id="" name="password_confirmation" placeholder="Nhập lại mật khẩu mới...">
                <a style="position: absolute;top: 60%;right: 10px;" href="javascript::void(0)" class="fa fa-eye-slash"></a>
                @if($errors->has('password_confirmation'))
                <div class="error" style="margin-bottom: 5px;">{{ $errors->first('password_confirmation') }}</div>
                @endif
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