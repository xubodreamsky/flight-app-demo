<?php
namespace front;
use \Flight;

class MainController extends BaseController {

    public function index() {
        $res = Flight::controller("api/Token")->check(Flight::request()->data);
        $user = $res["status"] ? Flight::model("User")->getById($res["data"]["id"]) : NULL;
        Flight::render("front/MainIndex", array(
            "uid" => $user ? $user["id"] : 0,
            "user" => $user
        ));
    }
}

