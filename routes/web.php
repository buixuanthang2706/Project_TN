<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use App\District;
use App\Categories;
use App\Motelroom;
Route::get('/', function () {
	$district = District::all();
    $categories = Categories::all();
    $hot_motelroom = Motelroom::where('approve',1)->limit(6)->orderBy('count_view','desc')->get();
    $map_motelroom = Motelroom::where('approve',1)->get();
	$listmotelroom = Motelroom::where('approve',1)->paginate(4);
    return view('home.index',[
    	'district'=>$district,
        'categories'=>$categories,
        'hot_motelroom'=>$hot_motelroom,
    	'map_motelroom'=>$map_motelroom,
        'listmotelroom'=>$listmotelroom
    ]);
});
Route::get('category/{id}','MotelController@getMotelByCategoryId');
/* Admin */
Route::get('admin/login','AdminController@getLogin');
Route::post('admin/login','AdminController@postLogin')->name('admin.login');
Route::group(['prefix'=>'admin','middleware'=>'adminmiddleware'], function () {
    Route::get('logout','AdminController@logout');
    Route::get('','AdminController@getIndex');
    Route::get('thongke','AdminController@getThongke');
    Route::get('report','AdminController@getReport');
    Route::group(['prefix'=>'users'],function(){
        Route::get('list','AdminController@getListUser');
        Route::get('edit/{id}','AdminController@getUpdateUser');
        Route::post('edit/{id}','AdminController@postUpdateUser')->name('admin.user.edit');
        Route::get('del/{id}','AdminController@DeleteUser');
    });
    Route::group(['prefix'=>'congviec'],function(){
        Route::get('list','AdminController@getListMotel');
        Route::get('approve/{id}','AdminController@ApproveMotelroom');
        Route::get('unapprove/{id}','AdminController@UnApproveMotelroom');
        Route::get('del/{id}','AdminController@DelMotelroom');
        // Route::get('edit/{id}','AdminController@getUpdateUser');
        // Route::post('edit/{id}','AdminController@postUpdateUser')->name('admin.user.edit');
        // Route::get('del/{id}','AdminController@DeleteUser');
    });
});
/* End Admin */
Route::get('/congviec/{slug}',function($slug){
    $job = Motelroom::findBySlug($slug);
    $job->count_view = $job->count_view +1;
    $job->save();
    $categories = Categories::all();
    return view('home.detail',['motelroom'=>$job, 'categories'=>$categories]);
});
Route::get('/connect/{job_id}','MotelController@UngTuyen')->name('user.connect');
Route::get('/report/{id}','MotelController@userReport')->name('user.report');
Route::get('/congviec/del/{id}','MotelController@user_del_motel');
/* User */
Route::group(['prefix'=>'user'], function () {
    Route::get('register','UserController@get_register');
    Route::post('register','UserController@post_register')->name('user.register');

    Route::get('login','UserController@get_login');
    Route::post('login','UserController@post_login')->name('user.login');
    Route::get('logout','UserController@logout');

    Route::get('dangtin','UserController@get_dangtin')->middleware('dangtinmiddleware');
    Route::post('dangtin','UserController@post_dangtin')->name('user.dangtin')->middleware('dangtinmiddleware');

    Route::get('ungvien/{id}','UserController@getprofileungvien')->name('user.profileungvien')->middleware('dangtinmiddleware');
    Route::get('profile','UserController@getprofile')->name('user.profile')->middleware('dangtinmiddleware');
    Route::get('profile/edit','UserController@getEditprofile')->middleware('dangtinmiddleware');
    Route::post('profile/edit','UserController@postEditprofile')->name('user.edit')->middleware('dangtinmiddleware');
    Route::get('profile/edit','UserController@getEditprofile')->middleware('dangtinmiddleware');
    // Route::match(['put', 'patch'], '/profile1/{id}','UserController@postConnects');
    Route::get('profile1/{id}','UserController@postConnect')->middleware('dangtinmiddleware');
    Route::get('profile2/{id}','UserController@tuchoiConnect')->middleware('dangtinmiddleware');
});
/* ----*/

Route::post('searchmotel','MotelController@SearchMotelAjax');
