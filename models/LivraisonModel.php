<?php
require_once __DIR__ . '/Database.php';

class LivraisonModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllLivraisons() {
        $sql = "SELECT l.id, l.commande_id, l.date_livraison, l.adresse_livraison, l.payée,
                    p.date_paiement, p.mode_paiement,
                    lv.nom AS livreur_nom, lv.prenom AS livreur_prenom, lv.telephone AS livreur_telephone,
                    c.montant_total, c.statut AS commande_statut, p.id AS paiement_id
                FROM livraisons l
                JOIN livreurs lv ON l.livreur_id = lv.id
                JOIN commandes c ON l.commande_id = c.id
                LEFT JOIN paiements p ON p.commande_id = c.id
                ORDER BY l.date_livraison DESC";
        $result = mysqli_query($this->db->conn, $sql);
        if (!$result) {
            die("Erreur lors de la récupération des livraisons : " . mysqli_error($this->db->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getLivraisonById($id) {
        $sql = "SELECT l.id, l.commande_id, l.date_livraison, l.adresse_livraison, l.payée,
                    p.date_paiement, p.mode_paiement,
                    lv.nom AS livreur_nom, lv.prenom AS livreur_prenom, lv.telephone AS livreur_telephone,
                    c.montant_total, c.statut AS commande_statut, p.id AS paiement_id
                FROM livraisons l
                JOIN livreurs lv ON l.livreur_id = lv.id
                JOIN commandes c ON l.commande_id = c.id
                LEFT JOIN paiements p ON p.commande_id = c.id
                WHERE l.id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }


    public function createLivraison($commandeId, $livreurId, $adresse, $payee) {
        $sql = "INSERT INTO livraisons (commande_id, livreur_id, date_livraison, adresse_livraison, payée)
                VALUES (?, ?, NOW(), ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "iisi", $commandeId, $livreurId, $adresse, $payee);
        return mysqli_stmt_execute($stmt);
    }


    


}