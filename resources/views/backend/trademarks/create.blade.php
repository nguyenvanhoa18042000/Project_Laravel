
@extends('backend.layouts.master')
@section('title')
Tạo mới thương hiệu
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

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lí thương hiệu</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí thương hiệu</li>
                    <li class="breadcrumb-item active">Tạo mới</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>

@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tạo mới thương hiệu</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.trademark.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                    <input type="text" class="form-control" name="name" placeholder="Tên thương hiệu..." value="{{ old('name',isset($trademark->name) ? $trademark->name : '') }}">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                  <div style="text-align: center; margin-top: 2%">
                    <img id="out_img" src="{{asset('storage/images/product/default.png')}}" style="width:35%; height: 100px;">
                  </div>
                  <div class="form-group">
                    <label for="image">Ảnh thương hiệu (jpeg, jpg, png)</label>
                    <input id="inp_img" type="file" class="form-control" name="image">
                    @if($errors->has('image'))
                    <div class="error">{{ $errors->first('image') }}</div>
                    @endif
                  </div>

                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
                  <a href="{{ route('backend.home') }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
              </form>
        <!-- end form -->
        <!-- /.card-body -->
        <div class="card-footer">Tạo mới thương hiệu</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection
