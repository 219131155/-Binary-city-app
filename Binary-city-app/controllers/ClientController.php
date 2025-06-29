<?php
// Load the Client model so we can access database logic
require_once __DIR__ . '/../models/Client.php';

class ClientController {
    private $clientModel;

    // Constructor: instantiate the model when the controller is created
    public function __construct() {
        $this->clientModel = new Client();
    }

    // Action: Display the list of all clients
    public function index() {
        // Get all clients from the model
        $clients = $this->clientModel->getAll();

        // Include the view file to show the client list
        include __DIR__ . '/../views/clients/index.php';
    }

    // Action: Show the form to create a new client
    public function createForm() {
        $error = null; // For form error handling
        include __DIR__ . '/../views/clients/form.php';
    }

    // Action: Process the submitted form to create a new client
    public function create() {
        // Get the client name from POST request
        $name = trim($_POST['name'] ?? '');
        $error = null;

        // Simple validation
        if (empty($name)) {
            $error = "Name is required.";
            include __DIR__ . '/../views/clients/form.php';
            return;
        }

        // Generate a unique client code based on the name
        $code = $this->clientModel->generateClientCode($name);

        // Call model method to insert the new client
        $this->clientModel->create($name, $code);

        // Redirect back to the index page to show updated list
        header('Location: index.php?controller=client&action=index');
        exit;
    }
}
