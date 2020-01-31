@extends('backend.layouts.master')
@section('title')
Danh sách bài viết
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
  <div class="card">
  </div>
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th style="width: 5%">ID</th>
          <th style="width: 20%">Tiêu đề</th>
          <th style="width: 15%">Danh mục</th>                     
          <th>Hình ảnh</th>
          <th>Lượt xem</th>
          <th>Trạng thái</th>
          <!-- <th>Nổi bật</th> -->
          <!-- <th>Người đăng</th> -->
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($posts))
        @foreach($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>
            {{ $post->title }}
          </td>

          <td>{{ isset($post->news_category->name) ? $post->news_category->name :'' }}
          </td>
          
          <td>
            <img src="{{asset($post->image)}}" style="width: 100px; height: 100px;">
          </td>

          <td>{{ $post->status }}
          </td>

          <td>{{ $post->view_count }}
          </td>

          <td>
            <a href="{{ route('backend.post.edit',$post->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>

            <a href="{{ route('backend.post.destroy',$post->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
    <!-- <div style="float: right; margin-right: 2%">{!! $posts->links() !!}</div> -->
  </div>
  <!-- /.card-body -->
  <!-- <div class="card-footer">Danh sách danh mục</div> -->

</div>
</div>
<!-- /.card -->

</section>
@endsection
