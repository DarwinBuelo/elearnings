<?php

class FileManager
{
    const TABLE_NAME = 'uploaded_file';

    protected $uploadedFileID;
    protected $fileName;
    protected $type;
    protected $dateAdded;

    function __construct($fileName,$type){
        $data = ['name'=>$fileName, 'type'=>$type];
        $id  = DBcon::insert(static::TABLE_NAME,$data);
        if($id){
            $this->setUploadedFileID($id);
            $this->setName($fileName);
            $this->setType($type);
            $this->setDateAdded(date('Y-m-d H:i:s'));
        }
        
    }

    public static function LoadArray(array $fileIDs = null)
    {
        if (!empty($fileIDs)) {
            $sql = "SELECT * FROM ".self::TABLE_NAME." WHERE id IN (".implode(',', $fileIDs).")";
        } else {
            $sql = "SELECT * FROM ".self::TABLE_NAME;
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
            $return[$item['uploaded_file_id']] = $new;
        }
        return $return;
    }

    public static function Load($id)
    {
        return static::LoadArray([$id])[0];
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
}