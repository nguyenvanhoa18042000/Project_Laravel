@extends('backend.layouts.master')
@section('title')
Tạo mới người dùng
@endsection
@section('css')

@endsection
@section('script')
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
<div class="content-header">
    <!-- Content Header -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tạo mới người dùng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('backend.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.user.index') }}">Quản lí người dùng</a></li>
                    <li class="breadcrumb-item active">Tạo mới</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
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
                        <h3 class="card-title">Tạo mới người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên người dùng</label>
                                <input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name" value="{{ old('name') }}">
                                @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="" placeholder="Email người dùng" name="email" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div style="text-align: center; margin-top: 2%">
                                    <img id="out_img" src="{{asset('storage/images/user_avatar/default-avatar.jpg')}}" style="width:250px; height: 250px; border-radius: 50%;">
                                </div>
                            <div class="form-group">
                                <label for="avatar">Ảnh đại diện (jpeg, jpg, png)</label>
                                <input id="inp_img" type="file" class="form-control" name="avatar">
                                @if($errors->has('avatar'))
                                <div class="error">{{ $errors->first('avatar') }}</div>
                                @endif
                            </div>

                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="password" class="form-control" id="" name="password" placeholder="Nhập mật khẩu người dùng">
                                </div>
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" id="" name="password_confirmation" placeholder="Nhập lại mật khẩu người dùng">
                                </div>
                                @if($errors->has('password'))
                                    <div class="error" style="margin-left: 1%">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="number" class="form-control" id="" name="phone" placeholder="Số điện thoại của người dùng" value="{{ old('phone') }}">
                                @if($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" class="form-control" id="" name="address" placeholder="Địa chỉ của người dùng" value="{{ old('address') }}">
                                @if($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" style="width: 100%;" name="role">
                                    <option value="2">Quản lý</option>
                                    <option value="1" selected>Quản trị viên</option>
                                    <option value="0">Khách hàng</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
                        <a href="{{ route('backend.home') }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
                    </form>
                    <!-- end form -->
                    <!-- /.card-body -->
                    <div class="card-footer">Tạo mới người dùng</div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
@endsection