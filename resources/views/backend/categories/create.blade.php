
@extends('backend.layouts.master')
@section('title')
Tạo danh mục
@endsection
@section('css')
<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff !important;
    border-color: #006fe6 !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white !important;
  }
</style>
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
                <h1 class="m-0 text-dark">Quản lí danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí danh mục</li>
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
          <h3 class="card-title">Tạo mới danh mục</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.category.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',isset($category->name) ? $category->name : '') }}" placeholder="Tên danh mục ...">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug',isset($category->slug) ? $category->slug : '') }}" placeholder="">
                    @if($errors->has('slug'))
                        <div class="error">{{ $errors->first('slug') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="parent_id">Danh mục cha</label>
                    <select name="parent_id" class="form-control">
                      <option value="">--Chọn danh mục cha--</option>
                      @if(isset($categories))
                        {{Helper::data_tree($categories)}}
                      @endif
                    </select>
                    @if($errors->has('parent_id'))
                        <div class="error">{{ $errors->first('parent_id') }}</div>
                    @endif
                </div>

                <div class="form-group">
                  <label>Thương hiệu kinh doanh</label>
                  <select class="select2" name="trademarks[]" multiple="multiple" data-placeholder="Chọn các thương hiệu sản phẩm bạn muốn bán ..." style="width: 100%;">
                    @if(isset($trademarks))
                      @foreach($trademarks as $trademark)
                        <option value="{{$trademark->id}}">{{$trademark->name}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>

                <div style="text-align: center; margin-top: 2%">
                  <img id="out_img" src="{{ asset('storage/images/product/default.png') }}" style="width:64px; height: 64px;">
                </div>
                <div class="form-group">
                  <label for="image">Ảnh nhỏ (png , size 24x24)</label>
                  <input id="inp_img" type="file" class="form-control" name="image">
                  @if($errors->has('image'))
                  <div class="error">{{ $errors->first('image') }}</div>
                  @endif
                </div>

                  <div class="form-group">
                    <label for="description">Mô tả</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Mô tả danh mục ...">
                    @if($errors->has('description'))
                        <div class="error">{{ $errors->first('description') }}</div>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
                  <a href="{{ route('backend.home') }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
              </form>
        <!-- end form -->
        <!-- /.card-body -->
        <div class="card-footer">Tạo mới danh mục</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection
