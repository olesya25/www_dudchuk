<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 13:45
 */

class Drill extends Model{
    protected $chosenDrills = [];
    public $lastInserted;
public function __construct(){
    $table = 'drill';
    parent::__construct($table);
}
public function addNewDrill($params){
    $this->assign($params);
    $this->save();
    $this->lastInserted = $this->db->getLastId();
}

}