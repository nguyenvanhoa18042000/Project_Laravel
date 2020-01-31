@extends('backend.layouts.master')
@section('title')
Danh sách thương hiệu
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
                <h1 class="m-0 text-dark">Quản lí thương hiệu</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí thương hiệu</li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách thương hiệu --</h3>
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th>Tên thương hiệu</th>
                      <th>Ảnh</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($trademarks))
	                  	@foreach($trademarks as $trademark)
		                    <tr>
		                      <td>{{ $trademark->id }}</td>
		                      <td>{{ $trademark->name }}</td>
		                      <td><img style="width: 27%;height: 40px;" src="{{ asset($trademark->image) }}"></td>

		                      <td>
		                      	<a href="{{ route('backend.trademark.edit',$trademark->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>

		                      	<a href="{{ route('backend.trademark.destroy',$trademark->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></a>
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $trademarks->links() !!}</div>
              
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách thương hiệu</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection