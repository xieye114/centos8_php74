rem centos 8

set mypath=d:/centos8

set path2=d:\centos8

if exist %path2%\mysql_data (
  rem cancel
)else (
  md %path2%\mysql_data
)

docker  run  --name=cc  -tid -p 80:80 -p 3306:3306 -v %mypath%/nginx_config:/etc/nginx/conf.d  -v %mypath%/code:/code -v %mypath%/composer/cache:/root/.cache/composer -v %mypath%/composer/config:/root/.config/composer -v %mypath%/root_config/history.txt:/root/.bash_history  -v %mypath%/root_config/bashrc.txt:/root/.bashrc  -v %mypath%/mysql_data:/var/lib/mysql --privileged=true  centos:8y   /usr/sbin/init