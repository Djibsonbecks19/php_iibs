<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/CommandsClientModel.php';
require_once __DIR__ . '/../models/Database.php';

class CommandesClientController extends Controller {
    private $orderModel;

    public function __construct() {
        $database = new Database();
        $this->orderModel = new CommandsClientModel($database);
    }

    public function listCommands() {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $clientId = $_SESSION['id'];
        $orders = $this->orderModel->getClientOrders($clientId);

        $this->render('client/orders/list', ['orders' => $orders]);
    }

    public function viewOrder($orderId) {
        if (!isset($_SESSION['id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $clientId = $_SESSION['id'];
        $command = $this->orderModel->getOrderById($orderId, $clientId);

        if (!$command) {
            $_SESSION['error'] = "Commande introuvable";
            header("Location: index.php?action=clientOrders");
            exit();
        }

        $this->render('client/orders/view', ['command' => $command]);
    }
}