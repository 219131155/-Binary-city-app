<?php
require_once __DIR__ . '/../models/Contact.php';

class ContactController {
    private $contactModel;

    public function __construct() {
        $this->contactModel = new Contact();
    }

    public function index() {
        $contacts = $this->contactModel->getAll();
        include __DIR__ . '/../views/contacts/index.php';
    }

    public function createForm() {
        $error = null;
        include __DIR__ . '/../views/contacts/form.php';
    }

    public function create() {
        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';
        $email = $_POST['email'] ?? '';
        $error = null;

        if (empty($name) || empty($surname) || empty($email)) {
            $error = "All fields are required.";
            include __DIR__ . '/../views/contacts/form.php';
            return;
        }

        if (!$this->contactModel->isEmailUnique($email)) {
            $error = "Email must be unique.";
            include __DIR__ . '/../views/contacts/form.php';
            return;
        }

        $this->contactModel->create($name, $surname, $email);
        header('Location: index.php?controller=contact&action=index');
    }
}
