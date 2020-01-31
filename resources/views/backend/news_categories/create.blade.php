
@extends('backend.layouts.master')
@section('title')
Tạo danh mục tin tức
@endsection
@section('content-header')

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Quản lí tin tức</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí tin tức</li>
                    <li class="breadcrumb-item active">Danh mục</li>
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
          <h3 class="card-title">Tạo mới danh mục tin tức</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.news_category.store') }}">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" placeholder="Nhập danh mục tin tức" name="name" value="{{ old('name',isset($product->name) ? $product->name : '') }}">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="parent_id">Danh mục cha</label>
                    <select name="parent_id" class="form-control">
                      <option value="">Danh mục cha</option>
                      @if(isset($news_categories))
                        @foreach($news_categories as $news_category)
                          @if($news_category->parent_id == NULL)
                            <option value="{{ $news_category->id }}">{{ $news_category->name }}</option>
                          @endif
                        @endforeach
                      @endif
                    </select>
                    @if($errors->has('parent_id'))
                        <div class="error">{{ $errors->first('parent_id') }}</div>
                    @endif
                </div>

                  <div class="form-group">
                    <label for="description">Mô tả</label>
                    <input type="text" class="form-control" name="description" placeholder="Nhập mô tả danh mục tin tức" value="{{ old('description') }}">
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
        <div class="card-footer">Tạo mới danh mục tin tức</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection
