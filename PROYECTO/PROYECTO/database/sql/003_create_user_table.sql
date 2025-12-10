
use ecommerce;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'buyer', 'seller') NOT NULL
);

INSERT INTO users (username, password, full_name, user_type)
VALUES
('admin1', 'pass', 'System Administrator', 'admin'),
('buyer01', 'pass', 'John Doe', 'buyer'),
('seller09', 'pass', 'Carlos Perez', 'seller');