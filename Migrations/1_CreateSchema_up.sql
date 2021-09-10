CREATE TABLE `Customer` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstName TEXT,
    lastName TEXT,
    email TEXT
);

CREATE TABLE `Order` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    date DATETIME,
    countryCode TEXT,
    device TEXT,
    FOREIGN KEY (customer_id) REFERENCES `Customer`(id) ON DELETE CASCADE
);

CREATE TABLE `OrderItem` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    ean VARCHAR(13),
    quantity INT UNSIGNED,
    price NUMERIC,
    FOREIGN KEY (order_id) REFERENCES `Order`(id) ON DELETE CASCADE
);
