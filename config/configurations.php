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
define('CURRENT_USER_SESSION_NAME', 'ffdrtsynfRRKGUbfASVCNvdj'); // nazev session pro prrihlasenych uzivatlu
define('REMEMBER_ME_COOKIE_NAME', 'fbbahcyrriyubndERTDHFhg'); // nazev cookie pro prrihlasenych uzivateli remember me
define('ACCESS_RESTRICTED', 'Restricted'); // nazev controlleru, kam se presmeruje uzivatel bez dostupu
define('WEB_NAME', 'Workout Diary');
define('REMEMBER_COOKIE_EXPIRE', 2592000); // 30 dni -2592000 sec