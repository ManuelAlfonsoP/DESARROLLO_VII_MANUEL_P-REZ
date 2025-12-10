<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the base path for includes
define('BASE_PATH', __DIR__ . '/');

// Include the configuration file
require_once BASE_PATH . '../../config.php';

// Include necessary files
require_once BASE_PATH . '../Database.php';
require_once BASE_PATH . 'articuloManager.php';
require_once BASE_PATH . 'articulo.php';

// Create an instance of articuloManager
$articuloManager = new articuloManager();

// Get the action from the URL, default to 'list' if not set
$action = $_GET['action'] ?? 'list';

// Handle different actions
switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articuloManager->createProduct($_POST['nombre'],$_POST['precio'],$_POST['vendedor'],$_POST['inventario'],$_POST['description']);
            header('Location: ' . BASE_URL);
            exit;
        }
        require BASE_PATH . '../../views/product_form.php';
        break;
    case 'delete':
        $articuloManager->deleteProduct($_GET['id']);
        header('Location: ' . BASE_URL);
        break;
    case 'view':
        $product = $articuloManager->getProductbyId($_GET['id']);
        require BASE_PATH . '../../views/view_product.php';
        break;
    case 'decrease':
        $product = $articuloManager->disminuirInventario($_GET['id']);
    default:
        $products = $articuloManager -> getAllProducts();       
        require BASE_PATH . '../../views/catalog.php';
        break;
}