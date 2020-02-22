@extends('frontend.layouts.master')
@section('title')
Chi tiết sản phẩm
@section('css')
@endsection
@section('script')
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(function(){
	let listStar = $('.list_star .fa');
	listRatingText={
		1 : 'Không thích',
		2 : 'Tạm được',
		3 : 'Bình thường',
		4 : 'Rất tốt',
		5 : 'Tuyệt vời quá'
	};
	listStar.mouseover(function(){
		let $this = $(this);
		let number = $this.attr('data-key');


		listStar.removeClass('rating_active');
		$('.number_star').val(number);
		$.each(listStar, function(key,value){
			if(key+1 <= number){
				$(this).addClass('rating_active');
			}
		});
		$(".list_text").text('').text(listRatingText[number]).show();
	});
	$(".js_rating_action").click(function (event){
		event.preventDefault();
		if ( $('.form_rating').hasClass('hide') ) {
			$('.form_rating').addClass('active').removeClass('hide');
			$('.js_rating_action > a').text('Đóng lại');
		}else{
			$('.form_rating').addClass('hide').removeClass('active');
			$('.js_rating_action > a').text('Gửi đánh giá của bạn');
		}
	});

	$('.js_rating_product').click(function(event){
		event.preventDefault();
		let content_rating = $('#content_rating').val();
		let number_star = $('.number_star').val();
		let url = $(this).attr('href');		
		if (content_rating && number_star) {
			$.ajax({
				url:url,
				type:'POST',
				data:{
					number_star : number_star,
					content_rating : content_rating,
					_token: '{!! csrf_token() !!}',
				}
			}).done(function(result){
				if (result.code == 1) {
					alert('gửi đánh giá thành công');
					location.reload();
				}
				if(result.code == 0){
					var r = confirm('Bạn cần đăng nhập để đánh giá sản phẩm');
					if (r) {
						  window.location.href = $(".link-button").attr('href');
					}
				}
			});
		}
	});
	$("#move_to_rating").click(function (){
         var elmnt = document.getElementById("content_and_rating");
   		 elmnt.scrollIntoView({
		  	behavior: 'smooth' 
		});
    });
    $(".qty_product_at_detail_product").change(function(){
    	var quantity_product = $(this).val();
    	if (quantity_product < 1) {
    		alert('Số lượng sản phẩm phải lớn hơn 0');
    	}
    })
});
</script>
@endsection
@endsection
@section('content-header')
<div class="breadcrumb-area" style="margin-bottom: 2%;">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="index.html">Trang chủ</a></li>
				<li><a href="">{{$product->category->name}}</a></li>
				<li class="active">{{$product->name}}</li>
			</ul>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="content-wraper">
	<div class="container">
		<div class="row single-product-area">
			<div class="col-lg-5 col-md-6">
				<!-- Product Details Left -->
				<div class="product-details-left">
					<div class="product-details-images slider-navigation-1" style="padding-top: 2%;">
						<div class="lg-image">
							<img src="{{asset($product->image)}}" style="margin: auto;height: auto;" alt="product image">
						</div>
						@foreach($product->product_images as $product_image)
							@if($product_image->path != NULL)
								<div class="lg-image">
									<img src="{{asset($product_image->path)}}" alt="product image">
								</div>
							@endif
						@endforeach
					</div>
					<div class="product-details-thumbs slider-thumbs-1">
						@if($product->product_images->count() != 0)
							<div class="sm-image"><img src="{{asset($product->image)}}" alt="product image thumb"></div>
						@endif
						@foreach($product->product_images as $product_image)
							@if($product_image->path != NULL)
								<div class="sm-image">
									<img src="{{asset($product_image->path)}}">
								</div>	
							@endif
						@endforeach
					</div>
				</div>
				<!--// Product Details Left -->
			</div>

			<div class="col-lg-7 col-md-6">
				<div class="product-details-view-content sp-normal-content pt-60">
					<div class="product-info">
						<h2 style="font-size: 25px;">{{$product->category->name}} {{$product->name}}</h2>
						<div class="rating-box">
                            <ul class="rating rating-with-review-item">
                                <li>
                                	<?php
			                            $star = 0;
			                            if ($product->total_rating) {
			                              $star = round($product->total_number_star / $product->total_rating,1);
			                            }
			                        ?>
                                	<span class="rating">
                                      @for($i=1;$i<=5;$i++)
                                        <i class="fa fa-star" style="color:{{ $i <= $star ? '#ff9705' : '#898989'}};"></i>
                                      @endfor
                                    </span>
                                    <span>{{($star>0) ? $star : ''}}</span>
                                </li>
                                <li class="review-item" style="margin-left: 2%;"><a id="move_to_rating" style="color: #a5a5a5; cursor: pointer;">Xem & Viết đánh giá</a></li>
                            </ul>
                        </div>

						<div class="price-box pt-20">
							<strong class="new-price new-price-2" style="vertical-align: middle;">{{number_format(
									$product->sale_price - ($product->sale_price * (($product->discount_percent)/100))
								)}}₫
							</strong>
							@if($product->discount_percent > 0)
								<span style="display: inline-block; font-size: 18px; color: #999; text-decoration: line-through; margin-left: 10px;">
									{{number_format($product->sale_price)}}₫
								</span>
							@endif
						</div>
						<div class="product-desc">
							<p>
								<span class="description">
									{!! $product->description !!}
								</span>
							</p>
						</div>
						<div class="single-add-to-cart">
							<form action="{{route('frontend.add.cart.with.quantity',$product->id)}}" class="cart-quantity" method="POST">
								@csrf
								<div class="quantity">
									<label>Số lượng</label>
									<div>
										<input class="qty_product_at_detail_product" value="1" type="number" min="1" name="quantity_product">
									</div>
								</div>
								<button class="add-to-cart" type="submit">Thêm vào giỏ hàng</button>
							</form>
						</div>
						<div class="product-additional-info pt-25">
							<div class="product-social-sharing pt-25">
								<ul>
									<li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
									<li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
									<li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
									<li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
								</ul>
							</div>
						</div>
						<div class="block-reassurance">
							<ul>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-check-square-o"></i>
										</div>
										<p>Bảo mật thông tin sản phẩm cho khách hàng</p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-truck"></i>
										</div>
										<p>Giao hàng toàn quốc chỉ trong 24h </p>
									</div>
								</li>
								<li>
									<div class="reassurance-item">
										<div class="reassurance-icon">
											<i class="fa fa-exchange"></i>
										</div>
										<p>Hoàn trả lại tiền nếu khách hàng không hài lòng</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<div class="product-area pt-40" id="content_and_rating">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="li-product-tab">
					<ul class="nav li-product-menu">
						<li><a class="active" data-toggle="tab" href="#product-details"><span>Thông tin chi tiết</span></a></li>
						<li><a data-toggle="tab" href="#reviews"><span>Đánh giá</span></a></li>
					</ul>               
				</div>
				<!-- Begin Li's Tab Menu Content Area -->
			</div>
		</div>
		<div class="tab-content">
			<div id="product-details" class="tab-pane" style="overflow: hidden;text-align: center;width: 90%;margin: 1% auto" role="tabpanel">
				<div class="product-details-manufacturer">
					{!! $product->content !!}
				</div>
			</div>
			<div id="reviews" class="tab-pane active show" style="overflow: hidden;" role="tabpanel">
				<div class="product-reviews">
					<div class="product-details-comment-block component_rating" style="margin-bottom: 20px;">
						<p style="font-size: 23px; color: black;margin-bottom: 2%;">{{$product->total_rating}} đánh giá {{$product->name}}</p>
						<div class="component_rating_content" style="display: flex;align-items: center;border-radius: 5px;border: 1px solid #dedede;">
							<div class="rating_item" style="width: 20%; position: relative;">
								<span class="fa fa-star" style="font-size: 100px;color: #ff9705; margin: 0 auto; text-align: center; position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);"></span>
								<b style="position: absolute;top: 50%; left: 50%; transform: translate(-50%,-50%);color: white;font-size: 20px;">
								{{ $star > 0 ? $star : 0 }}
								</b>
							</div>
							<div class="list_rating" style="width: 60%; padding: 20px 0;">
							@for($i = 5;$i >= 1;$i--)
								<div class="item_rating" style="display: flex; align-items: center;">										
									<div style="width: 10%;">
										{{ $i }} <span class="fa fa-star" style="font-size: 16px;margin-left: 3%; color: #ff9705;"></span>
									</div>
									<div style="width:70%;margin: 0 20px; ">
										<span style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius: 5px; background: #dedede;">
											<b style="
											width: 
											@if($product->total_rating != 0)
											{{($rating_level[$i]/$product->total_rating)*100}}%;
											@else
												0%
											@endif
											height:100%;background-color: #f25800;display: block;border-radius: 5px;">
											</b>
										</span>
									</div>
									<div style="width: 20%;">
										<a href="" >{{$rating_level[$i]}} đánh giá
										</a>
									</div>										
								</div>
							@endfor
							</div>
							<div class="js_rating_action btn btn-primary" style="width: 16%;cursor: pointer;">
								<a href="#" style="color: white">Gửi đánh giá của bạn</a>
							</div>
						</div>
						<?php
							$listRatingText=[
								1 => 'Không thích',
								2 => 'Tạm được',
								3 => 'Bình thường',
								4 => 'Rất tốt',
								5=> 'Tuyệt vời quá'
							];
						?>
						<div class="form_rating hide">
							<div style="display: flex;margin-top: 15px; font-size: 15px;">
								<p style="margin-bottom: 0; color: black;">Chọn đánh giá của bạn</p>
								<span style="margin: 0 15px;color: #c2c2c2;cursor: pointer;" class="list_star">
									@for($i=1;$i<=5;$i++)
										<i class="fa fa-star" data-key="{{$i}}"></i>
									@endfor
								</span>
								<span class="list_text"></span>
								<input type="hidden" value="" class="number_star">
							</div>
							<div style="margin-top: 15px;">
								<textarea name="" id="content_rating" class="form-control" cols="30" rows="3"></textarea>
							</div>
							<div style="margin-top: 15px;cursor: pointer;">
								<a href="{{ route('rating.store',$product->id) }}" class="js_rating_product btn btn-primary">Gửi đánh giá</a>
							</div>
						</div>
					</div>
				</div>
				<div class="component_list_rating">
						@if(isset($ratings))
							@foreach($ratings as $rating)
							<div class="rating_item" style="margin-bottom: 1%;">
								<div>
									<span style="
									color: 
									@if($rating->user->deleted_at == NULL)
										#333
									@else
										#a19c9c 
									@endif;
									font-weight: bold;text-transform: capitalize;">{{isset($rating->user->name) ? $rating->user->name : '[N\A]' }}</span>
									<span>
										@if($rating->user->role == 1 && $rating->user->deleted_at == NULL)
											<b class="qtv">Quản trị viên</b>
										@endif
									</span>
								</div>
								<p style="margin-bottom: 0;">
									<span class="pro_rating">
										@for($i=1;$i<=5;$i++)
											<i class="fa fa-star" style="color:{{$i <= $rating->number_star ? '#ff9705' : ''}};"></i>
										@endfor
									</span>
									<span> {{$rating->content}}</span>
								</p>
								<div>
									<span><i class="fa fa-clock-o"></i> {{$rating->created_at->format('H:i:s  |  d-m-Y')}}</span>
								</div>
							</div>
							@endforeach
						@endif
						<div style="margin-top: 3%;">{!! $ratings->links() !!}</div>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="product-area li-laptop-product pt-30 pb-50">
	<div class="container">
		<div class="row">
			<!-- Begin Li's Section Area -->
			<div class="col-lg-12">
				<div class="li-section-title">
					<h2>
						<span>Các sản phẩm khác cùng loại</span>
					</h2>
				</div>
				<div class="row">
					<div class="product-active owl-carousel">
						@foreach($products as $product)
							<div class="col-lg-12">
							<!-- single-product-wrap star -->
							<div class="single-product-wrap">
								<div class="product-image">
									<a href="{{route('frontend.detail_product',$product->slug)}}">
										<img width="206px" height="206px" src="{{asset($product->image)}}" alt="Li's Product Image">
									</a>
									<span class="sticker">New</span>
								</div>
								<div class="product_desc">
									<div class="product_desc_info">
										<div class="product-review">
											<h5 class="manufacturer">
												<a href="{{route('frontend.detail_product',$product->slug)}}">{{$product->total_rating}} đánh giá</a>
											</h5>
											<div class="rating-box">
												<ul class="rating">
													<?php
							                            $star = 0;
							                            if ($product->total_rating) {
							                              $star = round($product->total_number_star / $product->total_rating,1);
							                            }
							                        ?>
				                                	<span class="rating">
				                                      @for($i=1;$i<=5;$i++)
				                                        <i class="fa fa-star" style="color:{{ $i <= $star ? '#ff9705' : '#898989'}};"></i>
				                                      @endfor
				                                    </span>
				                                    <span> 
				                                    	@if($star>0)
				                                    		{{$star}}
				                                    	@endif
				                                    </span>
												</ul>
											</div>
										</div>
										<h4><a class="product_name" href="{{route('frontend.detail_product',$product->slug)}}">{{$product->name}}</a></h4>
										<div class="price-box">
											<span class="new-price" style="color: #e80f0f">
												{{number_format(
												$product->sale_price - ($product->sale_price * (($product->discount_percent)/100))
												)}}₫
											</span>
											@if($product->discount_percent > 0)
												<span style="text-decoration: line-through;color: #999;font-size: 14px;">
													{{number_format($product->sale_price)}}₫
												</span>
											@endif
										</div>
									</div>
									<div class="add-actions">
										<ul class="add-actions-link">
											<li class="add-cart active"><a href="#">Add to cart</a></li>
											<li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
											<li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- single-product-wrap end -->
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- Li's Section Area End Here -->
		</div>
	</div>
</section>
@endsection