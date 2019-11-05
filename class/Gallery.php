<?php

class Gallery
{
    const TABLE_NAME = "gallery";
    
    public $imageID;
    public $filename;
    public $description;
    public $remove;
    
    
    public static function getImages(){
        $sql = 'SELECT * FROM '.self::TABLE_NAME.' where remove <> 1';
        $result = Dbcon::execute($sql);
        $data = Dbcon::fetch_all_assoc($result);
        return $data;
    }   
    
    
}
