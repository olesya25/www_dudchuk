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
        $validation = new Validate();
        $drill_training = new DrillTraining();
        if(isset($_POST['training'])){
            $validation->check($_POST, [
                'training_date'=> [
                    'display' => 'Date',
                    'required' => true,

                ],
                'training_notes' => [
                    'display' => 'Notes',
                    'required' => true,
                ]
            ]);
            if($validation->passed()){
                $training = new Training(currentUser()->id);
                $training_params = array();
                $training_params['training_date'] = $_POST['training_date'];
                $aim_sanitized = Input::sanitize($_POST['training_notes']);
                $training_params['training_notes'] =  $aim_sanitized;
                $training->createNewTraining($training_params);

                $drillsArray []= $_POST['drills'];
                $descriptionsArr [] = $_POST['description'];
                $temp = array();
                $nDescrp = count($descriptionsArr[0]);
                for($i = 0; $i < $nDescrp; $i++){
                    if($descriptionsArr[0][$i] != ""){
                        array_push($temp,$descriptionsArr[0][$i]);
                        continue;
                    }
                }
                if(!empty($drillsArray[0])){
                    $n = count($drillsArray[0]);
                    $training_drill_params = array();
                    for($i = 0; $i < $n; $i++){
                        $training_drill_params['training_drill_description'] = $temp[$i];
                        $training_drill_params['fk_training_id'] = $training->lastInserted;
                        $training_drill_params['fk_drill_id'] = $drillsArray[0][$i];
                        $drill_training->addDrill($training_drill_params);
                    }
                }
            }

        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('diary/createtraining');
    }


    public function drillsAction(){

   // return $putChosen;
        $this->view->render('diary/drills');
    }

    public function Action(){
        $this->view->render('diary/category');
    }

}