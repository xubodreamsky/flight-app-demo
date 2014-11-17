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

* 初始化第三方库：`cd [app-root-dir] && composer install`
* 导入数据到mysql数据库：`shell/demo.sql`
* 修改`app/storage`目录权限为`0777`
* 配置ngnix/apache，请参考官网安装说明：<http://flightphp.com/install>

## nginx配置示例

```
server {
    listen 80;
    root /var/www/flight-app-demo/public;
    index index.php index.html index.htm;
    error_log off;
    access_log off;

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

