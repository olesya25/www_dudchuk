<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 11:34
 */

class Diary extends Controller{

public function __construct($controller, $action){
    parent::__construct($controller, $action);

}

public function mydiaryAction(){

    $this->view->render('diary/mydiary');
}
public function createAction(){
    $this->view->render('diary/create');
}
    public function createtrainingAction(){

        $this->view->render('diary/createtraining');
    }

    public function drillsAction(){


        $this->view->render('diary/drills');
    }

    public function categoryAction(){
        $this->view->render('diary/category');
    }

}