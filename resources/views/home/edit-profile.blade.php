@extends('layouts.master')
@section('link')
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
@endsection
@section('js')
	<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
@endsection
@section('content')
<div class="container" style="padding-left: 0px;padding-right: 0px;">
	<div class="gap"></div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
			<div class="gap"></div>
			<div class="panel panel-primary">
				<div class="panel-heading">Chỉnh sửa hồ sơ</div>
				<div class="panel-body">
					<div class="gap"></div>
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					@if(session('thongbao'))
		                        <div class="alert bg-success">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<span class="text-semibold">Done</span>  {{session('thongbao')}}
								</div>
		            @endif
					<form class="form-horizontal" method="POST" action="{{ route('user.edit') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="content-upload">
							<center>
								@if(Auth::user()->avatar == 'no-avatar.jpg')
									<img class="user_avatar" id="output" src="images/no-avatar.jpg">
								@else
									<img class="user_avatar" id="output" src="uploads/avatars/{{ $user->avatar }}">
								@endif
								<label for="avtuser" class="labelforfile"><i class="fas fa-file-image"></i> Chọn ảnh</label>
								<input class="form-control" name="avtuser" id="avtuser" type="file" accept="image/*" onchange="loadFile(event)" style="display: none">
								<script>
								  var loadFile = function(event) {
								    var output = document.getElementById('output');
								    output.src = URL.createObjectURL(event.target.files[0]);
								  };
								</script>
							</center>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tên hiển thị:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtname" value="{{$user->name}}" placeholder="Tên hiển thị trên hệ thống">
							</div>
						</div>
						{{-- @foreach ($profileusers as $prouser) --}}
					   <div class="form-group">
							<label class="control-label col-sm-3">Họ và Tên:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtfullname" value="{{$profileusers->fullname}}" placeholder="Họ và Tên">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ngày sinh:</label>
							<div class="col-sm-9">				      
								<input type="date" required="true" name="txtbirtday" class="form-control wsm" id="txtns" value="{{$profileusers->birthday}}" placeholder="Ngày sinh">
							</div>
						</div>
						<div class="form-group form-check-inline">
							<label class="control-label col-sm-3">Giới tính:</label>
							<div class="col-sm-9" style="display: flex;padding-top: 7px;">
								<div class="form-check" style="padding-right: 15px;">
									<input class="form-check-input" type="radio" name="txtsex" id="txtgioitinh1" value="0" checked>
									<label class="form-check-label" for="txtgioitinh1">
									  Nam
									</label>
								  </div>
								  <div class="form-check" style="padding-right: 15px;">
									<input class="form-check-input" type="radio" name="txtsex" id="txtgioitinh2" value="1">
									<label class="form-check-label" for="txtgioitinh2">
									  Nữ
									</label>
								  </div>
								  <div class="form-check" style="padding-right: 15px;">
									<input class="form-check-input" type="radio" name="txtsex" id="txtgioitinh2" value="2">
									<label class="form-check-label" for="txtgioitinh2">
									  Khác
									</label>
								  </div>
								{{-- <input type="text" class="form-control" name="txtsex" value="{{$profileusers->sex}}" placeholder="Giới tính"> --}}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Địa chỉ:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtadress" value="{{$profileusers->adress}}" placeholder="Địa chỉ">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Trình độ học vấn:</label>
							<div class="col-sm-9">
							<select class="form-control select2 select2-danger" name="txteducation" data-dropdown-css-class="select2-danger" style="width: 100%;">
								<option selected="selected">{{$profileusers->education}}</option>
								<option value="Trung học phổ thông">Trung học phổ thông</option>
								<option value="Trung cấp">Trung cấp</option>
								<option value="Đại Học/Cao đẳng">Đại Học/Cao đẳng</option>
								<option value="Thạc sĩ">Thạc sĩ</option>
								<option value="Tiến sĩ">Tiến sĩ</option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Chuyên ngành:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtspecialized" value="{{$profileusers->specialized}}" placeholder="Chuyên ngành">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Kỹ năng:</label>
							<div class="select2-purple col-sm-9">
								<select class="select2" multiple="multiple" data-placeholder="Hãy chọn kỹ năng" name="txtskill[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
									<option value="Giao tiếp">Giao tiếp</option>
									<option value="Soạn thảo văn bản">Soạn thảo văn bản</option>
									<option value="Lau dọn nhà cửa">Lau dọn nhà cửa</option>
									<option value="Bảng tính điện tử">Bảng tính điện tử</option>
									<option value="Truy vấn dữ liệu">Truy vấn dữ liệu </option>
									<option value="Trình diễn điện tử" >Trình diễn điện tử </option>
									<option value="Sử dụng Web và Internet" >Sử dụng Web và Internet </option>
									<option value="Thiết kế trang Web" >Thiết kế trang Web </option>
									<option value="Sử dụng Email" >Sử dụng Email </option>
									<option value="Sử dụng máy quay camera số" >Sử dụng máy quay camera số</option>
									<option value="Hiểu biết các ứng dụng mạng máy tính" >Hiểu biết các ứng dụng mạng máy tính</option>
									<option value="Thao tác thành thạo với tệp và thư mục trong Windows" >Thao tác thành thạo với tệp và thư mục trong Windows</option>
									<option value="Biết cách tìm và sao chép phần mềm từ Internet" >Biết cách tìm và sao chép phần mềm từ Internet </option>
									<option value="Biết cách cài đặt phần mềm máy tính" >Biết cách cài đặt phần mềm máy tính </option>
									<option value="Có hiểu biết về công nghệ và phần mềm quản lý hệ thống đào tạo" >Có hiểu biết về công nghệ và phần mềm quản lý hệ thống đào tạo</option>
									<option value="Có hiểu biết về công nghệ Videoconferencing và ứng dụng" >Có hiểu biết về công nghệ Videoconferencing và ứng dụng</option>
									<option value="Biết cách sử dụng máy quét" > Biết cách sử dụng máy quét </option>
									<option value="Khác">Khác</option>
								</select>
							  </div>
							{{-- <div class="col-sm-9">
								<input type="text" class="form-control"  placeholder="Kỹ năng">
							</div> --}}
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Sở thích:</label>
							<div class="select2-purple col-sm-9">
								<select class="select2" multiple="multiple" data-placeholder="Hãy chọn sở thích" name="txtinterests[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
									<option value="Nghe nhạc">Nghe nhạc</option>
									<option value="Xem phim">Xem phim</option>
									<option value="Đọc sách">Đọc sách</option>
									<option value="Chơi thể thao">Chơi thể thao</option>
									<option value="Đi du lich">Đi du lich </option>
									<option value="Nấu nướng" >Nấu nướng</option>
									<option value="Khác">Khác</option>
								</select>
							</div>
						</div>

						{{-- @endforeach --}}
						<H4 style="color: red;text-align:center;">Nếu bạn không muốn thay đổi mật khẩu có thể bỏ trống !!!</H4>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="txtpass" placeholder="Nhập mật khẩu">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">Nhập lại mật khẩu:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="retxtpass" placeholder="Nhập lại mật khẩu">
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-offset-5 col-sm-9">
								<button type="submit" class="btn btn-primary">Chỉnh sửa</button>
							</div>
						</div>
					</form><div class="gap"></div>
				</div>

			<div class="gap"></div>
			</div>
		</div>
	</div>

</div>
@endsection