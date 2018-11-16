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
        $action_name = (isset($url[0]) && $url[0] != '')? $url[0] : 'index';
        array_shift($url);

        //Zkontroluju, zda controller ma dostup k metode

        $access = self::hasAccess($controller_name, $action_name);

        if(!$access){
            $controller = $controller_name = ACCESS_RESTRICTED;
            $action = 'indexAction';


        }

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
    public static function hasAccess($controller_name, $action_name = 'index'){
        $aclFile = file_get_contents(ROOT. '/app/acl.json');
        $acl = json_decode($aclFile, true);// asociativni pole
        $currentUserAcl[] = "Guest";
        $access = false;

        if(Session::exist(CURRENT_USER_SESSION_NAME)){
            $currentUserAcl[] = "LoggedIn";
                $currentUserAcl[] = currentUser()->acl();
        }

        foreach ($currentUserAcl as $levelAccess){
            if(array_key_exists($levelAccess, $acl) && array_key_exists($controller_name, $acl[$levelAccess])){
                if(in_array($action_name, $acl[$levelAccess][$controller_name]) || in_array("*", $acl[$levelAccess][$controller_name])){
                    $access = true;
                    break;
                }
            }
        }

        foreach ($currentUserAcl as $levelAccess){

           // if(array_key_exists('denied', $acl[$levelAccess])){
                //dump_die($acl);
                $denied = $acl[$levelAccess]['denied'];
                if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])){
                    $access = false;
                    break;
                }
            //}
        }

        return $access;

    }

    public static function getMenu($menu){
        //prochazi pole a subpole
        $menuArray = [];
        $menuFile = file_get_contents(ROOT. '/app/'.$menu.'.json');

        $acl = json_decode($menuFile, true);
        foreach ($acl as $key => $value){
            if(is_array($value)){
                $subMenu = [];
                foreach ($value as $k => $v){
                    if($k == 'separator' && !empty($subMenu)){
                        $subMenu[$k] = '';
                        continue;
                    }else if ($finalValue = self::get_link($v)){
                        $subMenu[$k] = $finalValue;
                    }
                }
                if(!empty($subMenu)){

                    $menuArray[$key] = $subMenu;
                }
            }else{
                if($finalValue = self::get_link($value)){
                    $menuArray[$key] = $finalValue;
                }
            }
        }

        return $menuArray;
    }

    private static function get_link($value){

        // kontroluju zda neni externi odkaz pomoci regularnich vyrazu
        if(preg_match('/https?:\/\//', $value) == 1){
            return $value;
        }else{
            $urlArray = explode('/', $value);
            $controller_name = ucwords($urlArray[0]);
            $action_name = (isset($urlArray[1]))? $urlArray[1] : '';
            //dump_die($controller_name);
            if(self::hasAccess($controller_name, $action_name)){

                return PROOT.$value;
            }
            return false;
        }
    }


}