<?php
require_once __DIR__ . '/../config/db.php';

class Link {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * Fetch all clients from the database.
     *
     * @return array An array of client records.
     */
    public function getClients(): array {
        $stmt = $this->conn->query("SELECT * FROM clients ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch all contacts from the database.
     *
     * @return array An array of contact records.
     */
    public function getContacts(): array {
        $stmt = $this->conn->query("SELECT * FROM contacts ORDER BY surname ASC, name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Link a contact to a client.
     *
     * @param int $clientId
     * @param int $contactId
     * @return bool
     */
    public function link(int $clientId, int $contactId): bool {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO client_contact_links (client_id, contact_id) VALUES (?, ?)");
        return $stmt->execute([$clientId, $contactId]);
    }
}

