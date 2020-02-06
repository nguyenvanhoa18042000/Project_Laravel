@extends('backend.layouts.master')
@section('title')
Tạo mới bài viết
@endsection
@section('css')
@endsection
@section('script')
<script>
	$(document).ready(function () {
		$('#textarea').summernote({
			placeholder: 'Nội dung chi tiết bài viết...',
			height: 250,
			minHeight: 150,
			maxHeight: 500
		});
		$('#textarea_for_description').summernote({
			placeholder: 'Mô tả bài viết...',
			height: 50,
			minHeight: 150,
			maxHeight: 200
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
</script>
@endsection
@section('content-header')

<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Tạo mới bài viết</h1>
		</div><!-- /.col -->
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
				<li class="breadcrumb-item active">Quản lí tin tức</li>
				<li class="breadcrumb-item active">Bài viết</li>
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
			<h3 class="card-title">Tạo mới bài viết</h3>

			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fas fa-times"></i></button>
					</div>
				</div>
				<!-- form start -->
				<form role="form" method="POST" action="{{ route('backend.post.store') }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="title">Tiêu đề bài viết</label>
									<input type="text" placeholder="Tiêu đề bài viết" class="form-control" name="title" value="{{ old('title') }}">
									@if($errors->has('title'))
									<div class="error">{{ $errors->first('title') }}</div>
									@endif
								</div>

								<div class="form-group">
									<label for="slug">Slug bài viết</label>
									<input type="text" placeholder="Slug bài viết" class="form-control" name="slug" value="{{ old('slug') }}">
									@if($errors->has('slug'))
									<div class="error">{{ $errors->first('slug') }}</div>
									@endif
								</div>

								<div class="form-group">
									<label for="news_category_id">Danh mục bài viết</label>
									<select name="news_category_id" class="form-control">
										<option value="">--Chọn danh mục bài viết--</option>
										@if(isset($news_categories))
										@foreach($news_categories as $news_category)
										@if($news_category->parent_id == NULL)
										<option value="{{ $news_category->id }}">{{ $news_category->name }}</option>
										@endif
										@endforeach
										@endif
									</select>
									@if($errors->has('news_category_id'))
									<div class="error">{{ $errors->first('news_category_id') }}</div>
									@endif
								</div>

								<div style="text-align: center; margin-top: 2%">
									<img id="out_img" src="{{asset('storage/images/product/default.png')}}" style="width:40%; height: 300px;">
								</div>
								<div class="form-group">
									<label for="image">Ảnh sản phẩm (jpeg, jpg, png)</label>
									<input id="inp_img" type="file" class="form-control" name="image">
									@if($errors->has('image'))
									<div class="error">{{ $errors->first('image') }}</div>
									@endif
								</div>

								<div class="form-group" style="margin-top: 1%;">
									<label for="description">Mô tả</label>
									<textarea id="textarea_for_description" class="form-control" name="description"></textarea>
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

								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input name="hot" checked class="custom-control-input" type="checkbox" id="customCheckbox2">
										<label for="customCheckbox2" class="custom-control-label">Bài viết nổi bật</label>
									</div>
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
				<div class="card-footer">Tạo mới bài viết</div>

			</div>
		</div>
		<!-- /.card -->

	</section>
	@endsection
