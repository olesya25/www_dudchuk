<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 17/11/2018
 * Time: 14:55
 */

class Category extends Model {
    public function  __construct(){
        $table = 'category';
        parent::__construct($table);
}

}