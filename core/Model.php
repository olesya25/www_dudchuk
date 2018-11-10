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
        foreach ($resultQuery as $res){
            $obj = new $this->modelName($this->table);
            foreach ($res as $key => $value){
                $obj->key = $value;

            }
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

    public function update($id, $name_id, $field){
        if(empty($field) || $id == ''){
            return false;
        }else{
            return $this->db->update($this->table, $name_id, $id,$field);
        }
    }

    public function delete($name_id, $id = ''){
        if($id == '' && $this->id == ''){
            return false;
        }
        if($id == ''){
            $id = $this->id;
        }
        if($this->delete){
            return $this->update($id, $name_id, ['deleted' => 1]);
        }

        return $this->db->delete($this->table, $name_id, $id);

    }

    public function findFirst($params=[]){
        $resultQuery = $this->db->findFirst($this->table, $params);
        $result = new $this->modelName($this->table);
        foreach($resultQuery as $key => $value){
            $result->key = $value;
        }
        return $result;

    }
    public function findById($id){
        return $this->findFirst(['condotion'=>"id = ?", 'bind' => [$id]]);
    }

    public function query($sql, $bind=[]){
        $this->db->query($sql,$bind);
    }

    public function save($nameId){
        $fields = [];
        foreach ($this->columnNames as $columnName) {
            $fields[$columnName] = $this->$columnName;
        }
        if(property_exists($this, 'id') && $this->id != ''){
            return $this->update($this->id, $nameId, $fields);
        }else{
            return $this->insert($fields);
        }
    }

    public function assign($params){
        if(empty($params)){
            foreach ($params as $key => $value){
                if(in_array($key, $this->columnNames)){
                    $this->$key = sanit($value);
                }
            }
            return true;
        }
        return false;
    }


}