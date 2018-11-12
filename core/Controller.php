<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 22:54
 */

class Controller extends Application {

    protected $controller, $action;
    public $view;


    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View();

    }

    protected function load_model($model){
        if(class_exists($model)){
            $this->{$model.'Model'} = new $model(strtolower($model));

        }
    }

}