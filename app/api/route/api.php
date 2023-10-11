<?php

use think\facade\Route;

// url版本路由，在url地址上带版本号
Route::rule(':version/:controller/:function', ':version.:controller/:function')
    ->allowCrossDomain([
        'Access-Control-Allow-Origin' => '*', // //解决跨域问题
        'Access-Control-Allow-Methods' => 'GET,POST,OPTIONS',
        'Access-Control-Allow-Headers' => 'x-requested-with,content-type,token'
    ]);

// 头部模式（请求头部带版本号）
$version = request()->header('version');
//默认跳转到v1版本
if ($version == null) $version = "v1";
Route::rule(':controller/:function', $version . '.:controller/:function');

