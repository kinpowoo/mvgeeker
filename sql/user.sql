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

 Date: 10/26/2017 23:01:01 PM
*/

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `token` varchar(50) NOT NULL COMMENT '帐号激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0-未激活,1-已激活',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
