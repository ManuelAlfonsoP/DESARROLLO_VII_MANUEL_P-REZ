<?php

// Function to read .env file

function loadEnv($path) {
    if (!file_exists($path)) {
        die(".env NO ENCONTRADO");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv("$name=$value");
    }
}

// loadEnv(__DIR__ . '.env');

// Load environment variables
loadEnv(__DIR__ . '/.env');

// Define constants using environment variables
define('BASE_URL', getenv('BASE_URL'));
define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));

// Derived constants
define('PUBLIC_URL', BASE_URL . '/public');

// You can add more configuration settings here