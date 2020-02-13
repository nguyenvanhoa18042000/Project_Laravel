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

<script>
@if(Session::has('message'))
toastr.options = {
  "closeButton": true,
  "progressBar": true,
  "timeOut": "3000",
}
var type="{{Session::get('alert-type')}}"
switch(type){
  case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
  case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
}
@endif
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
      @can('create',App\Models\NewsCategory::class)
        <a href="{{route('backend.news_category.create')}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới danh mục tin tức</a>
      @endcan
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th>Tên danh mục</th>
                      <th>Danh mục chứa</th>
                      <th>Mô tả</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($news_categories))
	                  	@foreach($news_categories as $news_category)
		                    <tr>
		                      <td>{{ $news_category->id }}</td>
		                      <td>
                            <a class="to-link" style="color: #333;" target="_blank" href="{{route('frontend.detail_news_category',$news_category->slug)}}">
                              {{ $news_category->name }}
                            </a>
                          </td>
                          <td>
                            @if($news_category->parent_id == NULL)
                              Danh mục cha
                            @else
                              @foreach($news_categories as $news_cate)
                                @if($news_category->parent_id == $news_cate->id)
                                  {{$news_cate->name}}
                                @else
                                  @continue
                                @endif
                              @endforeach
                            @endif
                          </td>
		                      <td>{{ $news_category->description }}</td>
		                      <td>
                            <a href="{{ route('backend.news_category.show_posts',$news_category->id) }}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Bài viết của danh mục" style="margin-right: 4%"><i class="fas fa-list"></i></a>

		                      	<a href="{{ route('backend.news_category.edit',$news_category->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>

		                      	@if($news_category->deleted_at == NULL)
                              @can('delete',$news_category)
                              <a href="{{ route('backend.news_category.destroy',$news_category->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Đưa vào thùng rác"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              @endcan
                            @else
                              @can('restore',$news_category)
                              <a href="{{ route('backend.news_category.restore',$news_category->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Khôi phục"style="margin:0 4% 0% 0"><i class="fa fa-undo" aria-hidden="true" ></i></a>
                              @endcan
                              @can('forceDelete',$news_category)
                              <a href="{{ route('backend.news_category.forcedelete',$news_category->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
                              @endcan
                            @endif
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