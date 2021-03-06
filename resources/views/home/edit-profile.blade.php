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
				<div class="panel-heading">Ch???nh s???a h??? s??</div>
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
									<button type="button" class="close" data-dismiss="alert"><span>??</span><span class="sr-only">Close</span></button>
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
								<label for="avtuser" class="labelforfile"><i class="fas fa-file-image"></i> Ch???n ???nh</label>
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
							<label class="control-label col-sm-3">T??n hi???n th???:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtname" value="{{$user->name}}" placeholder="T??n hi???n th??? tr??n h??? th???ng">
							</div>
						</div>
						{{-- @foreach ($profileusers as $prouser) --}}
					   <div class="form-group">
							<label class="control-label col-sm-3">H??? v?? T??n:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtfullname" value="{{$profileusers->fullname}}" placeholder="H??? v?? T??n">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ng??y sinh:</label>
							<div class="col-sm-9">				      
								<input type="date" required="true" name="txtbirtday" class="form-control wsm" id="txtns" value="{{$profileusers->birthday}}" placeholder="Ng??y sinh">
							</div>
						</div>
						<div class="form-group form-check-inline">
							<label class="control-label col-sm-3">Gi???i t??nh:</label>
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
									  N???
									</label>
								  </div>
								  <div class="form-check" style="padding-right: 15px;">
									<input class="form-check-input" type="radio" name="txtsex" id="txtgioitinh2" value="2">
									<label class="form-check-label" for="txtgioitinh2">
									  Kh??c
									</label>
								  </div>
								{{-- <input type="text" class="form-control" name="txtsex" value="{{$profileusers->sex}}" placeholder="Gi???i t??nh"> --}}
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">?????a ch???:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtadress" value="{{$profileusers->adress}}" placeholder="?????a ch???">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tr??nh ????? h???c v???n:</label>
							<div class="col-sm-9">
							<select class="form-control select2 select2-danger" name="txteducation" data-dropdown-css-class="select2-danger" style="width: 100%;">
								<option selected="selected">{{$profileusers->education}}</option>
								<option value="Trung h???c ph??? th??ng">Trung h???c ph??? th??ng</option>
								<option value="Trung c???p">Trung c???p</option>
								<option value="?????i H???c/Cao ?????ng">?????i H???c/Cao ?????ng</option>
								<option value="Th???c s??">Th???c s??</option>
								<option value="Ti???n s??">Ti???n s??</option>
							  </select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Chuy??n ng??nh:</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="txtspecialized" value="{{$profileusers->specialized}}" placeholder="Chuy??n ng??nh">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">K??? n??ng:</label>
							<div class="select2-purple col-sm-9">
								<select class="select2" multiple="multiple" data-placeholder="H??y ch???n k??? n??ng" name="txtskill[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
									<option value="Giao ti???p">Giao ti???p</option>
									<option value="So???n th???o v??n b???n">So???n th???o v??n b???n</option>
									<option value="Lau d???n nh?? c???a">Lau d???n nh?? c???a</option>
									<option value="B???ng t??nh ??i???n t???">B???ng t??nh ??i???n t???</option>
									<option value="Truy v???n d??? li???u">Truy v???n d??? li???u </option>
									<option value="Tr??nh di???n ??i???n t???" >Tr??nh di???n ??i???n t??? </option>
									<option value="S??? d???ng Web v?? Internet" >S??? d???ng Web v?? Internet </option>
									<option value="Thi???t k??? trang Web" >Thi???t k??? trang Web </option>
									<option value="S??? d???ng Email" >S??? d???ng Email </option>
									<option value="S??? d???ng m??y quay camera s???" >S??? d???ng m??y quay camera s???</option>
									<option value="Hi???u bi???t c??c ???ng d???ng m???ng m??y t??nh" >Hi???u bi???t c??c ???ng d???ng m???ng m??y t??nh</option>
									<option value="Thao t??c th??nh th???o v???i t???p v?? th?? m???c trong Windows" >Thao t??c th??nh th???o v???i t???p v?? th?? m???c trong Windows</option>
									<option value="Bi???t c??ch t??m v?? sao ch??p ph???n m???m t??? Internet" >Bi???t c??ch t??m v?? sao ch??p ph???n m???m t??? Internet </option>
									<option value="Bi???t c??ch c??i ?????t ph???n m???m m??y t??nh" >Bi???t c??ch c??i ?????t ph???n m???m m??y t??nh </option>
									<option value="C?? hi???u bi???t v??? c??ng ngh??? v?? ph???n m???m qu???n l?? h??? th???ng ????o t???o" >C?? hi???u bi???t v??? c??ng ngh??? v?? ph???n m???m qu???n l?? h??? th???ng ????o t???o</option>
									<option value="C?? hi???u bi???t v??? c??ng ngh??? Videoconferencing v?? ???ng d???ng" >C?? hi???u bi???t v??? c??ng ngh??? Videoconferencing v?? ???ng d???ng</option>
									<option value="Bi???t c??ch s??? d???ng m??y qu??t" > Bi???t c??ch s??? d???ng m??y qu??t </option>
									<option value="Kh??c">Kh??c</option>
								</select>
							  </div>
							{{-- <div class="col-sm-9">
								<input type="text" class="form-control"  placeholder="K??? n??ng">
							</div> --}}
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">S??? th??ch:</label>
							<div class="select2-purple col-sm-9">
								<select class="select2" multiple="multiple" data-placeholder="H??y ch???n s??? th??ch" name="txtinterests[]" data-dropdown-css-class="select2-purple" style="width: 100%;">
									<option value="Nghe nh???c">Nghe nh???c</option>
									<option value="Xem phim">Xem phim</option>
									<option value="?????c s??ch">?????c s??ch</option>
									<option value="Ch??i th??? thao">Ch??i th??? thao</option>
									<option value="??i du lich">??i du lich </option>
									<option value="N???u n?????ng" >N???u n?????ng</option>
									<option value="Kh??c">Kh??c</option>
								</select>
							</div>
						</div>

						{{-- @endforeach --}}
						<H4 style="color: red;text-align:center;">N???u b???n kh??ng mu???n thay ?????i m???t kh???u c?? th??? b??? tr???ng !!!</H4>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">M???t kh???u:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="txtpass" placeholder="Nh???p m???t kh???u">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="pwd">Nh???p l???i m???t kh???u:</label>
							<div class="col-sm-9"> 
								<input type="password" class="form-control" name="retxtpass" placeholder="Nh???p l???i m???t kh???u">
							</div>
						</div>
						<div class="form-group"> 
							<div class="col-sm-offset-5 col-sm-9">
								<button type="submit" class="btn btn-primary">Ch???nh s???a</button>
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