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

// new DbController ();


// Récupération de la page demandée en URL
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);


// Récupération d'une action
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);


// Vérifie si une action est demandée
if(!is_null($action)) {
    // Récupère la chaine demandé et la découpe pour récupérer le controleur et la méthode
    // ex: 'user-login'
    $tabAction = explode('-',$action);
    // $tabAction[0] -> user
    // $tabAction[1] -> login

    $controller = ucfirst($tabAction[0]).'Controller';
    //loginController

    $method = $tabAction[1].'Action';
    // loginAction

    $object = new $controller();
    $resAction = $object->$method();

    if(is_array($resAction) && isset($resAction['view'])) 
    {        $page = $resAction['view'];
    }

}


// Test si une page est demandée sinon affiche la page par défaut
// Vérifie également si la vue existe
if(is_null($page) || !file_exists(PATHVIEWS.$page.'.php')) {
    $page = 'welcome';
}

// Affiche la vue
include PATHVIEWS.'page.php';
