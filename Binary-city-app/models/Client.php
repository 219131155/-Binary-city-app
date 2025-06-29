<?php
// Include the database configuration class
require_once __DIR__ . '/../config/db.php';

class Client {
    // Property to hold the database connection
    private $conn;

    // Constructor: Establish database connection
    public function __construct() {
        $db = new Database();           // Create a new instance of the Database class
        $this->conn = $db->connect();   // Get the PDO connection using connect()
    }

    // Get all clients with number of linked contacts
    public function getAll() {
        $stmt = $this->conn->query("
            SELECT c.*, 
                (SELECT COUNT(*) 
                 FROM client_contact_links 
                 WHERE client_id = c.id) AS linked_contacts
            FROM clients c
            ORDER BY name ASC
        ");

        // Return result as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insert a new client into the database
    public function create($name, $code) {
        $stmt = $this->conn->prepare("INSERT INTO clients (name, code) VALUES (?, ?)");
        return $stmt->execute([$name, $code]); // Execute with provided values
    }

    // Generate a unique client code (e.g. ADA001, JON002)
    public function generateClientCode($name) {
        // Extract letters only and take the first 3 characters
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $name), 0, 3));

        // Ensure prefix is 3 characters long by padding with random letters if too short
        while (strlen($prefix) < 3) {
            $prefix .= chr(65 + rand(0, 25)); // Append random A-Z character
        }

        // Try codes like ADA001, ADA002, etc. until a unique one is found
        $counter = 1;
        do {
            $number = str_pad($counter, 3, '0', STR_PAD_LEFT); // Format: 001, 002, etc.
            $code = $prefix . $number;

            // Check if code already exists
            $stmt = $this->conn->prepare("SELECT id FROM clients WHERE code = ?");
            $stmt->execute([$code]);
            $exists = $stmt->rowCount() > 0;

            $counter++; // Try next number if exists
        } while ($exists);

        return $code;
    }
}

