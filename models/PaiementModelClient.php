<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '../../core/Controller.php';

class PaiementModelClient extends Controller {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getByClient($client_id) {
        $sql = "SELECT p.id, p.commande_id, p.montant, p.date_paiement, p.mode_paiement,
                       c.statut AS commande_statut
                FROM paiements p
                JOIN commandes c ON p.commande_id = c.id
                WHERE c.client_id = $client_id
                ORDER BY p.date_paiement DESC";

        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function paymentForm($commande_id) {
        $check_sql = "SELECT id FROM commandes WHERE id = '$commande_id'";
        $check_result = mysqli_query($this->db->conn, $check_sql);
        
        if (mysqli_num_rows($check_result) == 0) {
            return false;
        }

       $this->render('client/paiement/form', ['commande_id' => $commande_id]);
    }

    public function process($commande_id, $montant, $mode_paiement, $client_id) {
        $check_sql = "SELECT id FROM commandes 
                     WHERE id = '$commande_id' 
                     AND client_id = '$client_id' 
                     AND statut != 'payée'";
        $check_result = mysqli_query($this->db->conn, $check_sql);
        
        if (mysqli_num_rows($check_result) == 0) {
            return false;
        }

        $sql_paiement = "INSERT INTO paiements (commande_id, montant, date_paiement, mode_paiement) 
                        VALUES ('$commande_id', '$montant', NOW(), '$mode_paiement')";
        mysqli_query($this->db->conn, $sql_paiement);

        $sql_livraison = "UPDATE livraisons SET payée = '1' WHERE commande_id = '$commande_id'";
        mysqli_query($this->db->conn, $sql_livraison);

        $sql_commande = "UPDATE commandes SET statut = 'payée' WHERE id = '$commande_id'";
        mysqli_query($this->db->conn, $sql_commande);

        return true;
    }
}