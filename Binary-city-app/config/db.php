<?php
// Database configuration and connection class
class Database {
    private $host = 'localhost';
    private $db_name = 'binary_city';
    private $username = 'root';
    private $password = 'Tjpiko6462';
    public $conn;

    // Connect to the database using PDO
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};port=3306",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
