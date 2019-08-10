<?php

class Role
{
    public $roleID;
    public $roleName;

    public static function loadArray(){
        $sql = "SELECT
                    *
                FROM
                    roles
                " ;
        $result = DBcon::execute($sql);
        return DBcon::fetch_all_assoc($result);

    }

    public function getRoleID(){
        return $this->roleID;
    }

    public function setRoleID($id){
        $this->roleID = $id;
    }

    public function getRoleName(){
        return $this->roleName;
    }

    public function setRoleName($name){
       $this->roleName = $name;
    }
}