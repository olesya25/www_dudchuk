<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 07/11/2018
 * Time: 15:57
 */

class Home  extends Controller{


    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){
        //$db = DB::getInstance();
        $this->view->render('home/index');
    }

}