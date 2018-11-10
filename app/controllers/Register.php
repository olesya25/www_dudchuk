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
        $this->view->setLayout('default');
    }

    public function loginAction(){
        echo password_hash('password', PASSWORD_DEFAULT);
        $this->view->render('register/login');
    }

}