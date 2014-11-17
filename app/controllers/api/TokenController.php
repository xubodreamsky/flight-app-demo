<?php
namespace api;
use \Flight;

class TokenController extends BaseController {

    public function __construct() {
        if(Flight::get("token.name")) {
            Flight::model("Token")->setName(Flight::get("token.name"));
        }

        if(Flight::get("token.expires")) {
            Flight::model("Token")->setExpires(Flight::get("token.expires"));
        }

        Flight::model("Token")->setCache(Flight::cache("session"));
    }

    public function auth() {
        list($params, $is_return, $is_valid) = $this->_getParams(func_get_args());
        if(!$is_valid) {
            return Flight::returnJson(0, "参数错误", NULL, $is_return);
        }
        if(!$params->email) {
            return Flight::returnJson(0, "邮箱不能为空", NULL, $is_return);
        }
        if(!$params->password) {
            return Flight::returnJson(0, "密码不能为空", NULL, $is_return);
        }
        $user = Flight::model("User")->getByEmail($params->email);
        if(!$user) {
            return Flight::returnJson(0, "用户不存在", NULL, $is_return);
        }
        if(Flight::model("User")->buildPassword($params->password) != $user["password"]) {
            return Flight::returnJson(0, "密码错误", NULL, $is_return);
        }

        $token = Flight::model("Token")->build($user["id"]);
        $res = Flight::model("Token")->add($token, $user["id"]);
        if(!$res) {
            return Flight::returnJson(0, "保存Token失败", NULL, $is_return);
        } else {
            return Flight::returnJson(1, "用户授权成功", $res, $is_return);
        }
    }

    public function check() {
        list($params, $is_return, $is_valid) = $this->_getParams(func_get_args());
        if(!$is_valid) {
            return Flight::returnJson(0, "参数错误", NULL, $is_return);
        }
        $name = Flight::model("Token")->getName();
        $res = Flight::model("Token")->get(isset($_REQUEST[$name]) ? $_REQUEST[$name] : "");

        if(!$res) {
            return Flight::returnJson(0, "Token不存在或已过期", NULL, $is_return);
        } else {
            return Flight::returnJson(1, "Token有效", $res, $is_return);
        }
    }

    public function refresh() {
        list($params, $is_return, $is_valid) = $this->_getParams(func_get_args());
        if(!$is_valid) {
            return Flight::returnJson(0, "参数错误", NULL, $is_return);
        }
        $res = self::get();
        if(!$res) {
            return Flight::returnJson(0, "Token不存在或已过期", NULL, $is_return);
        }

        Flight::model("Token")->del($res["token"]);
        $token = Flight::model("Token")->build($user["id"]);
        $res = Flight::model("Token")->add($token, $res["id"]);
        if(!$res) {
            return Flight::returnJson(0, "保存Token失败", NULL, $is_return);
        } else {
            return Flight::returnJson(1, "刷新Token成功", $res, $is_return);
        }
    }

    public function revoke() {
        list($params, $is_return, $is_valid) = $this->_getParams(func_get_args());
        if(!$is_valid) {
            return Flight::returnJson(0, "参数错误", NULL, $is_return);
        }
        $name = Flight::model("Token")->getName();
        $res = Flight::model("Token")->get(isset($_REQUEST[$name]) ? $_REQUEST[$name] : "");
        if(!$res) {
            return Flight::returnJson(1, "取消用户授权成功", NULL, $is_return);
        }
        if(!Flight::model("Token")->del($res["token"])) {
            return Flight::returnJson(0, "删除Token失败", NULL, $is_return);
        } else {
            return Flight::returnJson(1, "取消用户授权成功", NULL, $is_return);
        }
    }
}

