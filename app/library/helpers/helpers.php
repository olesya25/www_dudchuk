<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 20:20
 */

function dump_die ($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function sanit($data){
    return htmlentities($data, ENT_QUOTES, 'UTF-8');
}

function currentUser(){
return Users::currentLoggedInUser();
}