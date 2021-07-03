@extends('layouts.master')
@section('content')
<?php 
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'năm',
		'm' => 'tháng',
		'w' => 'tuần',
		'd' => 'ngày',
		'h' => 'giờ',
		'i' => 'phút',
		's' => 'giây',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' trước' : 'Vừa xong';
}
?>

<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="banner-info mb-5">
				<div class="mapInfo false" style="" data-reactid="47">
					@if($user->avatar == 'no-avatar.jpg')
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:80px;width:80px;" alt="Thành Trung" size="80" src="images/no-avatar.jpg" class="avatar" data-reactid="57">
					@else
					<img style="color:#ffffff;background-color:rgb(188, 188, 188);user-select:none;display:inline-flex;align-items:center;justify-content:center;font-size:40px;border-radius:50%;height:80px;width:80px;" alt="Thành Trung" size="80" src="uploads/avatars/{{Auth::user()->avatar}}" class="avatar" data-reactid="57">
					@endif
					<a href="user/profile/edit"><div style="color: rgba(0, 0, 0, 0.87); background-color: transparent; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; box-sizing: border-box; font-family: Verdana, Arial, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 10px, rgba(0, 0, 0, 0.23) 0px 3px 10px; border-radius: 50%; display: inline-block; position: absolute; right: 20px; bottom: -17px;"><button tabindex="0" type="button" style="border: 10px; box-sizing: border-box; display: inline-block; font-family: Verdana, Arial, sans-serif; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); cursor: pointer; text-decoration: none; margin: 0px; padding: 0px; outline: none; font-size: 25px; font-weight: inherit; position: relative; vertical-align: bottom; z-index: 1; background-color: rgb(255, 255, 255); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 35px; width: 35px; overflow: hidden; border-radius: 50%; text-align: center; color: rgb(51, 51, 51);"><div><div style="transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; top: 0px;"><span class="ion-android-create" style="color: rgb(51, 51, 51); position: relative; font-size: 25px; display: inline-block; user-select: none; transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms; height: 35px; line-height: 35px; fill: rgb(255, 255, 255);"><i class="fas fa-pencil-alt"></i></span></div></div></button></div></a>
				</div>
				<div class="info">
					<h4 class="name" data-reactid="59">{{ $user->name }}</h4>
					<div class="infoText">
						Tham gia {{ time_elapsed_string($user->created_at) }} - {{ $user->created_at }}
					</div>
				</div>
			</div>
			<div class="mypage">
				<div class="">
					<div class="card">
					  <div class="card-header p-2" style="font-size: 20px;display: flex;justify-content: center;padding-top: 20px;">
						<ul class="nav nav-pills">
						  <li class="nav-item"><h2>Hồ sơ ứng viên</h2></li>
						</ul>
					  </div><!-- /.card-header -->
					  <div class="card-body">
						<div class="tab-content">
						 
						 	 <div >
								
								<div id="km-detail">
									<div class="fs-dtslt" style="font-size: 20px;">Hồ sơ ứng viên</div>
									<div style="padding: 5px;font-size: 18px;">
										
										<div class="card-body">
										
											<strong><i class="fa fa-user-circle"></i> Họ và Tên: </strong>
							
											<span class="text-muted">
												{{ $profileusers->fullname }}
											</span>
							
											<hr>
											<strong><i class="fa fa-birthday-cake"></i> Ngày sinh: </strong>
							
											<span class="text-muted">
												{{ $profileusers->birthday }}
											</span>
							
											<hr>
											<strong><i class="fa fa-user"></i> Giới tính: </strong>
											<span class="text-muted">
											<?php
											if($profileusers->sex == 0 ):
											  echo "Nam";
											elseif($profileusers->sex == 1 ):
											  echo "Nữ";
											else:
											  echo "Khác";
											endif;
											?>
											</span>
							
											<hr>
											<strong><i class="fa fa-home"></i> Địa chỉ: </strong>
							
											<span class="text-muted">
												{{ $profileusers->adress }}
											</span>
							
											<hr>
											<strong><i class="fas fa-book mr-1"></i> Trình độ học vấn:</strong>
							
											<span class="text-muted">
												{{ $profileusers->education }}
											</span>
							
											<hr>
							
											<strong><i class="fa fa-align-justify"></i> Chuyên ngành: </strong>
							
											<span class="text-muted">{{ $profileusers->specialized }}</span>
							
											<hr>
											<?php 
											$arrskill =  json_decode($profileusers->skills);
											?>
											
											<strong><i class="fas fa-pencil-alt mr-1"></i> Kỹ Năng:</strong>
							
											<span class="text-muted">
												@foreach($arrskill as $kynang)
											  <span class="tag tag-danger">{{ $kynang }}</span>
											  @endforeach
											</span>
											<hr>
											<?php 
											$arrsothich =  json_decode( $profileusers->interests );
											?>
											<strong><i class="fas fa-pencil-alt mr-1"></i> Sở thích:</strong>
												<span class="text-muted">
												@foreach($arrsothich as $sothich)
												<span class="tag tag-danger">{{ $sothich }}</span>
												@endforeach
											</span>
							
											<hr>
																										
										  </div>
										 
									</div>
								</div>	
								<div style="text-align: center;font-size: 25px;">
									<a href="user/profile1/{{$connect->id}}" style="color: blue"><i class="fas fa-check"></i> Kết Nối</a>
									<a href="user/profile2/{{ $connect->id }}" style="color:red"><i class="fas fa-times"></i> Từ chối</a>
								 </div>
							</div>
							
						</div>
						<!-- /.tab-content -->
					  </div><!-- /.card-body -->
					</div>
					<!-- /.nav-tabs-custom -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection