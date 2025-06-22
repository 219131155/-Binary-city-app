<?php
// Include the database configuration
require_once __DIR__ . '/../config/db.php';

class Client {
    private $conn;

    // Constructor: Connect to the database
    public function __construct() {
        $db = new Database();           // Create a new Database instance
        $this->conn = $db->connect();   // Connect using the connect() method
    }

    // Fetch all clients with linked contact counts
    public function getAll() {
        $stmt = $this->conn->query("
            SELECT c.*, 
                (SELECT COUNT(*) FROM client_contact_links WHERE client_id = c.id) AS linked_contacts
            FROM clients c
            ORDER BY name ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new client record
    public function create($name, $code) {
        $stmt = $this->conn->prepare("INSERT INTO clients (name, code) VALUES (?, ?)");
        return $stmt->execute([$name, $code]);
    }

    // Generate a unique client code (e.g. ADA001)
    public function generateClientCode($name) {
        // Keep only letters and make uppercase
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $name), 0, 3));

        // Pad with random letters if name is too short
        while (strlen($prefix) < 3) {
            $prefix .= chr(65 + rand(0, 25)); // ASCII A-Z
        }

        // Start counter to find next unique code
        $counter = 1;
        do {
            $number = str_pad($counter, 3, '0', STR_PAD_LEFT);
            $code = $prefix . $number;

            // Check if code exists in database
            $stmt = $this->conn->prepare("SELECT id FROM clients WHERE code = ?");
            $stmt->execute([$code]);
            $exists = $stmt->rowCount() > 0;

            $counter++;
        } while ($exists);

        return $code;
    }
}
