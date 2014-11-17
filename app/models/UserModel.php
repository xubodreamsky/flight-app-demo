<?php
class UserModel extends Model {

    protected $_table = "user";

    public function getById($id) {
        return $this->_db->get($this->_table, "*", array(
            "id" => (int)$id
        ));
    }

    public function getByEmail($email) {
        return $this->_db->get($this->_table, "*", array(
            "email" => $email
        ));
    }

    public function buildPassword($password) {
        return md5($password);
    }
}

