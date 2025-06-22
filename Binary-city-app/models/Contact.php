<?php
require_once __DIR__ . '/../config/db.php';

class Contact {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Fetch all contacts with linked client count
    public function getAll() {
        $stmt = $this->conn->query("
            SELECT c.*, (
                SELECT COUNT(*) FROM client_contact_links WHERE contact_id = c.id
            ) AS linked_clients
            FROM contacts c
            ORDER BY surname ASC, name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create new contact
    public function create($name, $surname, $email) {
        $stmt = $this->conn->prepare("INSERT INTO contacts (name, surname, email) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $surname, $email]);
    }

    // Check for unique email
    public function isEmailUnique($email) {
        $stmt = $this->conn->prepare("SELECT id FROM contacts WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() === 0;
    }
}
