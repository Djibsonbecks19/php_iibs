<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/CommandsModel.php';
require_once __DIR__ . '/../models/Database.php';

class CommandsController extends Controller {
    private $commandModel;

    public function __construct() {
        $database = new Database();
        $this->commandModel = new CommandsModel($database);
    }

    public function listCommands() {
        $commands = $this->commandModel->getAll();
        $this->render('commands/list', ['commands' => $commands]);
    }

    public function addCommand() {
        $clients = $this->commandModel->getClients();
        $products = $this->commandModel->getProducts();
        $this->render('commands/add', ['clients' => $clients, 'products' => $products]);
    }


    public function saveCommand() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $clientId = $_POST['client_id'];
            $productId = $_POST['produit_id'];
            $quantity = $_POST['quantite'];
            $status = $_POST['statut'];

            if ($this->commandModel->create($clientId, $productId, $quantity, $status)) {
                header("Location: index.php?action=listCommands");
                exit();
            } else {
                $error = "Erreur lors de la création de la commande";
                $clients = $this->commandModel->getClients();
                $products = $this->commandModel->getProducts();
                $this->render('commands/add', [
                    'clients' => $clients,
                    'products' => $products,
                    'error' => $error
                ]);
            }
        }
    }

    public function editCommand($id) {
        $command = $this->commandModel->getCommandeAvecDetails($id);
        $this->render('commands/edit', [
            'command' => $command,
        ]);
    }

    public function updateCommand() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $statut = $_POST['statut'] ?? null;

            if ($statut !== null) {
                $success = $this->commandModel->update($id, $statut);

                

                if ($success) {
                    $commands = $this->commandModel->getAll();
                    $this->render('commands/list', ['commands' => $commands]);
                } else {
                    $error = "Erreur lors de la mise à jour.";
                    $commands = $this->commandModel->getAll();
                    $this->render('commands/list', compact('commands', 'error'));
                }
            } else {
                $error = "Données invalides.";
                $commands = $this->commandModel->getAll();
                $this->render('commands/list', compact('commands', 'error'));
            }
        } else {
            $error = "ID commande manquant ou mauvaise requête.";
            $commands = $this->commandModel->getAll();
            $this->render('commands/list', compact('commands', 'error'));
        }
    }




    public function deleteCommand($id) {
        if ($this->commandModel->delete($id)) {
            header("Location: index.php?action=listCommands");
            exit();
        } else {
            $error = "Erreur lors de la suppression de la commande";
            $commands = $this->commandModel->getAll();
            $this->render('commands/list', [
                'commands' => $commands,
                'error' => $error
            ]);
        }
    }

    public function viewCommand($id) {
        $command = $this->commandModel->getCommandeAvecDetails($id);
        $this->render('commands/view', ['command' => $command]);
    }
}