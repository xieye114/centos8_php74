FROM centos:8

ENV TZ Asia/Shanghai

WORKDIR /root

RUN curl -o /etc/yum.repos.d/CentOS-Base.repo https://mirrors.aliyun.com/repo/Centos-8.repo \
    && rm -f  /etc/yum.repos.d/CentOS-centosplus.repo \
    && rm -f  /etc/yum.repos.d/CentOS-PowerTools.repo \
    && rm -f  /etc/yum.repos.d/CentOS-Extras.repo \
    && rm -f  /etc/yum.repos.d/CentOS-AppStream.repo \
    && dnf makecache \
	&& dnf install -y epel-release \
    && sed -i 's|^#baseurl=https://download.fedoraproject.org/pub|baseurl=https://mirrors.aliyun.com|' /etc/yum.repos.d/epel* \
    && sed -i 's|^metalink|#metalink|' /etc/yum.repos.d/epel* \
    && dnf makecache \
    && dnf install -y https://mirrors.aliyun.com/remi/enterprise/remi-release-8.rpm \
    && sed -i  's/https*:\/\/rpms.remirepo.net/https:\/\/mirrors.aliyun.com\/remi/g'  /etc/yum.repos.d/remi* \
    && sed -i 's/#baseurl/baseurl/g' /etc/yum.repos.d/remi* \
	&& sed -i 's|^mirrorlist|#mirrorlist|' /etc/yum.repos.d/remi* \
    && dnf makecache \
	&& dnf install -y yum-utils \
    && dnf install -y php74 php74-php-devel  php74-php-fpm  php74-php-mbstring php74-php-memcache \
	&& dnf install -y php74-php-memcached php74-php-redis  php74-php-mysqlnd  php74-php-pdo  php74-php-bcmath php74-php-xml \
	&& dnf install -y php74-php-gd php74-php-gmp php74-php-igbinary php74-php-imagick   php74-php-mcrypt  php74-php-pdo_mysql \
	&& dnf install -y php74-php-posix php74-php-simplexml  php74-php-opcache php74-php-xsl php74-php-xmlwriter php74-php-xmlreader php74-php-swoole \
	&& dnf install -y php74-php-zip php74-php-phalcon  php74-php-yaml php74-php-yar php74-php-yaf php74-php-uuid

RUN ln -s /usr/bin/php74 /usr/bin/php \
    && curl -o /usr/local/bin/composer https://mirrors.aliyun.com/composer/composer.phar \
    && chmod +x /usr/local/bin/composer \
	&& composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
	&& echo $'[nginx-stable] \n\
name=nginx stable repo \n\
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/ \n\
gpgcheck=1 \n\
enabled=1 \n\
gpgkey=https://nginx.org/keys/nginx_signing.key \n\
module_hotfixes=true \n'\
      > /etc/yum.repos.d/nginx.repo \
    && dnf makecache \
	&& dnf install -y nginx \
    && systemctl enable nginx \
	&& systemctl enable php74-php-fpm \
	&& sed -i 's/user\ =\ apache/user\ =\ nginx/g' /etc/opt/remi/php74/php-fpm.d/www.conf \  
    && sed -i 's/group\ =\ apache/group\ =\ nginx/g' /etc/opt/remi/php74/php-fpm.d/www.conf  \
	&& sed -i 's/listen\ =\ \/var\/opt\/remi\/php74\/run\/php-fpm\/www.sock/listen=9000/g' /etc/opt/remi/php74/php-fpm.d/www.conf \
    && dnf install -y  wget vim redis zip unzip p7zip rsync crontabs supervisor net-tools python3	\
	&& systemctl enable redis

RUN ln -fs /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone \
	&& dnf install -y  langpacks-zh_CN \
	&& sed -i 's/en_US/zh_CN/g' /etc/locale.conf \
    && dnf install -y @mysql \
    && sed -i 's/\/var\/lib\/mysql\/mysql.sock/\/tmp\/mysql.sock/g' /etc/my.cnf.d/mysql-server.cnf \
    && sed -i 's/[client]/[client]\\n\/socket=\/tmp\/mysql.sock/g' /etc/my.cnf.d/client.cnf \
    && systemctl enable mysqld

	

CMD "/usr/sbin/init"
