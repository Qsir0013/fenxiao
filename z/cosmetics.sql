/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cosmetics

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-07-24 09:36:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fen_address
-- ----------------------------
DROP TABLE IF EXISTS `fen_address`;
CREATE TABLE `fen_address` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '对应的用户id',
  `name` varchar(255) NOT NULL COMMENT '收件人',
  `phone` bigint(10) unsigned NOT NULL COMMENT '手机号',
  `address` longtext NOT NULL COMMENT '地址',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_address
-- ----------------------------
INSERT INTO `fen_address` VALUES ('9', '9', 'zhansgsan', '15899776548', '北京', '2018-07-21 17:01:57');
INSERT INTO `fen_address` VALUES ('8', '2', '张三', '15898789965', '上海', '2018-07-20 09:39:55');
INSERT INTO `fen_address` VALUES ('22', '11', 'luow', '0', '艾泽拉斯', '2018-07-23 15:34:29');
INSERT INTO `fen_address` VALUES ('20', '10', '1', '0', '1', '2018-07-23 14:12:43');
INSERT INTO `fen_address` VALUES ('21', '10', '2', '0', '2', '2018-07-23 14:16:52');
INSERT INTO `fen_address` VALUES ('23', '11', '粑粑', '0', '艾泽拉斯 东部王国 黑石山', '2018-07-23 15:34:54');
INSERT INTO `fen_address` VALUES ('24', '11', '粑粑', '0', '艾泽拉斯 东部王国 黑石山', '2018-07-23 15:35:07');
INSERT INTO `fen_address` VALUES ('25', '12', '1', '1', '1', '2018-07-23 17:12:45');
INSERT INTO `fen_address` VALUES ('26', '13', '1', '1', '1', '2018-07-23 17:25:17');
INSERT INTO `fen_address` VALUES ('27', '14', '1', '1', '1', '2018-07-23 17:26:31');
INSERT INTO `fen_address` VALUES ('28', '15', '1', '1', '1', '2018-07-23 17:27:30');
INSERT INTO `fen_address` VALUES ('29', '16', '1', '1', '1', '2018-07-23 17:29:39');
INSERT INTO `fen_address` VALUES ('30', '17', '1', '1', '1', '2018-07-23 17:32:45');

-- ----------------------------
-- Table structure for fen_admin
-- ----------------------------
DROP TABLE IF EXISTS `fen_admin`;
CREATE TABLE `fen_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `passwd` varchar(255) NOT NULL COMMENT '用户密码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `login_time` datetime NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_admin
-- ----------------------------
INSERT INTO `fen_admin` VALUES ('1', '123', '202cb962ac59075b964b07152d234b70', '2018-06-10 22:38:26', '2018-07-21 19:30:23');

-- ----------------------------
-- Table structure for fen_agent
-- ----------------------------
DROP TABLE IF EXISTS `fen_agent`;
CREATE TABLE `fen_agent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(255) NOT NULL COMMENT '代理名称',
  `discount` varchar(255) NOT NULL COMMENT '优惠',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_agent
-- ----------------------------
INSERT INTO `fen_agent` VALUES ('1', '无代理', '100', '2018-07-20 15:05:24');
INSERT INTO `fen_agent` VALUES ('2', '特约代理', '100', '2018-07-21 15:37:38');
INSERT INTO `fen_agent` VALUES ('3', '金牌代理', '85', '2018-07-21 15:37:57');
INSERT INTO `fen_agent` VALUES ('4', '核心代理', '80', '2018-07-21 15:38:07');
INSERT INTO `fen_agent` VALUES ('5', '总代', '70', '2018-07-21 15:38:18');
INSERT INTO `fen_agent` VALUES ('6', '官方代理', '60', '2018-07-21 15:38:37');
INSERT INTO `fen_agent` VALUES ('7', '大咖代理', '50', '2018-07-21 15:38:45');

-- ----------------------------
-- Table structure for fen_order
-- ----------------------------
DROP TABLE IF EXISTS `fen_order`;
CREATE TABLE `fen_order` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `number` bigint(20) NOT NULL COMMENT '订单号',
  `pro` int(10) unsigned NOT NULL COMMENT '对应的商品',
  `num` tinyint(3) unsigned NOT NULL COMMENT '商品总数',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '对应的用户',
  `address_id` bigint(20) unsigned NOT NULL COMMENT '对应的地址',
  `total` int(255) unsigned NOT NULL COMMENT '总价格',
  `logistics_static` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '物流状态  0未发货 1已发货 2已收货',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '状态 审核中2  通过1 未通过0',
  `pid` int(11) DEFAULT '0' COMMENT '通过审核者id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_order
