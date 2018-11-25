<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 25/11/2018
 * Time: 19:06
 */

class CategoryDrill extends Model {
    public function __construct(){
        $table = 'category_drill';
        parent::__construct($table);
    }

    public function addToCategory($params){
        $this->assign($params);
        $this->save();
    }

}