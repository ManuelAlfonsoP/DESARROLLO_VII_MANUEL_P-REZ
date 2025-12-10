USE ecommerce;

CREATE TABLE IF NOT EXISTS receipts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    buyer INT NOT NULL,
    seller INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- producto al que pertenece el recibo
    CONSTRAINT fk_receipts_product
        FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    -- comprador
    CONSTRAINT fk_receipts_buyer
        FOREIGN KEY (buyer)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    -- vendedor
    CONSTRAINT fk_receipts_seller
        FOREIGN KEY (seller)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);