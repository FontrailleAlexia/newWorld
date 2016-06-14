/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : newworld2

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-05-31 20:27:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `shelf` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shelf_id` (`shelf`),
  CONSTRAINT `fk_shelf_id` FOREIGN KEY (`shelf`) REFERENCES `shelf` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Salade', '1', 'images/category/1.png');
INSERT INTO `category` VALUES ('2', 'Pomme', '2', 'images/category/2.png');
INSERT INTO `category` VALUES ('3', 'Boeuf', '3', 'images/category/3.png');
INSERT INTO `category` VALUES ('4', 'Saumon', '4', 'images/category/4.png');
INSERT INTO `category` VALUES ('5', 'Poisson pané', '4', 'images/category/5.png');
INSERT INTO `category` VALUES ('6', 'Crème', '6', 'images/category/6.png');
INSERT INTO `category` VALUES ('7', 'Beurre', '6', 'images/category/7.png');
INSERT INTO `category` VALUES ('8', 'Oeuf', '6', 'images/category/8.png');
INSERT INTO `category` VALUES ('9', 'Porc', '3', 'images/category/9.png');
INSERT INTO `category` VALUES ('10', 'Veau', '3', 'images/category/10.png');
INSERT INTO `category` VALUES ('11', 'Agneau', '3', 'images/category/11.png');
INSERT INTO `category` VALUES ('12', 'Fromage de vache', '7', 'images/category/12.png');
INSERT INTO `category` VALUES ('13', 'Fromage de brebis', '7', 'images/category/13.png');
INSERT INTO `category` VALUES ('14', 'Jambon', '3', 'images/category/14.png');

-- ----------------------------
-- Table structure for distributor
-- ----------------------------
DROP TABLE IF EXISTS `distributor`;
CREATE TABLE `distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `activity` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of distributor
-- ----------------------------
INSERT INTO `distributor` VALUES ('1', 'Julien', 'GARNIER', 'juliengarnier94@hotmail.fr', 'SUPER U', '0', '0637682739', 'Rue Raoul Servant', '', '69007', 'Lyon');

-- ----------------------------
-- Table structure for lot
-- ----------------------------
DROP TABLE IF EXISTS `lot`;
CREATE TABLE `lot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harvestDate` date NOT NULL,
  `daysPreserve` int(11) NOT NULL,
  `productionMode` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `pointOfSale` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_id` (`product`),
  KEY `productionMode` (`productionMode`),
  KEY `fk_userId_id` (`userId`),
  KEY `fk_pointOfSale_id` (`pointOfSale`),
  CONSTRAINT `fk_pointOfSale_id` FOREIGN KEY (`pointOfSale`) REFERENCES `distributor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productionMode_id` FOREIGN KEY (`productionMode`) REFERENCES `productionmode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_id` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_userId_id` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of lot
-- ----------------------------
INSERT INTO `lot` VALUES ('1', '6', '2', '2', '0000-00-00', '2', '1', '3.58', '1');
INSERT INTO `lot` VALUES ('2', '6', '3', '2', '2016-05-05', '3', '1', '2.00', '1');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `libelle` varchar(255) CHARACTER SET latin1 NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_category_id` (`category`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', '1', 'Frisée', 'images/product/1.png');
INSERT INTO `product` VALUES ('2', '2', 'Golden', 'images/product/2.png');
INSERT INTO `product` VALUES ('3', '2', 'Reinette', 'images/product/3.png');
INSERT INTO `product` VALUES ('4', '6', 'Beurre moulé', 'images/product/4.png');
INSERT INTO `product` VALUES ('5', '6', 'Beurre plaqué demi sel', 'images/product/5.png');
INSERT INTO `product` VALUES ('6', '6', 'Oeuf frais de poule', 'images/product/6.png');
INSERT INTO `product` VALUES ('7', '6', 'Oeuf frais très gros', 'images/product/7.png');
INSERT INTO `product` VALUES ('8', '3', 'Bavette', 'images/product/8.png');
INSERT INTO `product` VALUES ('9', '3', 'Faux filet', 'images/product/9.png');
INSERT INTO `product` VALUES ('10', '11', 'Gigot d\'agneau', 'images/product/10.png');
INSERT INTO `product` VALUES ('11', '11', 'Cote d\'agneau', 'images/product/11.png');
INSERT INTO `product` VALUES ('12', '12', 'Emmental', 'images/product/12.png');
INSERT INTO `product` VALUES ('13', '12', 'Mozzarella', 'images/product/13.png');
INSERT INTO `product` VALUES ('14', '13', 'Roquefort', 'images/product/14.png');
INSERT INTO `product` VALUES ('15', '4', 'Pavé de saumon', 'images/product/15.png');

-- ----------------------------
-- Table structure for productionmode
-- ----------------------------
DROP TABLE IF EXISTS `productionmode`;
CREATE TABLE `productionmode` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productionmode
-- ----------------------------
INSERT INTO `productionmode` VALUES ('1', 'Bio');
INSERT INTO `productionmode` VALUES ('2', 'Naturel');

-- ----------------------------
-- Table structure for shelf
-- ----------------------------
DROP TABLE IF EXISTS `shelf`;
CREATE TABLE `shelf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of shelf
-- ----------------------------
INSERT INTO `shelf` VALUES ('1', 'Légumes', 'images/shelf/1.png');
INSERT INTO `shelf` VALUES ('2', 'Fruits', 'images/shelf/2.png');
INSERT INTO `shelf` VALUES ('3', 'Viandes', 'images/shelf/3.png');
INSERT INTO `shelf` VALUES ('4', 'Poissons', 'images/shelf/4.png');
INSERT INTO `shelf` VALUES ('5', 'Lait', 'images/shelf/5.png');
INSERT INTO `shelf` VALUES ('6', 'Crémerie', 'images/shelf/6.png');
INSERT INTO `shelf` VALUES ('7', 'Fromages', 'images/shelf/7.png');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nickname` varchar(20) NOT NULL,
  `address` varchar(20) DEFAULT NULL,
  `address2` varchar(20) DEFAULT NULL,
  `postalcode` varchar(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_type_id` (`type`),
  CONSTRAINT `FK_type_id` FOREIGN KEY (`type`) REFERENCES `usertype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('6', 'Julien', 'GARNIER', 'juliengarnier94@hotmail.fr', '1994-02-05', '0637682737', 'julien42', 'Chemin des coccinell', 'aucun', '42578', 'CITY', '4869506958a2440db683d5d3492817b8', '2');

-- ----------------------------
-- Table structure for usertype
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES ('1', 'Vendeur');
INSERT INTO `usertype` VALUES ('2', 'Acheteur');
INSERT INTO `usertype` VALUES ('3', 'Producteur');
