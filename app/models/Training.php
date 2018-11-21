<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 13:45
 */

class Training extends Model{
    public $belongsTo, $lastInserted;
    public function __construct($id){
        $table = 'training';
        parent::__construct($table);
        $this->belongsTo = $id;


    }

    public function getTraining(){
        $userId = $this->belongsTo;
        $training = $this->find(['condition'=>'fk_user_id = ?', 'bind' => [$userId]]);
        return $training;
    }
    public function createNewTraining($params){
            $params['fk_user_id'] = $this->belongsTo;
           // dump_die($params);
            $this->assign($params);
            $this->save();
            $this->lastInserted = $this->db->getLastId();
    }

}