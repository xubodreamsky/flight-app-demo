<?php
/**
 * Demo Application
 */

define("START_TIME", microtime());
define("APP_PATH", dirname(__DIR__)."/app");

require __DIR__."/../vendor/autoload.php";

Flight::set(require APP_PATH."/config/global.php");
Flight::path(Flight::get("flight.controllers.path"));
Flight::path(Flight::get("flight.models.path"));
Flight::path(Flight::get("flight.libs.path"));

Flight::route("/", array("\\front\\MainController", "_index"));
Flight::route("/api/v1/token/auth", array("\\api\\TokenController", "_auth"));
Flight::route("/api/v1/token/refresh", array("\\api\\TokenController", "_refresh"));
Flight::route("/api/v1/token/check", array("\\api\\TokenController", "_check"));
Flight::route("/api/v1/token/revoke", array("\\api\\TokenController", "_revoke"));
Flight::route("/user/login", array("\\front\\UserController", "_login"));
Flight::route("/user/logout", array("\\front\\UserController", "_logout"));

Flight::before("start", array("\\Controller", "init"));
Flight::start();

