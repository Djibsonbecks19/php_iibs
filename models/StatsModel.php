<?php
require_once __DIR__ . '/Database.php';

class StatsModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getTopProducts() {
        $sql = "SELECT 
                    p.id, 
                    p.libelle, 
                    SUM(cp.quantite) AS total_commandes
                FROM produits p
                JOIN commande_produits cp ON p.id = cp.produit_id
                JOIN commandes c ON cp.commande_id = c.id
                WHERE c.statut = 'payée'
                GROUP BY p.id
                ORDER BY total_commandes DESC
                LIMIT 10";

        $result = mysqli_query($this->db->conn, $sql);
        if (!$result) {
            throw new Exception("Erreur de requête: " . mysqli_error($this->db->conn));
        }

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        return $products;
    }


    public function getMonthlyCommands() {
        $sql = "SELECT 
                DATE_FORMAT(date_commande, '%Y-%m') as month,
                COUNT(*) as command_count
                FROM commandes
                WHERE statut = 'payée'
                GROUP BY DATE_FORMAT(date_commande, '%Y-%m')
                ORDER BY month ASC";
        
        $result = mysqli_query($this->db->conn, $sql);
        if (!$result) {
            throw new Exception("Erreur de requête: " . mysqli_error($this->db->conn));
        }

        $months = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $months[] = $row;
        }
        
        return $months;
    }
}