<?php

class User
{
    public $id;
    public $name;
    public $lastname;
    public $username;
    public $role; // 0 for normal user and 1 for admin


    function addUser($name, $lastname, $username, $role)
    {
        //sql to add user
    }

    public function getID()
    {
        return $this->$id;
    }

    public function setID($id)
    {
        $this->$id = $id;
    }

    public function getName()
    {
        return $this->$name;
    }

    public function setName($name)
    {
        $this->$name = $name;
    }

    public function getName()
    {
        return $this->$name;
    }

    public function setName($name)
    {
        $this->$name = $name;
    }

    public function getLastName()
    {
        return $this->$lastName;
    }

    public function setLastname($lastname)
    {
        $this->$lastname = $lastname;
    }
}
