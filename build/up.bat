:: centos 8 容器启动文件，需自行修改下面的mypath

set mypath=c:/yyy
docker  run  --name=cc  -tid -p 80:80 -v %mypath%/nginx_config:/etc/nginx/conf.d  -v %mypath%/code:/code -v %mypath%/composer/cache:/root/.cache/composer -v %mypath%/composer/config:/root/.config/composer -v %mypath%/root_config/history.txt:/root/.bash_history  -v %mypath%/root_config/bashrc.txt:/root/.bashrc  -v %mypath%/mysql_data:/var/lib/mysql --privileged=true  centos:8y   /usr/sbin/init