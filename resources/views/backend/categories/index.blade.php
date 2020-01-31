@extends('backend.layouts.master')
@section('title')
Danh sách danh mục
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
                <h1 class="m-0 text-dark">Quản lí danh mục</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí danh mục</li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách danh mục --</h3>
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th>Tên danh mục</th>
                      <th>Danh mục cha</th>
                      <th>Mô tả</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($categories))
	                  	@foreach($categories as $category)
		                    <tr>
		                      <td>{{ $category->id }}</td>
		                      <td>{{ $category->name }}</td>
                          <td>
                            @if($category->parent_id == NULL)
                              Danh mục cha
                            @else
                              @foreach($categories as $cate)
                                @if($category->parent_id == $cate->id)
                                  {{$cate->name}}
                                @else
                                @continue
                                @endif
                              @endforeach
                            @endif
                          </td>
		                      <td>{{ $category->description }}</td>
		                      <td>
                            <a href="{{ route('backend.category.show_products',$category->id) }}" class="btn btn-success btn-sm " data-toggle="tooltip" title="Sản phẩm của danh mục" style="margin-right: 1%"><i class="fas fa-list"></i></a>
                            
                            @can('update',$category)
		                      	<a href="{{ route('backend.category.edit',$category->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa" style="margin-right: 1%"><i class="fas fa-edit"></i></a>
                            @endcan
                            
                            @if($category->deleted_at == NULL)
                              @can('delete',$category)
                              <a href="{{ route('backend.category.destroy',$category->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Đưa vào thùng rác"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              @endcan
                            @else
                              @can('restore',$category)
                              <a href="{{ route('backend.category.restore',$category->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Khôi phục"style="margin-right: 1%"><i class="fa fa-undo" aria-hidden="true" ></i></a>
                              @endcan
                              @can('forceDelete',$category)
                              <a href="{{ route('backend.category.forcedelete',$category->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a>
                              @endcan
                            @endif
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $categories->links() !!}</div>
              
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách danh mục</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection