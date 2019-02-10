# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.23)
# Database: BookSeller
# Generation Time: 2019-02-10 18:29:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bookinfo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookinfo`;

CREATE TABLE `bookinfo` (
  `book_id` int(100) NOT NULL AUTO_INCREMENT,
  `book_genre` varchar(30) NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_price` int(11) NOT NULL,
  `is_available` varchar(30) NOT NULL DEFAULT '',
  UNIQUE KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bookinfo` WRITE;
/*!40000 ALTER TABLE `bookinfo` DISABLE KEYS */;

INSERT INTO `bookinfo` (`book_id`, `book_genre`, `book_name`, `book_author`, `book_price`, `is_available`)
VALUES
	(1,'Computer Science','Basic Data Structures','John Smith',120,'Available'),
	(2,'Math','Essential Calculus I','James Stewart',155,'Available'),
	(3,'Math','Essential Calculus II','James Stewart',199,'Available'),
	(4,'Computer Science','Operating Systems','Jae Oh',105,'Shipped'),
	(5,'Math','Essential Calculus III','James Stewart',201,'Available'),
	(6,'Math','Statistics 101','John Doe',25,'Shipped'),
	(7,'Computer Science','Algorithms','John Doe',250,'Available'),
	(8,'Fiction','Game of Thrones','George RR. Martin',25,'Available'),
	(9,'Fiction','Harry Potter','JK Rowling',100,'Shipped'),
	(10,'Computer Science','Web Design for Nubes','Brian Welsh',4,'Available'),
	(11,'gtbetyh','ythruytn','yth6uj',300,'Available'),
	(12,'math','intro to math','math wizard',7000,'Available');

/*!40000 ALTER TABLE `bookinfo` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_type` varchar(6) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;

INSERT INTO `user_info` (`user_id`, `user_name`, `user_type`, `user_password`)
VALUES
	(0,'Rafi Rafsan','Seller','password1'),
	(1,'Brian Welsh','Seller','Password2'),
	(2,'Beibei Zhang','Buyer','password3'),
	(3,'Zhijan Chen','Seller','password4'),
	(4,'Jiaqi Feng','Buyer','password4'),
	(5,'Michael Scott','Buyer','dundermifflin'),
	(6,'Bruce Wayne','Seller','Batman');

/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
