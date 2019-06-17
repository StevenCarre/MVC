<?php
// Utilisation variable de session
session_start();
// Chemin racine de l'application
define('PATHROOT',__DIR__);
// Détermine / ou \
define('DS', DIRECTORY_SEPARATOR);
// Constante du chemin vers les vues
define('PATHVIEWS', PATHROOT.DS.'vues'.DS);
// Constante du chemin vers les controlleurs
define('PATHCTRL', PATHROOT.DS.'controllers'.DS);
// Constante répertoire images
define('PATHUPL', PATHROOT.DS.'www'.DS.'upload'.DS);
// Constante du chemin vers mes entités
define('PATHMDL', PATHROOT.DS.'models'.DS);
// Constante du chemin vers mes entités
define('LOG_DIR', PATHROOT.DS.'logs'.DS);



function autoLoadModel($modelName) {
    if(file_exists(PATHMDL.$modelName.'.php')) {
        require_once PATHMDL.$modelName.'.php';
    }
}

function autoLoadController($controllerName) {
    if(file_exists(PATHCTRL.$controllerName.'.php')) {
        require_once PATHCTRL.$controllerName.'.php';
    }
}

spl_autoload_register('autoLoadModel');
spl_autoload_register('autoLoadController');

new DbController ();