@extends('backend.layouts.master')
@section('title')
Tạo sản phẩm
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
          <h3 class="card-title">Tạo mới sản phẩm</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.product.store') }}">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề</label>
                    <input type="text" class="form-control" name="title_seo" value="{{ old('title_seo') }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <input type="text" class="form-control" name="description_seo" value="{{ old('description_seo') }}">
                    @if($errors->has('description_seo'))
                        <div class="error">{{ $errors->first('description_seo') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Gía sản phẩm</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                  </div>

                  <div class="form-group">
                    <label>Nội dung</label>
                    <textarea class="form-control" name="content" rows="5" cols="5"></textarea>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input name="hot" class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                      <label for="customCheckbox2" class="custom-control-label">Nổi bật</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
              </form>
        <!-- end form -->
        <!-- /.card-body -->
        <div class="card-footer">Tạo mới sản phẩm</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection
