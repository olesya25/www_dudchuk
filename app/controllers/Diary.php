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

        $drills = new Drill();
        $drill_training = new DrillTraining();
        $drillsContent = $drills->showAll();
        $drillsArray [] = $drillsContent[0]->getResult();
        $chosenDrills = array();
        $x = 0;
        foreach($drillsArray as $key => $value){
            foreach ($value as $k => $v){
                //dump_die($value);

         if(isset($_POST['tr'.$v->id])){
             array_push($chosenDrills,$_POST['tr'.$v->id] );
//$x++;
                //echo 'Hi';


         }



            }}
        dump_die($chosenDrills);
        $this->view->render('diary/createtraining');
    }

    public function drillsAction(){


        $this->view->render('diary/drills');
    }

    public function Action(){
        $this->view->render('diary/category');
    }

}