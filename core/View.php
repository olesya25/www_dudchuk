<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 23:01
 */

class View{
    protected $head, $body, $outputBuffer, $title = DEFAULT_TITLE, $layout = DEFAULT_LAYOUT;

    public function __construct()
    {
    }

    /**
     * Inkluduje soubor, obsahujicí view dné stránky
     * @param $viewName   cesta a nazev souboru
     */
    public function render($viewName){
        $viewArray = explode('/', $viewName);
        $viewNameString = implode(DS, $viewArray);
        if(file_exists(ROOT. '/app/views/' .$viewNameString. '.php') ){
            include (ROOT. '/app/views/'.$viewNameString. '.php');
            include (ROOT. '/app/views/layouts/' . $this->layout. '.php');

        }else{
            die('There is no such views');
        }

    }

    /**
     *
     * @param $type
     * @return bool
     */
    public function getContent($type){
        switch ($type){
            case 'head':
                return $this->head;
                break;
            case 'body':
                return $this->body;
                break;
            default:
                return false;
        }
    }

    /**
     * spustí bufferovaný vystup podle názvu
     * @param $type název
     */
    public function start($type){
        $this->outputBuffer = $type;
        ob_start();

    }

    /**
     *přeruší bufferovaný vystup
     */
    public function end(){
        switch ($this->outputBuffer){
            case 'head':
                $this->head= ob_get_clean();
                break;
            case 'body':
                $this->body = ob_get_clean();
                break;
            default:
                die('Run the start method first');
        }
    }

    /**
     * Nastaví záhlaví stranky
     * @param $title   záhlaví
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     *
     * @return string   vratí názav záhlaví
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     *  Nastaví layout
     * @param $layout
     *
     */
    public function  setLayout($layout){
        $this->layout = $layout;
    }



}