<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 16:18
 */

class Session
{
    /**
     * Zjistí  jestli session s daným názvem existuje
     * @param $name     název session
     * @return bool     true pokud  session s daným názvem existuje, jinak false
     */
    public static function exist($name){
        if(isset($_SESSION[$name])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Vratí session
     * @param $name      název session
     * @return mixed     Session
     */
    public static function get($name){
        return $_SESSION[$name];
    }

    /**
     * Nastaví session
     * @param $name    název session
     * @param $value   hodnota session
     * @return mixed   Session
     */
    public static function set($name, $value){
        return $_SESSION[$name] = $value;
    }

    /**
     * Smaže session
     * @param $name název session
     */
    public static function delete($name){
        if(self::exist($name)){
            unset($_SESSION[$name]);
        }
    }

    /**
     * Metodá odstraní v názvu agenta serveru verze
     * @return null|string|string[]  Vratí nazev bez uvedené verze
     */
    public static function uagent_no_version(){
        $uagent =  $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        $newUserAgnet = preg_replace($regx,'', $uagent);
        return $newUserAgnet;
    }

}