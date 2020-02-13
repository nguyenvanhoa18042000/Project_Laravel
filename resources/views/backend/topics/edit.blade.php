@extends('backend.layouts.master')
@section('title')
Cập nhật chủ đề
@endsection
@section('css')
@endsection
@section('content-header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Quản lí liên hệ</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quản lí liên hệ</li>
        <li class="breadcrumb-item active">Chủ đề</li>
        <li class="breadcrumb-item"><a href="#">Danh sách</a></li>
        <li class="breadcrumb-item active">Cập nhật</li>
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
      <h3 class="card-title">Cập nhật chủ đề liên hệ</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('backend.topic.update',$topic->id) }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Tên danh mục</label>
              <input type="text" class="form-control" name="name" value="{{ old('name',$topic->name) }}">
              @if($errors->has('name'))
              <div class="error">{{ $errors->first('name') }}</div>
              @endif
            </div>

            <div class="form-group">
              <label for="parent_id">Danh mục cha</label>
              <select name="parent_id" class="form-control">
                @if($topic->parent_id == NULL)
                <option value="" selected>Danh mục cha</option>
                @else
                <option value="">Danh mục cha</option>
                @endif
                {{Helper::data_tree($topics,$topic->parent_id,$topic->id)}}
              </select>
              @if($errors->has('parent_id'))
              <div class="error">{{ $errors->first('parent_id') }}</div>
              @endif
            </div>
          </div>
          <!-- /.card-body -->

          <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
          <a href="{{ URL::previous() }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
        </form>
        <!-- end form -->

        <!-- /.card-body -->
        <div class="card-footer">Cập nhật chủ đề liên hệ</div>

      </div>
    </div>
    <!-- /.card -->

  </section>
  @endsection
