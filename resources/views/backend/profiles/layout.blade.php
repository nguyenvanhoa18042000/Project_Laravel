<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<meta name="csrf_token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/backend/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/backend/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="/backend/plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/backend/dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="/backend/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="/backend/plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet" href="/backend/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="/backend/plugins/toastr/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="/backend/css/my_css.css">
	@yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<!-- Navbar -->
		@include('backend.includes.navbar')
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('backend.includes.sidebar_profile')
		<!-- Content Wrapper. Contains page content -->

		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				@yield('content-header')
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				@yield('content')
			</section>
			<!-- /.content -->

	</div>
	</div>
	<!-- ./wrapper -->
	
	<!-- jQuery -->
	<script>
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
	</script>
	<script src="/backend/plugins/jquery/jquery.min.js"></script>
	<script src="/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="/backend/plugins/select2/js/select2.full.min.js"></script>

	<!-- ChartJS -->
	<script src="/backend/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="/backend/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="/backend/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="/backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="/backend/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="/backend/plugins/moment/moment.min.js"></script>
	<script src="/backend/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="/backend/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/backend/dist/js/adminlte.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="/backend/dist/js/pages/dashboard.js"></script>
	<script type="text/javascript" src="/backend/plugins/toastr/toastr.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="/backend/dist/js/demo.js"></script>
	<script type="text/javascript">
		$(function() {                 
			$('.select2').select2()
			
			$('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
		});
	</script>
	@yield('script')
</body>
</html>