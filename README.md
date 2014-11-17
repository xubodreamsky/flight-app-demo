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

* 导入数据到mysql数据库：`shell/demo.sql`
* 初始化第三方库：`cd [app-root-dir] && composer install`
* 配置ngnix/apache，请参考官网安装说明：<http://flightphp.com/install>

## 授权协议

* MIT

## 联系方式

* <webin.wu@foxmail.com>

