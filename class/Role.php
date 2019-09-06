<?php

class Role
{
    const ROLE_TEACHER = 2;
    const ROLE_ADMIN   = 1;
    const TABLE_NAME   = 'roles';

    public $roleID;
    public $roleName;

    public static function loadArray(array $ids = null)
    {
        if (!empty($ids)) {
            $returnData = [];
            foreach ($ids as $id) {
                $Object = self::Load($id);
                if ($Object) {
                    $returnData[$id] = $Object;
                }
            }
            return $returnData;
        } else {
            $sql    = "SELECT id FROM ".self::TABLE_NAME;
             $data   = Dbcon::execute($sql);
            $result = Dbcon::fetch_all_assoc($data);
            $return = [];
            foreach ($result as $key => $value) {
                $return[$value['id']] = self::load($value['id']);
            }
            return $return;
        }
    }

    public static function Load($id)
    {
        $sql    = "SELECT * FROM ".self::TABLE_NAME." WHERE id=".$id;
        $result = Dbcon::execute($sql);
        $data   = DBcon::fetch_assoc($result);
        if (!empty($data)) {
            $new = new self();
            $new->setRoleID($data['id']);
            $new->setRoleName($data['role_name']);
            return $new;
        } else {
            return false;
        }
    }

    public function getRoleID()
    {
        return $this->roleID;
    }

    public function setRoleID($id)
    {
        $this->roleID = $id;
    }

    public function getRoleName()
    {
        return $this->roleName;
    }

    public function setRoleName($name)
    {
        $this->roleName = $name;
    }
}