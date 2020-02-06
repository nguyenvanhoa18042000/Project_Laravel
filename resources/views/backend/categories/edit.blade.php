@extends('backend.layouts.master')
@section('title')
Chỉnh sửa danh mục
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
          <h3 class="card-title">Tạo mới danh mục</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('backend.category.update',$category->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',$category->name) }}">
                    @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="parent_id">Danh mục cha</label>
                    <select name="parent_id" class="form-control">
                      @if($category->parent_id == NULL)
                        <option value="" selected>Danh mục cha</option>
                      @endif
                      @if(isset($categories))
                        @foreach($categories as $cate)
                          @if($cate->parent_id == NULL)
                          <option value="{{ $cate->id }}" 
                            @if ($category->parent_id == $cate->id) selected @endif>{{ $cate->name }}
                          </option>
                          @endif
                        @endforeach
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
                      @foreach($trademarks_edit as $trademark_edit_v1)
                        @if($trademark_edit_v1->deleted_at != NULL)
                          <option value="{{$trademark_edit_v1->id}}"
                          @foreach($trademarks_edit as $trademark_edit_v2)
                            @if($trademark_edit_v1->id == $trademark_edit_v2->id) selected @endif
                          @endforeach
                          >
                          {{$trademark_edit_v1->name}}
                          </option>
                        @endif
                      @endforeach

                      @foreach($trademarks as $trademark)                     
                          <option value="{{$trademark->id}}"
                            @foreach($trademarks_edit as $trademark_edit)
                              @if($trademark->id == $trademark_edit->id) selected @endif
                            @endforeach
                          >
                          {{$trademark->name}}
                          </option>  
                      @endforeach
                    @endif
                  </select>
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <input type="text" class="form-control" name="description" value="{{ old('description',$category->description) }}">
                    @if($errors->has('description'))
                        <div class="error">{{ $errors->first('description') }}</div>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
                  <a href="{{ URL::previous() }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
              </form>
        <!-- end form -->

        <!-- /.card-body -->
        <div class="card-footer">Tạo mới danh mục</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection
