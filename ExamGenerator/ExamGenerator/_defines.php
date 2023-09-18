<?php
// =====================  Initialisation des variables globales
$env = 'test';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('VIEWS', 'views');
define('MODEL', 'models');
define('VENDOR', 'public' . DS . 'vendor');
define('CSS', 'public' . DS . 'css');
define('JS', 'public' . DS . 'js');
define('IMAGES', 'public' . DS . 'img');
define('INCLUDES', 'includes');
define('ELEVE', 3);
if ($env == 'prod') {
    define('DBHOST', '');
    define('USER', '');
    define('PWD', '');
    define('DBNAME', '');
    define('DEBUG', false);
} else {
    define('DBHOST', 'localhost');
    define('USER', 'root');
    define('PWD', ''); // A modifier en fonction de votre configuration
    define('DBNAME', 'examgenerator');
    define('DEBUG', true);
}


define('URL_BASE', 'http://' . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] == '80') ? '' : ':' . $_SERVER['SERVER_PORT']) . ((dirname($_SERVER['SCRIPT_NAME']) == DS) ? '' : dirname($_SERVER['SCRIPT_NAME'])));
