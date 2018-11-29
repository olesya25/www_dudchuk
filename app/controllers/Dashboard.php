<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 11:06
 */

class Dashboard extends Controller {

    /**
     * Dashboard constructor.
     * @param $controller
     * @param $action
     */
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    /**
     *
     */
    public function dashboardAction(){
        $this->view->render('dashboard/dashboard');
    }

    /**
     * Metoda se stará o  přiřazení role trenera uživateli
     */
    public function assignroleAction(){
        if(isset($_POST['accept'])){
            $user = new Users();
            $user->assignCoach($_POST['accept']);
        }

        $this->view->render('dashboard/assignrole');
    }

}