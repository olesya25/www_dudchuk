<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 20:10
 */
define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('DB_NAME', 'workout_diary');
define('HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mysql');
define('DEFAULT_CONTROLLER', 'Home'); // defaultni kontroller, pokud ten neni zadan v urrl adrese
define('PROOT', '/www_dudchuk/');
define('DEFAULT_LAYOUT', 'default'); // pokud layout neni nastaven v kontrollerru, tak pozijeme defaultni
define('DEFAULT_TITLE', 'Training dairy'); // nazev webu, pokud neni nastaveny jinak