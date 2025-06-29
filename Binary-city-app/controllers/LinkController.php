<?php
require_once __DIR__ . '/../models/Link.php';

class LinkController {
    private $linkModel;

    public function __construct() {
        $this->linkModel = new Link();
    }

    public function form(): void {
        $clients = $this->linkModel->getClients();
        $contacts = $this->linkModel->getContacts();
        $message = null;
        include __DIR__ . '/../views/links/link.php';
    }

    public function submit(): void {
        $clientId = $_POST['client_id'] ?? null;
        $contactId = $_POST['contact_id'] ?? null;
        $message = null;

        if ($clientId && $contactId) {
            $this->linkModel->link((int)$clientId, (int)$contactId);
            $message = "Contact linked to client successfully.";
        } else {
            $message = "Please select both a client and contact.";
        }

        $clients = $this->linkModel->getClients();
        $contacts = $this->linkModel->getContacts();
        include __DIR__ . '/../views/links/link.php';
    }
}

