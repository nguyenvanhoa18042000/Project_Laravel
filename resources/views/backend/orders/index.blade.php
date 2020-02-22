@extends('backend.layouts.master')
@section('title')
Danh sách đơn hàng
@endsection
@section('css')
<style>
@media only screen and (min-width: 992px) {
  .modal-lg, .modal-xl {
    max-width: 1000px;
  }
}
</style>
@endsection
@section('script')
<script>
$(function(){
  $('.status').change(function(){
    var id_order = $('#id_order').val();
    var status = $(this).val();
    if(status != '')
    {
     var _token = $('input[name="_token"]').val();
     $.ajax({
      url:"{{ route('backend.order.handle') }}",
      method:"POST",      
      data:{
        status:status,
        id_order:id_order,
        _token:_token
      },
      success:function(data){
        location.reload();
      }
    });
   }
  });

  $('.td-status').mousedown(function(){
    var btn_status = $(".btn-status");
    var status = $(".status");
    $(this).find(btn_status).css("display","none");
    $(this).find(status).css("display","block");
  });

  
});
</script>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $("#form-search").submit(function() {
        $(this).find(":input").filter(function(){return !this.value;}).attr("disabled", "disabled");
    });
    $("#form-search").find(":input").prop("disabled", false);

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
      <h1 class="m-0 text-dark">Quản lí đơn hàng</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        <li class="breadcrumb-item active">Quản lí đơn hàng</li>
        <li class="breadcrumb-item active">Danh sách</li>
      </ol>
    </div><!-- /.col -->
  </div>
</div>
@endsection
@section('content')

<section class="content">

  <!-- Default box -->
  <h3 style="text-align: center;">-- Danh sách đơn hàng --</h3>
  <div class="card">
  </div>
  <form id="form-search" class="form-inline" action="" style="margin-bottom: 1%; margin-left: 1%">
    <div class="form-group">
      <select class="form-control" name="status_order" id="search-category">
        <option value="">-- Trạng thái đơn hàng --</option>
        <option value="1" @if (\Request::get('status') == 1 ) selected @endif>Chưa xử lí</option>
        <option value="2" @if (\Request::get('status') == 2 ) selected @endif>Đã xử lí</option>
        <option value="3" @if (\Request::get('status') == 3 ) selected @endif>Đang giao hàng</option>
        <option value="4" @if (\Request::get('status') == 4 ) selected @endif>Đã giao hàng</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
  </form>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th>Tên khách hàng</th>
          <th style="width: 25%;">Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Tổng tiền</th>
          <th>Thời gian đặt</th>
          <th>Tình trạng</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{$order->user->name}}</td>
          <td>{{ (Str::limit($order->address, 100, $end='...')) }}</td>
          <td>{{$order->phone_number}}</td>
          <td>{{ number_format($order->total_money,0,',','.') }} VNĐ</td>
          <td>
            {{$order->created_at->format('H:i:s - d/m/Y')}}
          </td>
          <td class="td-status">
            @if($order->status == App\Models\Order::STATUS_DONE)
              <button class="btn btn-success" style="cursor: context-menu;">Đã giao hàng</button>
            @else
              @if($order->status == App\Models\Order::STATUS_NO_PROCESS)
                <button class="btn btn-secondary btn-status" >Chưa xử lí</button>
              @elseif($order->status == App\Models\Order::STATUS_PROCESS)
                <button class="btn btn-warning btn-status" >Đã xử lí</button>
              @elseif($order->status == App\Models\Order::STATUS_DELIVERY)
                <button class="btn btn-primary btn-status" >Đang giao hàng</button>
              @else
                <button class="btn btn-danger btn-status" >Đã hủy</button>
              @endif
              <form class="status-order" action="javascript:;" method="POST">
                @csrf
                <input id="id_order" type="hidden" value="{{$order->id}}">
                <select name="status_order" class="form-control status" style="width: 80%;display: none;">
                  <option @if($order->status == 1) selected @endif value="1">Chưa xử lí</option>
                  <option @if($order->status == 2) selected @endif value="2">Đã xử lí</option>
                  <option @if($order->status == 3) selected @endif value="3">Đang giao hàng</option>
                  <option @if($order->status == 4) selected @endif value="4">Đã giao hàng</option>
                  <option @if($order->status == 0) selected @endif value="0">Đã hủy đơn</option>
                </select>
              </form>
            @endif
          </td>
          <td>
            <a style="margin-right: 3%" href="{{ route('backend.order.show',$order->id) }}" class="btn btn-sm btn-primary js_order_item" data-id="{{$order->id}}" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
            @can('delete',$order)
            <a href="{{ route('backend.order.destroy',$order->id) }}" class="btn btn-sm btn_delete"  data-toggle="tooltip" title="Xóa đơn hàng"><i class="fa fa-times" aria-hidden="true"></i></a>
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