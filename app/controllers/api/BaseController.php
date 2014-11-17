<?php
namespace api;
use \Controller;
use \Flight;
use \flight\util\Collection;

class BaseController extends Controller {

    protected function _getParams(array $args) {
        $params = isset($args[0]) ? $args[0] : null;
        if(is_array($params) || $params instanceof Collection) {
            if(is_array($params)) {
                $params = new Collection($params);
            }
            $is_return = TRUE;
            $is_valid = TRUE;
        } else {
            $params = Flight::request()->data;
            $is_return = FALSE;
            $is_valid = $this->_checkParams($params);
            if(!$is_valid) {
                $params = new Collection(array());
            }
        }

        return array($params, $is_return, $is_valid);
    }

    protected function _checkParams(Collection $params) {
        if(Flight::request()->method != "POST") {
            return FALSE;
        }
        // todo:签名检查
        return TRUE;
    }
}

