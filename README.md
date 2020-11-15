# win10系统使用 docker 快速搭建 centos8 的 php 开发环境

## 安装 Docker Desktop
网上有很多教程，需设置一下镜像。但不设置也没关系。
镜像有很多，如 https://hub-mirror.c.163.com

## 用git 下载构建文件到本地。

假设我想下载到本机D盘的centos8目录。
~~~
d:

cd \

git clone https://github.com/xieye114/centos8_php74.git centos8
~~~

## 构建镜像，启动容器

~~~
cd centos8\build

构建镜像，第一次大约2分钟。因为尽量使用了阿里的镜像，速度超级快。
build

启动容器前需修改 up.bat，只需改这一次 
set mypath=d:/temp/centos8_php74
set path2=d:\temp\centos8_php74
改成
set mypath=d:/centos8
set path2=d:\centos8

启动容器，右下角docker会不停弹窗，让你确认，点击是，共享。
up
~~~

## 进入容器

~~~
exec

cd /code

安装一个laravel 8 的项目。
composer create-project --prefer-dist laravel/laravel blog "8.*"

安装结束后（大约1分钟多），按住CTRL+d 可以退出容器。
~~~

## 测试安装结果
把 d:\centos8\code\web.php 拷贝到 d:\centos8\code\blog\routes\web.php,覆盖之。

打开浏览器。输入 localhost

自行点击 测试redis安装，和mysql安装。
如果成功，会各自显示安装成功的字样。

## 退出容器。
如不想使用了，进入build目录，执行down 命令。
每次关电脑前最好关闭容器。

## mysql 的数据存放
其中mysql的数据都保存在windows上，就算容器关闭，下次再打开，数据依然保留。

## nginx 的配置修改。
修改 nginx_config 里的配置文件后，只需进入容器，systemctl restart nginx ，即可生效。

## 共享目录
其实可以事先在docker Desktop里设置共享目录，只需设置 d:\centos8 即可，不设置也没关系，弹窗同意也行。

## 常用命令
build是日常维护目录，进入此目录可以执行以下命令。

~~~
build 构建镜像
remove 删除镜像
up 启动容器（会自动创建）
down 关闭容器
exec 进入容器
按住CTRL+d 可以退出容器。
~~~





