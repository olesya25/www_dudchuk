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
    if(isset($_POST['add-notes'])){
        $training = new Training(currentUser()->id);
        $training->addNotes($_POST['add-notes'], $_POST['notes']);
        //dump_die($_POST['add-notes']);
    }

    $this->view->render('diary/mydiary');
}
public function createAction(){
    $this->view->render('diary/create');
}

    public function createtrainingAction(){
        $validation = new Validate();
        $drill_training = new TrainingDrill();
        if(isset($_POST['training'])){
            $validation->check($_POST, [
                'training_date'=> [
                    'display' => 'Date',
                    'required' => true,

                ],
                'training_aim' => [
                    'display' => 'Notes',
                    'required' => true,
                ]
            ]);
            if($validation->passed()){
                $training = new Training(currentUser()->id);
                $training_params = array();
                $training_params['training_date'] = $_POST['training_date'];
                $aim_sanitized = Input::sanitize($_POST['training_aim']);
                $training_params['training_aim'] =  $aim_sanitized;
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

        $this->view->render('diary/drills');
    }
    public function adddrillAction(){
        $validation = new Validate();
        if(isset($_POST['drill'])) {
            $validation->check($_POST, [
                'drill_name'=> [
                    'display' => 'Name',
                    'required' => true,

                ],
                'drill_description' => [
                    'display' => 'Description',
                    'required' => true,
                ],
                'drill_url' => [
                    'display' => 'Url',
                    'valid_url' => true
                ]
            ]);
            if($validation->passed()){
                $drill = new Drill();
                $drill_params = array();
                $drill_params['drill_name'] = Input::sanitize($_POST['drill_name']);
                $drill_params['drill_description'] = Input::sanitize($_POST['drill_description']);
                $drill_params['drill_url'] = Input::sanitize($_POST['drill_url']);
                $drill_params['drill_date_of_adding'] = date('Y-m-d');
                $drill_params['fk_user_id'] = currentUser()->id;
                $drill->addNewDrill($drill_params);
                $categories = $_POST['categories'];
                $categoryDrill = new CategoryDrill();
                foreach ($categories as $categoryId){
                    $categoryDrill->addToCategory(['fk_category_id' => $categoryId, 'fk_drill_id' => $drill->lastInserted]);
                }
            }


        }
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('diary/adddrill');
    }

}