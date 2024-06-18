CREATE TABLE `users`
(
      id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      first_name VARCHAR(50) NOT NULL,
     last_name VARCHAR(50) NOT NULL,
      username VARCHAR(15) NOT NULL,
      password VARCHAR(255)NOT NULL,
       photo VARCHAR(255) DEFAULT NULL
);

CREATE TABLE `products`
(
      id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(50) NOT NULL,
     description text NOT NULL,
      price decimal(5,2) NOT NULL,
      section_id INT(11) NOT NULL

);

CREATE TABLE `sections`
(
      id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(50) NOT NULL
);

