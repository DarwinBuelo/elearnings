<?php

class Util
{

    public static function dateNow(){
        $dtz = new DateTimeZone("Asia/Hong_Kong"); //Your timezone
        $now = new DateTime(date("Y-m-d"), $dtz);
        return $now->format("Y-m-d H:i:s");
    }

    public static function redirect($url)
    {
        ob_start();
        header('Location:'.$url);
        ob_end_flush();

    }

    public static function getParam($param){
        if(isset($_REQUEST[$param])){
            return $_REQUEST[$param];
        }else{
            return false;
        }
    }

    
    public static function date($date=null){
        if(!empty($date)){
            $formated = date('m/d/Y', strtotime($date));
        }else{
            $formated = date('m/d/Y');
        }
        return $formated;
    }

    public static function debug($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}
