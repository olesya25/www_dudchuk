<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 22:36
 */

class Application{

    public function __construct(){
        $this->_set_report();
    }

    private function _set_report(){
        if(DEBUG){
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }else{
            error_reporting(0);
            ini_set( 'display_errors', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT . '/tmp/logs/errors.php');
        }

    }

}