<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "nsa";
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

        if (!$this->conn) {
            die("Connexion échouée : " . mysqli_connect_error());
        }
    }
}
?>
