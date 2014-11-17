<?php
namespace front;
use \Flight;

class UserController extends BaseController {

    public static function login() {
        $res = Flight::controller("api/Token")->check(Flight::request()->data);
        if($res["status"]) {
            Flight::redirect("/");
        }

        if(Flight::request()->method == "POST") {
            $res = Flight::controller("api/Token")->auth(Flight::request()->data);
            if($res["status"]) {
                setcookie(
                    Flight::model("Token")->getName(),
                    $res["data"]["token"],
                    $res["data"]["create_time"]+$res["data"]["expires"],
                    "/"
                );
            }
            Flight::json($res);
        } else {
            Flight::render("front/UserLogin");
        }
    }

    public static function logout() {
        $res = Flight::controller("api/Token")->revoke(Flight::request()->data);
        if(Flight::request()->method == "POST") {
            if($res["status"]) {
                setcookie(
                    Flight::model("Token")->getName(),
                    $res["data"]["token"],
                    time()-3600*24,
                    "/"
                );
            }
            Flight::json($res);
        }
    }
}

