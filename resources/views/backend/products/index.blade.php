@extends('backend.layouts.master')
@section('title')
Danh sách sản phẩm
@endsection
@section('css')
<style>
  .rating .active{color: #ff9705;}
</style>
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
        <li class="breadcrumb-item active">Danh sách</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>

@endsection
@section('content')

<section class="content">
  <h3 style="text-align: center;">-- Danh sách sản phẩm --</h3>
  @can('create',App\Models\Product::class)
    <a href="{{route('backend.product.create')}}" class="btn btn-sm btn-success" style="color: white; float: right;margin:0 1% 1% 0;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới sản phẩm</a>
  @endcan
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
          <th>Hình ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Danh mục</th>                     
          <th>Giá</th>   
          <th>Nổi bật</th>            
          <th>Số lượng</th>                     
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @if(isset($products))
        @foreach($products as $product)
        <?php
        $star = 0;
        if ($product->total_rating) {
          $star = round($product->total_number_star / $product->total_rating,1);
        }
        ?>
        <tr>
          <td>{{ $product->id }}</td>

          <td>
            <img src="{{asset($product->image)}}" style="width: 80px; height: 80px;">
          </td>

          <td>
            <a class="to-link" style="color: #333;" target="_blank" href="{{route('frontend.detail_product',$product->id)}}">
              {{ (Str::limit($product->name, 50, $end='...')) }}
            </a>
            <ul style="padding-left: 10%;">
              <li>
                <span class="rating">
                  @for($i=1;$i<=5;$i++)
                  <i class="fas fa-star {{ $i <= $star ? 'active' : '' }}"></i>
                  @endfor
                </span>
                <span> {{$star}}</span>
              </li>
              <li>
                <span>{{$product->total_rating}} đánh giá</span>
              </li>
            </ul>
          </td>
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
          @if($product->hot == 1)
          @can('changeHot',$product)
          <a href="{{ route('backend.product.change_hot',$product->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Tắt nổi bật">Nổi bật</a>
          @elsecan('notChangeHot',$product)
          <a href="javascript:void(0)" style="cursor: default;" class="btn btn-success btn-sm" data-toggle="tooltip">Nổi bật</a>
          @endcan
          @else
          @can('changeHot',$product)
          <a href="{{ route('backend.product.change_hot',$product->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Bật nổi bật">Không</a>
          @elsecan('notChangeHot',$product)
          <a href="javascript:void(0)" style="cursor: default;" class="btn btn-secondary btn-sm" data-toggle="tooltip">Không</a>
          @endcan
          @endif
        </td>

        <td>
          <ul style="padding-left: 0;">
            <li>Hiện có: <span>@if($product->amount>0) {{$product->amount}} @else Hết hàng @endif</span></li>
            <li>Đã bán: <span>{{$product->amount_sold}}</span></li>
          </ul>
        </td>

        <td>
          @can('viewAny',App\Models\Product::class)
          <a target="_blank" href="{{ route('frontend.detail_product',$product->id) }}" class="btn btn-primary btn-sm " data-toggle="tooltip" title="Xem chi tiết" style="margin:0 1% 4% 0"><i class="fa fa-eye" aria-hidden="true"></i></a>
          <a  href="{{ route('backend.product.get.image.description',$product->id) }}" class="btn btn-sm" data-toggle="tooltip" title="Ảnh mô tả SP" style="margin:0 1% 4% 0;background-color: #80777c;color: white;"><i class="fas fa-image"></i></a>
          @endcan

          @can('update',$product)
          <a href="{{ route('backend.product.edit',$product->id) }}" class="btn btn_edit btn-sm " data-toggle="tooltip" title="Chỉnh sửa" style="margin:0 1% 4% 0"><i class="fas fa-edit"></i></a>
          @endcan

          @if($product->deleted_at == NULL)
          @can('delete',$product)
          <a href="{{ route('backend.product.destroy',$product->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Đưa vào thùng rác" style="margin:0 1% 4% 0"><i class="fa fa-trash" aria-hidden="true"></i></a>
          @endcan
          @else
          @can('restore',$product)
          <a href="{{ route('backend.product.restore',$product->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Khôi phục"style="margin:0 1% 4% 0"><i class="fa fa-undo" aria-hidden="true" ></i></a>
          @endcan
          @can('forceDelete',$product)
          <a href="{{ route('backend.product.forcedelete',$product->id) }}" class="btn btn_delete btn-sm" data-toggle="tooltip" title="Xóa" style="margin:0 1% 4% 0"><i class="fa fa-times" aria-hidden="true"></i></a>
          @endcan
          @endif
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
