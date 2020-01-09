@extends('backend.layouts.master')
@section('title')
Tạo sản phẩm
@endsection
@section('css')
 <link rel="stylesheet" href="backend/plugins/summernote/summernote-bs4.css">
@endsection
@section('script')
<script src="backend/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#textarea').summernote({
    	placeholder: 'Nội dung chi tiết sản phẩm...',
        height: 250,
	    minHeight: 150,
	    maxHeight: 500
    });
  })
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
                	<div class="row">
                		<div class="col-6" style="border: 1px solid #bab0b0">
                			<div class="form-group">
		                    <label for="name">Tên sản phẩm</label>
		                    <input type="text" placeholder="Tên sản phẩm" class="form-control" name="name" value="{{ old('name') }}">
		                    @if($errors->has('name'))
		                        <div class="error">{{ $errors->first('name') }}</div>
		                    @endif
		                  </div>

		                  <div class="form-group">
		                    <label for="description">Mô tả</label>
		                   <textarea placeholder="Mô tả ngắn sản phẩm" class="form-control" placeholder="Nội dung" name="description" rows="3" cols="3"></textarea>
		                   @if($errors->has('description'))
		                        <div class="error">{{ $errors->first('description') }}</div>
		                    @endif
		                  </div>

		                  <div class="form-group">
		                    <label for="category_id">Loại sản phẩm</label>
		                    <select name="category_id" class="form-control">
		                    	<option value="">--Chọn loại sản phẩm--</option>
		                    	@if(isset($categories))
			                    	@foreach($categories as $category)
			                    		@if($category->parent_id == NULL)
			                    			<option value="{{ $category->id }}">{{ $category->name }}</option>
			                    		@endif
			                    	@endforeach
			                    @endif
		                    </select>
		                    @if($errors->has('category_id'))
	                        	<div class="error">{{ $errors->first('category_id') }}</div>
	                    	@endif
		                </div>
		                <div class="form-group">
		                    <div class="custom-control custom-checkbox">
		                      <input name="hot" value="1" class="custom-control-input" type="checkbox" id="customCheckbox2">
		                      <label for="customCheckbox2" class="custom-control-label">Nổi bật</label>
		                    </div>
              			</div>
		            </div>

                		<div class="col-6" style="border: 1px solid #bab0b0;border-left: none;">
			                <div class="form-group">
			                    <label for="origin_price">Giá gốc sản phẩm</label>
			                    <input type="number" placeholder="Giá gốc sản phẩm" class="form-control" name="origin_price" value="{{ old('origin_price') }}">
			                    @if($errors->has('origin_price'))
		                        	<div class="error">{{ $errors->first('origin_price') }}</div>
		                    	@endif
			                </div>
			                <div class="form-group">
			                    <label for="sale_price">Giá bán sản phẩm</label>
			                    <input type="number" placeholder="Giá bán sản phẩm" class="form-control" name="sale_price" value="{{ old('sale_price') }}">
			                    @if($errors->has('sale_price'))
		                        	<div class="error">{{ $errors->first('sale_price') }}</div>
		                    	@endif
			                </div>
			                <div class="form-group">
			                    <label for="discount_percent">% Giảm giá</label>
			                    <input type="number" placeholder="% Giảm giá" class="form-control" name="discount_percent" value="0">
			                </div>
			                <div class="form-group">
			                    <label for="thumbnail">Ảnh sản phẩm</label>
			                    <input type="file" class="form-control" name="thumbnail" value="{{ old('thumbnail') }}">
			                </div>
                		</div>
					<div class="col-12">
						<div class="form-group">
		                    <label for="content">Nội dung</label>
		                    <textarea id="textarea" class="form-control" name="content"></textarea>
		                     @if($errors->has('content'))
		                        <div class="error">{{ $errors->first('content') }}</div>
		                    @endif
		                </div>
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
