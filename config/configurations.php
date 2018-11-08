<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 06/11/2018
 * Time: 20:10
 */
define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('DEFAULT_CONTROLLER', 'Home'); // defaultni kontroller, pokud ten neni zadan v urrl adrese
define('PROOT', '/workoutdiary/');
define('DEFAULT_LAYOUT', 'default'); // pokud layout neni nastaven v kontrollerru, tak pozijeme defaultni
define('DEFAULT_TITLE', 'Training dairy'); // nazev webu, pokud neni nastaveny jinak