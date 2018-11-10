<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 16:18
 */

class Session
{
    public static function exist($name){
        if(isset($_SESSION[$name])){
            return true;
        }else{
            return false;
        }
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public static function set($name, $value){
        return $_SESSION[$name] = $value;
    }

    public static function delete($name){
        if(self::exist($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function uagent_no_version(){
        $uagent =  $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $newUserAgnet = preg_replace($regx,'', $uagent);
        return $newUserAgnet;
    }

}