@if($order)
<div class="card-body table-responsive p-0 add-border-radius">
	<table class="table table-hover">
		<thead class="add-background-thead">
			<tr>
				<th></th>
				<th>Hình ảnh</th>
				<th>Tên sản phẩm</th>
				<th>Gía</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				{{$order->total_money}}
			</tr>
			
		</tbody>
	</table>
</div>
@endif