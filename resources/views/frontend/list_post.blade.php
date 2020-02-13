<?php Carbon\Carbon::setLocale('vi'); ?>
@extends('frontend.layouts.master')
@section('title')
Trang chủ
@section('css')
@endsection
@section('script')
@endsection
@endsection
@section('content-header')
@endsection
@section('content')
<div class="li-main-blog-page pb-10">
	<div class="container-fluid" style="width: 90%;margin: auto;">
		<div class="row">
			<ul class="menu">
				<li>
					<a @if(!isset($news_cate)) style="background:#fed700;" @endif href="{{route('frontend.news')}}">TIN MỚI</a>
				</li>
				@foreach($news_categories as $news_category)
				@if($news_category->parent_id == NULL && $news_category->deleted_at == NULL)
				@if($loop->last)
				<li>
					<a @if(isset($news_cate) && $news_cate->id == $news_category->id) style="background:#fed700;" @endif href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a>
					<label class="menulabel">MỚI</label>
				</li>
				@else
				<li><a @if(isset($news_cate) && $news_cate->id == $news_category->id) style="background:#fed700;" @endif href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a></li>
				@endif
				@endif
				@endforeach				
			</ul>
		</div>
		<div class="row pb-10">
			<div class="col-lg-8 order-lg-2 order-1">
				<div class="row li-main-content" style="width: 100%;">
					<div class="infopage">
						@if(isset($news_cate))
						<h1>{{$news_cate->name}}</h1>
						<span>{{$news_cate->description}}</span>
						@else
						<h1>TIN MỚI</h1>
						<span>Những bài viết mới nhất</span>
						@endif
					</div>
					<ul class="newslist" id="mainlist">
						@foreach($posts as $post)
						<li>
							<a href="{{route('frontend.detail_post',$post->slug)}}">
								<div class="tempvideo">
									<img width="250" height="140" src="{{asset($post->image)}}">
								</div>
								<h3>
									@if($post->hot == 1)
									<label class="hot">Hot</label>
									@endif
									{{$post->title}}
								</h3>
								<figure>
									{!! $post->description !!}
								</figure>
								<div class="timepost">
									<span><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
									<span class="namecate">{{$post->news_category->name}}</span>
								</div>
							</a>
						</li>
						@endforeach
					</ul>
					<!-- Begin Li's Pagination Area -->
					<div class="col-lg-12">
						<div class="text-center pt-25">
							<div class="row">
								<div class="col-lg-12">
									<ul style="position:relative;left:50%; transform: translateX(-7%);">
										<li>{!! $posts->links() !!}</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Li's Pagination End Here Area -->
				</div>
			</div>

			<div class="col-lg-4  order-2">
				<div class="li-blog-sidebar-wrapper">
					<div class="li-blog-sidebar">
						<div class="boxright">
							<h4 class="topNewsTitle">THẢO LUẬN NHIỀU</h4>
							<ul class="listpost">
								<li>
									<label>1</label>
									<div class="colu">
										<a href="">
											<h3 style="font-weight: normal;font: 14px/18px Arial,Helvetica,sans-serif;color: #333;outline: none;zoom: 1;">Samsung ra mắt máy giặt tích hợp máy sấy có trí tuệ nhân tạo AI</h3>
										</a>
									</div>
									<div class="clr"></div>
								</li>
								<li>
									<label>2</label>
									<div class="colu">
										<a href="">
											<h3 style="font-weight: normal;font: 14px/18px Arial,Helvetica,sans-serif;color: #333;outline: none;zoom: 1;">Nhận ngay 25GB dung lượng Dropbox miễn phí cực đơn giản</h3>
										</a>
									</div>
									<div class="clr"></div>
								</li>
								<li>
									<label>3</label>
									<div class="colu">
										<a href="">
											<h3 style="font-weight: normal;font: 14px/18px Arial,Helvetica,sans-serif;color: #333;outline: none;zoom: 1;">Phát triển thành công ứng dụng xét nghiệm chủng virus corona trên điện thoại</h3>
										</a>
									</div>
									<div class="clr"></div>
								</li>
								<li>
									<label>4</label>
									<div class="colu">
										<a href="">
											<h3 style="font-weight: normal;font: 14px/18px Arial,Helvetica,sans-serif;color: #333;outline: none;zoom: 1;">5 cách khắc phục điện thoại Android không bật được 4G</h3>
										</a>
									</div>
									<div class="clr"></div>
								</li>
								<li>
									<label>5</label>
									<div class="colu">
										<a href="">
											<h3 style="font-weight: normal;font: 14px/18px Arial,Helvetica,sans-serif;color: #333;outline: none;zoom: 1;">Tổng hợp tất cả các phím tắt thông dụng trên Google Chrome, lưu lại để dùng ngay</h3>
										</a>
									</div>
									<div class="clr"></div>
								</li>
							</ul>
						</div>
						@if(isset($new_posts))
						<div>
							<a href="#" class="linkproduct">Bài viết mới nhất</a>
							<ul class="newspromotion">
								@foreach($new_posts as $new_post)
								<li>
									<a href="{{route('frontend.detail_post',$new_post->slug)}}">
										<img width="380" height="215" src="{{asset($new_post->image)}}" class="lazy"/>
										<h3>Đặt trước Samsung Galaxy Z Flip chỉ đến 18h h&#244;m nay (12/02), số lượng cực kỳ giới hạn</h3>
									</a>
								</li>
								@endforeach
							</ul>
							<div class="clr"></div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<ul class="menu" style="width: 100%;margin: auto;">
				<li><a @if(!isset($news_cate)) style="background:#fed700;" @endif href="{{route('frontend.news')}}">TIN MỚI</a></li>
				@foreach($news_categories as $news_category)
				@if($news_category->parent_id == NULL && $news_category->deleted_at == NULL)
				@if($loop->last)
				<li>
					<a @if(isset($news_cate) && $news_cate->id == $news_category->id) style="background:#fed700;" @endif href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a>
					<label class="menulabel">MỚI</label>
				</li>
				@else
				<li><a @if(isset($news_cate) && $news_cate->id == $news_category->id) style="background:#fed700;" @endif href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a></li>
				@endif
				@endif
				@endforeach				
			</ul>
		</div>
	</div>
</div>
@endsection