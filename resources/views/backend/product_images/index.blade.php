@extends('backend.layouts.master')
@section('title')
Danh sách ảnh mô tả
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
                <h1 class="m-0 text-dark">Quản lí sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Quản lí sản phẩm</li>
                    <li class="breadcrumb-item"><a href="{{route('backend.product.index')}}">Danh sách</a></li>
                    <li class="breadcrumb-item active">Ảnh mô tả</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>
@endsection
@section('content')

<section class="content">

      <!-- Default box -->
      <h3 style="text-align: center;">-- Danh sách ảnh mô tả của sản phẩm --</h3>
      @can('actionProductImageDescription',$product)
        <a href="{{route('backend.product.add.image.description',$product->id)}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm ảnh mô tả</a>
      @endcan
      <div class="card">
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover">
                  <thead class="add-background-thead">
                    <tr>
                      <th>ID</th>
                      <th style="width: 40%">Ảnh</th>
                      <th>Ngày tạo</th>                     
                      <th>@can('actionProductImageDescription',$product) Thao tác @endcan</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@if(isset($product_images))
	                  	@foreach($product_images as $key=>$product_image)
		                    <tr>
		                      <td>{{$key+1}}</td>
		                      <td style="width: 40%"><img style="width: 30%;height: 80px;" src="{{ asset($product_image->path) }}"></td>
                          <td>{{$product_image->created_at->format('H:i:s - d/m/Y')}}</td>
		                      <td>  
                            @can('actionProductImageDescription',$product)
                            <a href="{{ route('backend.product.forcedelete.image.description',$product_image->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-times" aria-hidden="true"></i></a> 
                            @endcan                        
		                      </td>
		                  	</tr>
		                @endforeach
	                @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $product_images->links() !!}</div>
              
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách thương hiệu</div> -->
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection