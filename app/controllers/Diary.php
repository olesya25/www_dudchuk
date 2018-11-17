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
    $training = new Training(currentUser()->id);
    $userTr = $training->getTraining();

    if(!empty($userTr)){
        $userTr = $training->getTraining();

        //var_dump($userTr);
    }
    $this->view->render('diary/mydiary');
}
public function createAction(){
    $this->view->render('diary/create');
}
    public function createtrainingAction(){

        $this->view->render('diary/createtraining');
    }


}