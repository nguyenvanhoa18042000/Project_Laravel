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
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('.js_order_item').click(function(event){
      event.preventDefault();
      let $this = $(this);
      let url = $this.attr('href');

      $('.order_id').text('').text($this.attr('data-id'));
      $('#myModalOrder').modal('show');
      $('#md_content').html('');

      $.ajax({
        url:url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      }).done(function(result){
          if(result){
            $('#md_content').append(result);
          }
      });
    });
  });
</script>
@endsection
@section('content-header')
<div class="container-fluid">
	<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0 text-dark">Trang chủ</h1>
		</div>
    <!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đơn hàng của bạn</li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">

  <!-- Default box -->
  <h3 style="text-align: center;">-- Danh sách đơn hàng --</h3>
  <div class="card">
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th style="width: 20%;">Địa chỉ</th>
          <th style="width: 12%">Số điện thoại</th>
          <th>Ghi chú</th>
          <th>Tổng tiền</th>
          <th style="width: 11%;">Thời gian</th>
          <th style="width: 11%;">Tình trạng</th>
          <th style="width: 15%">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ (Str::limit($order->address, 100, $end='...')) }}</td>
          <td>{{$order->phone_number}}</td>
          <td>@if($order->note != NULL) {{ (Str::limit($order->note, 100, $end='...')) }} @else Trống @endif</td>
          <td>{{ number_format($order->total_money,0,',','.') }} VNĐ</td>
          <td>
            {{$order->created_at->format('H:i:s | d/m/Y')}}
          </td>
          <td class="td-status">
            @if($order->status == App\Models\Order::STATUS_DONE)
              <button class="btn btn-sm btn-success" style="cursor: context-menu;">Đã giao hàng</button>
            @elseif($order->status == App\Models\Order::STATUS_NO_PROCESS)
              <button class="btn btn-sm btn-secondary btn-status" style="cursor: context-menu;">Chưa xử lí</button>
            @elseif($order->status == App\Models\Order::STATUS_PROCESS)
              <button class="btn btn-sm btn-warning btn-status" style="cursor: context-menu;">Đã xử lí</button>
            @elseif($order->status == App\Models\Order::STATUS_DELIVERY)
              <button class="btn btn-sm btn-primary btn-status" style="cursor: context-menu;">Đang giao hàng</button>
            @else
              <button class="btn btn-sm btn-danger btn-status" style="cursor: context-menu;">Đã hủy</button>
            @endif
          </td>
          <td>
            @can('view',$order)
            <a style="margin-right: 3%" href="{{ route('profile.user.order.show',$order->id) }}" class="btn btn-sm btn-primary js_order_item" data-id="{{$order->id}}" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
            @endcan
            @if($order->status == App\Models\Order::STATUS_NO_PROCESS || $order->status == App\Models\Order::STATUS_PROCESS)
            @can('update',$order)
            <a style="margin-right: 3%" href="{{ route('profile.user.order.edit',$order->id) }}" class="btn btn-sm btn_edit" data-id="{{$order->id}}" data-toggle="tooltip" title="Chỉnh sửa"><i class="fa fa-pen"></i></a>
            @endcan
            @endif
            @can('delete',$order)
            @if($order->status != App\Models\Order::STATUS_DONE && $order->status != App\Models\Order::STATUS_CANCELLED)
            <a href="{{ route('profile.user.order.delete',$order->id) }}" class="btn btn-sm btn_delete"  data-toggle="tooltip" title="Xóa đơn hàng"><i class="fa fa-times" aria-hidden="true"></i></a>
            @endif
            @endcan
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div style="float: right; margin-right: 2%"></div>

    <div class="modal fade" id="myModalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="border-left: 7px solid #ef3614;padding-left: 5px;">Chi tiết mã đơn hàng <b class="order_id">sdasda</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="md_content" style="padding: 0;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Đóng</button>
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<!-- /.card-body -->
<!-- <div class="card-footer">Danh sách danh mục</div> -->

</div>
</div>
<!-- /.card -->

</section>
@endsection