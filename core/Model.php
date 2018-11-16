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
        $this->setTableColumns();
        $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
    }


    protected function setTableColumns(){
        $columns = $this->getColumns();
        foreach ($columns as $column){
            $columnName = $column->Field;
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
        foreach ($resultQuery as $res){
            $obj = new $this->modelName($this->table);
            $obj->populateData($res);
            $result [] = $obj;
        }
        return $result;

    }
    public function insert($fields){
        if(empty($fields)){
            return false;
        }else{
            return $this->db->insert($this->table, $fields);
        }
    }

    public function update($id, $field){
        if(empty($field) || $id == ''){
            return false;
        }else{
            return $this->db->update($this->table, $id,$field);
        }
    }

    public function delete($id = ''){
        if($id == '' && $this->id == ''){
            return false;
        }
        if($id == ''){
            $id = $this->id;
        }
        if($this->delete){
            return $this->update($id,  ['deleted' => 1]);
        }

        return $this->db->delete($this->table, $id);

    }

    public function findFirst($params=[]){
        $resultQuery = $this->db->findFirst($this->table, $params);
        $result = new $this->modelName($this->table);
        if($resultQuery){
            $result->populateData($resultQuery);
        }

        return $result;

    }
    public function findById($id){
        return $this->findFirst(['condition'=>"id = ?", 'bind' => [$id]]);
    }

    public function query($sql, $bind=[]){
        $this->db->query($sql,$bind);
    }

    public function save(){
        $fields = [];
        //dump_die($fields);
        foreach ($this->columnNames as $columnName) {
            $fields[$columnName] = $this->$columnName;
        }
        if(property_exists($this, 'id') && $this->id != ''){
            return $this->update($this->id, $fields);
        }else{
            return $this->insert($fields);
        }
    }

    public function assign($params){
        if(!empty($params)){
            foreach ($params as $key => $value){
                //dump_die($this->columnNames);
                if(in_array($key, $this->columnNames)){
                    $this->$key = sanit($value);
                }
            }
            return true;
        }
        return false;
    }

    public function populateData($result){
        foreach($result as $key=>$value){
            $this->$key = $value;
        }
    }


}