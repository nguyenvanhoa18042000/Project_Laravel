@extends('backend.layouts.master')
@section('title')
Tạo sản phẩm
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('backend/dist/css/file-upload-with-preview.min.css')}}">
@endsection
@section('script')
<script src="{{asset('backend/dist/js/file-upload-with-preview.min.js')}}"></script>
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
	//var $name = 'https://images.unsplash.com/photo-1557090495-fc9312e77b28?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=668&q=80';

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
				<form role="form" method="POST" action="{{ route('backend.product.store') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="card-body" style="padding-top: 0">
						<div class="row">
							<div class="col-6" style="border: 1px solid #bab0b0; border-top:none; border-left: none; padding-top: 1%">
								<div class="form-group">
									<label for="name">Tên sản phẩm</label>
									<input type="text" placeholder="Tên sản phẩm" class="form-control" name="name" value="{{ old('name') }}">
									@if($errors->has('name'))
									<div class="error">{{ $errors->first('name') }}</div>
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
									<label for="origin_price">Số lượng sản phẩm (>=0)</label>
									<input type="number" placeholder="Số lượng sản phẩm" class="form-control" name="amount" value="{{ old('amount') }}">
									@if($errors->has('amount'))
									<div class="error">{{ $errors->first('amount') }}</div>
									@endif
								</div>

								<div style="text-align: center; margin-top: 2%">
									<img id="out_img" src="{{ asset('images/product/default.png') }}" style="width:59%; height: 261px;">
								</div>
								<div class="form-group">
									<label for="image">Ảnh sản phẩm (JPEG, JPG, PNG)</label>
									<input id="inp_img" type="file" class="form-control" name="image">
									@if($errors->has('image'))
									<div class="error">{{ $errors->first('image') }}</div>
									@endif
								</div>
	
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input name="hot" value="1" class="custom-control-input" type="checkbox" id="customCheckbox2">
										<label for="customCheckbox2" class="custom-control-label">Nổi bật</label>
									</div>
								</div>
							</div>

							<div class="col-6" style="border: 1px solid #bab0b0; border-left: none; border-top:none; border-right: none; padding-top: 1% ">

								<div class="form-group">
									<label for="origin_price">Giá gốc sản phẩm (VNĐ)</label>
									<input type="number" placeholder="Giá gốc sản phẩm" class="form-control" name="origin_price" value="{{ old('origin_price') }}">
									@if($errors->has('origin_price'))
									<div class="error">{{ $errors->first('origin_price') }}</div>
									@endif
								</div>
								<div class="form-group">
									<label for="sale_price">Giá bán sản phẩm (VNĐ)</label>
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
									<div class="custom-file-container" data-upload-id="myupload">
										<div class="custom-file-container__image-preview" style="overflow: hidden; margin: 1%;"></div>

										<label>Ảnh chi tiết sản phẩm (JPEG, JPG, PNG) <a href="javascript:void(0)" class="custom-file-container__image-clear">&times;</a></label>
										<label class="custom-file-container__custom-file">
											<input type="file" name="images[]" class="custom-file-container__custom-file__custom-file-input" accept="image/*" multiple aria-label="Mutiple Select Files">
											<input type="hidden" name="MAX_FILE_SIZE" value="10485760" >
											<span class="custom-file-container__custom-file__custom-file-control"></span>
										</label>
										@if($errors->has('images.*'))
											<div class="error">{{ $errors->first('images.*') }}</div>
										@endif
									</div>
								</div>
							</div>
															
							<div class="col-12">
								<div class="form-group" style="margin-top: 1%;">
									<label for="description">Mô tả</label>
									<textarea placeholder="Mô tả ngắn sản phẩm" class="form-control" placeholder="Nội dung" name="description" rows="3" cols="3">{{ old('description') }}</textarea>
									@if($errors->has('description'))
									<div class="error">{{ $errors->first('description') }}</div>
									@endif
								</div>

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
					<a href="{{ route('backend.home') }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>

				</form>
				<!-- end form -->
				<!-- /.card-body -->
				<div class="card-footer">Tạo mới sản phẩm</div>

			</div>
		</div>
		<!-- /.card -->

	</section>
	@endsection
