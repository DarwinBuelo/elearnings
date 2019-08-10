<?php

class Role
{
    public $roleID;
    public $roleName;

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