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
<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
	<div class="container mb-0">
		<div id="google-map">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.987205239079!2d105.84695891440668!3d20.99314999437004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac6dce1c3075%3A0x1151330eb74574fe!2zSOG7hyB0aOG7kW5nIGdpw6FvIGThu6VjIHbDoCBjw7RuZyBuZ2jhu4cgWmVudA!5e0!3m2!1svi!2s!4v1579080928542!5m2!1svi!2s" width="600" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
				<div class="contact-page-side-content">
					<h3 class="contact-page-title">Contact Us</h3>
					<p class="contact-page-message mb-25">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.</p>
					<div class="single-contact-block">
						<h4><i class="fa fa-fax"></i> Address</h4>
						<p>123 Main Street, Anytown, CA 12345 – USA</p>
					</div>
					<div class="single-contact-block">
						<h4><i class="fa fa-phone"></i> Phone</h4>
						<p>Mobile: (08) 123 456 789</p>
						<p>Hotline: 1009 678 456</p>
					</div>
					<div class="single-contact-block last-child">
						<h4><i class="fa fa-envelope-o"></i> Email</h4>
						<p>yourmail@domain.com</p>
						<p>support@hastech.company</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 order-2 order-lg-1">
				<div class="contact-form-content pt-sm-55 pt-xs-55">
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
				</div>
			</div>
		</div>
	</div>
</div>
@endsection