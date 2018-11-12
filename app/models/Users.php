<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 16:46
 */

class Users extends Model{

    private $isLoggedIn, $sessionName, $cookieName;
    public static $currentLoggedInUser;


    public function __construct($user = ''){
        $table = 'users';
        parent::__construct($table);
        $this->sessionName = CURRENT_USER_SESSION_NAME;
        $this->cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->delete = true;
        if(is_int($user)){
           $usr =  $this->db->findFirst('users', ['condition'=>'id = ?', 'bind' => [$user]]);
        }else{
            $usr = $this->db->findFirst('users',['condition' => 'u_username = ?', 'bind' => [$user]]);

        }

        if($usr){
            foreach ($usr as $key => $value){
                $this->$key = $value;
            }
        }
    }

    public function findByUsername($username){

         $usr = $this->findFirst(['condition' => 'u_username = ?', 'bind' => [$username]]);
         //dump_die($usr);

    }

    public function login($rememberMe = false){
        Session::set($this->sessionName, $this->id);
        if($rememberMe){
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->cookieName, $hash, REMEMBER_COOKIE_EXPIRE);
            $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];
            $this->db->query("DELETE FROM user_session WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
            $this->db->insert('user_session', $fields);
        }
    }



}