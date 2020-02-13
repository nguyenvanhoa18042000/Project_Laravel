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
<!-- <div class="breadcrumb-area">
	<div class="container">
		<div class="breadcrumb-content">
			<ul>
				<li><a href="index.html">Trang chủ</a></li>
				<li class="active">Chi tiết bài viết</li>
			</ul>
		</div>
	</div>
</div> -->
@endsection
@section('content')
<div class="li-main-blog-page li-main-blog-details-page pt-5 pb-5 pb-sm-45 pb-xs-45">
	<div class="container-fluid">
		<div class="row">
			<ul class="menu" style="width: 88%;margin: auto;">
				<li><a href="{{route('frontend.news')}}">TIN MỚI</a></li>
				@foreach($news_categories as $news_category)
					@if($news_category->parent_id == NULL && $news_category->deleted_at == NULL)
						@if($loop->last)
					        <li>
								<a href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a>
								<label class="menulabel">MỚI</label>
							</li>
						@else
							<li><a href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a></li>
					    @endif
					@endif
				@endforeach				
			</ul>
		</div>
		@if($post->news_category->name != 'Stories')
			<div class="row">
			@if(isset($post->background_img_title))
				<div class="bgcover" style="background-image: url({{asset($post->background_img_title)}});">
					<div class="bgtrans">
						<h1>{{$post->title}}</h1>
						<div class="userdetail">
							<a href="#">
								<img width="20" height="20" src="{{asset($post->user->avatar)}}"> {{$post->user->name}}
							</a>
							<span style="color: white"><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
						</div>
					</div>
				</div>
			@endif
			<section style="margin: auto;">
				@if(!isset($post->background_img_title))
					<div class="titledetail">
						{{$post->title}}
					</div>
					<div class="userdetail">
						<a href="#" style="color: #837575">
							<img width="20" height="20" src="{{asset($post->user->avatar)}}"> {{$post->user->name}}
						</a>
						<span style="color: #837575"><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
					</div>
				@endif
			</section>
			<section class="content-post" @if(!isset($post->background_img_title)) style= "margin-top:0;"  @endif>
				<article class="artrating">
					{!!$post->content!!}
				</article>
				<div class="bottom">
					<h5 class="titlerelate">Bài viết liên quan</h5>
					<ul class="newsrelate">
						@foreach($posts as $post)
							<li>
								<a href="{{route('frontend.detail_post',$post->slug)}}" class="linkimg">
									<div class="tempvideo">
										<img src="{{asset($post->image)}}" width="240" height="130">
									</div>
									<h3>
										{!!$post->description!!}
									</h3>
									<p style="margin-bottom: 8px">
										<span class="timepost"><i class="fa fa-calendar"></i> {{ $post->created_at->diffForHumans() }}</span>
										<span class="lesscom"><i class="fa fa-comment" aria-hidden="true"></i> 3</span>
									</p>
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</section>
			</div>
		@else
			<div class="row">
				{!!$post->content!!}
			</div>
		@endif
	</div>
	<div class="row">
			<ul class="menu" style="width: 88%;margin: auto;">
				<li><a href="{{route('frontend.news')}}">TIN MỚI</a></li>
				@foreach($news_categories as $news_category)
					@if($news_category->parent_id == NULL && $news_category->deleted_at == NULL)
						@if($loop->last)
					        <li>
								<a href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a>
								<label class="menulabel">MỚI</label>
							</li>
						@else
							<li><a href="{{route('frontend.detail_news_category',$news_category->slug)}}">{{$news_category->name}}</a></li>
					    @endif
					@endif
				@endforeach				
			</ul>
	</div>
</div>
@endsection