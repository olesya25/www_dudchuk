<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 16:19
 */

class Cookie{
    public static function set($name, $value, $expire){
        if(setcookie($name, $value, time() + $expire, '/')){
            return true;
        }else{
            return false;
        }
    }
    public static function  delete($name){
        self::set($name, '', time() -1);

    }

    public static function get($name){
        return $_COOKIE[$name];
    }
    public static function exist($name){
        if(isset($_COOKIE[$name])){
            return true;
        }else{
            return false;
        }
    }

}