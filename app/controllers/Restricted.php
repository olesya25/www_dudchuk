<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 15/11/2018
 * Time: 20:58
 */

class Restricted extends Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){

        $this->view->render('restricted/index');
    }


}