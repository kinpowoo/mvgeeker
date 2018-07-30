/*
 Navicat Premium Data Transfer

 Source Server         : kinpowoo
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : imooc

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 10/26/2017 23:00:54 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `source`
-- ----------------------------
DROP TABLE IF EXISTS `source`;
CREATE TABLE `source` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varbinary(60) DEFAULT NULL,
  `cloud` varbinary(200) DEFAULT NULL,
  `magnet` varbinary(500) DEFAULT NULL,
  `size` varbinary(20) DEFAULT NULL,
  `publishTime` datetime DEFAULT NULL,
  `pic1` varbinary(255) DEFAULT NULL,
  `pic2` varbinary(255) DEFAULT NULL,
  `pic3` varbinary(255) DEFAULT NULL,
  `description` varbinary(500) DEFAULT NULL,
  `createTime` int(11) DEFAULT NULL,
  `author` varbinary(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
