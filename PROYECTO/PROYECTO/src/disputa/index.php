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
require_once BASE_PATH . 'disputaManager.php';
require_once BASE_PATH . 'disputa.php';

// Create an instance of facturaManager
$disputaManager = new disputaManager();

// Get the action from the URL, default to 'list' if not set
$action = $_GET['action'] ?? 'list';

// Handle different actions
switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $disputaManager->createDispute($_POST['receipt_id'],$_POST['user_id'],$_POST['reason']);
            header('Location: ' . BASE_URL);
            exit;
        }
        require BASE_PATH . '../../views/dispute_form.php';
        break;
    case 'delete':
        $disputaManager->deleteDispute($_GET['id']);
        header('Location: ' . BASE_URL);
        break;
    case 'view':
        $disputa = $disputaManager->getReviewbyId($_GET['id']);
        require BASE_PATH . '../../views/view_dispute.php';
        break;
    case 'viewbuyer':
        $disputas = $disputaManager->getDisputasByUser($_GET['id']);
        require BASE_PATH . '../../views/user_disputes.php';
        break;
    case 'viewseller':
        $disputas = $disputaManager->getSellerDisputes($_GET['id']);
        require BASE_PATH . '../../views/user_disputes.php';
        break;
    case 'viewadmin':
        $disputas = $disputaManager->getAllDisputes();
        require BASE_PATH . '../../views/user_disputes.php';
        break;
    case 'detail':
        $disputeId = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decision = $_POST['decision'] ?? null;

            if (in_array($decision, ['aceptada', 'rechazada'], true)) {
                $disputaManager->updateStatus($disputeId, $decision);
            }
            header('Location: index.php?action=admin');
            exit;
        }
        $disputa = $disputaManager->getDisputeByIdcomplete($disputeId);
        if (!$disputa) {
            header('Location: index.php?action=admin');
            exit;
        }

        require BASE_PATH . '../../views/disputa_detail.php';
        break;
        break;
    default:
        $disputa = $disputaManager -> getAllDisputes();       
        require BASE_PATH . '../../views/receipts.php';
        break;

}