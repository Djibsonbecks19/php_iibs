<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/LivraisonModel.php';
require_once __DIR__ . '/../models/CommandsModel.php';

class LivraisonController extends Controller {
    private $livraisonModel;
    private $commandModel;

    public function __construct() {
        $database = new Database();
        $this->commandModel = new CommandsModel($database);
        $this->livraisonModel = new LivraisonModel($database);
    }

    public function listLivraisons() {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour accéder aux livraisons.");
        }

        $livraisons = $this->livraisonModel->getAllLivraisons();
        $this->render('livraison/list', ['livraisons' => $livraisons]);
    }

    public function viewLivraison($livraisonId) {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour accéder aux détails de la livraison.");
        }

        $livraison = $this->livraisonModel->getLivraisonById($livraisonId);

        if (!$livraison) {
            die("Livraison introuvable ou accès non autorisé.");
        }

        $this->render('livraison/view', ['livraison' => $livraison]);
    }

    public function createLivraison() {
        if (!isset($_SESSION['id'])) {
                die("Veuillez vous connecter pour créer une livraison.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commandeId = $_POST['commande_id'] ?? null;
            $livreurId = $_POST['livreur_id'] ?? null;
            $adresse = $_POST['adresse_livraison'] ?? '';


            if ($commandeId && $livreurId && !empty($adresse)) {
                $success = $this->livraisonModel->createLivraison($commandeId, $livreurId, $adresse, 0);
                    if ($success) {
                        header("Location: index.php?action=listLivraisons");
                        exit();
                    } else {
                        $error = "Erreur lors de la création de la livraison.";
                    }
            } else {
                    $error = "Tous les champs sont obligatoires.";
            }
        }

        $commandes = $this->commandModel->getCommandesValidees(); 
        $livreurs = $this->commandModel->getLivreursDisponibles(); 

        $this->render('livraison/preparer', compact('commandes', 'livreurs', 'error'));
    }

    
}