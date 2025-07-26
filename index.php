<?php
session_start();
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/controllers/ProduitsController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/CommandsController.php';
require_once __DIR__ . '/controllers/ClientProductController.php';
require_once __DIR__ . '/controllers/PanierClientController.php';
require_once __DIR__ . '/controllers/FactureController.php';
require_once __DIR__ . '/controllers/PaiementController.php';
require_once __DIR__ . '/controllers/LivraisonControllerClient.php';
require_once __DIR__ . '/controllers/CommandesClientController.php';
require_once __DIR__ . '/controllers/LivraisonController.php';
require_once __DIR__ . '/controllers/StatsController.php';




$action = $_GET['action'] ?? 'listProduitsClients';


switch ($action) {


    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'showCreateAccount':
        $controller = new AuthController();
        $controller->showCreateAccount();
        break;
        
    case 'createAccount':
        $controller = new AuthController();
        $controller->createAccount();
        break;
        
    case 'disconnect':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'listProduits':
        $controller = new ProduitsController();
        $controller->listProduitsC();
        break;
    case 'addProduit':
        $controller = new ProduitsController();
        $controller->addProduitC();
        break;
    case 'saveProduit':
        $controller = new ProduitsController();
        $controller->saveProduitC();
        break;
    case 'editProduit':
        $controller = new ProduitsController();
        $controller->editProduitC();
        break;
    case 'updateProduit':
        $controller = new ProduitsController();
        $controller->updateProduitC();
        break;
    case 'deleteProduit':
        $controller = new ProduitsController();
        $controller->deleteProduitC();
        break;
     case 'listCommandesClients':
        $controller = new CommandesClientController();
        $controller->listCommands();
        break;

    case 'listCommands':
        $controller = new CommandsController();
        $controller->listCommands();
        break;
        
    case 'addCommand':
        $controller = new CommandsController();
        $controller->addCommand();
        break;
        
    case 'saveCommand':
        $controller = new CommandsController();
        $controller->saveCommand();
        break;
        
    case 'editCommand':
        $id = $_GET['id'] ?? 0;
        $controller = new CommandsController();
        $controller->editCommand($id);
        break;
        
    case 'updateCommand':
        $controller = new CommandsController();
        $controller->updateCommand();
        break;
        
    case 'deleteCommand':
        $id = $_GET['id'] ?? 0;
        $controller = new CommandsController();
        $controller->deleteCommand($id);
        break;
        
    case 'viewCommand':
        $id = $_GET['id'] ?? 0;
        $controller = new CommandsController();
        $controller->viewCommand($id);
        break;

    case 'paymentForm':
        $controller = new PaiementController();
        $controller->showForm();
        break;


    case 'listProduitsClients':
        $controller = new ClientProductController();
        $controller->listProducts();
        break;
    case 'addToCart':
        $controller = new ClientProductController();
        $controller->addToCart();
        break;

    case 'viewPanier':
        $controller = new ClientCartController();
        $controller->viewCart();
        break;
    case 'removeFromCart':
        $id = $_GET['id'] ?? 0;
        $controller = new ClientCartController();
        $controller->removeFromCart($id);
        break;
    case 'clearCart':
        $controller = new ClientCartController();
        $controller->clearCart();
        break;
    case 'checkout':
        $controller = new ClientCartController();
        $controller->checkout();
        break;

    case 'clientOrders':
        $controller = new CommandesClientController();
        $controller->listCommands();
        break;
    case 'viewOrder':
        $id = $_GET['id'] ?? 0;
        $controller = new CommandesClientController();
        $controller->viewOrder($id);
        break;


    case 'listPaiementsClients':
        $controller = new PaiementController();
        $controller->listPaiements();
        break;
        
        
    case 'processPayment':
        $controller = new PaiementController();
        $controller->processPayment();
        break;
        
    case 'listLivraisonsClients':
        $controller = new LivraisonControllerClient();
        $controller->listLivraisons();
        break;
    
    case 'listLivraisons':
        $controller = new LivraisonController();
        $controller->listLivraisons();
        break;
    
    case 'createLivraison':
        $controller = new LivraisonController();
        $controller->createLivraison();
        break;
        
    case 'facture':
        $controller = new FactureController();
        $controller->showFacture();
        break;

    case 'consulterStatistiques':
        $controller = new StatsController();
        $controller->consulterStatistiques();
        break;

    default:
        http_response_code(404);
        echo "Page not found";
        break;
}