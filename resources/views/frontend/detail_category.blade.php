@extends('frontend.layouts.master')
@section('title')
Trang chủ
@section('css')
@endsection
@section('script')
@endsection
@endsection
@section('content-header')
<div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="index.html">Trang chủ</a></li>
				<li><a href="">Danh mục {{$category->name}}</a></li>
				@if(isset($trademark_search)) <li><a href="">{{$trademark_search->name}}</a></li> @endif
			</ul>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="content-wraper pt-20 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<!-- Begin Li's Banner Area -->
				<div class="single-banner shop-page-banner">
					<a href="#">
						<!-- <img src="{{asset('frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner"> -->
						<img src="https://cdn.tgdd.vn/2020/01/banner/ban-online-1200-75-1200x75-1.png" alt="Li's Static Banner">
					</a>
				</div>

				<div class="manuwrap" style="padding-top: 10px;">
			        <div class="manunew">
			        	@if(isset($trademarks))
			        		@foreach($trademarks as $trademark)
				                <a href="
				                @if(isset($minPrice,$maxPrice) && !isset($trademark_search))
				                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark->id,$minPrice,$maxPrice])}}
				                @else
				                	{{route('frontend.detail_category_by_trademark',[$category->id,$trademark->id])}}
				                @endif">
				                    <img src="{{asset($trademark->image)}}" />
				                </a>
			                @endforeach
			        	@endif
			        </div>
			        <div class="clr"></div>
			    </div>

			    <ul class="filter" style="border-bottom: none;">
		            <li class="title">
		                <a href="javascript:;" style="cursor: text;">Chọn mức giá:</a>
		            </li>
		            <li class="frange">
		                <a href="
		                @if(isset($trademark_search) && !isset($minPrice,$maxPrice))
		                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark_search,0,2000000])
			            	}}
		                @else
			                {{route('frontend.detail_category_by_price',[$category->id,0,2000000])
			            	}}
			            @endif" 
			            	data-id="7">
		                    Dưới 2 triệu
		                </a>
		                <a href="
		                @if(isset($trademark_search) && !isset($minPrice,$maxPrice))
		                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark_search,2000000,4000000])
			            	}}
		                @else
			                {{route('frontend.detail_category_by_price',[$category->id,2000000,4000000])
			            	}}
			            @endif"  data-id="9">
		                    Từ 2 - 4 triệu
		                </a>
		                <a href="
		                @if(isset($trademark_search) && !isset($minPrice,$maxPrice))
		                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark_search,4000000,7000000])
			            	}}
		                @else
			                {{route('frontend.detail_category_by_price',[$category->id,4000000,7000000])
			            	}}
			            @endif"  data-id="289">
		                    Từ 4 - 7 triệu
		                </a>
		                <a href="
		                @if(isset($trademark_search) && !isset($minPrice,$maxPrice))
		                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark_search,7000000,13000000])
			            	}}
		                @else
			                {{route('frontend.detail_category_by_price',[$category->id,7000000,13000000])
			            	}}
			            @endif"  data-id="562">
		                    Từ 7 - 13 triệu
		                </a>
		                <a href="
		                @if(isset($trademark_search) && !isset($minPrice,$maxPrice))
		                	{{route('frontend.detail_category_by_trademark_and_price',[$category->id,$trademark_search,13000000,10000000000])
			            	}}
		                @else
			                {{route('frontend.detail_category_by_price',[$category->id,13000000,10000000000])
			            	}}
			            @endif"  data-id="253">
		                    Tr&#234;n 13 triệu
		                </a>
            		</li>
		        </ul>
					<!-- product-select-box start -->
					<!-- <div class="product-select-box">
						<div class="product-short">
							<p>Sort By:</p>
							<select class="nice-select">
								<option value="trending">Relevance</option>
								<option value="sales">Name (A - Z)</option>
								<option value="sales">Name (Z - A)</option>
								<option value="rating">Price (Low &gt; High)</option>
								<option value="date">Rating (Lowest)</option>
								<option value="price-asc">Model (A - Z)</option>
								<option value="price-asc">Model (Z - A)</option>
							</select>
						</div>
					</div> -->
					<!-- product-select-box end -->

			    @if(isset($minPrice,$maxPrice) && !isset($trademark_search))
			    	<div class="choosedfilter">
		                <a href="{{route('frontend.detail_category',$category->id)}}">
		                    <span>
		                    @if($minPrice == 0)
								Dưới {{$maxPrice/1000000}} triệu
							@elseif($minPrice == 13000000)
								Trên {{$minPrice/1000000}} triệu
							@else
		                    	Từ {{$minPrice/1000000}} - {{$maxPrice/1000000}} triệu
		                    @endif
		                	</span>
		                    <i class="fa fa-times" aria-hidden="true"></i>
		                </a>
		                <div class="watching">
					        <h1>{{$category->name}} 
					        	@if($minPrice == 0)
								Dưới {{$maxPrice/1000000}} triệu
								@elseif($minPrice == 13000000)
									Trên {{$minPrice/1000000}} triệu
								@else
			                    	Từ {{$minPrice/1000000}} - {{$maxPrice/1000000}} triệu
			                    @endif
		                	</h1>
					    </div>
					 </div>
			    @endif

				@if(isset($trademark_search) && !isset($minPrice,$maxPrice))
			    	<div class="choosedfilter" >
		                <a href="{{route('frontend.detail_category',$category->id)}}">
		                    <span>{{$trademark_search->name}}</span>
		                    <i class="fa fa-times" aria-hidden="true"></i>
		                </a>
		                <div class="watching">
					        <h1>{{$category->name}} {{$trademark_search->name}} </h1>
					    </div>
					 </div>
			    @endif

			    @if(isset($minPrice,$maxPrice,$trademark_search))
			    	<div class="choosedfilter">
			    		<a href="{{route('frontend.detail_category_by_price',[$category->id,$minPrice,$maxPrice])}}">
		                    <span>{{$trademark_search->name}}</span>
		                    <i class="fa fa-times" aria-hidden="true"></i>
		                </a>
		                <a href="{{route('frontend.detail_category_by_trademark',[$category->id,$trademark_search])}}">
		                    <span>
		                    @if($minPrice == 0)
								Dưới {{$maxPrice/1000000}} triệu
							@elseif($minPrice == 13000000)
								Trên {{$minPrice/1000000}} triệu
							@else
		                    	Từ {{$minPrice/1000000}} - {{$maxPrice/1000000}} triệu
		                    @endif
		                	</span>
		                    <i class="fa fa-times" aria-hidden="true"></i>
		                </a>
		                <a style="background: #c10017" href="{{route('frontend.detail_category',$category->id)}}">
		                	Xóa tất cả
		                	<i class="fa fa-times" aria-hidden="true"></i>
		                </a>
		                <div class="watching">
					        <h1>{{$category->name}} {{$trademark_search->name}} 
					        	@if($minPrice == 0)
								Dưới {{$maxPrice/1000000}} triệu
								@elseif($minPrice == 13000000)
									Trên {{$minPrice/1000000}} triệu
								@else
			                    	Từ {{$minPrice/1000000}} - {{$maxPrice/1000000}} triệu
			                    @endif
		                	</h1>
					    </div>
					 </div>
			    @endif

				<!-- shop-top-bar end -->
				<!-- shop-products-wrapper start -->
				<div class="shop-products-wrapper" style="border-top: 1px solid #999">
					<div class="tab-content">
						<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
							<div class="product-area shop-product-area">
								<div class="row">
									@if(isset($products))
										@foreach($products as $product)
										<div class="col-lg-3 col-md-4 col-sm-6 mt-40">
											<!-- single-product-wrap start -->
											<div class="single-product-wrap">
												<div class="product-image">
													<a href="single-product.html">
														<img src="{{asset($product->image)}}" alt="Li's Product Image">
													</a>
													<span class="sticker">New</span>
												</div>
												<div class="product_desc">
													<div class="product_desc_info">
														<div class="product-review">
															<h5 class="manufacturer">
																<a href="{{route('frontend.detail_product',$product->id)}}">{{$product->total_rating}} đánh giá</a>
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
														<h4><a class="product_name" href="{{route('frontend.detail_product',$product->id)}}">{{$product->name}}</a></h4>
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
															<li class="add-cart active"><a href="shopping-cart.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua sản phẩm</a></li>
															<li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-eye"></i></a></li>
															<li><a class="links-details" href="wishlist.html"><i class="fa fa-heart-o"></i></a></li>
														</ul>
													</div>
												</div>
											</div>
											<!-- single-product-wrap end -->
										</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div class="paginatoin-area">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<p>Showing 1-12 of 13 item(s)</p>
								</div>
								<div class="col-lg-6 col-md-6">
									<ul class="pagination-box">
										<li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
										</li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li>
											<a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- shop-products-wrapper end -->
			</div>
		</div>
	</div>
</div>
@endsection