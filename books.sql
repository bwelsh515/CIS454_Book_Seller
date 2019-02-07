# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.23)
# Database: Textbooks
# Generation Time: 2019-02-07 00:29:35 +0000
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
  `book_genre` varchar(30) NOT NULL,
  `book_name` varchar(30) NOT NULL,
  `book_author` varchar(30) NOT NULL,
  `book_price` int(11) NOT NULL,
  `is_available` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `bookinfo` WRITE;
/*!40000 ALTER TABLE `bookinfo` DISABLE KEYS */;

INSERT INTO `bookinfo` (`book_genre`, `book_name`, `book_author`, `book_price`, `is_available`)
VALUES
	('Computer Science','Basic Data Structures','John Smith',120,b'1'),
	('Math','Essential Calculus I','James Stewart',155,b'1'),
	('Math','Essential Calculus II','James Stewart',199,b'1'),
	('Computer Science','Operating Systems','Jae Oh',105,b'1'),
	('Math','Essential Calculus III','James Stewart',201,b'1'),
	('Math','Statistics 101','John Doe',25,b'1'),
	('Computer Science','Algorithms','John Doe',250,b'0'),
	('Fiction','Game of Thrones','George RR. Martin',25,b'1'),
	('Fiction','Harry Potter','JK Rowling',100,b'0'),
	('Computer Science','Web Design for Nubes','Brian Welsh',4,b'1');

/*!40000 ALTER TABLE `bookinfo` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
