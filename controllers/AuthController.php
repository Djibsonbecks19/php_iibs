<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/Database.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public function login() {
        // 🔁 Corriger les redirections infinies ici
        if (isset($_SESSION['login'])) {
            $currentAction = $_GET['action'] ?? '';

            // On redirige uniquement si on n'est PAS déjà sur la page cible
            if (!in_array($currentAction, ['listProduitsClients', 'listProduits', 'listCommandes'])) {
                $this->redirectBasedOnRole($_SESSION['role']);
                exit;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if (empty($login) || empty($password)) {
                $error = "Tous les Champs sont Obligatoires";
                $this->render('auth/login', ['error' => $error]);
                return;
            }

            $user = $this->userModel->authenticate($login, $password);

            if ($user) {
                $_SESSION["role"] = $user["role"];
                $_SESSION["login"] = $login;
                $_SESSION["id"] = $user["id"];
                $_SESSION["nom"] = $user["nom"];
                $_SESSION["prenom"] = $user["prenom"];
                $_SESSION["pp"] = $user["pp"];

                $this->redirectBasedOnRole($user["role"]);
            } else {
                $error = "Login ou Mot de passe incorrect";
                $this->render('auth/login', ['error' => $error]);
            }
        } else {
            $this->render('auth/login');
        }
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case "client":
                header("Location: index.php?action=listProduitsClients");
                break;
            case "RS":
                header("Location: index.php?action=listProduits");
                break;
            case "secretaire":
                header("Location: index.php?action=listCommands");
                break;
            default:
                header("Location: index.php");
                break;
        }
        exit();
    }

    public function showCreateAccount() {
        $this->render('auth/createAccount');
    }

    public function createAccount() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userData = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'telephone' => $_POST['telephone'],
                'adresse' => $_POST['adresse'],
                'role' => 1, 
                'login' => $_POST['login'],
                'password' => $_POST['password']
            ];

            foreach ($userData as $key => $value) {
                if (empty($value) && $key !== 'role') {
                    $error = "Tous les champs sont obligatoires";
                    $this->render('auth/createAccount', ['error' => $error, 'formData' => $_POST]);
                    return;
                }
            }

            if ($this->userModel->checkLoginExists($userData['login'])) {
                $error = "Ce login est déjà utilisé";
                $this->render('auth/createAccount', ['error' => $error, 'formData' => $_POST]);
                return;
            }

            $profilePicturePath = $this->userModel->uploadProfilePicture($_FILES['pp']);
            if (!$profilePicturePath) {
                $error = "Veuillez sélectionner une photo de profil valide";
                $this->render('auth/createAccount', ['error' => $error, 'formData' => $_POST]);
                return;
            }

            if ($this->userModel->createUser($userData, $profilePicturePath)) {
                $_SESSION['success'] = "Compte créé avec succès! Vous pouvez maintenant vous connecter.";
                header("Location: index.php?action=login");
                exit();
            } else {
                $error = "Erreur lors de la création du compte";
                $this->render('auth/createAccount', ['error' => $error, 'formData' => $_POST]);
            }
        } else {
            $this->render('auth/createAccount');
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
