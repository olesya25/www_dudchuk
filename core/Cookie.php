<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 16:19
 */

class Cookie{
    /**
     * Statická metoda. Nastaví Cookies pro uživatele
     * @param $name   Název cooikes
     * @param $value  Hodnota cookies
     * @param $expire Čas za jak dlouho vyprší aktualně nasatvené cookies
     * @return bool   Vrací true pokud cookies se nastaví. Jinak false
     */
    public static function set($name, $value, $expire){
        if(setcookie($name, $value, time() + $expire, '/')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $name Názav cookies, které chcemé smazat
     */
    public static function  delete($name){
        self::set($name, '', time() -1);

    }

    /**
     *
     * @param $name   Názav cookies
     * @return mixed  Vrací aktualně nastavené cookies
     */
    public static function get($name){
        return $_COOKIE[$name];
    }

    /**
     * @param $name   Názav cookies
     * @return bool   Vrací true, pokud cookie s daným názvem  je nastáavený. Jinak false
     */
    public static function exist($name){
        if(isset($_COOKIE[$name])){
            return true;
        }else{
            return false;
        }
    }

}