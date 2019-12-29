@extends('backend.layouts.master')
@section('title')
Tạo sản phẩm
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
<h3 style="text-align: center;">-- Danh sách sản phẩm --</h3>
      <div class="card">
              </div>
              <!-- /.card-header -->
              
              <div class="card-body table-responsive p-0">
                <form class="form-inline" action="" style="margin-bottom: 1%; margin-left: 1%">
                  <div class="form-group">
                    <input type="text" placeholder="Tên sản phẩm" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                      <select class="form-control" name="" id="">
                          <option value="">Danh mục</option>
                      </select>
                  </div>
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </form>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên sản phẩm</th>
                      <th>Loại sản phẩm</th>
                      <!-- <th>Hình ảnh</th> -->
                      <th>Trạng thái</th>
                      <!-- <th>Nổi bật</th> -->
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($products))
                        @foreach($products as $product)
                             <tr>
                              <td>{{ $product->id }}</td>
                              <td>
                                {{ $product->name }}
                                <ul>
                                    <li><span>{{number_format($product->sale_price)}}</span> VNĐ</li>
                                    <li><span>{{$product->discount_percent}}</span> %</li>
                                </ul>
                              </td>
                              <td>{{ $product->category_id }}</td>
                              <td>
                                <a 
                                @if($product->status == 1) data-toggle="tooltip" title="Ẩn" 
                                @else data-toggle="tooltip" title="Hiển thị" 
                                @endif 
                                class="btn btn-sm btn_status btn-primary" href="{{ route('backend.product.edit_status',$product->id) }}">{!! $product->getStatus($product->status)['name'] !!}</a>  
                              </td>
                              <td>
                                <a href="{{ route('backend.product.edit',$product->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>

                                <a href="{{ route('backend.product.destroy',$product->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
                <div style="float: right; margin-right: 2%">{!! $products->links() !!}</div>
              </div>
              <!-- /.card-body -->
        <!-- <div class="card-footer">Danh sách danh mục</div> -->
          
        </div>
      </div>
      <!-- /.card -->

</section>
@endsection
