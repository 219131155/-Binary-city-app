<?php
$controller = $_GET['controller'] ?? 'client';
$action = $_GET['action'] ?? 'index';

//echo "DEBUG: Controller = $controller, Action = $action<br>";

switch ($controller) {
    case 'client':
        require_once __DIR__ . '/../controllers/ClientController.php';
        $clientController = new ClientController();
        $handler = $clientController;
        break;

    case 'contact':
        require_once __DIR__ . '/../controllers/ContactController.php';
        $contactController = new ContactController();
        $handler = $contactController;
        break;

    case 'link':
        require_once __DIR__ . '/../controllers/LinkController.php';
        $linkController = new LinkController();
        $handler = $linkController;
        break;

    default:
        echo "❌ Error: Controller '$controller' not recognized.";
        exit;
}

if (method_exists($handler, $action)) {
    $handler->$action();
} else {
    echo "❌ Error: Action '$action' not found in controller '$controller'.";
}

