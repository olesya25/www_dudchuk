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

    /**
     * Controller constructor. Dědí od třidy Application
     * V konstruktoru se nastaví hodnoty kontrolleru a metody.
     * Vytvoří se nováinstance třidy View.
     * @param $controller   název kontrolleru
     * @param $action       název metody
     */
    public function __construct($controller, $action)
    {
        parent::__construct();
        $this->controller = $controller;
        $this->action = $action;
        $this->view = new View();

    }

}