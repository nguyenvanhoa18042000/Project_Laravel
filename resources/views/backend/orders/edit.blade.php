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
                <li class="breadcrumb-item"><a href="{{route('profile.user.order')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa</li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Chỉnh sửa đơn hàng</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <!-- form start -->
              <form role="form" method="POST" action="{{ route('profile.user.order.update',$order->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address',$order->address) }}">
                    @if($errors->has('address'))
                        <div class="error">{{ $errors->first('address') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number',$order->phone_number) }}">
                    @if($errors->has('phone_number'))
                        <div class="error">{{ $errors->first('phone_number') }}</div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Ghi chú</label>
                    <input type="text" class="form-control" name="note" value="{{ old('note',$order->note) }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email liên hệ</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email',$order->email) }}">
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                  <button type="submit" class="btn btn-primary ml-4 mb-4">Lưu thông tin</button>
                  <a href="{{ URL::previous() }}" type="button" class="btn btn-danger ml-1 mb-4" style="color: white">Hủy bỏ</a>
              </form>
        <!-- end form -->

        <!-- /.card-body -->
        <div class="card-footer">Chỉnh sửa đơn hàng</div>
          
        </div>
      </div>
      <!-- /.card -->

    </section>
@endsection