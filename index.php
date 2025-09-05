<?php
require_once 'config/constants.php';
require_once 'config/database.php';
require_once 'utils/helpers.php';

// Activation de l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Gestion des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Démarrer la session
session_start();

// Routing basique
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Inclure le contrôleur approprié
switch ($page) {
    case 'institutes':
        require_once 'controllers/InstituteController.php';
        $controller = new InstituteController();
        break;
    case 'services':
        require_once 'controllers/ServiceController.php';
        $controller = new ServiceController();
        break;
    case 'availability':
        require_once 'controllers/AvailabilityController.php';
        $controller = new AvailabilityController();
        break;
    case 'reservations':
        require_once 'controllers/ReservationController.php';
        $controller = new ReservationController();
        break;
    default:
        // Page d'accueil
        require_once 'views/home.php';
        exit;
}

// Exécuter l'action demandée
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    http_response_code(404);
    require_once 'views/404.php';
}
?>