<!DOCTYPE html>
<html lang="en">
<head>
	<title>TimViecBT</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<base href="{{asset('')}}">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="assets/awesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/toast/toastr.min.css">
	<script src="assets/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/myjs.js"></script>
	<link rel="stylesheet" href="assets/selectize.default.css" data-theme="default">
	<script src="assets/js/fileinput/fileinput.js" type="text/javascript"></script>
	<script src="assets/js/fileinput/vi.js" type="text/javascript"></script>
	<link rel="stylesheet" href="assets/fileinput.css">
	<script src="assets/pgwslider/pgwslider.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="assets/pgwslider/pgwslider.min.css">
	@yield('link')
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.8/js/plugins/purify.min.js" type="text/javascript"></script> -->
<link rel="stylesheet" href="assets/bootstrap/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="assets/bootstrap/bootstrap-select.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href=""><img src="images/logo.png"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					@foreach($categories as $category)
					<li><a href="category/{{$category->id}}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
				@if(Auth::user())
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-dangtin" href="user/dangtin"><i class="fas fa-edit"></i> ????ng tin ngay</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Xin ch??o! {{Auth::user()->name}} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="user/profile">Th??ng tin chi ti???t</a></li>
							<li><a href="user/dangtin">????ng tin</a></li>
							<li><a href="user/logout">Tho??t</a></li>
						</ul>
					</li>
					
				</ul>
				
				@else
				<ul class="nav navbar-nav navbar-right">
					<li><a class="btn-dangtin" href="user/dangtin"><i class="fas fa-edit"></i> ????ng tin ngay</a></li>
					<li><a href="user/login"><i class="fas fa-user-circle"></i> ????ng Nh???p</a></li>
					<li><a href="user/register"><i class="fas fa-sign-in-alt"></i> ????ng K??</a></li>
				</ul>
				@endif
			</div>
		</div>
	</nav>
	
		@yield('content')
	<div class="gap"></div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="logo-footer">
						<a href="/" title="C???ng th??ng tin s??? 1 v??? D??? ??n B???t ?????ng s???n - Homedy.com">
							<img src="images/logo.png">                        
						</a>
						<div style="padding-top: 10px;">
							<p>D??? ??n ph??t tri???n ???ng d???ng b???n ????? s??? v??o Website T??m ki???m Vi???c L??m</p>
							<p>Sinh vi??n th???c hi???n: B??i Xu??n Th???ng TK15.4</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>
	
<script type="text/javascript" src="assets/toast/toastr.min.js"></script>
@yield('js')
</body>
</html>
