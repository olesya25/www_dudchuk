<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 20:36
 */

class Router{

    public static function route($url){

        /////////////////////CONTROLLER/////////////////////////////////////
        $controller = '';
        if(isset($url[0]) && $url[0] != ''){
            $controller = ucfirst($url[0]);

        }else{
            $controller = DEFAULT_CONTROLLER;
        }
        $controller_name = $controller;
        array_shift($url);

        ///////////////////////METODA///////////////////////////////////////
        $actoin = '';
        if(isset($url[0]) && $url[0] != ''){
            $action = $url[0] .'Action';

        }else{
            $action = 'indexAction';
        }
        $action_name = $action;
        array_shift($url);

        /////////////////////ARGUMENTY///////////////////////////////////////
        $params = $url;

        /////////////////////////////////////////////////////////////////////
        $dispatcher = new $controller($controller_name, $action);


        if(method_exists($controller, $action)){
            call_user_func_array([$dispatcher, $action], $params);
        }else{
            echo 'Method doesn\'t exist';
        }
    }
    public static function redirect($location){
        if(!headers_sent()){
            header('Location:'.PROOT.$location);
            exit();
            //presmerovani pomoci javascript
        }else{
            echo'<script type="text/javascript>">';
            echo'window.location.href="'.PROOT.$location.'";';
            echo'</script>';
            echo'<noscript>';
            echo'<meta http-equiv="refresh" content="0;url='.$location.'"/>';
            echo'</noscript>';exit;

        }
    }


}