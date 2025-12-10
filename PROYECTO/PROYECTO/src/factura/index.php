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
require_once BASE_PATH . 'facturaManager.php';
require_once BASE_PATH . 'factura.php';

// Create an instance of facturaManager
$facturaManager = new facturaManager();

// Get the action from the URL, default to 'list' if not set
$action = $_GET['action'] ?? 'list';

// Handle different actions
switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $facturaManager->createReceipt($_POST['product_id'],$_POST['product_name'],$_POST['buyer'],$_POST['seller']);
            header('Location: ' . BASE_URL);
            exit;
        }
        break;
    case 'delete':
        $facturaManager->deleteReceipt($_GET['id']);
        header('Location: ' . BASE_URL);
        break;
    case 'view':
        $factura = $facturaManager->getReceiptbyId($_GET['id']);
        require BASE_PATH . '../../views/view_receipt.php';
        break;
    case 'viewbuyer':
        $factura = $facturaManager->getBuyerReceipts($_GET['id']);
        require BASE_PATH .'../../views/user_receipts.php';
        break;
    case 'viewseller':
        $factura = $facturaManager->getSellerReceipts($_GET['id']);
        require BASE_PATH .'../../views/user_receipts.php';
        break; 
    default:
        $factura = $facturaManager -> getAllReceipts();       
        require BASE_PATH . '../../views/receipts.php';
        break;
}