<?php
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/controllers/AssuranceController.php';
require_once __DIR__ . '/controllers/TypeAssuranceController.php'; // <- add this

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Redirect root to /assurances
if ($uri === '/' || $uri === '') {
    header('Location: /assurances');
    exit;
}

$assuranceCtrl = new AssuranceController();
$typeCtrl = new TypeAssuranceController(); // <- add this

switch($uri) {
    // Assurance routes
    case '/assurances':
        $assuranceCtrl->index();
        break;

    case '/assurances/create':
        if($method === 'POST') $assuranceCtrl->store();
        else $assuranceCtrl->create();
        break;

    case '/assurances/edit':
        $id = $_GET['id'] ?? null;
        if($method === 'POST') $assuranceCtrl->update($id);
        else $assuranceCtrl->edit($id);
        break;

    case '/assurances/delete':
        $id = $_GET['id'] ?? null;
        $assuranceCtrl->delete($id);
        break;

    case '/type_assurance':
        $typeCtrl->index();
        break;

    case '/type_assurance/create':
        if($method === 'POST') $typeCtrl->store();
        else $typeCtrl->create();
        break;

    case '/type_assurance/edit':
        $id = $_GET['id'] ?? null;
        if($method === 'POST') $typeCtrl->update($id);
        else $typeCtrl->edit($id);
        break;

    case '/type_assurance/delete':
        $id = $_GET['id'] ?? null;
        $typeCtrl->delete($id);
        break;

    default:
        echo "404 Not Found";
}
