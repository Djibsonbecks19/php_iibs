<?php
require_once __DIR__ . '/Database.php';

class PanierClientModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function addToCart($clientId, $productId, $libelle, $price, $quantity, $image) {
        $total = $price * $quantity;
        $sql = "INSERT INTO panier (product_id, libelle_produit, prix_unitaire, quantité, id_client, total, image)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "isdiids",
            $productId,
            $libelle,
            $price,
            $quantity,
            $clientId,
            $total,
            $image
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getCartItems($clientId) {
        $sql = "SELECT p.*, pr.quantite_stock 
                FROM panier p
                JOIN produits pr ON p.product_id = pr.id
                WHERE p.id_client = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        return $items;
    }

    public function getCartTotal($clientId) {
        $sql = "SELECT SUM(total) as total_panier FROM panier WHERE id_client = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row['total_panier'] ?? 0;
    }

    public function removeFromCart($itemId, $clientId) {
        $sql = "DELETE FROM panier WHERE id = ? AND id_client = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $itemId, $clientId);
        return mysqli_stmt_execute($stmt);
    }

    public function clearCart($clientId) {
        $sql = "DELETE FROM panier WHERE id_client = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        return mysqli_stmt_execute($stmt);
    }
}