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
//    /**
//     * Priradi role trenera uzivateli
//     * @param $id       id uzivatele, kteromu prirazujeme role
//     */
//    private function assignCoach($id){
//        if( $this->update($id, ['fk_role_id' => 3, 'coach_permission' => 0])){
//
//            //dump_die($id);
//            return "The role of coach was assigned";
//        }else{
//            return "Some error occurred";
//        }
//    }
    public function dashboardAction(){
        $usr = new Users();

        //echo
        //$this->view->dispaylUsers =
        $this->view->render('dashboard/dashboard');
    }

    public function assignroleAction(){
        if(isset($_POST['accept'])){
            $user = new Users();
            $user->assignCoach($_POST['accept']);
        }

        $this->view->render('dashboard/assignrole');
    }
    public function display($items = []){

    }


}