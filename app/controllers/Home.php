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

        dump_die($_SESSION);
        //$db->update('users', 3, ['u_name'=>'Anastasia']);
        $this->view->render('home/index');
    }

}