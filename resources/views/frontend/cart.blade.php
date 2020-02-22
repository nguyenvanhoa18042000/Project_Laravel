@extends('frontend.layouts.master')
@section('title')
Giỏ hàng
@endsection
@section('css')
@endsection
@section('script')
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
  $(function(){
  	$('.btn-update-quantity-product').click(function(){
  		var rowId = $(this).attr('data-id');
  		var quantity_product = $(this).parent().find('.quantity_product').val();
  		if (quantity_product < 0) {
  			alert('Số lượng sản phẩm phải lớn hơn 0');
  		}
  		if (quantity_product > 0) {
  			var _token = $('input[name="_token"]').val();
	  		$.ajax({
	  			url:"{{ route('frontend.update.quantity.cart') }}",
		        method:"POST",      
		        data:{
		        rowId:rowId,
		        quantity_product:quantity_product,
		        _token:_token
		        },
		        success:function(data){
		        	location.reload();
		        }
	  		});
  		}
  	});
  });
</script>
@endsection
@section('content-header')
<h1 style="text-align: center;margin: 2% 0 0 0;font-weight: normal;">-- Giỏ Hàng --</h1>
<p style="text-align: center;color: black;">({{\Cart::count()}} sản phẩm)</p>
@endsection
@section('content')
<div class="Shopping-cart-area pt-20 pb-60">
	<div class="container">
	    <div class="row">
	        <div class="col-12">
	            <form action="#">
	                <div class="table-content table-responsive">
	                    <table class="table">
	                        <thead>
	                            <tr>
	                                <th class="li-product-remove">Xóa</th>
	                                <th class="li-product-thumbnail">Hình ảnh</th>
	                                <th class="cart-product-name">Tên sản phẩm</th>
	                                <th class="li-product-price">Giá sản phẩm</th>
	                                <th class="li-product-quantity">Số lượng</th>
	                                <th class="li-product-subtotal">Thành tiền</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @if((\Cart::count()) >=1 )
	                            @foreach($products as $product)
	                                <tr>
	                                    <td class="li-product-remove"><a href="{{route('frontend.destroy.cart',$product->rowId)}}"><i class="fa fa-times"></i></a></td>
	                                    <td class="li-product-thumbnail"><a href="{{route('frontend.detail_product',$product->options->slug)}}"><img style="width: 100px;height: 85px;" src="{{asset($product->options->image)}}" alt="Li's Product Image"></a></td>
	                                    <td class="li-product-name"><a href="{{route('frontend.detail_product',$product->options->slug)}}" style="color: #333">{{$product->name}}</a></td>
	                                    <td class="li-product-price">                                       
	                                    	<span class="amount" style="">{{number_format($product->price)}}₫</span>
	                                    	@if($product->options->discount_percent > 0)
	                                    	<p style="margin: 0"><span style="text-decoration: line-through;">{{number_format($product->options->sale_price)}}₫</span> | <span>{{$product->options->discount_percent}}%</span></p>
	                                    	@endif
	                                    </td>
	                                    <td class="quantity">
	                                        <input class="quantity_product" style="width: 18%;height: 35px;border-radius: 7px;border: 1px solid #999;background: white" type="number" min="1" name="" value="{{$product->qty}}"> 
	                                        <button data-id = "{{$product->rowId}}" class="btn btn-sm btn-primary btn-update-quantity-product" data-toggle = "tooltip" data-original-title = "Cập nhật"><i class="fa fa-refresh" aria-hidden="true"></i></button>
	                                    </td>
	                                    <td class="product-subtotal"><span class="amount" style="color: #e80f0f;">{{number_format($product->qty * $product->price)}}₫</span></td>
	                                </tr>
	           					@endforeach
	           				@endif
	                        </tbody>
	                    </table>
	                </div>
	                <div class="row">
	                    <div class="col-md-5 ml-auto">
	                        <div class="cart-page-total">
	                            <h2>Tổng số giỏ hàng</h2>
	                            <ul>
	                                <li>Tổng tiền thanh toán :<span style="color: #e80f0f">{{\Cart::subtotal()}}₫</span></li>
	                            </ul>
	                            <a href="{{route('frontend.get.form.pay')}}">Tiến hành thanh toán</a>
	                        </div>
	                    </div>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
@endsection