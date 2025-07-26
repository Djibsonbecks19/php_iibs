<?php
require_once __DIR__ . '/Database.php';

class CommandsModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function getAll() {
        $sql = "SELECT cp.*, c.*, u.nom, u.prenom,
                GROUP_CONCAT(p.libelle SEPARATOR ', ') AS produits_noms,
                SUM(cp.quantite) AS total_produits,
                    SUM(cp.prix_total) AS montant_total
                FROM commandes c
                JOIN utilisateurs u ON c.client_id = u.id
                JOIN commande_produits cp ON cp.commande_id = c.id
                JOIN produits p ON cp.produit_id = p.id
                GROUP BY c.id
                ORDER BY c.date_commande DESC";
        $result = mysqli_query($this->db->conn, $sql);
        $commands = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $commands[] = $row;
        }
        return $commands;
    }

   public function getCommandeAvecDetails($orderId) {
        $sqlCommande = "SELECT c.id AS commande_id, c.client_id, c.date_commande, c.statut, c.montant_total
                        FROM commande_produits cp
                        JOIN commandes c ON cp.commande_id = c.id
                        WHERE cp.commande_id = ?
                        LIMIT 1"; 
        $stmt = mysqli_prepare($this->db->conn, $sqlCommande);
        mysqli_stmt_bind_param($stmt, "i", $orderId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $commande = mysqli_fetch_assoc($result);

        if (!$commande) {
            return null;
        }

        // Get all products from commande_produits for this commande_id
        $sqlProduits = "SELECT cp.*, p.libelle AS product_name, p.image AS product_image
                        FROM commande_produits cp
                        JOIN produits p ON cp.produit_id = p.id
                        WHERE cp.commande_id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sqlProduits);
        mysqli_stmt_bind_param($stmt, "i", $orderId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $produits = [];
        $produitsNoms = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $produits[] = $row;
            $produitsNoms[] = $row['product_name'];
        }

        $commande['produits'] = $produits;
        $commande['total_produits'] = count($produits);
        $commande['produits_noms'] = implode(', ', $produitsNoms);

        return $commande;
    }





    public function create($clientId, $productId, $quantity, $status) {
        // Get product price
        $productSql = "SELECT prix_unitaire FROM produits WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $productSql);
        mysqli_stmt_bind_param($stmt, "i", $productId);
        mysqli_stmt_execute($stmt);
        $product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        
        $totalAmount = $quantity * $product['prix_unitaire'];
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

    public function update($id, $statut) {
        $sqlC = "UPDATE commandes SET statut = ? WHERE id = ?";
        $stmtC = mysqli_prepare($this->db->conn, $sqlC);
        mysqli_stmt_bind_param($stmtC, "si",  $statut, $id);
        mysqli_stmt_execute(statement: $stmtC);

        $sql = "UPDATE commande_produits SET 
                    statut = ?
                WHERE commande_id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "si",  $statut, $id);
        return mysqli_stmt_execute(statement: $stmt);
    }



    public function delete($id) {
        $sql = "DELETE FROM commande_produits WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    public function getClients() {
        $sql = "SELECT * FROM utilisateurs WHERE role='client'";
        $result = mysqli_query($this->db->conn, $sql);
        $clients = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $clients[] = $row;
        }
        return $clients;
    }

    public function getProducts() {
        $sql = "SELECT * FROM produits";
        $result = mysqli_query($this->db->conn, $sql);
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    public static function getStatusBadgeClass($status) {
        switch (strtolower($status)) {
            case 'en attente':
                return 'warning';
            case 'payée':
                return 'success';
            case 'validée':
                return 'primary';
            case 'expédiée':
                return 'info';
            case 'livrée':
                return 'primary';
            case 'annulée':
                return 'danger';
            default:
                return 'secondary';
        }
    }

    public function getForPayment($commande_id, $client_id) {
        $commande_id = mysqli_real_escape_string($this->db->conn, $commande_id);
        $client_id = mysqli_real_escape_string($this->db->conn, $client_id);

        $sql = "SELECT *
                FROM commandes 
                WHERE id = '$commande_id' AND client_id = '$client_id' AND statut != 'payée'";
        
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_assoc($result);
    }

    public function getFactureDetails($commande_id, $client_id) {
        $commande_id = mysqli_real_escape_string($this->db->conn, $commande_id);
        $client_id = mysqli_real_escape_string($this->db->conn, $client_id);

        $sql = "SELECT 
                    c.id AS commande_id,
                    c.date_commande,
                    c.montant_total,
                    c.statut,
                    p.date_paiement,
                    p.mode_paiement,
                    u.nom AS client_nom,
                    u.prenom AS client_prenom,
                    l.adresse_livraison,
                    l.date_livraison,
                    livreur.nom AS livreur_nom,
                    livreur.prenom AS livreur_prenom,
                    livreur.telephone AS livreur_telephone
                FROM commandes c
                LEFT JOIN paiements p ON c.id = p.commande_id
                JOIN utilisateurs u ON c.client_id = u.id
                JOIN livraisons l ON c.id = l.commande_id
                JOIN livreurs livreur ON l.livreur_id = livreur.id
                WHERE c.id = '$commande_id' AND c.client_id = '$client_id'";

        $result = mysqli_query($this->db->conn, $sql);

        if (!$result) {
            die("Erreur lors de la récupération de la facture : " . mysqli_error($this->db->conn));
        }

        return mysqli_fetch_assoc($result);
    }


    public function getCommandesValidees() {
        $sql = "SELECT c.id, CONCAT('Commande #', c.id, ' - ', u.nom, ' ', u.prenom) AS label
                FROM commandes c
                JOIN utilisateurs u ON c.client_id = u.id
                WHERE c.statut = 'Validée'
                ORDER BY c.id DESC";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getLivreursDisponibles() {
        $sql = "SELECT id, CONCAT(nom, ' ', prenom, ' - ', telephone) AS label
                FROM livreurs
                WHERE disponible = 1
                ORDER BY nom";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


}