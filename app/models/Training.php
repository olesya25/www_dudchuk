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
        $count = count($training);
        $calendar = array();
        for($i = 0; $i < $count; $i++){
            $calendar[] = array(
                'id' => $training[$i]->id,
                'title' => htmlspecialchars($training[$i]->training_aim),
                'notes' => htmlspecialchars($training[$i]->training_notes),
                'date' => $training[$i]->training_date
            );
        }
        return $calendar;
    }
    public function createNewTraining($params){
            $params['fk_user_id'] = $this->belongsTo;
            $params['training_notes'] = "";
            //dump_die($params);
            $this->assign($params);
            $this->save();
            $this->lastInserted = $this->db->getLastId();
    }

    public function addNotes($id, $notes){
        //dump_die($notes);
        $this->update($id, ['training_notes' => $notes]);
    }

}