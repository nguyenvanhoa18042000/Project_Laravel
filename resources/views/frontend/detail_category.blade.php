@extends('frontend.layouts.master')
@section('title')
Danh mục
@endsection
@section('css')
@endsection
@section('script')
<script>
	$(function(){
		$('.orderby').change(function(){
			$('#form-order').submit();
		})
	})
</script>
@endsection
@section('content-header')
@endsection
@section('content')
<div class="content-wraper pt-20 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Begin Li's Banner Area -->
				<div class="single-banner shop-page-banner">
					<div class="row">
						<div class="col-8"><img src="https://cdn.tgdd.vn/2020/02/banner/800-170-800x170-37.png"></div>
						<div class="col-4">
							<img style="padding-bottom: 3%;" src="https://cdn.tgdd.vn/2020/02/banner/390-80giam1trieu-390x80.png">
							<img src="https://cdn.tgdd.vn/2020/01/banner/sticky-oppoa5-4-390x80.png">
						</div>
					</div>
				</div>

				<div class="manuwrap" style="padding-top: 20px;width: 100%">
					<div class="manunew">
						@if(isset($trademarks))
						@foreach($trademarks as $trademark)
						@if(request()->exists('p'))
						<a href="{{route('frontend.detail_category',['slug' => $category->slug,'trademark' => $trademark->slug, 'p'=> request()->get('p'), 'orderby' => request()->get('orderby')])}}">
							<img src="{{asset($trademark->image)}}" />
						</a>
						@else
						<a href="{{route('frontend.detail_category',['slug' => $category->slug,'trademark' => $trademark->slug, 'orderby' => request()->get('orderby')])}}">
							<img src="{{asset($trademark->image)}}" />
						</a>
						@endif
						@endforeach
						@endif
					</div>
					<div class="clr"></div>
				</div>

				@if($category->name != 'Laptop')
				<ul class="filter" style="border-bottom: none;">
					<li class="title">
						<a href="javascript:;" style="cursor: text;">Chọn mức giá:</a>
					</li>
					<li class="frange">
						<a href="{{request()->fullUrlWithQuery(['p' => 'duoi-2-trieu'])}}" data-id="7"> Dưới 2 triệu</a>
						<a href="{{request()->fullUrlWithQuery(['p' => 'tu-2-4-trieu'])}}" data-id="7"> Từ 2 - 4 triệu</a>
						<a href="{{request()->fullUrlWithQuery(['p' => 'tu-4-7-trieu'])}}" data-id="7"> Từ 4 - 7 triệu</a>
						<a href="{{request()->fullUrlWithQuery(['p' => 'tu-7-13-trieu'])}}" data-id="7"> Từ 7 - 13 triệu</a>
						<a href="{{request()->fullUrlWithQuery(['p' => 'tren-13-trieu'])}}" data-id="7"> Trên 13 triệu</a>
					</li>
				</ul>
				@endif

				@if(request()->exists('p') && !isset($trademark_search))
				<div class="choosedfilter">
					<a href="{{route('frontend.detail_category',$category->slug)}}">
						<span>
							@switch(request()->get('p'))
							@case('duoi-2-trieu')
							Dưới 2 triệu
							@break
							@case('tu-2-4-trieu')
							Từ 2 - 4 triệu  
							@break
							@case('tu-4-7-trieu')
							Từ 4 - 7 triệu  
							@break
							@case('tu-7-13-trieu')
							Từ 7 - 13 triệu  
							@break
							@case('tren-13-trieu')
							Trên 13 triệu  
							@break
							@default

							@endswitch
						</span>
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<div class="watching">
						<h1>{{$category->name}} 
							@switch(request()->get('p'))
							@case('duoi-2-trieu')
							Dưới 2 triệu
							@break
							@case('tu-2-4-trieu')
							Từ 2 - 4 triệu  
							@break
							@case('tu-4-7-trieu')
							Từ 4 - 7 triệu  
							@break
							@case('tu-7-13-trieu')
							Từ 7 - 13 triệu  
							@break
							@case('tren-13-trieu')
							Trên 13 triệu  
							@break
							@default							        
							@endswitch
						</h1>
					</div>
				</div>
				@endif
				<!-- product-select-box start -->
				<div class="product-select-box">
					<div class="product-short" style="margin:1% 0 2% 0;">
						<p style="color: #333">Sắp xếp :</p>
						<form id="form-order" class="tree-most" method="GET" >
							<select name="orderby" class="nice-select orderby">
								<option {{ Request::get('orderby') == "moi-nhat" || !Request::get('orderby') ? "selected = 'selected'" : "" }} value="moi-nhat">Mới nhất</option>
								<option {{Request::get('orderby') == "gia-thap-den-cao" ? "selected = 'selected'" : "" }} value="gia-thap-den-cao">Giá thấp đến cao</option>
								<option {{Request::get('orderby') == "gia-cao-den-thap" ? "selected = 'selected'" : "" }} value="gia-cao-den-thap">Giá cao đến thấp</option>
							</select>
						</form>
					</div>
				</div>
				<!-- product-select-box end -->

				@if(request()->exists('p') && isset($trademark_search))
				<div class="choosedfilter">
					<a href="{{route('frontend.detail_category',['slug' => $category->slug, 'p'=> request()->get('p')])}}">
						<span>{{$trademark_search->name}}</span>
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<a href="{{route('frontend.detail_category',['slug' => $category->slug, 'trademark' => $trademark_search->slug ])}}">
						<span>
							@switch(request()->get('p'))
							@case('duoi-2-trieu')
							Dưới 2 triệu
							@break
							@case('tu-2-4-trieu')
							Từ 2 - 4 triệu  
							@break
							@case('tu-4-7-trieu')
							Từ 4 - 7 triệu  
							@break
							@case('tu-7-13-trieu')
							Từ 7 - 13 triệu  
							@break
							@case('tren-13-trieu')
							Trên 13 triệu  
							@break
							@default

							@endswitch
						</span>
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<a style="background: #c10017" href="{{route('frontend.detail_category',$category->slug)}}">
						Xóa tất cả
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<div class="watching">
						<h1>{{$category->name}} {{$trademark_search->name}}
							@switch(request()->get('p'))
							@case('duoi-2-trieu')
							Dưới 2 triệu
							@break
							@case('tu-2-4-trieu')
							Từ 2 - 4 triệu  
							@break
							@case('tu-4-7-trieu')
							Từ 4 - 7 triệu  
							@break
							@case('tu-7-13-trieu')
							Từ 7 - 13 triệu  
							@break
							@case('tren-13-trieu')
							Trên 13 triệu  
							@break
							@default							        
							@endswitch
						</h1>
					</div>
				</div>
				@endif

				@if(isset($trademark_search) && !request()->exists('p'))
				<div class="choosedfilter" >
					<a href="{{route('frontend.detail_category',$category->slug)}}">
						<span>{{$trademark_search->name}}</span>
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<div class="watching">
						<h1>{{$category->name}} {{$trademark_search->name}} </h1>
					</div>
				</div>
				@endif

				<!-- shop-top-bar end -->
				<!-- shop-products-wrapper start -->
				<div class="shop-products-wrapper" style="border-top: 1px solid #eee">
					<div class="tab-content">
						<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
							<div class="product-area shop-product-area">
								<div class="container">
									<div class="row" style="width: 100%;margin: auto;">
										<div class="navigat cate42">
											<h2 style="margin: 0">{{$category->name}} mới nhất</h2>
										</div>
										<ul class="homeproduct" style="border-left:1px solid #eee ">
											@foreach($products as $product)
											<li class="product" data-id="210441" style="padding-bottom: 20px;padding-top: 5px;">
												<a href="{{route('frontend.detail_product',$product->slug)}}" >
													<img width="180" height="180" src="{{asset($product->image)}}" />
													<h3 class="name_product" style="margin-bottom: 0">{{$product->name}}</h3>
													<div class="price" style="padding-bottom: 5px;">
														@php 
														    $price_sale = $product->sale_price - ($product->sale_price * (($product->discount_percent)/100))
														@endphp
														<strong>
															{{number_format($price_sale,0,",","."
															)}}₫
														</strong>
														@if($product->discount_percent > 0)
														<span style="font: 14px/18px Helvetica,Arial,'DejaVu Sans','Liberation Sans',Freesans,sans-serif;font-size: 13px;">{{$product->sale_price}}₫</span>
														@endif
													</div>
													<div class="ratingresult" style="padding: 0 10px;">
					                                	<?php
								                            $star = 0;
								                            if ($product->total_rating) {
								                              $star = round($product->total_number_star / $product->total_rating,1);
								                            }
								                        ?>
					                                      @for($i=1;$i<=5;$i++)
					                                        <i class="fa fa-star" style="color:{{ $i <= $star ? '#ff9705' : '#898989'}};"></i>
					                                      @endfor
					                                    <!-- </span> -->
					                                	<span style="text-decoration: none;">{{$product->total_rating}} đánh giá</span>
						                        	</div>
						                        	@if($product->amount != 0)
														@if($product->discount_percent > 0)
															<label class="discount">GIẢM {{number_format($product->sale_price - $price_sale,0,",",".")}}₫</label>
														@else
															<label class="installment">Trả góp 0%</label>
														@endif
													@else
														<label style="background: #22bddb" class="installment">Đang nhập hàng</label> 
													@endif
													<a href="{{route('frontend.add.cart',$product->id)}}" class="btn btn-store">MUA NGAY</a>       
												</a>
											</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- shop-products-wrapper end -->
					</div>
					<div class="col-lg-12">
						<div class="text-center pt-25" id="pagination-detail-category">
							<li>{!! $products->links() !!}</li>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection