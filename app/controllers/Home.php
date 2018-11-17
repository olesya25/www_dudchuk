<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 07/11/2018
 * Time: 15:57
 */

class Home extends Controller{


    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){
    if(currentUser()){
    $role  = currentUser()->acl();
    switch ($role){
        case 'User': Router::redirect('home/userindex');
            break;
        case 'Coach' : Router::redirect('home/coachindex');
            break;
        case 'Admin' : Router::redirect('home/adminindex');
            break;
    }
}


        $this->view->render('home/index');
    }

    /**
     * Domaci stranka pro obycejneho uzivatele
     */
    public function userindexAction(){

        $this->view->render('home/userindex');
    }
    public function coachrequestAction(){
        $validation = new Validate();

        if($validation->fileUpload()){
            $fileName = $validation->fileName;
            //dump_die($fileName);
            $this->view->displayErrors = $validation->displaySuccess();
            $user = new Users();
            $user->update(currentUser()->id, [
                'coach_permission' => '1',
                'name_of_pdf' => $fileName
            ]);
        }else{
            $this->view->displayErrors = $validation->displayErrors();
        }
        $this->view->render('home/coachrequest');
    }
    /**
     * Domaci stranka pro admina
     */
    public function adminindexAction(){
        $this->view->render('home/adminindex');
    }

    /**
     * Domaci stranka pro trenera
     */
    public function coachindexAction(){
        $this->view->render('home/coachindex');
    }



}