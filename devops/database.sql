-- Active: 1669062443244@@127.0.0.1@3306@iurru
CREATE TABLE product_categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    tax INT
);

CREATE INDEX idx_product_categories ON product_categories (id, name);

CREATE TABLE products (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    value INT UNSIGNED,
    stock INT UNSIGNED,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES product_categories(id)
);

CREATE INDEX idx_products ON products (id, name, category_id);

CREATE TABLE sales (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    total_value INT UNSIGNED,
    total_tax INT UNSIGNED,
    created_at DATE DEFAULT (CURRENT_DATE)
);

CREATE INDEX idx_sales ON sales (id, created_at);

CREATE TABLE product_sales (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sale_id INT,
    product_id INT,
    quantity INT UNSIGNED,
    current_value INT UNSIGNED,
    current_tax INT UNSIGNED,
    created_at DATETIME DEFAULT (CURRENT_TIMESTAMP),
    FOREIGN KEY (sale_id) REFERENCES sales(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE INDEX idx_product_sales ON product_sales (id, sale_id, product_id, created_at);