-- ----------------------------
INSERT INTO `fen_order` VALUES ('8', '12321321', '1', '2', '3', '1', '11776', '1', '2018-07-19 09:48:31', '1', '6');
INSERT INTO `fen_order` VALUES ('9', '23213213', '1', '2', '2', '1', '11776', '1', '2018-07-19 09:48:31', '0', '2');
INSERT INTO `fen_order` VALUES ('10', '2018071997485150', '1', '3', '3', '1', '17664', '1', '2018-07-19 17:43:38', '1', '6');
INSERT INTO `fen_order` VALUES ('85', '2018072354101565', '1', '1', '10', '20', '0', '0', '2018-07-23 15:39:34', '2', '0');
INSERT INTO `fen_order` VALUES ('36', '2018072149521005', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:08:01', '2', '0');
INSERT INTO `fen_order` VALUES ('37', '2018072148101514', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:09:04', '2', '0');
INSERT INTO `fen_order` VALUES ('38', '2018072110148501', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:18:22', '2', '0');
INSERT INTO `fen_order` VALUES ('39', '2018072197555448', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:19:06', '2', '0');
INSERT INTO `fen_order` VALUES ('40', '2018072110056519', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:40:45', '2', '0');
INSERT INTO `fen_order` VALUES ('41', '2018072197549851', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:42:34', '2', '0');
INSERT INTO `fen_order` VALUES ('42', '2018072153529753', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:46:29', '2', '0');
INSERT INTO `fen_order` VALUES ('43', '2018072152515549', '4', '1', '2', '8', '2944', '0', '2018-07-21 16:48:36', '2', '0');
INSERT INTO `fen_order` VALUES ('44', '2018072151535750', '4', '1', '2', '8', '2944', '0', '2018-07-21 17:18:43', '2', '0');
INSERT INTO `fen_order` VALUES ('45', '2018072156535457', '4', '1', '2', '8', '2944', '0', '2018-07-21 17:20:40', '2', '0');
INSERT INTO `fen_order` VALUES ('46', '2018072152554910', '4', '1', '2', '8', '2944', '0', '2018-07-21 17:22:44', '2', '0');
INSERT INTO `fen_order` VALUES ('47', '201807211019947', '4', '1', '2', '8', '2944', '1', '2018-07-21 17:26:22', '2', '0');
INSERT INTO `fen_order` VALUES ('48', '2018072110210010', '5', '1', '2', '8', '6', '0', '2018-07-21 17:29:03', '2', '0');
INSERT INTO `fen_order` VALUES ('49', '2018072153551005', '4', '1', '2', '8', '2944', '0', '2018-07-21 17:29:57', '2', '0');
INSERT INTO `fen_order` VALUES ('50', '2018072149991005', '4', '1', '2', '8', '3533', '0', '2018-07-21 17:49:05', '2', '0');
INSERT INTO `fen_order` VALUES ('51', '2018072155481009', '5', '1', '2', '8', '7', '0', '2018-07-21 17:52:39', '2', '0');
INSERT INTO `fen_order` VALUES ('52', '2018072110156495', '4', '1', '2', '8', '3533', '0', '2018-07-21 18:29:34', '0', '2');
INSERT INTO `fen_order` VALUES ('53', '2018072110049102', '4', '1', '2', '8', '3533', '0', '2018-07-21 18:32:13', '0', '2');
INSERT INTO `fen_order` VALUES ('86', '2018072348569953', '1', '1', '10', '20', '0', '0', '2018-07-23 15:43:12', '2', '0');
INSERT INTO `fen_order` VALUES ('87', '2018072310110051', '1', '1', '10', '20', '0', '0', '2018-07-23 15:45:18', '2', '0');
INSERT INTO `fen_order` VALUES ('88', '2018072310254525', '1', '1', '10', '20', '0', '0', '2018-07-23 15:49:35', '2', '0');
INSERT INTO `fen_order` VALUES ('89', '2018072353575098', '1', '1', '10', '20', '0', '0', '2018-07-23 15:50:13', '2', '0');
INSERT INTO `fen_order` VALUES ('90', '2018072352579948', '1', '1', '10', '20', '0', '0', '2018-07-23 16:08:04', '2', '0');
INSERT INTO `fen_order` VALUES ('91', '2018072310152505', '1', '1', '10', '20', '0', '0', '2018-07-23 16:09:18', '2', '0');
INSERT INTO `fen_order` VALUES ('92', '2018072356975610', '1', '1', '10', '20', '0', '0', '2018-07-23 16:10:00', '2', '0');
INSERT INTO `fen_order` VALUES ('93', '2018072310252971', '1', '1', '10', '20', '0', '0', '2018-07-23 16:10:55', '2', '0');
INSERT INTO `fen_order` VALUES ('94', '2018072310156984', '1', '1', '10', '20', '0', '0', '2018-07-23 16:14:22', '2', '0');
INSERT INTO `fen_order` VALUES ('95', '2018072352100102', '1', '1', '10', '20', '0', '0', '2018-07-23 16:15:16', '2', '0');
INSERT INTO `fen_order` VALUES ('96', '2018072350509956', '1', '1', '10', '20', '0', '0', '2018-07-23 16:16:18', '2', '0');
INSERT INTO `fen_order` VALUES ('97', '2018072399555150', '1', '1', '10', '20', '0', '0', '2018-07-23 16:17:00', '2', '0');
INSERT INTO `fen_order` VALUES ('98', '2018072310298575', '1', '1', '10', '20', '0', '0', '2018-07-23 16:18:23', '2', '0');
INSERT INTO `fen_order` VALUES ('99', '2018072351514853', '1', '1', '10', '20', '0', '0', '2018-07-23 16:20:35', '2', '0');
INSERT INTO `fen_order` VALUES ('100', '2018072397565510', '1', '1', '10', '20', '0', '0', '2018-07-23 16:21:14', '2', '0');
INSERT INTO `fen_order` VALUES ('101', '2018072310198539', '1', '1', '10', '20', '0', '0', '2018-07-23 16:22:54', '2', '0');
INSERT INTO `fen_order` VALUES ('102', '2018072353995653', '1', '1', '10', '20', '0', '0', '2018-07-23 16:25:57', '2', '0');
INSERT INTO `fen_order` VALUES ('103', '2018072310010252', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:27:42', '2', '0');
INSERT INTO `fen_order` VALUES ('104', '2018072350525149', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:30:26', '2', '0');
INSERT INTO `fen_order` VALUES ('105', '2018072352559848', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:31:00', '2', '0');
INSERT INTO `fen_order` VALUES ('106', '2018072348565548', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:32:48', '2', '0');
INSERT INTO `fen_order` VALUES ('107', '2018072310010249', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:37:33', '2', '0');
INSERT INTO `fen_order` VALUES ('108', '2018072357551014', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:39:53', '2', '0');
INSERT INTO `fen_order` VALUES ('109', '2018072351491025', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:42:43', '2', '0');
INSERT INTO `fen_order` VALUES ('110', '2018072310149515', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:44:46', '2', '0');
INSERT INTO `fen_order` VALUES ('111', '2018072353505055', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:45:25', '2', '0');
INSERT INTO `fen_order` VALUES ('112', '2018072350985249', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:47:14', '2', '0');
INSERT INTO `fen_order` VALUES ('113', '2018072310151100', '1', '1', '10', '20', '5888', '0', '2018-07-23 16:49:50', '2', '0');

-- ----------------------------
-- Table structure for fen_pro
-- ----------------------------
DROP TABLE IF EXISTS `fen_pro`;
CREATE TABLE `fen_pro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `title` varchar(255) NOT NULL COMMENT '产品名称',
  `price` varchar(255) NOT NULL COMMENT '产品市场价格',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后创建时间',
  `banner` varchar(255) NOT NULL COMMENT '缩略图',
  `content` varchar(255) NOT NULL COMMENT '详情',
  `num` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '点击量',
  `des` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_pro
-- ----------------------------
INSERT INTO `fen_pro` VALUES ('1', 'iPhone', '5888', '2018-07-23 10:12:39', './uploads/123.jpg', './uploads/123.jpg', '0', '银色 黑色');

-- ----------------------------
-- Table structure for fen_transaction
-- ----------------------------
DROP TABLE IF EXISTS `fen_transaction`;
CREATE TABLE `fen_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '序号',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '对应的用户',
  `event` varchar(255) NOT NULL COMMENT '事件',
  `money` bigint(20) unsigned NOT NULL COMMENT '金额',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_transaction
-- ----------------------------
INSERT INTO `fen_transaction` VALUES ('1', '3', '购买商品:支出17664元', '17664', '2018-07-19 18:50:01');
INSERT INTO `fen_transaction` VALUES ('2', '3', '购买商品:支出17664元', '17664', '2018-07-19 18:50:19');
INSERT INTO `fen_transaction` VALUES ('3', '3', '购买商品:支出17664元', '17664', '2018-07-19 18:59:50');
INSERT INTO `fen_transaction` VALUES ('4', '3', '购买商品:支出17664元', '17664', '2018-07-19 19:00:11');
INSERT INTO `fen_transaction` VALUES ('5', '3', '购买商品:支出17664元', '17664', '2018-07-20 09:47:04');
INSERT INTO `fen_transaction` VALUES ('6', '2', '购买商品:支出2944元', '2944', '2018-07-21 16:46:51');
INSERT INTO `fen_transaction` VALUES ('7', '2', '购买商品:支出2944元', '2944', '2018-07-21 17:30:07');
INSERT INTO `fen_transaction` VALUES ('8', '2', '购买商品:支出3533元', '3533', '2018-07-21 17:49:10');
INSERT INTO `fen_transaction` VALUES ('9', '2', '购买商品:支出7元', '7', '2018-07-21 17:52:42');
INSERT INTO `fen_transaction` VALUES ('10', '2', '购买商品:支出3533元', '3533', '2018-07-21 18:32:15');
INSERT INTO `fen_transaction` VALUES ('11', '2', '获得返利:收入2944元', '2944', '2018-07-23 13:15:10');
INSERT INTO `fen_transaction` VALUES ('12', '2', '获得返利:收入2944元', '2944', '2018-07-23 13:16:25');
INSERT INTO `fen_transaction` VALUES ('13', '2', '获得返利:收入4416元', '4416', '2018-07-23 13:19:43');
INSERT INTO `fen_transaction` VALUES ('14', '2', '获得返利:收入0元', '0', '2018-07-23 13:20:00');
INSERT INTO `fen_transaction` VALUES ('15', '10', '购买商品:支出5888元', '5888', '2018-07-23 16:29:39');

-- ----------------------------
-- Table structure for fen_user
-- ----------------------------
DROP TABLE IF EXISTS `fen_user`;
CREATE TABLE `fen_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `wxname` varchar(255) NOT NULL COMMENT '微信昵称',
  `username` varchar(255) NOT NULL COMMENT '姓名',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别 1男 2女 0未知',
  `openid` varchar(255) NOT NULL DEFAULT '' COMMENT '用户的openid',
  `img` varchar(255) NOT NULL COMMENT '用户头像',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `login_time` datetime NOT NULL COMMENT '最后登录时间',
  `phone` tinyint(11) unsigned NOT NULL COMMENT '手机号',
  `idcode` varchar(255) NOT NULL COMMENT '身份证号码',
  `weicode` varchar(255) NOT NULL COMMENT '微信号',
  `agent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '对应的代理角色',
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '对应的父级',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '角色 1平台管理员 0普通用户',
  `static` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '审核状态 1通过 0拒绝 2审核中',
  `money` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '余额',
  `balance` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '返利余额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fen_user
-- ----------------------------
INSERT INTO `fen_user` VALUES ('2', '', 'zhansgsan', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '6', '2', '0', '1', '8114513349', '10324');
INSERT INTO `fen_user` VALUES ('3', '', '李四', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '4', '2', '0', '1', '8544473889', '1472');
INSERT INTO `fen_user` VALUES ('4', '', '王五', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '3', '2', '0', '0', '0', '0');
INSERT INTO `fen_user` VALUES ('5', '', '小红', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '1', '4', '0', '1', '0', '0');
INSERT INTO `fen_user` VALUES ('6', '', '小花', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '2', '5', '0', '1', '0', '0');
INSERT INTO `fen_user` VALUES ('7', '', '小绿', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '3', '6', '0', '1', '0', '0');
INSERT INTO `fen_user` VALUES ('8', '', '小白', '1', 'dsadasdasd', '', '2018-07-18 17:36:42', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '2', '7', '0', '1', '0', '0');
INSERT INTO `fen_user` VALUES ('9', '', 'zhansgsan', '0', '', '', '2018-07-21 17:01:57', '0000-00-00 00:00:00', '255', '455879633548765489', 'dsad_12123', '2', '4', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('10', 'wded', '', '0', 'oHpuZ5Ths0LY6GDWEVBybZ6RfnxI', 'http:sdafadsfdsf', '2018-07-21 17:56:00', '0000-00-00 00:00:00', '0', '', '', '2', '0', '0', '2', '245276780988', '8678768767');
INSERT INTO `fen_user` VALUES ('11', '亦余心之所善兮', '', '1', 'oHpuZ5SkuEOjWq9p6wF1qZryNbyk', 'https://wx.qlogo.cn/mmopen/vi_32/7NmY3zMy6k2zFxcA5fusAnJbZuTxjvI6jVylusn95PNkKdwxH6JSAIoVPttburnMlzz2uxXM4GsWgnQmqkUlFg/132', '2018-07-21 19:47:08', '0000-00-00 00:00:00', '0', '', '', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('12', '', '1', '0', '', '', '2018-07-23 17:12:45', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('13', '', '1', '0', '', '', '2018-07-23 17:25:17', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('14', '', '1', '0', '', '', '2018-07-23 17:26:31', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('15', '', '1', '0', '', '', '2018-07-23 17:27:30', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('16', '', '1', '0', '', '', '2018-07-23 17:29:39', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
INSERT INTO `fen_user` VALUES ('17', '', '1', '0', '', '', '2018-07-23 17:32:45', '0000-00-00 00:00:00', '1', '1', '1', '0', '0', '0', '2', '0', '0');
