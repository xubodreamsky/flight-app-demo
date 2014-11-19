<?php
return array(
    "flight.controllers.path" => dirname(__DIR__)."/controllers",
    "flight.models.path" => dirname(__DIR__)."/models",
    "flight.views.path" => dirname(__DIR__)."/views",
    "flight.libs.path" => dirname(__DIR__)."/libs",
    "flight.routes" => array(
        array("/", "/front/MainController", "index"),
        array("/user/login", "/front/UserController", "login"),
        array("/user/logout", "/front/UserController", "logout"),
        array("/api/v1/token/auth", "/api/TokenController", "auth"),
        array("/api/v1/token/refresh", "/api/TokenController", "refresh"),
        array("/api/v1/token/check", "/api/TokenController", "check"),
        array("/api/v1/token/revoke", "/api/TokenController", "revoke")
    ),
    "db.host" => "localhost",
    "db.port" => 3306,
    "db.user" => "root",
    "db.pass" => "",
    "db.name" => "demo",
    "db.charset" => "utf8",
    "cache.path" => dirname(__DIR__)."/storage/cache",
    "log.path" => dirname(__DIR__)."/storage/logs"
);

