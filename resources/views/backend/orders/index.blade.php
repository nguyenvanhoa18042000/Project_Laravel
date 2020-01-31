@extends('backend.layouts.master')
@section('title')
Danh sách đơn hàng
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('.js_order_item').click(function(event){
      event.preventDefault();
      let $this = $(this);
      let url = $this.attr('href');

      $('.order_id').text('').text($this.attr('data-id'));
      $('#myModalOrder').modal('show');

      $.ajax({
        url:url,
      }).done(function(result){
        console.log(result);
      });
    });
  });
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
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0 add-border-radius">
    <table class="table table-hover">
      <thead class="add-background-thead">
        <tr>
          <th>ID</th>
          <th>Tên khách hàng</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Tổng tiền</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{$order->id}}</td>
          <td>{{$order->user->name}}</td>
          <td>{{$order->address}}</td>
          <td>{{$order->phone}}</td>
          <td>{{ number_format($order->total_money,0,',','.') }} VNĐ</td>
          <td>
            @if($order->status == 1)
            <a href="#" class="btn btn-sm btn-success" style="font-size: 13px">Đã xử lý</a>
            @else
            <a href="#" class="btn btn-sm btn-secondary" style="font-size: 13px">Chờ xử lý</a>
            @endif
          </td>
          <td>
            <a href="{{ route('backend.order.show',$order->id) }}" class="btn btn-sm btn-primary js_order_item" data-id="{{$order->id}}" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye"></i></a>
            <a href="{{ route('backend.order.edit',$order->id) }}" class="btn btn-sm btn_delete"  data-toggle="tooltip" title="Xóa đơn hàng"><i class="fa fa-times" aria-hidden="true"></i></a>
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
            <h5 class="modal-title" id="exampleModalLabel">Chi tiết mã đơn hàng <b class="order_id">sdasda</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="md_content">
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