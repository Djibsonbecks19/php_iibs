<?php
class Database {
    private $host = "localhost";
    private $user = "postgres";
    private $password = "sonbeckscoding"; 
    private $database = "postgres";
    private $port = 5434;
    public $conn;

    public function __construct() {
        try {
            $dsn = "pgsql:host=" . $this->host . 
                   ";port=" . $this->port . 
                   ";dbname=" . $this->database;
            
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connexion échouée : " . $e->getMessage());
        }
    }
}
