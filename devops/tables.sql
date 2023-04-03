-- Active: 1669062443244@@127.0.0.1@3306@iurru
CREATE TABLE product_categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    tax INT
);

CREATE INDEX idx_product_categories
ON product_categories (id, name);

CREATE TABLE products (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    value INT,
    stock int,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES product_categories(id)
);
CREATE INDEX idx_products
ON products (id, name, category_id);