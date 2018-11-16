<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 15/11/2018
 * Time: 11:30
 */

class UserSession extends Model{

    public function __construct(){
        $table = 'user_session';
        parent::__construct($table);
    }

    public static function getFromCookie(){
        $userSession = new self();
        if(Cookie::exist(REMEMBER_ME_COOKIE_NAME)){

            $userSession = $userSession->findFirst([
                'condition' => 'user_agent = ? AND session = ?',
                'bind' => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
            ]);
        }
        if(!$userSession){
            return false;
        }
        return $userSession;


    }

}