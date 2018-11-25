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
        if($user != ''){
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

    }

    public function findByUsername($username){

         $usr = $this->findFirst(['condition' => 'u_username = ?', 'bind' => [$username]]);
         //dump_die($usr);
        return $usr;

    }
    public static function currentLoggedInUser(){
        if(!isset(self::$currentLoggedInUser) && Session::exist(CURRENT_USER_SESSION_NAME)){

                $u = new Users((int) Session::get(CURRENT_USER_SESSION_NAME));
                self::$currentLoggedInUser = $u;

        }

        return self::$currentLoggedInUser;
    }
    public static function loginFromCookie(){
        $userSession = UserSession::getFromCookie();

        if($userSession->user_id != ''){
             $user = new self((int)$userSession->user_id);
        }
        if($user){
            $user->login();
        }

        return $user;
    }

    public function registerNewUser($params){

        $params['u_registration_date'] = date("Y-m-d H:i:s");
        $params['fk_role_id'] = 2;
        $params['name_of_pdf'] = "";
        $params['message_to_admin'] = "";
        $params['coach_permission'] = 0;
        $params['u_delete'] = 0;
        //dump_die($params);
        $this->assign($params);
        $this->u_password = password_hash($this->u_password, PASSWORD_DEFAULT);

        $this->save();

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

    public function logout(){
        $userSession = UserSession::getFromCookie();
        if($userSession){
            $userSession->delete();
        }
        Session::delete(CURRENT_USER_SESSION_NAME);
        if(Cookie::exist(REMEMBER_ME_COOKIE_NAME)){
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    public function acl(){
        $role = new Role();
        $role_obj = $role->findById($this->fk_role_id);

        $acl = $role_obj->role_name;

        if (isset($acl)){
            return $acl;
        }else{
            return false;
        }

    }

    /**
     * Priradi role trenera uzivateli
     * @param $id       id uzivatele, kteromu prirazujeme role
     */
    public function assignCoach($id){
        if( $this->update($id, ['fk_role_id' => 3, 'coach_permission' => 0])){

            //dump_die($id);
            return "The role of coach was assigned";
        }else{
            return "Some error occurred";
        }
    }

    public function showAllUsers(){
       return $this->showAll();
    }




}