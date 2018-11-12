
<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 19:08
 */


define('ROOT', dirname(__FILE__));

include_once (ROOT . '/config/configurations.php');
include_once (ROOT . '/app/library/helpers/functions.php');


//Automaticky pozada o tridu, pokud ta existuje
function autoload($className)
{
    if (file_exists(ROOT . '/core/' . $className . '.php')) {
        require_once(ROOT . '/core/' . $className . '.php');
    } elseif (file_exists(ROOT . '/app/controllers/' . $className . '.php')) {
        require_once(ROOT . '/app/controllers/' . $className . '.php');
    } elseif (file_exists(ROOT . '/app/models/' . $className . '.php')) {
        require_once(ROOT . '/app/models/' . $className . '.php');

    }
}


spl_autoload_register('autoload');
session_start();
$url =  array();

if(isset($_SERVER['PATH_INFO'])){
    $url = explode('/', ltrim($_SERVER['PATH_INFO'], '/'));
}else{
    $url = [];
}

Router::route($url);

