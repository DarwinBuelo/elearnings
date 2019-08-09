<?php

class Util
{

    public static function redirect($url)
    {
        header('location:'.$url);
    }

    public static function getParam($param){
        if(isset($_REQUEST[$param])){
            return $_REQUEST[$param];
        }else{
            return false;
        }
    }
}