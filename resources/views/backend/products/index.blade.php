@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
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
                    <li class="breadcrumb-item active">Danh sách</li>
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
              <form class="form-inline" action="" style="margin-bottom: 1%; margin-left: 1%">
                  <div class="form-group">
                    <input type="text" name="name" placeholder="Tên sản phẩm" class="form-control" id="name" value="{{(\Request::get('name')!='') ? \Request::get('name') : '' }}">
                  </div>
                  <div class="form-group">
                      <select class="form-control" name="category_id" id="">
                        <option value="">-- Danh mục --</option>
                        @if(isset($categories))
                          @foreach ($categories as $category)
                            @if($category->parent_id == NULL)
                              <option value="{{$category->id}}" @if (\Request::get('category_id') == $category->id ) selected @endif>{{$category->name}}</option>
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
                      <th>ID</th>
                      <th>Tên sản phẩm</th>
                      <th>Loại sản phẩm</th>                     
                      <th>Giá</th>
                      <th>Hình ảnh</th>
                      <th>Số lượng</th>
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
                              </td>

                              <td>{{ isset($product->category->name) ? $product->category->name :'' }}
                              </td>
                                                          
                              <td>
                                <ul style="padding-left: 0;">
                                  <li>Giá gốc: <span>{{number_format($product->origin_price)}}</span> VNĐ</li>
                                  <li>Giá bán: <span>{{number_format($product->sale_price)}}</span> VNĐ</li>
                                  <li>Giảm giá: <span>{{$product->discount_percent}}</span> %</li>
                                </ul>
                              </td>

                              <td>
                                <img src="{{asset('storage/images/product/main/'.$product->image)}}" style="width: 100px; height: 100px;">
                              </td>

                              <td>
                                <ul style="padding-left: 0;">
                                  <li>Hiện có: <span>@if($product->amount>0) {{$product->amount}} @else Hết hàng @endif</span></li>
                                  <li>Đã bán: <span>{{$product->amount_sold}}</span></li>
                                </ul>
                              </td>

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
