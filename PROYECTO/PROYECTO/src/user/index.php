<?php
require_once "../config_session.php";
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
require_once BASE_PATH . 'userManager.php';
require_once BASE_PATH . 'user.php';

// Create an instance of articuloManager
$userManager = new userManager();

// Get the action from the URL, default to 'list' if not set
$action = $_GET['action'] ?? 'list';

if($action === 'logout') {
    $userManager->logout();
        header("Location: index.php");
        exit;
}

// Reviso si hay una sesion, para redireccionar al sitio correcto
if (isset($_SESSION['user_type'])) {
    $type = $_SESSION['user_type'];

    switch ($type) {
        case 'admin':
            // header('Location: ' . BASE_URL . 'views/admin_dashboard.php');
            exit;
        case 'seller':
            header('Location: ' . BASE_URL . 'src/articulo');
            exit;
        case 'buyer':
            header('Location: ' . BASE_URL . 'src/articulo');
            exit;
    }
}



// Handle different actions
switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new user($_POST);
            $userManager->createUser($_POST['user'],$_POST['password'],$_POST['full_name'],$_POST['user_type']);
            header('Location: ' . BASE_URL);
            exit;
        }
        require BASE_PATH . '../../views/sign_up_form.php';
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['user'];
        $password = $_POST['password'];
        $loginResult = $userManager->login($username, $password);
        if ($loginResult === true) {
            if ($_SESSION['user_type'] === 'admin') {
                header("Location: ../articulo");
                exit;
            }

            if ($_SESSION['user_type'] === 'seller') {
                header("Location: ../articulo");
                exit;
            }

            if ($_SESSION['user_type'] === 'buyer') {
                header("Location: ../articulo");
                exit;
            }
            exit;
        } else {
            header("Location: ../user");
            echo "Invalid username or password.";
        }
    }
    break;  
    default:    
        require BASE_PATH . '../../views/login_form.php';
        break;
}