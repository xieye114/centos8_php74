<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis as RedisDB;
use \Illuminate\Database\Capsule\Manager as Capsule;

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

Route::get('/', function () {
     echo "Lavavel 版本:". app()->version();
     echo "<br><a href='". url('test_redis') ."'>测试redis安装..</a>"; 
echo "<br><a href='". url('test_mysql') ."'>测试mysql安装..</a>";
   phpinfo();
});

Route::get('test_redis', function () {
    $redis = RedisDB::connection();
    $redis->zAdd('key', 1, 'val1');
    $redis->zAdd('key', 0, 'val0');
    $redis->zAdd('key', 5, 'val5');
   $result= $redis->zRange('key', 0, -1); 
    if (count($result)==3){
     echo "经测试，redis安装成功！";
     echo json_encode($result);    
}else {
    echo "redis安装失败";
}
});

Route::get('test_mysql', function () {
     $capsule = new Capsule;  
       $capsule->addConnection([  
           'driver'    => 'mysql',  
           'host'      => '127.0.0.1',  
           'database'  => 'mysql',  
           'username'  => 'root',  
           'password'  => '',  
           'charset'   => 'utf8',  
           'collation' => 'utf8_unicode_ci',  
           'prefix'    => '',  
       ]);  
       $capsule->setAsGlobal();  
       $conn =$capsule;   
         
       $result = $conn::select('SELECT version(),now()');  
       var_dump($result);  
       echo "<br>mysql 数据库安装成功！";  
});

