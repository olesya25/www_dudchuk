<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 15/11/2018
 * Time: 21:31
 */

class Role extends Model{
    public function __construct(){
        $table = 'role';
        parent::__construct($table);

    }

    public  function getRole($roleId){
        return $this->findById($roleId);
    }



}