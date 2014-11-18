Flight框架示例应用
==================

此为[Flight框架](http://flightphp.com/)示例应用，实现用户登录、退出功能。

## 目录结构说明

目录结构参考[laravel框架](http://laravel.com)，采用[composer](https://getcomposer.org/)管理第三方库。

```
/vendor             # 第三方库
/app                # 应用根目录
/app/controllers    # MVC
/app/models
/app/views
/app/libs           # 其他库
/app/storage        # 缓存,日志等数据
/app/config         # 配置文件
/public             # 网站根目录
/shell              # 工具脚本
```

## 初始化说明

```
cd /var/www
# 创建项目
git clone https://github.com/wwb-dev/flight-app-demo ./demo
cd ./demo
composer install
# 也可以用composer创建项目
# composer create-project wuwenbin/flight-app-demo ./demo dev-master
# 导入测试数据到数据库
mysql -u root -p -h localhost demo < ./shell/demo.sql
# 修改目录权限
# chmod 777 ./app/storage
```

## web服务器配置

ngnix/apache配置请参考官网安装说明：<http://flightphp.com/install>

```
# nginx配置示例
server {
    listen 80;
    root /var/www/demo;
    index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php;
    }

    location ~ \.php$ {
        fastcgi_index index.php;
        fastcgi_pass 127.0.0.1:9000;
        include fastcgi_params;
    }
}
```

## 授权协议

* MIT

## 联系方式

* <webin.wu@foxmail.com>

