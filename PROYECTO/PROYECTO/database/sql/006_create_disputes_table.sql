CREATE TABLE IF NOT EXISTS disputes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receipt_id INT NOT NULL,         
    user_id INT NOT NULL,            
    reason VARCHAR(255) NOT NULL,                  
    status ENUM('open', 'resolved', 'rejected') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    CONSTRAINT fk_disputes_receipt
      FOREIGN KEY (receipt_id) REFERENCES receipts(id)
      ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT fk_disputes_user
      FOREIGN KEY (user_id) REFERENCES users(id)
      ON UPDATE CASCADE ON DELETE CASCADE
);