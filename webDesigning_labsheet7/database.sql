-- Online Bookstore schema + seed data (MySQL 5.7+/8, MariaDB 10.3+)
CREATE DATABASE IF NOT EXISTS bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bookstore;

DROP TABLE IF EXISTS wishlist, reviews, order_items, orders, books, categories, users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200) NOT NULL,
  author VARCHAR(150) NOT NULL,
  price DECIMAL(8,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  image VARCHAR(255) DEFAULT NULL,
  category_id INT DEFAULT NULL,
  description TEXT,
  featured TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
  INDEX (title), INDEX (author)
) ENGINE=InnoDB;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  status ENUM('Pending','Shipped','Delivered') NOT NULL DEFAULT 'Pending',
  ship_name VARCHAR(100) NOT NULL,
  ship_address VARCHAR(255) NOT NULL,
  ship_city VARCHAR(100) NOT NULL,
  ship_zip VARCHAR(20) NOT NULL,
  ship_phone VARCHAR(30) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  book_id INT NOT NULL,
  title VARCHAR(200) NOT NULL,
  price DECIMAL(8,2) NOT NULL,
  quantity INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  book_id INT NOT NULL,
  user_id INT NOT NULL,
  rating TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY one_review (book_id, user_id),
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE wishlist (
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, book_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Seed: admin account (email admin@bookstore.test, password Admin@123)
INSERT INTO users (name,email,password_hash,role) VALUES ('Administrator','admin@bookstore.test','$2y$10$w.DB2D5CJq4JYcywLEZxge.tmAIZ2gW7CABzOAwhLk3DxFSoJFfrm','admin');

INSERT INTO categories (name) VALUES ('Fiction'),('Science'),('Technology'),('History'),('Children');

INSERT INTO books (title,author,price,stock,category_id,description,featured) VALUES
('The Silent Harbor','Maya Collins',12.99,25,1,'A quiet coastal town hides a secret that unravels over one stormy winter.',1),
('Cosmos Unveiled','Arjun Rao',18.50,15,2,'A friendly tour of the universe, from black holes to the search for life.',1),
('Learn PHP the Practical Way','Dana Whitfield',29.00,40,3,'Build real web applications with PHP and MySQL, step by step.',1),
('Empires of Salt','Hassan Idris',21.75,10,4,'The rise and fall of the great trade empires of the ancient world.',0),
('Pip and the Paper Moon','Lila Moreno',9.99,50,5,'A gentle bedtime adventure about a mouse who builds a moon of paper.',1),
('Midnight Algorithms','Chen Wei',15.25,18,1,'A thriller about a programmer who finds a message hidden in old code.',0),
('Clean Database Design','Priya Nair',34.00,12,3,'Normalization, indexing and schema patterns that stand the test of time.',1),
('Letters from the Deep','Oscar Lindqvist',14.50,0,2,'Marine biologists share dispatches from the ocean floor.',0),
('The Cartographer''s Daughter','Isla Grant',13.75,30,1,'A mapmaker''s daughter follows her father''s last map into the unknown.',0),
('A Short History of Trade','Tomas Berg',19.99,22,4,'How markets, money and merchants shaped the modern world.',0),
('Robots at the Zoo','Lila Moreno',8.99,35,5,'A rhyming picture book about robots who run the city zoo.',0),
('Quantum for Curious Minds','Nadia Karim',24.00,14,2,'Quantum physics explained with everyday analogies and zero maths panic.',0);
