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
     $validation->check($_POST, [
         'username' => [
             'display' => "Username",
             'required' => true
         ],
         'password' => [
             'display' => "Password",
             'required' => true,
             'min' => 6
         ]
     ]);
        //dump_die($validation->passed());
        if($validation->passed()){

            $user = new Users($_POST['username']);
            $user->findByUsername($_POST['username']);
        //$user = $this->UsersModel->findByUserName($_POST['username']);
        //dump_die($user);
            //if($user->id != NULL){
                if($user && password_verify(Input::get('password'), $user->u_password)){

                    $remember = false;
                    if(isset($_POST['remember_me']) && Input::get('remember_me')){
                        $remember = true;
                    }

                    $user->login($remember);
                    Router::redirect('home');
                }else{
                    $validation->addError("Incorrect username or password.");
                }

            //}

        }

    }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/login');
    }


    public function logoutAction(){
        if(currentUser()){
            currentUser()->logout();
        }
        Router::redirect( 'register/login');
    }

    public function registerAction(){
        $validation = new Validate();
        $postedValues = ['u_name'=> '', 'u_surname' => '', 'u_email'=> '', 'u_username' =>'','u_password'=>'', 'confirm' =>''];
        if($_POST){
            $postedValues = postedValues($_POST);
            $validation->check($_POST, [
                'u_name'=> [
                    'display' => 'First Name',
                    'required' => true,

                ],
                'u_surname' => [
                    'display' => 'Last Name',
                    'required' => true,
                ],
                'u_email' =>[
                    'display' => 'Email',
                    'required' => true,
                    'unique' => 'users',
                    'valid_email' => true
                ],
                'u_username' =>[
                    'display' => 'Username',
                    'required' => true,
                    'unique'=>'users',
                    'min' => 6,
                    'max' => 100
                ],
                'u_password' =>[
                    'display' => 'Password',
                    'required' => true,
                    'min' => 6
                ],
                'confirm' =>[
                    'display' => 'Confrim Password',
                    'required' => true,
                    'matches' => 'u_password'
                ]
            ]);
            if($validation->passed()){
                $newUser = new Users();

                $newUser->registerNewUser($_POST);
                //dump_die($newUser);
                //$newUser->login();
                Router::redirect('register/login');

            }
        }

        $this->view->post = $postedValues;
        $this->view->displayErrors = $validation->displayErrors();

        $this->view->render('register/register');
    }

}