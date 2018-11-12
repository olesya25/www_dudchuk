<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 09/11/2018
 * Time: 15:19
 */

class Register extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        //$this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function loginAction(){
        $validation = new Validate();

    if($_POST){
     $validation = true;
        if($validation === true){
            $user = new Users($_POST['username']);
            $user->findByUsername($_POST['username']);
        //$user = $this->UsersModel->findByUserName($_POST['username']);
        //dump_die($user);
            if($user->id != NULL){
                if($user && password_verify(Input::get('password'), $user->u_password)){

                    $remember = false;
                    if(isset($_POST['remember_me']) && Input::get('remember_me')){
                        $remember = true;
                    }

                    $user->login($remember);
                    Router::redirect('home');
                }

            }

        }

    }

        $this->view->render('register/login');
    }

}