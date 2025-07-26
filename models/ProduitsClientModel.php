<?php
require_once __DIR__ . '/Database.php';

class ProduitsClientModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM produits";
        $result = mysqli_query($this->db->conn, $sql);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM produits WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
}