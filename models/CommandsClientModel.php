<?php
require_once __DIR__ . '/Database.php';

class CommandsClientModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function createOrder($clientId, $productId, $quantity, $totalAmount, $status) {
        $orderDate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO commandes (client_id, produit_id, quantite, date_commande, montant_total, statut)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "iiisds",
            $clientId,
            $productId,
            $quantity,
            $orderDate,
            $totalAmount,
            $status
        );
        return mysqli_stmt_execute($stmt);
    }

    public function getClientOrders($clientId) {
        $sql ="SELECT 
                c.id AS commande_id,
                c.date_commande,
                c.montant_total,
                c.statut,
                p.libelle AS product_name,
                cp.quantite,
                cp.prix_total
                FROM commandes c
                JOIN commande_produits cp ON cp.commande_id = c.id
                JOIN produits p ON p.id = cp.produit_id
                WHERE c.client_id = ?
                ORDER BY c.date_commande DESC
            ";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        return $orders;
    }
    public function getOrderById($orderId, $clientId) {
        $sql = "SELECT c.id AS commande_id, c.date_commande, c.statut, 
                    cp.quantite, cp.prix_total,
                    p.libelle AS product_name, p.image AS product_image,
                    u.nom AS client_nom, u.prenom AS client_prenom
                FROM commandes c
                JOIN commande_produits cp ON c.id = cp.commande_id
                JOIN produits p ON cp.produit_id = p.id
                JOIN utilisateurs u ON c.client_id = u.id
                WHERE c.id = ? AND c.client_id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $orderId, $clientId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $order = [
            'commande_id' => $orderId,
            'date_commande' => null,
            'statut' => null,
            'client_nom' => null,
            'client_prenom' => null,
            'montant_total' => null,
            'produits' => []
        ];

        while ($row = mysqli_fetch_assoc($result)) {
            $order['date_commande'] = $row['date_commande'];
            $order['statut'] = $row['statut'];
            $order['client_id'] = $clientId;
            $order['client_nom'] = $row['client_nom'];
            $order['client_prenom'] = $row['client_prenom'];
            if ($order['montant_total'] === null) {
                $order['montant_total'] = 0; 
            }
            $order['produits'][] = [
                'product_name' => $row['product_name'],
                'product_image' => $row['product_image'],
                'quantite' => $row['quantite'],
                'prix_total' => $row['prix_total'],
            ];
        }
        foreach ($order['produits'] as $prod) {
            $order['montant_total'] += $prod['prix_total'];
        }
        return $order;
    }


    public function createCommande($clientId, $total, $statut) {
        $stmt = $this->db->conn->prepare("INSERT INTO commandes (client_id, montant_total, statut, date_commande) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("ids", $clientId, $total, $statut);
        $stmt->execute();
        return $this->db->conn->insert_id; 
    }


    public function addProduitToCommande($commandeId, $produitId, $quantite, $prixTotal) {
        $stmt = $this->db->conn->prepare("INSERT INTO commande_produits (commande_id, produit_id, quantite, prix_total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $commandeId, $produitId, $quantite, $prixTotal);
        $stmt->execute();
    }


    public function getOrderItems($orderId) {
        $sql = "SELECT cp.*, p.libelle as product_name, p.image as product_image 
                FROM commande_produits cp
                JOIN produits p ON cp.produit_id = p.id
                WHERE cp.commande_id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $orderId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $items = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        return $items;
    }
}