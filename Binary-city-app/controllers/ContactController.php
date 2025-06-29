<?php
require_once __DIR__ . '/../models/Contact.php';
require_once __DIR__ . '/../models/Client.php';  // Include Client model to fetch clients

class ContactController {
    private $contactModel;
    private $clientModel;

    // Constructor initializes Contact and Client models
    public function __construct() {
        $this->contactModel = new Contact();
        $this->clientModel = new Client();
    }

    // Display list of all contacts
    public function index() {
        $contacts = $this->contactModel->getAll();  // Get all contacts from DB
        include __DIR__ . '/../views/contacts/index.php';  // Load the view to show contacts
    }

    // Show the form to create a new contact
    public function createForm() {
        $error = null;  // No error initially
        $clients = $this->clientModel->getAll();  // Fetch clients for the dropdown in the form
        include __DIR__ . '/../views/contacts/form.php';  // Load the contact creation form
    }

    // Handle form submission to create a new contact
    public function create() {
        // Retrieve form POST data, use null or empty string defaults if missing
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $email = $_POST['email'] ?? '';
        $client_id = $_POST['client_id'] ?? null;  // Get selected client ID
        $error = null;

        // Validate that all fields including client_id are provided
        if (empty($name) || empty($surname) || empty($email) || empty($client_id)) {
            $error = "All fields are required.";
            $clients = $this->clientModel->getAll();  // Reload clients for the form dropdown
            include __DIR__ . '/../views/contacts/form.php';  // Show form again with error
            return;
        }

        // Validate that the email is unique
        if (!$this->contactModel->isEmailUnique($email)) {
            $error = "Email must be unique.";
            $clients = $this->clientModel->getAll();  // Reload clients for the form dropdown
            include __DIR__ . '/../views/contacts/form.php';  // Show form again with error
            return;
        }

        // All validations passed, create the contact including the client link
        $this->contactModel->create($name, $surname, $email, $client_id);

        // Redirect to contact list page after successful creation
        header('Location: index.php?controller=contact&action=index');
        exit;
    }
}

