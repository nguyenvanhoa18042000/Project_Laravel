@extends('backend.layouts.master')
@section('title')
Trang dashboard
@endsection
@section('css')
@endsection
@section('content-header')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Trang chủ</h1>
        </div><!-- /.col -->
        <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div> -->
    </div>
</div>

@endsection
@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$number_products}}</h3>

        <p>Sản phẩm</p>
    </div>
    <div class="icon">
        <i class="fab fa-product-hunt"></i>
    </div>
    <a href="{{route('backend.product.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$number_orders}}</h3>

        <p>Đơn hàng</p>
    </div>
    <div class="icon">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </div>
    <a href="{{route('backend.order.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$number_posts}}</h3>

        <p>Bài viết</p>
    </div>
    <div class="icon">
        <i class="fas fa-newspaper"></i>
    </div>
    <a href="{{route('backend.post.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$number_users}}</h3>

        <p>Khách hàng</p>
    </div>
    <div class="icon">
        <i class="fa fa-user" aria-hidden="true"></i>
    </div>
    <a href="{{route('backend.user.index')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>
<!-- ./col -->
</div>

<div class="container_fluid">
    <div class="row" style="margin: 2% 0 4% 0;">
        <div class="col-5">
            <div id="container">
                
            </div>
        </div>
        <div class="col-7">
            <h3>Danh sách đơn hàng mới nhất</h3>
            <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover table-sm">
                  <thead class="add-background-thead">
                    <tr>
                      <th>STT</th>
                      <th>Tên KH</th>
                      <th>Số điện thoại</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Thời gian</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$order->user->name}}</td>
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
                  </tbody>
                </table>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h3>Danh sách liên hệ mới nhất</h3>
            <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover table-sm">
                  <thead class="add-background-thead">
                    <tr>
                      <th style="width: 10%;">STT</th>
                      <th>Họ tên</th>
                      <th>Tiêu đề</th>
                      <th style="width: 20%;">Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($contacts as $key => $contact)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->title}}</td>
                            <td>
                              @if($contact->status == 1)
                                <span class="badge badge-success">Đã trả lời</span>
                              @else
                                <span class="badge badge-secondary">Chưa trả lời</span>
                              @endif  
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
        <div class="col-6">
            <h3>Danh sách đánh giá mới nhất</h3>
            <div class="card-body table-responsive p-0 add-border-radius">
                <table class="table table-hover table-sm">
                  <thead class="add-background-thead">
                    <tr>
                      <th style="width: 10%;">STT</th>
                      <th>Tên TV</th>
                      <th>Sản phẩm</th>
                      <th style="width: 25%">Điểm đánh giá</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($ratings as $key => $rating)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$rating->user->name}}</td>
                            <td><a href=""></a></td>
                            <td>
                                <ul style="padding-left: 0%;">
                                  <li style="list-style: none;">
                                    <span class="rating">
                                      @for($i=1;$i<=5;$i++)
                                      <i class="fas fa-star" style ="color:{{ $i <= $rating->number_star ? '#ff9705' : '' }}"></i>
                                      @endfor
                                    </span>
                                  </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    // Create the chart
let data = "{{$dataMoney}}";
dataChart = JSON.parse(data.replace(/&quot;/g,'"'));
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Biểu đồ doanh thu'
    },
    subtitle: {
        
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Mức tiền (VNĐ)'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:0f} VNĐ'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: dataChart
        }
    ],
    
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
