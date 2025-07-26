<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PaiementModelClient.php';
require_once __DIR__ . '/../models/CommandsModel.php';

class PaiementController extends Controller {
    private $paiementModel;
    private $commandeModel;

    public function __construct() {
        $database = new Database();
        $this->paiementModel = new PaiementModelClient($database);
        $this->commandeModel = new CommandsModel($database);
    }

    public function listPaiements() {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour accéder aux paiements.");
        }

        $paiements = $this->paiementModel->getByClient($_SESSION['id']);
        $this->render('client/paiement/list', [
            'paiements' => $paiements,
            'success' => $_GET['success'] ?? null
        ]);
    }

    public function showForm() {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour effectuer un paiement.");
        }

        if (!isset($_GET['commande_id'])) {
            die("Aucune commande spécifiée.");
        }

        $commande = $this->commandeModel->getForPayment($_GET['commande_id'], $_SESSION['id']);

        if (!$commande) {
            die("Commande invalide ou déjà payée.");
        }

        $this->render('paiement/form', ['commande' => $commande]);
    }

    public function processPayment() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientId = $_SESSION['id'];
            $commandeId = $_GET['commande_id'];
            $montant = $_POST['montant'];
            $modePaiement = $_POST['mode_paiement'];

            $paiementModel = new PaiementModelClient(new Database());
            $success = $paiementModel->process($commandeId, $montant, $modePaiement, $clientId);

            if ($success) {
                $_SESSION['success'] = "Paiement effectué avec succès.";
                header("Location: index.php?action=listCommandesClients");
                exit();
            } else {
                $_SESSION['error'] = "Erreur lors du traitement du paiement.";
            }
        }
        $commande = $this->commandeModel->getForPayment($_GET['commande_id'], $_SESSION['id']);
        if (!$commande) {
            die("Commande invalide ou déjà payée.");
        }
        

        $this->render('client/paiement/form', ['commande' => $commande]);

}   

}