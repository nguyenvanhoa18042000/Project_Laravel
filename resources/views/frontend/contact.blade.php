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
				<li class="active">Liên hệ</li>
			</ul>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="contact-main-page mt-20 mb-0 mb-md-20 mb-sm-20 mb-xs-20">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 order-1 order-lg-2">
				<div class="contact-page-side-content">
					<h3 class="contact-page-title">THÔNG TIN LIÊN LẠC</h3>
					<p class="contact-page-message mb-25">Tìm Siêu thị Di Động? Xin mời ghé kéo xuống để xem bản đồ và địa chỉ các Siêu thị trên toàn quốc. Chúng tôi luôn muốn những góp ý của khách hàng để ngày một cải tiến, phát triển tốt hơn giúp khách hàng hài lòng nhất có thể</p>
					<div class="single-contact-block">
						<h4><i class="fa fa-fax"></i> Địa chỉ</h4>
						<p>Tầng 6, số 2 ngõ 118 Trương Định, Hai Bà Trưng, Hà Nội</p>
					</div>
					<div class="single-contact-block">
						<h4><i class="fa fa-phone"></i> Số điện thoại</h4>
						<p>Mobile: (08) 123 456 789</p>
						<p>Hotline: 1009 678 456</p>
					</div>
					<div class="single-contact-block last-child">
						<h4><i class="fa fa-envelope-o"></i> Email</h4>
						<p>info@zent.vn</p>
						<p>nguyenvanhoa@gmail.com</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 order-2 order-lg-1 mt-sm-20">
				<form method="POST" action="{{route('frontend.contact.store')}}" >
					@csrf
					<div class="contact-form">
						@if(Session::has('send_contact_success'))
							<button class="btn btn-success" style="width: 100%;margin-bottom: 2%;">{{Session::get('send_contact_success')}}</button>
						@endif
						<h1>SIÊU THỊ ĐIỆN MÁY XIN HÂN HẠNH ĐƯỢC HỖ TRỢ QUÝ KHÁCH</h1>
						<div class="the-form-wrapper">

							<div class="topic-filter-wrapper clearfix">
								<label class="topic-filter">Qúy khách đang quan tâm về:</label>
								<select id="topic-filter" class="topic-filter" name="topic_id">
	                                <option value="" selected="" disabled="">Chọn chủ đề</option>
	                                    {{Helper::data_tree($topics)}}
	                            </select>
	                            @if($errors->has('topic_id'))
			                        <div class="error error_at_contact" style="width: 50%;float: right;">{{ $errors->first('topic_id') }}</div>
			                    @endif
							</div>
							<div class="row-wrapper clearfix">
                            <div class="label-wrapper">
                                <label for="title">Tiêu đề <strong> *</strong></label>
                            </div>
                            <div class="input-wrapper">
                                    <input id="title" name="title" class="input title" type="text">
                                    @if($errors->has('title'))
				                        <div class="error error_at_contact">{{ $errors->first('title') }}</div>
				                    @endif
                            </div>
                        </div>
                        <div class="row-wrapper clearfix">
                            <div class="label-wrapper">
                                <label for="message">Nội dung <strong> *</strong></label>
                            </div>
                            <div class="input-wrapper">
                                <textarea id="message" name="content" class="textarea message" placeholder="Xin quý khách vui lòng mô tả chi tiết"></textarea>
                                @if($errors->has('content'))
			                        <div class="error error_at_contact" style="margin-top: 0;">{{ $errors->first('content') }}</div>
			                    @endif
                            </div>
                        </div>
                        <div class="row-wrapper clearfix">
                            <div class="label-wrapper">
                                <label for="fullname">Họ và tên <strong> *</strong></label>
                            </div>
                            <div class="input-wrapper">
                                <input id="fullname" name="name" class="input fullname" type="text">
                                @if($errors->has('name'))
			                        <div class="error error_at_contact">{{ $errors->first('name') }}</div>
			                    @endif
                            </div>
                        </div>
                        <div class="row-wrapper clearfix">
                            <div class="label-wrapper">
                                <label for="email">Địa chỉ email</label>
                            </div>
                            <div class="input-wrapper">
                                <input id="email" name="email" class="input email" type="text">
                                @if($errors->has('email'))
			                        <div class="error error_at_contact">{{ $errors->first('email') }}</div>
			                    @endif
                            </div>
                        </div>
                        <div class="row-wrapper clearfix">
                            <div class="label-wrapper">
                                <label for="tel">Số điện thoại</label>
                            </div>
                            <div class="input-wrapper">
                                <input id="tel" name="phone" class="input tel" type="text" maxlength="11">
                                @if($errors->has('phone'))
			                        <div class="error error_at_contact">{{ $errors->first('phone') }}</div>
			                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="submit-wrapper">
                        <input id="submit" name="submit" class="submit submit" type="submit" value="Gửi Liên Hệ">
                    </div>
                </div>
            </form>
				<!-- <div class="contact-form-content pt-sm-55 pt-xs-55">
					<h3 class="contact-page-title">Tell Us Your Message</h3>
					<div class="contact-form">
						<form  id="contact-form" action="http://demo.hasthemes.com/limupa-v3/limupa/mail.php" method="post">
							<div class="form-group">
								<label>Your Name <span class="required">*</span></label>
								<input type="text" name="customerName" id="customername" required>
							</div>
							<div class="form-group">
								<label>Your Email <span class="required">*</span></label>
								<input type="email" name="customerEmail" id="customerEmail" required>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<input type="text" name="contactSubject" id="contactSubject">
							</div>
							<div class="form-group mb-30">
								<label>Your Message</label>
								<textarea name="contactMessage" id="contactMessage" ></textarea>
							</div>
							<div class="form-group">
								<button type="submit" value="submit" id="submit" class="li-btn-3" name="submit">send</button>
							</div>
						</form>
					</div>
					<p class="form-messege"></p>
				</div> -->
			</div>
		</div>
	</div>
	<div class="container mt-60 mb-0">
		<div id="google-map" style="height: 350px">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.987205239079!2d105.84695891440668!3d20.99314999437004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac6dce1c3075%3A0x1151330eb74574fe!2zSOG7hyB0aOG7kW5nIGdpw6FvIGThu6VjIHbDoCBjw7RuZyBuZ2jhu4cgWmVudA!5e0!3m2!1svi!2s!4v1579080928542!5m2!1svi!2s" width="600" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	</div>
</div>
@endsection