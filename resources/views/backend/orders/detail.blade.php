@if($order)
<div style="padding: 5px 0 0 17px;">
	@if(Auth::user()->role > 0)<p><strong>Họ tên người nhận :</strong> {{$order->user->name}} </p>@endif
	<p><strong>Số điện thoại :</strong> {{$order->phone_number}} </p>
	<p><strong>Địa chỉ nhận hàng :</strong> {{$order->address}} </p>
	<p><strong>Ghi chú :</strong> {{$order->note}} </p>
	<p><strong>Ngày đặt hàng :</strong> {{ $order->created_at->format('H:i:s - d/m/Y') }} </p>
	<p><strong>Tình trạng :</strong> 
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
	</p>
</div>
<div class="card-body table-responsive p-0 add-border-radius">
	<table class="table table-hover">
		<thead class="add-background-thead">
			<tr>
				<th>STT</th>
				<th>Hình ảnh</th>
				<th>Tên sản phẩm</th>
				<th>Giá</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
				<!-- <th>Thao tác</th> -->
			</tr>
		</thead>
		<tbody>
			@if(isset($products))
				@foreach($products as $key => $product)
					@php 
						$quantity = $product->pivot->quantity;
						$price = ($product->pivot->sale_price)-($product->pivot->sale_price * ($product->pivot->discount_percent/100)); 
					@endphp
				<tr>
					<td>{{$key+1}}</td>
					<td><img style="width: 80px;height: 60px;" src="{{asset($product->image)}}"></td>
					<td><a href="{{route('frontend.detail_product',$product->slug)}}">{{$product->name}}</a></td>
					@if(Auth::user()->role == 2 || Auth::user()->role == 1)
					<td>
						<ul style="padding-left: 3px;">
							@if($product->pivot->discount_percent != 0)
							<li>Giá khuyến mãi: {{number_format($price)}} VNĐ</li>
							@endif
							<li>Giá bán: <span style="text-decoration: @if($product->pivot->discount_percent != 0) line-through @endif">{{number_format($product->pivot->sale_price)}} VNĐ</span></li>
							<li>Giá gốc: {{number_format($product->pivot->origin_price)}} VNĐ</li>
							<li>Giảm giá: {{$product->pivot->discount_percent}}%</li>
						</ul>
					</td>
					@else
					<td>{{number_format($price)}} VNĐ</td>
					@endif
					<td>{{$quantity}}</td>
					<td>{{number_format($price * $quantity)}} VNĐ</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>
@endif