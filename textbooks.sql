CREATE DATABASE Textbooks;
USE Textbooks;

CREATE TABLE user_info(
user_id INT NOT NULL,
user_name VARCHAR(45) NOT NULL,
is_seller BIT NOT NULL,
is_buyer BIT NOT NULL,
UNIQUE(user_id)
);
