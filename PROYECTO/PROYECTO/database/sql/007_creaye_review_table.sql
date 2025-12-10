CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT NOT NULL,        
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_reviews_product
      FOREIGN KEY (product_id) REFERENCES products(id)
      ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT fk_reviews_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT chk_reviews_rating
      CHECK (rating BETWEEN 1 AND 5)
);