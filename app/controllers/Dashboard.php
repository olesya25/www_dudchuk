<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 11:06
 */

class Dashboard extends Controller {

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function dashboardAction(){
        $usr = new Users();

        //echo
        //$this->view->dispaylUsers =
        $this->view->render('dashboard/dashboard');
    }

    public function assignroleAction(){
        $this->view->render('dashboard/assignrole');
    }
    public function display($items = []){

    }

}