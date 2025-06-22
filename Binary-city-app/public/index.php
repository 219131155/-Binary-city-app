<?php
// Step 1: Get controller and action from URL query string
$controller = $_GET['controller'] ?? 'client';  // Default to 'client'
$action = $_GET['action'] ?? 'index';           // Default to 'index'

// Step 2: Debug — Show which controller/action was received
echo "DEBUG: Controller = $controller, Action = $action<br>";

// Step 3: Route to correct controller based on value of $controller
if ($controller === 'client') {
    // Include the client controller
    require_once __DIR__ . '/../controllers/ClientController.php';

    // Create a ClientController instance
    $clientController = new ClientController();

    // Call the action method if it exists
    if (method_exists($clientController, $action)) {
        $clientController->$action();
    } else {
        echo "❌ Error: Client action '$action' not found.";
    }
} elseif ($controller === 'contact') {
    // Include the contact controller
    require_once __DIR__ . '/../controllers/ContactController.php';

    // Create a ContactController instance
    $contactController = new ContactController();

    // Call the action method if it exists
    if (method_exists($contactController, $action)) {
        $contactController->$action();
    } else {
        echo "❌ Error: Contact action '$action' not found.";
    }
} else {
    echo "❌ Error: Controller '$controller' not recognized.";
}

