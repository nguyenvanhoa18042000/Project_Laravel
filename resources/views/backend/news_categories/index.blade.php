@extends('backend.layouts.master')
@section('title')
Danh sách danh mục tin tức
@endsection
@section('script')
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
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
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách danh mục tin tức --</h3>
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th>Tên danh mục</th>
                      <th>Mô tả</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($news_categories))
	                  	@foreach($news_categories as $news_category)
		                    <tr>
		                      <td>{{ $news_category->id }}</td>
		                      <td>{{ $news_category->name }}</td>
		                      <td>{{ $news_category->description }}</td>
		                      <td>
		                      	@if($news_category->status==1)
		                      		<a href="{{ route('backend.news_category.edit_status',$news_category->id) }}" class="btn btn_status btn-sm" data-toggle="tooltip" title="Ẩn"><i class="fa fa-globe"></i></a>
		                      	@else 
		                      		<a href="{{ route('backend.news_category.edit_status',$news_category->id) }}" class="btn btn_status btn-sm" data-toggle="tooltip" title="Hiển thị"><i class="fa fa-lock" aria-hidden="true"></i></a>
		                      	@endif
		                  	  </td>
		                      <td>
                            <a href="{{ route('backend.news_category.show_posts',$news_category->id) }}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Bài viết của danh mục" style="margin-right: 5%"><i class="fas fa-list"></i></a>

		                      	<a href="{{ route('backend.news_category.edit',$news_category->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>

		                      	<a href="{{ route('backend.news_category.destroy',$news_category->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></a>
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $news_categories->links() !!}</div>
              
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách danh mục</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection