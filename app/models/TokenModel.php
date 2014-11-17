<?php
class TokenModel extends Model {

    protected $_name;
    protected $_expires;
    protected $_cache;

    public function __construct() {
        $this->_name = "token";
        $this->_expires = 3600*24*30;
        $this->_path = "token";
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function getName() {
        return $this->_name;
    }

    public function setExpires($expires) {
        $this->_expires = $expires;
    }

    public function getExpires() {
        return $this->_expires;
    }

    public function setCache($cache) {
        $this->_cache = $cache;
    }

    public function getCache() {
        return $this->_cache;
    }

    public function get($token) {
        // $token = isset($_REQUEST[$this->_name]) ? $_REQUEST[$this->_name] : "";
        return $this->_cache->fetch($token);
    }

    public function add($token, $id) {
        $data = array(
            "token" => $token,
            "create_time" => time(),
            "update_time" => time(),
            "expires" => $this->_expires,
            "id" => $id
        );

        if($this->_cache->save($token, $data, $data["expires"])) {
            return $data;
        } else {
            return FALSE;
        }
    }

    public function del($token) {
        return $this->_cache->delete($token);
    }

    public function setUpdateTime($token) {
        $res = $this->_cache->fetch($token);
        if(!$res) {
            return FALSE;
        }

        return $this->_cache->save($token, array(
            "id" => $id,
            "create_time" => $res["create_time"],
            "update_time" => time(),
            "expires" => $res["expires"]
        ), $res["create_time"]+$res["expires"]-time());
    }

    public function build($id = "") {
        $rand_str = "";
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890~!@#$%^&*()-_=+:;\"'|\\<,>.?/";
        $rand_len = 16;
        for($i = 0; $i < $rand_len; $i++) {
            $k = rand(0,100)%strlen($chars);
            $rand_str .= $chars[$k];
        }
        return md5(md5($id.microtime().$rand_str).$rand_str);
    }
}

