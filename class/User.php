<?php

class User
{
    private $id;
    private $username;
    private $name;
    private $surname;
    private $middlename;
    private $email;
    private $phone;
    private $roleID;
    private $roleName;

    /**
     * TODO :  Role name is not yet working
     */
    const TABLE_NAME = "users";

    public static function addUser($name, $surname, $username, $middlename, $email, $password, $role = 1)
    {
        $data = [
            'username' => $username,
            'name' => $name,
            'surname' => $surname,
            'middlename' => $middlename,
            'email' => $email,
            'password' => hash('sha256', $password),
            'role' => $role
        ];
        $result = Dbcon::insert('users', $data);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function login($username, $password)
    {
        $username = Dbcon::clean($username);
        $password = Dbcon::clean($password);
        $password = hash('sha256', $password);
        if (!strpos($username, '@')) {
            $sql = "
                SELECT 
                    u.id,
                    u.username,
                    u.name,
                    u.surname,
                    u.middlename,
                    u.email,
                    u.phone,
                    r.id as role_id,
                    r.role_name
                FROM
                    users as u
                LEFT JOIN
                    roles as r
                ON 
                    r.id = u.role
                WHERE
                    username = '{$username}'
                AND 
                    password = '{$password}'
            ";
        } else {
            $sql = "
                SELECT 
                    u.id,
                    u.username,
                    u.name,
                    u.surname,
                    u.middlename,
                    u.email,
                    u.phone,
                    r.id as role_id,
                    r.role_name
                FROM
                    users as u
                LEFT JOIN
                    roles as r
                ON 
                    r.id = u.role
                WHERE
                    email = '{$username}'
                AND 
                    password ='{$password}'
            ";
        }
        $data = Dbcon::execute($sql);
        $result = DBcon::fetch_assoc($data);
        if (!empty($result)) {
            $this->setID($result['id']);
            $this->setUsername($result['username']);
            $this->setName($result['name']);
            $this->setSurname($result['surname']);
            $this->setMiddlename($result['middlename']);
            $this->setEmail($result['email']);
            $this->setPhone($result['phone']);
            $this->setRoleID($result['role_id']);
            return true;
        }
    }

    public function LoadArray(array $ids = null)
    {
        if (!empty($ids)) {
            $return = [];
            foreach ($ids as $id) {
                $Object = self::load($id);
                if ($Object) {
                    $return[$id] = $Object;
                }
            }

        } else {
            $sql = "SELECT id FROM " . self::TABLE_NAME;
            $data = Dbcon::execute($sql);
            $result = Dbcon::fetch_all_assoc($data);
            $return = [];
            foreach ($result as $key => $value) {
                $return[$value['id']] = self::load($value['id']);
            }
        }

        return $return;
    }

    public static function Load($id = null)
    {
        $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE id = " . $id;
        $data = Dbcon::execute($sql);
        $returnData = Dbcon::fetch_assoc($data);
        if (!empty($returnData)) {
            $new = new static();
            $new->setID($returnData['id']);
            $new->setUsername($returnData['username']);
            $new->setName($returnData['name']);
            $new->setSurname($returnData['surname']);
            $new->setMiddlename($returnData['middlename']);
            $new->setEmail($returnData['email']);
            $new->setPhone($returnData['phone']);
            $new->setRoleID($returnData['role']);
            // Role name
            $roleObj = Role::Load($returnData['role']);
            $new->setRoleName($roleObj->getRoleName());
            return $new;
        } else {
            return false;
        }
    }

    public static function userCount($id = null)
    {
        if (empty($id)) {
            $sql = "SELECT 
                        count(*)
                    FROM
                        users";
        } else {
            $sql = "SELECT
                        *
                    FROM
                        users
                    WHERE
                        role_id = '{$id}'";
        }
        $result = DBcon::execute($sql);
        return DBcon::fetch_row($result);
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getMiddlename()
    {
        return $this->middlename;
    }

    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
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

    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }
}