<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/ProduitsModel.php';

class ProduitsController extends Controller {
    private $productModel;

    public function __construct() {
        $database = new Database();
        $this->productModel = new ProduitsModel($database);
    }

    public function listProduitsC() {
        $products = $this->productModel->getAll();
        $this->render('produits/list', ['products' => $products]);
    }

    public function addProduitC() {
        $this->render('produits/add');
    }

    public function saveProduitC() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imagePath = $this->productModel->uploadImage($_FILES['image']);
            
            if ($imagePath) {
                $data = [
                    'libelle' => $_POST['libelle'],
                    'quantite_stock' => $_POST['quantite_stock'],
                    'prix_unitaire' => $_POST['prix_unitaire'],
                    'quantite_seuil' => $_POST['quantite_seuil']
                ];
                
                if ($this->productModel->create($data, $imagePath)) {
                    header("Location: index.php?action=listProduits");
                    exit();
                } else {
                    $message = "Erreur lors de l'ajout du produit";
                }
            } else {
                $message = "Erreur lors de l'upload de l'image";
            }
            $this->render('produits/add', ['message' => $message]);
        }
    }

    public function editProduitC() {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getById($id);
        if ($product) {
            $this->render('produits/edit', ['product' => $product]);
        } else {
            header("Location: index.php?action=listProduits");
            exit();
        }
    }

    public function updateProduitC() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $data = [
                'libelle' => $_POST['libelle'],
                'quantite_stock' => $_POST['quantite_stock'],
                'prix_unitaire' => $_POST['prix_unitaire'],
                'quantite_seuil' => $_POST['quantite_seuil'],
                'image' => $_POST['image']
            ];
            
            if ($this->productModel->update($id, $data)) {
                header("Location: index.php?action=listProduits");
                exit();
            } else {
                $message = "Erreur lors de la mise à jour du produit";
                $product = $this->productModel->getById($id);
                $this->render('produits/edit', ['product' => $product, 'message' => $message]);
            }
        }
    }

    public function deleteProduitC() {
        $id = $_GET['id'] ?? 0;
        if ($this->productModel->delete($id)) {
            header("Location: index.php?action=listProduits");
            exit();
        } else {
            $message = "Erreur lors de la suppression du produit";
            $this->render('produits/delete', ['message' => $message]);
        }
    }
}