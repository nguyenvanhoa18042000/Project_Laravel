@extends('backend.profiles.layout')
@section('title')
Danh sách đánh giá
@endsection
@section('script')
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
			<h1 class="m-0 text-dark">Trang chủ</h1>
		</div><!-- /.col -->
       <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Trang chủ</li>
            </ol>
        </div> --><!-- /.col -->
    </div>
</div>
@endsection
@section('content')
@section('content')
<div class="row">
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$number_order_done}}</h3>

        <p>Đơn hàng đã giao</p>
    </div>
    <div class="icon">
        <i class="fas fa-handshake"></i>
    </div>
    <a href="{{route('backend.order.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$number_order_delivery}}</h3>

        <p>Đang giao hàng</p>
    </div>
    <div class="icon">
        <i class="fa fa-truck" aria-hidden="true"></i>
    </div>
    <a href="{{route('backend.order.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3 style="color: white">{{$number_order_process}}</h3>

        <p style="color: white">Đơn hàng đã xử lí</p>
    </div>
    <div class="icon">
        <i class="fa fa-check" aria-hidden="true"></i>
    </div>
    <a href="{{route('backend.order.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$number_order_cancelled}}</h3>

        <p>Đơn hàng đã hủy</p>
    </div>
    <div class="icon">
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
    <a href="{{route('backend.order.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<!-- ./col -->
</div>

<div class="container_fluid">
    <div class="row" style="margin: 2% 0 4% 0;">
        <div class="col-12 col-sm-12 col-lg-12">
            <h3>Đơn hàng mới đây nhất</h3>
            <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover table-sm">
                  <thead class="add-background-thead">
                    <tr>
                      <th>STT</th>
                      <th>Địa chỉ</th>
                      <th>Số điện thoại</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Thời gian</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($user_orders))
                    @foreach($user_orders as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{ (Str::limit($order->address, 100, $end='...')) }}</td>
                            <td>{{ $order->phone_number }}</td>
                            <td>{{number_format($order->total_money)}} VNĐ</td>
                            <td>
                                @switch($order->status)
                                    @case(App\Models\Order::STATUS_DONE)
                                        <button style="cursor: context-menu;" class="btn btn-sm btn-success">Đã giao hàng</button>
                                        @break

                                    @case(App\Models\Order::STATUS_PROCESS)
                                        <button style="cursor: context-menu;" class="btn btn-sm btn-warning">Đã xử lí</button>
                                        @break
                                    @case(App\Models\Order::STATUS_DELIVERY)
                                        <button style="cursor: context-menu;" class="btn btn-sm btn-primary">Đang giao hàng</button>
                                        @break
                                    @case(App\Models\Order::STATUS_CANCELLED)
                                        <button style="cursor: context-menu;" class="btn btn-sm btn-danger">Đã hủy</button>
                                        @break
                                    @default
                                        <button style="cursor: context-menu;" class="btn btn-sm btn-secondary">Chưa xử lí</button>
                                @endswitch
                            </td>
                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                        </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <h3>Đánh giá mới đây nhất</h3>
            <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover table-sm">
                  <thead class="add-background-thead">
                    <tr>
                      <th>STT</th>
                      <th>Sản phẩm</th>
                      <th style="width: 15%;">Điểm đánh giá</th>
                      <th>Nội dung</th>
                      <td style="width: 11%;padding-left: 5px;">Thời gian</td>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($user_ratings))
                    @foreach($user_ratings as $key => $rating)
                     
                        <tr>
                        <td>{{$key + 1}}</td>
                        <td><a target="_blank" href=""></a></td>
                        <td>
                          <ul style="padding-left: 0">
                            <li style="list-style: none;">
                              <span class="rating">
                                @for($i=1;$i<=5;$i++)
                                <i class="fas fa-star" style ="color:{{ $i <= $rating->number_star ? '#ff9705' : '' }}"></i>
                                @endfor
                              </span>
                            </li>
                          </ul>
                        </td>
                        <td>{{ (Str::limit($rating->content, 300, $end='...')) }}</td>
                        <td>{{$rating->created_at->format('H:i:s | d/m/Y')}}</td>
                      </tr>
                     
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
@endsection