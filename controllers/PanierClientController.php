<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/PanierClientModel.php';
require_once __DIR__ . '/../models/ProduitsClientModel.php';
require_once __DIR__ . '/../models/CommandsClientModel.php';
require_once __DIR__ . '/../models/Database.php';

class ClientCartController extends Controller {
    private $cartModel;
    private $productModel;
    private $orderModel;

    public function __construct() {
        $database = new Database();
        $this->orderModel = new CommandsClientModel($database);
        $this->cartModel = new PanierClientModel($database);
        $this->productModel = new ProduitsClientModel($database);
    }

    public function viewCart() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $clientId = $_SESSION['id'];
        $cartItems = $this->cartModel->getCartItems($clientId);
        $cartTotal = $this->cartModel->getCartTotal($clientId);

        $this->render('client/cart/view', [
            'cartItems' => $cartItems,
            'cartTotal' => $cartTotal
        ]);
    }

    public function removeFromCart($itemId) {
        $clientId = $_SESSION['id'];
        if ($this->cartModel->removeFromCart($itemId, $clientId)) {
            $_SESSION['success'] = "Article retiré du panier";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression";
        }
        header("Location: index.php?action=viewPanier");
        exit();
    }

    public function clearCart() {
        $clientId = $_SESSION['id'];
        if ($this->cartModel->clearCart($clientId)) {
            $_SESSION['success'] = "Panier vidé avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors du vidage du panier";
        }
        header("Location: index.php?action=viewPanier");
        exit();
    }

   public function checkout() {
        $clientId = $_SESSION['id'];
        $cartItems = $this->cartModel->getCartItems($clientId);

        if (empty($cartItems)) {
            $_SESSION['error'] = "Votre panier est vide.";
            header("Location: index.php?action=viewPanier");
            exit();
        }

        $cartTotal = $this->cartModel->getCartTotal($clientId);

        // Créer une nouvelle commande
        $commandeId = $this->orderModel->createCommande($clientId, $cartTotal, 'en attente');

        foreach ($cartItems as $item) {
            $this->orderModel->addProduitToCommande($commandeId, $item['product_id'], $item['quantité'], $item['total']);
        }

        // Vider le panier
        $this->cartModel->clearCart($clientId);

        $_SESSION['success'] = "Commande passée avec succès.";
        header("Location: index.php?action=clientOrders");
        exit();
    }



}