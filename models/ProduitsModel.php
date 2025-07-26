<?php
require_once __DIR__ . '/Database.php';

class ProduitsModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    // Get all products
    public function getAll() {
        $sql = "SELECT * FROM produits";
        $result = mysqli_query($this->db->conn, $sql);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    // Get single product
    public function getById($id) {
        $sql = "SELECT * FROM produits WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Create product
    public function create($data, $imagePath) {
        $sql = "INSERT INTO produits (libelle, quantite_stock, prix_unitaire, quantite_seuil, image) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sddis",
            $data['libelle'],
            $data['quantite_stock'],
            $data['prix_unitaire'],
            $data['quantite_seuil'],
            $imagePath
        );
        return mysqli_stmt_execute($stmt);
    }

    // Update product
    public function update($id, $data) {
        $sql = "UPDATE produits SET 
                libelle = ?,
                quantite_stock = ?,
                prix_unitaire = ?,
                quantite_seuil = ?,
                image = ?
                WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "sddisi",
            $data['libelle'],
            $data['quantite_stock'],
            $data['prix_unitaire'],
            $data['quantite_seuil'],
            $data['image'],
            $id
        );
        return mysqli_stmt_execute($stmt);
    }

    // Delete product
    public function delete($id) {
        $sql = "DELETE FROM produits WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    // Handle file upload
    public function uploadImage($file) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = $upload_dir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $destination;
        }
        return false;
    }
}