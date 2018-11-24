<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 20/11/2018
 * Time: 14:12
 */

class TrainingDrill extends Model{
    public function __construct(){
        $table = 'training_drill';
        parent::__construct($table);
    }

    public function addDrill($params){
        $this->assign($params);
        $this->save();

    }

    public function showDrill($trainingId){
        $drill = $this->find(['condition'=>'fk_training_id = ?', 'bind' => [$trainingId]]);
        $count = count($drill);
        $arrayDrill = array();
        for($i = 0; $i < $count; $i++){
            $arrayDrill[] = array(
                'title' => htmlspecialchars($drill[$i]->training_drill_description),
                'drill_id' => $drill[$i]->fk_drill_id,
            );
        }
        return $arrayDrill;
    }

}