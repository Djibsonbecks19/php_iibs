<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/ProduitsClientModel.php';
require_once __DIR__ . '/../models/PanierClientModel.php';
require_once __DIR__ . '/../models/Database.php';

class ClientProductController extends Controller {
    private $productModel;
    private $cartModel;

    public function __construct() {
        $database = new Database();
        $this->productModel = new ProduitsClientModel($database);
        $this->cartModel = new PanierClientModel($database);
    }

    public function listProducts() {
        $products = $this->productModel->getAllProducts();
        $this->render('client/products/list', ['products' => $products]);
    }

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientId = $_SESSION['id'];
            $productId = $_POST['produit_id'];
            $libelle = $_POST['libelle'];
            $price = $_POST['prix'];
            $quantity = $_POST['quantite'];
            $image = $_POST['image'];

            if ($this->cartModel->addToCart($clientId, $productId, $libelle, $price, $quantity, $image)) {
                $_SESSION['success'] = "Produit ajouté au panier avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout au panier";
            }
            header("Location: index.php?action=listProduitsClients");
            exit();
        }
    }
}