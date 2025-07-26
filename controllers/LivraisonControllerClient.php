<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/LivraisonModelClient.php';

class LivraisonControllerClient extends Controller {
    private $livraisonModel;

    public function __construct() {
        $database = new Database();
        $this->livraisonModel = new LivraisonModelClient($database);
    }

    public function listLivraisons() {
        if (!isset($_SESSION['id'])) {
            die("Veuillez vous connecter pour accéder aux livraisons.");
        }

        $livraisons = $this->livraisonModel->getByClient($_SESSION['id']);
        $this->render('client/livraison/list', ['livraisons' => $livraisons]);
    }
}