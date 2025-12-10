<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the base path for includes
define('BASE_PATH', __DIR__ . '/');

require_once BASE_PATH . '../config_session.php';

// Include the configuration file
require_once BASE_PATH . '../../config.php';

// Include necessary files
require_once BASE_PATH . '../Database.php';
require_once BASE_PATH . 'reviewManager.php';
require_once BASE_PATH . 'review.php';

// Create an instance of facturaManager
$reviewManager = new reviewManager();

// Get the action from the URL, default to 'list' if not set
$action = $_GET['action'] ?? 'list';

// Handle different actions
switch ($action) {
    case 'create':
        $userId = $_SESSION['user_id'] ?? ($_SESSION['id'] ?? null);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewManager->crearReview($_POST['product_id'],$_POST['user_id'],$_POST['rating'],$_POST['comment']);
            header('Location: ' . BASE_URL);
            exit;
        }
        require BASE_PATH . '../../views/review_form.php';
        break;
    case 'delete':
        $reviewManager->deleteReview($_GET['id']);
        header('Location: ' . BASE_URL);
        break;
    case 'viewbuyer':
        $reviews = $reviewManager->getBuyerReviews($_GET['id']);
        require BASE_PATH . '../../views/user_reviews.php';
        break;
    default:
        $reviews = $reviewManager -> getAllReviews();       
        require BASE_PATH . '../../views/receipts.php';
        break;
}