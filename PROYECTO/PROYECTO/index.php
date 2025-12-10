<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the base path for includes
define('BASE_PATH', __DIR__ . '/');

// Include the configuration file
require_once BASE_PATH . 'config.php';

// Include necessary files
require_once BASE_PATH . 'src/Database.php';

if (isset($_SESSION['type'])) {
    $type = $_SESSION['type'];

    switch ($type) {
        case 'admin':
            // header('Location: ' . BASE_URL . 'views/admin_dashboard.php');
            exit;
        case 'user':
            // header('Location: ' . BASE_URL . 'views/catalog.php');
            exit;
        case 'seller':
            header('Location: ' . BASE_URL . 'src/articulo');
            exit;
    }
}

// Load to login form
// $tasks = $taskManager->getAllTasks();
// require BASE_PATH . 'views/login_form.php';
header('Location: ' . BASE_URL . 'src/user');

