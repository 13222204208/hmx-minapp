<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('minapp')->group(function (){

    Route::group(['namespace' => 'Minapp'], function () {

        Route::post('login', 'LoginController@login');//用户登陆
        Route::get('banner', 'BannerController@banner');//获取banner列表;
        Route::get('affiche', 'AfficheController@affiche');//获取公告;
        Route::get('activity', 'ActivityController@activity');//获取活动;
        Route::get('channel','ChannelController@channel');//获取频道;
        Route::get('course','CourseController@course');//获取课程;
        Route::get('about','AgreementController@about');//关于我们和隐私权益;

        Route::post('enroll','EnrollController@enroll');//提交活动报名信息
        
        Route::group(['middleware' => 'auth:api'], function () {   
            Route::post('upload_img','UserInfoController@uploadImg');//上传图片
            Route::post('update_info','UserInfoController@updateInfo');//更新用户信息
        });
    });

});

Route::prefix('admin')->group(function (){

    Route::group(['namespace' => 'Admin'], function () {

        Route::post('login','LoginController@adminLogin');//登录

        Route::post('logout','LoginController@adminLogout');//登出

        Route::post('upload/img','UploadImgController@uploadImg');//上传图片
        Route::post('upload/content/img','UploadImgController@uploadContentImg');//上传富文本图片
        
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('info','LoginController@info');//获取后台登陆信息    
            
            Route::resource('admin', 'AdminController');//后台帐号  
           
            Route::resource('banner', 'BannerController');//banner图
            
            Route::resource('activity', 'ActivityController');//活动
            
            Route::resource('channel', 'ChannelController');//频道

            Route::resource('content', 'ContentController');//内容

            Route::resource('course', 'CourseController');//课程

            Route::resource('affiche', 'AfficheController');//公告

            Route::resource('agreement', 'AgreementController');//协议
            
            Route::resource('enroll', 'EnrollController');//活动报名列表
            
        });
    });

});