<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 28/11/2018
 * Time: 11:38
 */

if(!empty($_GET['uploads'])){
    $fileName = basename($_GET['uploads']);

    $filePath = $_SERVER["DOCUMENT_ROOT"].'/www_dudchuk/uploads/'.$fileName;
    if(!file_exists($filePath)){
        die('File not found');
    }
    if(!empty($fileName)){
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary ");

        readfile($filePath);
        exit;
    }
}