<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 16/11/2018
 * Time: 13:45
 */

class Drill extends Model
{
public function __construct(){
    $table = 'drill';
    parent::__construct($table);
}

}