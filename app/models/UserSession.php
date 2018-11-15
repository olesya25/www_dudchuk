<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 15/11/2018
 * Time: 11:30
 */

class UserSession extends Model{

    public function __construct($table){
        $table = 'user_session';
        parent::__construct($table);
    }

}