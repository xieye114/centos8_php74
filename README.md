# win10系统使用docker快速搭建php开发环境

## 用git 下载到本地。

假设我想下载到本机D盘的centos8目录。
则
~~~
d:

cd \

git clone https://github.com/xieye114/centos8_php74.git centos8

cd centos8\build
~~~

## 构建镜像。

~~~
build

修改up.bat，一次性的。修改 
set mypath=d:/temp/centos8_php74
set path2=d:\temp\centos8_php74
改成
set mypath=d:/centos8
set path2=d:\centos8

启动容器
up
~~~

## 随时可进入容器

~~~
exec

cd /code
composer create-project --prefer-dist laravel/laravel blog "8.*"

按住CTRL+d 可以退出容器。
~~~

## 测试安装结果
把 d:\centos8\build\web.php 拷贝到 d:\centos8\build\blog\route\web.php,覆盖

打开浏览器。输入 localhost

自行点击 测试redis安装，和mysql安装。
如果都成功，会显示安装成功的字样。

## mysql 的数据存放
其中mysql的数据都保存在windows上，就算容器关闭，下次再打开，数据依然保留。

## nginx 的配置修改。
修改 nginx_config 里的配置文件后，只需进入容器，systemctl restart nginx ，即可生效。

## 日常使用
关机前最好进入build目录，执行down命令关闭容器。
build是日常维护目录，进入此目录可以执行以下命令。

~~~
build 构建镜像
remove 删除镜像
up 启动容器（会自动创建）
down 关闭容器
exec 进入容器
按住CTRL+d 可以退出容器。
~~~





