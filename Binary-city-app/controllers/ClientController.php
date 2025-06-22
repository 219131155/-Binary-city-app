<?php
// Load the client model
require_once __DIR__ . '/../models/Client.php';

class ClientController {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new Client(); // Load model
    }

    // Show all clients
    public function index() {
        $clients = $this->clientModel->getAll();
        include __DIR__ . '/../views/clients/index.php';
    }

    // Show the client creation form
    public function createForm() {
        $error = null;
        include __DIR__ . '/../views/clients/form.php';
    }

    // Handle form submission and client creation
    public function create() {
        $name = $_POST['name'] ?? '';
        $error = null;

        if (empty($name)) {
            $error = "Name is required.";
            include __DIR__ . '/../views/clients/form.php';
            return;
        }

        // ✅ Generate a client code from the name
        $code = $this->clientModel->generateClientCode($name);

        // ✅ Create the client record
        $this->clientModel->create($name, $code);

        // ✅ Redirect to the index page
        header('Location: index.php?controller=client&action=index');
        exit;
    }
}
