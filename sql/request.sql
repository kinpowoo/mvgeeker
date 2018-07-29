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

 Date: 10/26/2017 23:00:47 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `request`
-- ----------------------------
DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varbinary(50) DEFAULT NULL,
  `type` varbinary(10) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `count` int(11) DEFAULT '1',
  `createTime` int(11) DEFAULT NULL,
  `author` varbinary(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
