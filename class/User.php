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

    public static function addUser($name, $surname, $username,$middlename, $email, $password, $role = 1)
    {
        $data = [
            'username' => $username,
            'name'=> $name ,
            'surname' => $surname,
            'middlename' => $middlename,
            'email' => $email,
            'password'=>hash('sha256',$password),
            'role'=>$role
        ];
        $result =Dbcon::insert('users', $data);
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
        $password = hash('sha256',$password);
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
                    password = ('{$password}')
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
                    password = MD5('{$password}')
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
            $this->setRoleName($result['role_name']);
            return true;
        }
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($id)
    {
        $this->$id = $id;
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
