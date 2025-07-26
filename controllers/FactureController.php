<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/CommandsModel.php';

class FactureController extends Controller {
    private $commandeModel;

    public function __construct() {
        $database = new Database();
        $this->commandeModel = new CommandsModel($database);
    }

    public function showFacture() {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour accéder à cette page.");
        }

        if (!isset($_GET['commande_id'])) {
            die("Aucune commande spécifiée.");
            
        }

        $facture = $this->commandeModel->getFactureDetails($_GET['commande_id'], $_SESSION['id']);

        if (!$facture) {
            var_dump($_SESSION);
            var_dump($_GET);
            die("Facture introuvable ou accès non autorisé.");
        }

        $this->render('facture/show', ['facture' => $facture]);
    }
}