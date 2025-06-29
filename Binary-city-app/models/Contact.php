<?php
require_once __DIR__ . '/../config/db.php';

class Contact {
    private $conn;

    // Constructor connects to the database
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * Fetch all contacts with their linked client's name
     * This uses a LEFT JOIN to include contacts even if client is missing (optional)
     */
    public function getAll() {
        $stmt = $this->conn->query("
            SELECT c.*, cl.name AS client_name
            FROM contacts c
            LEFT JOIN clients cl ON c.client_id = cl.id
            ORDER BY c.surname ASC, c.name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new contact with client linkage
     * @param string $name       Contact first name
     * @param string $surname    Contact surname
     * @param string $email      Contact email (must be unique)
     * @param int $clientId      ID of the client the contact belongs to
     */
    public function create($name, $surname, $email, $clientId) {
        $stmt = $this->conn->prepare("
            INSERT INTO contacts (name, surname, email, client_id)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$name, $surname, $email, $clientId]);
    }

    /**
     * Check if a contact email is unique (not already in use)
     * @param string $email
     * @return bool
     */
    public function isEmailUnique($email) {
        $stmt = $this->conn->prepare("SELECT id FROM contacts WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() === 0;
    }
}

