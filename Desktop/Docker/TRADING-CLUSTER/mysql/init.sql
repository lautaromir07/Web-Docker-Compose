CREATE DATABASE IF NOT EXISTS trading_db;
USE trading_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert a default user (admin / admin123)
-- In a real app we would hash this, but for a "simple" student project, plain text or md5 is often expected for clarity, 
-- but I'll use simple password_verify logic in PHP.
INSERT INTO users (username, password) VALUES ('admin', 'admin123');
