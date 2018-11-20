<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 20/11/2018
 * Time: 14:12
 */

class DrillTraining extends Model{
    public function __construct(){
        $table = 'training_drill';
        parent::__construct($table);
    }

    public function addDrill($params){
        $this->assign($params);
        $this->save();

    }

}