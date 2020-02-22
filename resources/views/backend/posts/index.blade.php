@extends('backend.layouts.master')
@section('title')
Danh sách bài viết
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $("#form-search").submit(function() {
        $(this).find(":input").filter(function(){return !this.value;}).attr("disabled", "disabled");
    });
    $("#form-search").find(":input").prop("disabled", false);
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
        <li class="breadcrumb-item active">Bài viết</li>
        <li class="breadcrumb-item active">Danh sách</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')

<section class="content">
  <h3 style="text-align: center;">-- Danh sách bài viết --</h3>
  @can('create',App\Models\Post::class)
    <a href="{{route('backend.post.create')}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới bài viết</a>
  @endcan
  <div class="card">
  </div>
  <form id="form-search" class="form-inline" action="" style="margin-bottom: 1%; margin-left: 1%">
    <div class="form-group">
      <input type="text" name="title" placeholder="Tiêu đề bài viết" class="form-control" id="title" value="{{(\Request::get('title')!='') ? \Request::get('title') : '' }}">
    </div>
    <div class="form-group">
      <select class="form-control" name="news_category_id" id="search-news-category">
        <option value="">-- Danh mục --</option>
        @if(isset($news_categories))
        @foreach ($news_categories as $news_category)
        @if($news_category->parent_id == NULL)
        <option value="{{$news_category->id}}" @if (\Request::get('news_category_id') == $news_category->id ) selected @endif>{{$news_category->name}}</option>
        @endif
        @endforeach
        @endif

      </select>
    </div>
    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
  </form>
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th style="width: 5%">ID</th>
          <th style="width: 30%">Tiêu đề</th>
          <th style="width: 15%">Danh mục</th>                     
          <th>Hình ảnh</th>
          <th>Lượt xem</th>
          <th>Nổi bật</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($posts))
        @foreach($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>
            <a class="name" target="_blank" href="{{route('frontend.detail_post',$post->slug)}}" style="color: #333">{{ (Str::limit($post->title, 80, $end='...')) }}</a>
          </td>

          <td>{{ isset($post->news_category->name) ? $post->news_category->name :'' }}
          </td>
          
          <td>
            <img src="{{asset($post->image)}}" style="width: 120px; height: 70px;">
          </td>

          <td>{{ $post->view_count }}
          </td>

          <td>
            @if($post->hot == 1)
              @can('changeHot',$post)
                <a href="{{ route('backend.post.change_hot',$post->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Tắt nổi bật">Nổi bật</a>
              @elsecan('notChangeHot',$post)
                <a href="javascript:void(0)" style="cursor: default;" class="btn btn-success btn-sm" data-toggle="tooltip">Nổi bật</a>
              @endcan
            @else
              @can('changeHot',$post)
              <a href="{{ route('backend.post.change_hot',$post->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Bật nổi bật">Không</a>
              @elsecan('notChangeHot',$post)
              <a href="javascript:void(0)" style="cursor: default;" class="btn btn-secondary btn-sm" data-toggle="tooltip">Không</a>
              @endcan
            @endif
          </td>

          <td>
            @can('update',$post)
              <a href="{{ route('backend.post.edit',$post->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
            @endcan

            @if($post->deleted_at == NULL)
              @can('delete',$post)
              <a href="{{ route('backend.post.destroy',$post->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Đưa vào thùng rác"><i class="fa fa-trash" aria-hidden="true"></i></a>
              @endcan
            @else
              @can('restore',$post)
              <a href="{{ route('backend.post.restore',$post->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Khôi phục"style="margin:0 4% 0% 0"><i class="fa fa-undo" aria-hidden="true" ></i></a>
              @endcan
              @can('forceDelete',$post)
              <a href="{{ route('backend.post.forcedelete',$post->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
              @endcan
            @endif
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <div style="float: right; margin-right: 2%">{!! $posts->links() !!}</div>
  </div>
  <!-- /.card-body -->
  <!-- <div class="card-footer">Danh sách danh mục</div> -->

</div>
</div>
<!-- /.card -->

</section>
@endsection
