<?php

class FileManager
{
    const TABLE_NAME = 'uploaded_file';

    protected $uploadedFileID;
    protected $fileName;
    protected $type;
    protected $dateAdded;
    protected $ownerID;
    protected $User;

    function __construct()
    {
        $this->User = unserialize($_SESSION['user']);
    }

    public static function CreateFile($fileName, $type)
    {
        $user = unserialize($_SESSION['user']);
        $data = ['name' => $fileName, 'type' => $type,'owner_id' => $user->getID()];
        $id = DBcon::insert(self::TABLE_NAME, $data);
        if ($id) {
            $new = new static();
            $new->setUploadedFileID($id);
            $new->setName($fileName);
            $new->setType($type);
            $new->setDateAdded(date('Y-m-d H:i:s'));
            $new->setOwnerID($user->getID());
            return $new;
        }
        return false;
    }


    public static function LoadArray(array $fileIDs = null)
    {
        if (!empty($fileIDs)) {
            $sql = "SELECT * FROM " . self::TABLE_NAME . " WHERE uploaded_file_id IN (" . implode(',', $fileIDs) . ")";
        } else {
            $sql = "SELECT * FROM " . self::TABLE_NAME ." WHERE owner_id " ;
        }

        $result = DBcon::execute($sql);
        $data = DBcon::fetch_all_assoc($result);
        $return = [];
        foreach ($data as $item) {
            $new = new static();
            $new->setUploadedFileID($item['uploaded_file_id']);
            $new->setName($item['name']);
            $new->setType($item['type']);
            $new->setDateAdded($item['date_added']);
            $new->setOwnerID($item['owner_id']);
            $return[$item['uploaded_file_id']] = $new;
        }
        return $return;
    }

    public function getOwnersName(){
        $sql = "SELECT 
                    name,
                    surname,
                    middlename
                FROM
                    users
                WHERE
                    id = " .$this->getOwnerID();
        $result = DBcon::execute($sql);
        $data =  Dbcon::fetch_assoc($result);
        return ucfirst($data['name']) ." ".ucfirst($data['surname']);
    }

    public static function Load($id)
    {
        return static::LoadArray([$id])[$id];
    }

    public function setUploadedFileID($id)
    {
        $this->uploadedFileID = $id;
    }

    public function getUploadedFileID()
    {
        return $this->uploadedFileID;
    }

    public function setName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getName()
    {
        return $this->fileName;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    protected function setDateAdded($date)
    {
        $this->dateAdded = $date;
    }

    public function getDateAdded()
    {
        return $this->getDateAdded;
    }


    public function setOwnerID($id)
    {
        $this->ownerID = $id;
    }

    public function getOwnerID()
    {
        return $this->ownerID;
    }


}