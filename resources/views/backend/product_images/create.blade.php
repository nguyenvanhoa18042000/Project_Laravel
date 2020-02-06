
@extends('backend.layouts.master')
@section('title')
Tạo mới ảnh mô tả
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/dist/css/file-upload-with-preview.min.css')}}">
@endsection
@section('script')
<script src="{{asset('backend/dist/js/file-upload-with-preview.min.js')}}"></script>
<script>
var upload = new FileUploadWithPreview('myupload',{
  text: {
    browse:'Chọn tệp',
          chooseFile: 'Không có tệp nào được chọn',
      },
      maxFileCount:5,
  presetFiles: [
  ],
});
</script>
@endsection
@section('content-header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lí sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí sản phẩm</li>
                    <li class="breadcrumb-item active">Danh sách</li>
                    <li class="breadcrumb-item active">Ảnh mô tả</li>
                    <li class="breadcrumb-item active">Thêm mới</li>
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
          <h3 class="card-title">Tạo mới ảnh mô tả</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.product.store.image.description') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <input type="hidden" name="idProduct" value="{{$idProduct}}">
                  <div class="form-group">
                  <div class="custom-file-container" data-upload-id="myupload">
                    <div class="custom-file-container__image-preview" style="overflow: hidden;
                    width: 45%; margin: auto;"></div>

                    <label>Ảnh mô tả sản phẩm (jpeg, jpg, png) <a href="javascript:void(0)" class="custom-file-container__image-clear">&times;</a></label>
                    <label class="custom-file-container__custom-file">
                      <input type="file" name="paths[]" class="custom-file-container__custom-file__custom-file-input" accept="image/*" multiple aria-label="Mutiple Select Files">
                      <input type="hidden" name="MAX_FILE_SIZE" value="10485760" >
                      <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    @if($errors->has('paths.*'))
                      <div class="error">{{ $errors->first('paths.*') }}</div>
                    @endif
                  </div>
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
