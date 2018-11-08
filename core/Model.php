<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 08/11/2018
 * Time: 22:55
 */

class Model{
    protected $db, $table, $modelName, $delete = false, $columnNames =[];
    public $id;

    public function __construct($table){
        $this->db = DB::getInstance();
        $this->table = $table;
        $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
    }


    protected function setTableColumns(){
        $columns = $this->getColumns();
        foreach ($columns as $column){
            $this->columnNames[] = $column->Field;
            $this->{$columnName} = null;
        }
    }

    public function getColumns(){
        return $this->db->getColumns($this->table);
    }

    public function find($params =[]){
        $result = [];
        $resultQuery = $this->db->find($this->table, $params);
    }


}