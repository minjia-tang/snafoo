/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : snafoo

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-09-25 21:41:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sna_foo
-- ----------------------------
DROP TABLE IF EXISTS `sna_foo`;
CREATE TABLE `sna_foo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `optional` enum('true','false') NOT NULL DEFAULT 'true',
  `purchaseLocations` varchar(256) NOT NULL,
  `purchaseCount` int(11) NOT NULL DEFAULT '0',
  `lastPurchaseDate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sna_foo
-- ----------------------------
INSERT INTO `sna_foo` VALUES ('1000', 'Ramen', 'false', 'Whole Foods', '1', '2015-08-22');
INSERT INTO `sna_foo` VALUES ('1001', 'Pop Tarts', 'false', 'Cub Foods', '1', '2015-07-28');
INSERT INTO `sna_foo` VALUES ('1002', 'Corn Nuts', 'false', 'Cub Foods', '1', '2015-07-28');
INSERT INTO `sna_foo` VALUES ('1003', 'Bagels', 'false', 'Cub Foods', '1', '2015-08-15');
INSERT INTO `sna_foo` VALUES ('1004', 'Wasabi Peas', 'false', 'CVS', '1', '2015-09-15');
INSERT INTO `sna_foo` VALUES ('1005', 'Mixed Nuts', 'false', 'CVS', '1', '2015-08-08');
INSERT INTO `sna_foo` VALUES ('1006', 'Bananas', 'false', 'Whole Foods', '1', '2015-08-12');
INSERT INTO `sna_foo` VALUES ('1007', 'Donuts', 'true', 'Pies & Cakes Bakery', '1', '2014-12-01');
INSERT INTO `sna_foo` VALUES ('1008', 'Spam', 'true', 'Cub Foods', '1', '2014-12-01');
INSERT INTO `sna_foo` VALUES ('1009', 'Pistachios', 'true', 'Cub Foods', '1', '2014-12-01');
INSERT INTO `sna_foo` VALUES ('1010', 'Buckets of M&M\'s', 'true', 'Cub Foods', '1', '2014-10-01');
INSERT INTO `sna_foo` VALUES ('1011', 'Suggestion1', 'true', 'Cub Foods', '0', null);
INSERT INTO `sna_foo` VALUES ('1012', 'Suggestion2', 'true', 'Cub Foods', '0', null);
INSERT INTO `sna_foo` VALUES ('1013', 'Suggestion3', 'true', 'Cub Foods', '0', null);
INSERT INTO `sna_foo` VALUES ('1014', 'test5', '', 'teest', '0', null);

-- ----------------------------
-- Table structure for sna_vote
-- ----------------------------
DROP TABLE IF EXISTS `sna_vote`;
CREATE TABLE `sna_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_month` date NOT NULL,
  `vote_sna_id` int(11) NOT NULL,
  `vote_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_month_id` (`vote_month`,`vote_sna_id`),
  KEY `foreign_sna_id` (`vote_sna_id`),
  CONSTRAINT `foreign_sna_id` FOREIGN KEY (`vote_sna_id`) REFERENCES `sna_foo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sna_vote
-- ----------------------------
INSERT INTO `sna_vote` VALUES ('1', '2015-09-30', '1007', '27');
INSERT INTO `sna_vote` VALUES ('2', '2015-09-30', '1008', '11');
INSERT INTO `sna_vote` VALUES ('3', '2015-09-30', '1009', '39');
INSERT INTO `sna_vote` VALUES ('4', '2015-09-30', '1010', '5');
INSERT INTO `sna_vote` VALUES ('6', '2015-09-30', '1014', '1');
INSERT INTO `sna_vote` VALUES ('7', '2015-09-30', '1012', '1');
