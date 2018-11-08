<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 07/11/2018
 * Time: 15:57
 */

class Home  extends Controller{


    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){
        $db = DB::getInstance();
        $sql = "SELECT * FROM user";
        $test = [
            'category_name' => 'Test',
            'category_description' => 'something else else'
        ];
        $users_result = $db->find('user', [
            'condition' => "u_name = ?",
            'bind' => ['Olesya'],
            'order' => "u_name",
            'limit' => 5

        ]);
        dump_die($users_result);
        $this->view->render('home/index');
    }

}