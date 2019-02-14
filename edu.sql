/*
Navicat MySQL Data Transfer

Source Server         : conn1
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : edu

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-20 11:25:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `privince` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `code` int(6) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `default` int(1) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', '2', 'yang1', '河南1', '周口', '舒庄乡', '466132', '1325359829', '1', null, '1540377830', '1537787743', '0');
INSERT INTO `address` VALUES ('2', '2', 'Jessica Rothstein', 'Athlone', 'Cottbus', 'Charlottenstrasse 33', '3026', '355601505', null, null, '1540377830', '1540275162', '0');
INSERT INTO `address` VALUES ('6', '5', 'Jessica Rothstein', '1', 'Cottbus', 'Charlottenstrasse 33', '3026', '355601505', null, null, '1540276807', '1540276807', '0');
INSERT INTO `address` VALUES ('7', '2', 'yang yusheng', '123', 'Cape Town1', 'Cnr Bird and, Cornhill Rd, Athlone, Cape Town, 7764', '7764', '216979320', null, null, '1540384140', '1540375509', '0');
INSERT INTO `address` VALUES ('8', '2', 'Braun Kevin', 'Braun Kevin', 'Jesteburg', 'Gruenauer Strasse 63', '21266', '2147483647', null, null, '1540384124', '1540376713', '0');
INSERT INTO `address` VALUES ('9', '5', 'Braun Kevin', 'Athlone', 'Jesteburg', 'Gruenauer Strasse 63', '21266', '2147483647', null, null, '1540470207', '1540470207', '0');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext CHARACTER SET utf8,
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `is_delete` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '0', '', '<p>欢迎使用ueditor!</p>', '0', '1542594254', '1542594254', '1');
INSERT INTO `article` VALUES ('2', 'test', '', '<p>欢迎使用ueditor!桑桑</p>', '1542038400', '1542594242', '1542594242', '1');
INSERT INTO `article` VALUES ('3', 'test', '', '<p>欢迎使用ueditor!</p>', '0', null, '1542598044', '0');
INSERT INTO `article` VALUES ('4', '哥哥哥他', '33高让狗哥', '<p>欢迎使用ueditor!方法二哥</p>', '1542816000', null, '1542598060', '0');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', '品牌2', '/upload/brand/1/4.gif', '国内知名品牌', '1', '1537002756', '1537263021', null, '0');
INSERT INTO `brand` VALUES ('27', '品牌1', '/upload/brand/27/3.gif', '国内知名品牌', '1', '1537260641', '1537263021', null, '0');
INSERT INTO `brand` VALUES ('28', 'yangyusheng', '/upload/brand/28/4.gif', '东鹏特饮3', '1', '1538148296', '1539315167', null, '0');
INSERT INTO `brand` VALUES ('29', 'yusheng', '/upload/brand/29/1.gif', '789', '1', '1538148313', '1539315158', null, '0');
INSERT INTO `brand` VALUES ('30', '品牌三', '/upload/brand/30/1.gif', '国内知名品牌', '1', '1539315237', '1539315237', null, '0');
INSERT INTO `brand` VALUES ('31', '杨玉胜', '/upload/brand/31/2.gif', 'geg4rh456h', '1', '1539315249', '1539315249', null, '0');
INSERT INTO `brand` VALUES ('32', 'Ralph Strauss', '/upload/brand/32/3.gif', '6', '1', '1539315262', '1539315262', null, '0');
INSERT INTO `brand` VALUES ('33', 'test', '/upload/brand/33/4.gif', '国内知名品牌', '1', '1539315271', '1539315271', null, '0');

-- ----------------------------
-- Table structure for car
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `total` float(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of car
-- ----------------------------
INSERT INTO `car` VALUES ('1', '1', '1', '1', '1.00', '1', '1', null, null, null);
INSERT INTO `car` VALUES ('9', '2', '54', '2', '0.00', '1540265529', '1540276621', null, '0', null);
INSERT INTO `car` VALUES ('10', '2', '55', '3', '33.00', '1540265534', '1540265543', null, '0', null);
INSERT INTO `car` VALUES ('30', '5', '36', '1', '9.00', '1542617104', '1542617104', null, '0', null);

-- ----------------------------
-- Table structure for cata
-- ----------------------------
DROP TABLE IF EXISTS `cata`;
CREATE TABLE `cata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `level` int(1) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cata
-- ----------------------------
INSERT INTO `cata` VALUES ('1', 'top1', '1', '0', '0', null, null, null, '000', '1');
INSERT INTO `cata` VALUES ('2', 'top2', '1', '0', '0', null, null, null, '000', '2');
INSERT INTO `cata` VALUES ('3', '二级1top1', '2', '1', '0', null, null, null, '111', '1100');
INSERT INTO `cata` VALUES ('4', '二级2top1', '2', '1', '0', null, null, null, '111', '1100');

-- ----------------------------
-- Table structure for cate
-- ----------------------------
DROP TABLE IF EXISTS `cate`;
CREATE TABLE `cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `level` int(2) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cate
-- ----------------------------
INSERT INTO `cate` VALUES ('1', '顶级一', '0', '1', '0', null, null, null, null);
INSERT INTO `cate` VALUES ('2', '顶级二', '0', '1', '0', null, null, null, null);
INSERT INTO `cate` VALUES ('3', '顶级三', '0', '1', '0', null, null, null, null);
INSERT INTO `cate` VALUES ('20', '1.1', '1', '2', '0', '1537498867', '1537498867', null, '');
INSERT INTO `cate` VALUES ('21', '1.2', '1', '2', '0', '1537498875', '1537498875', null, '');
INSERT INTO `cate` VALUES ('22', '1.3', '1', '2', '0', '1537498888', '1537498888', null, '');
INSERT INTO `cate` VALUES ('23', '顶级四', '0', '1', '0', '1537499245', '1537499245', null, '');
INSERT INTO `cate` VALUES ('24', '1.1.1', '20', '3', '0', '1537499258', '1537499258', null, '');

-- ----------------------------
-- Table structure for collection
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT NULL,
  `member_id` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `delete_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of collection
-- ----------------------------

-- ----------------------------
-- Table structure for collections
-- ----------------------------
DROP TABLE IF EXISTS `collections`;
CREATE TABLE `collections` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) DEFAULT NULL,
  `member_id` int(10) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `delete_time` int(10) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collections
-- ----------------------------
INSERT INTO `collections` VALUES ('2', '58', '2', '1540198504', '1540198504', null, '0');
INSERT INTO `collections` VALUES ('3', '55', '2', '1540199133', '1540199133', null, '0');
INSERT INTO `collections` VALUES ('4', '36', '2', '1540199467', '1540199467', null, '0');
INSERT INTO `collections` VALUES ('5', '55', '5', '1540276621', '1540276621', null, '0');
INSERT INTO `collections` VALUES ('6', '58', '5', '1540276621', '1540276621', null, '0');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `score` int(1) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '2', '54', '1', '评论一1', '4', '1538151052', null, null, null);
INSERT INTO `comment` VALUES ('2', '2', '55', '1', '评论一2', '5', '1538151052', null, null, null);
INSERT INTO `comment` VALUES ('3', '2', '56', '1', '评论一3', '5', '1538151052', '1538151052', null, null);
INSERT INTO `comment` VALUES ('4', '2', '57', '1', '评论一4', '5', '1538151052', '1538151052', null, null);
INSERT INTO `comment` VALUES ('5', '2', '58', '1', '评论一5', '5', '1538151052', '1538148257', null, null);
INSERT INTO `comment` VALUES ('6', '2', '59', '1', '评论一6', '5', '1538151052', '1538148257', null, null);
INSERT INTO `comment` VALUES ('7', '2', '60', '1', '评论一7', '5', '1538151052', '1538150383', null, null);
INSERT INTO `comment` VALUES ('8', '2', '61', '1', '评论一8', '5', '1538151052', '1538150383', null, null);
INSERT INTO `comment` VALUES ('9', '2', '62', '1', '评论一9', '5', '1538151052', '1538134502', null, null);
INSERT INTO `comment` VALUES ('10', '2', '36', '1', '评论一10', '5', '1538151052', null, null, null);
INSERT INTO `comment` VALUES ('11', '2', '55', '1', '评论一2', '5', '1538151052', null, null, null);
INSERT INTO `comment` VALUES ('24', '2', '58', '1', '', '0', '1539969098', '1539969098', null, '0');
INSERT INTO `comment` VALUES ('25', '2', '58', '1', '', '5', '1539969136', '1539969136', null, '0');
INSERT INTO `comment` VALUES ('26', '2', '58', '1', '发热风', '4', '1540052596', '1540052596', null, '0');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `marketprice` float(10,2) NOT NULL,
  `discount` float(4,2) DEFAULT NULL,
  `saleprice` float(10,2) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `imageurl` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `salednum` int(11) DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `is_delete` int(1) DEFAULT NULL,
  `description` varchar(10000) CHARACTER SET utf8 DEFAULT NULL,
  `evaluation` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `is_comment` int(1) DEFAULT NULL,
  `length` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `width` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `hight` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `origin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `material` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `weight` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cost` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext CHARACTER SET utf8,
  `stock` int(11) DEFAULT '0',
  `is_review` int(1) DEFAULT NULL,
  `start` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('36', '1', '11.21', '9.00', '10.00', null, '/upload/goods/36/1539256374.png,/upload/goods/36/1539256375.png,/upload/goods/36/1539256376.png,/upload/goods/36/1539256377.png,', '100', '1', null, '0', '1', '0', '商品简介', null, '1539787743', '1539256374', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '13', '0', '1');
INSERT INTO `goods` VALUES ('54', '产品1', '100.00', '10.00', '87.50', null, '/upload/goods/54/1539256353.png,/upload/goods/54/1539256354.png,/upload/goods/54/1539256355.png,/upload/goods/54/1539256356.png,', '23', '1', null, '1', '1', '0', '商品简介', null, '1538704728', '1539256353', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '43', '0', '1');
INSERT INTO `goods` VALUES ('55', '产品2', '200.00', '5.00', '66.00', null, '/upload/goods/55/1539256338.png,/upload/goods/55/1539256339.png,/upload/goods/55/1539256340.png,/upload/goods/55/1539256341.png,', '56', '1', null, '1', '1', '0', '商品简介', null, '1538704970', '1539256338', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '232', '0', '0');
INSERT INTO `goods` VALUES ('56', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '20', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('57', '产品5', '400.00', '6.00', '389.00', null, '/upload/goods/57/1539256306.png,/upload/goods/57/1539256307.png,/upload/goods/57/1539256308.png,/upload/goods/57/1539256309.png,', '67', '24', null, '1', '1', '0', '商品简介', null, '1538706681', '1539256306', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '45', '0', '0');
INSERT INTO `goods` VALUES ('58', '产品6', '500.00', '2.00', '400.00', null, '/upload/goods/58/1539256277.png,/upload/goods/58/1539256278.png,/upload/goods/58/1539256279.png,/upload/goods/58/1539256280.png,', '23', '21', null, '1', '1', '0', '商品简介', null, '1538706712', '1539256277', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '343', '0', '1');
INSERT INTO `goods` VALUES ('59', '产品7', '600.00', '7.00', '333.00', null, '/upload/goods/59/1539256261.png,/upload/goods/59/1539256262.png,/upload/goods/59/1539256263.png,/upload/goods/59/1539256264.png,', '89', '22', null, '0', '1', '0', '商品简介', null, '1538706745', '1539256261', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '756', '0', '0');
INSERT INTO `goods` VALUES ('60', '产品8', '700.00', '3.00', '444.00', null, '/upload/goods/60/1539256241.png,/upload/goods/60/1539256242.png,/upload/goods/60/1539256243.png,/upload/goods/60/1539256244.png,', '111', '2', null, '27', '1', '0', '商品简介', null, '1538706784', '1539256241', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '232', '0', '1');
INSERT INTO `goods` VALUES ('61', '产品9', '800.00', '7.00', '567.00', null, '/upload/goods/61/1539256222.png,/upload/goods/61/1539256223.png,/upload/goods/61/1539256224.png,/upload/goods/61/1539256225.png,', '756', '3', null, '1', '1', '0', '商品简介', null, '1538706811', '1539256222', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '3453', '0', '0');
INSERT INTO `goods` VALUES ('62', '产品10', '900.00', '6.60', '234.00', null, '/upload/goods/62/1539256203.png,/upload/goods/62/1539256204.png,/upload/goods/62/1539256205.png,/upload/goods/62/1539256206.png,', '50', '23', null, '1', '1', '0', '商品简介', null, '1538706836', '1539256203', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '234', '0', '1');
INSERT INTO `goods` VALUES ('63', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '20', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('64', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('65', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('66', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('67', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '1', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('68', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '1', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('69', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('70', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('71', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('72', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('73', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '20', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');
INSERT INTO `goods` VALUES ('74', '产品3', '300.00', '8.00', '90.00', null, '/upload/goods/56/1539256322.png,/upload/goods/56/1539256323.png,/upload/goods/56/1539256324.png,/upload/goods/56/1539256325.png,', '11', '3', null, '27', '1', '0', '商品简介', null, '1538705023', '1539256322', null, '0', '1', '', '', '', '', '', '', '', '', '0', '0', '', null, '2534', '0', '1');

-- ----------------------------
-- Table structure for grade
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `length` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL,
  `student_id` int(9) NOT NULL,
  `price` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES ('1', '高一（1）班', '4', '0', '1535639915', '1535783938', null, '0', '1', '10000');
INSERT INTO `grade` VALUES ('2', '高一（2）班', '5', '0', '0', '1535963106', null, '0', '2', '1234');
INSERT INTO `grade` VALUES ('3', 'ceshi', '1', '1', '1535793406', '1535793406', null, '0', '0', '1000');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `photoname` varchar(255) DEFAULT NULL,
  `sex` int(1) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code` int(6) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` int(16) DEFAULT NULL,
  `score` int(10) DEFAULT NULL,
  `level_id` int(2) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `ip` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `login_count` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('2', 'yang', '21232f297a57a5a743894a0e4a801fc3', 'yang', null, '2', '18', 'Cnr Bird and, Cornhill Rd, Athlone, Cape Town, 7764', '201000', '1611337277@qq.com', '216979320', '12666', '3', '1536663725', '1536663725', null, '1', '1540377252', null, '0', null);
INSERT INTO `member` VALUES ('3', 'admin', '202cb962ac59075b964b07152d234b70', 'admin', null, '2', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '1', '1536723531', null, null, '1', '1540377252', null, '0', '0');
INSERT INTO `member` VALUES ('4', 'admin1', 'c20ad4d76fe97759aa27a0c99bff6710', 'admin', null, '0', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536724016', null, null, '1', '1540377252', null, '0', '0');
INSERT INTO `member` VALUES ('5', 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '0', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750602', null, null, '1', '1542616595', null, '0', '0');
INSERT INTO `member` VALUES ('6', 'admin3', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750608', null, null, '1', '1536750608', null, '0', '0');
INSERT INTO `member` VALUES ('7', 'admin4', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '1', '1536750613', null, null, '1', '1536753924', null, '0', '0');
INSERT INTO `member` VALUES ('8', 'admin5', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '0', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750623', null, null, '1', '1536750623', null, '0', '0');
INSERT INTO `member` VALUES ('9', 'admin6', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750627', null, null, '1', '1536750627', null, '0', '0');
INSERT INTO `member` VALUES ('10', 'admin7', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750633', null, null, '1', '1536750633', null, '0', '0');
INSERT INTO `member` VALUES ('11', 'admin8', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '0', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750637', null, null, '1', '1540377252', null, '0', '0');
INSERT INTO `member` VALUES ('12', 'admin9', '21232f297a57a5a743894a0e4a801fc3', 'admin', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', '0', '0', '1536750642', null, null, '1', '1540377252', null, '0', '0');
INSERT INTO `member` VALUES ('13', 'yang1234', 'e10adc3949ba59abbe56e057f20f883e', '123456', null, '1', null, 'Gruenauer Strasse 63', null, 'shun0006@labari.eu', '2147483647', null, null, '1539857706', null, null, '1', '1541068586', null, '0', '0');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL,
  `member_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `payment` int(2) DEFAULT NULL,
  `delivery` int(2) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `is_delete` int(1) DEFAULT NULL,
  `numbers` varchar(200) DEFAULT NULL,
  `goods_ids` varchar(255) DEFAULT NULL,
  `is_pay` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1538048006', '0', null, null, '1');
INSERT INTO `order` VALUES ('2', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1540470030', '0', null, null, '1');
INSERT INTO `order` VALUES ('3', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1538048006', '0', null, null, '0');
INSERT INTO `order` VALUES ('4', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1538048006', '0', null, null, '0');
INSERT INTO `order` VALUES ('5', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1538048006', '0', null, null, '1');
INSERT INTO `order` VALUES ('6', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1538048006', '0', null, null, '0');
INSERT INTO `order` VALUES ('7', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1540470030', '0', null, null, '0');
INSERT INTO `order` VALUES ('8', '1', '2', '1', '2', '2', '1001', '1537787743', null, '1540470030', '0', null, null, '0');
INSERT INTO `order` VALUES ('9', '1', '0', '6', '1', '1', '305', '1540291013', null, '1540291013', '0', '1,1,1,', '56,57,54,', '0');
INSERT INTO `order` VALUES ('10', '1', '5', '6', '1', '1', '305', '1540291165', null, '1540291165', '0', '1,1,1,', '56,57,54,', '1');
INSERT INTO `order` VALUES ('11', '1', '5', '6', '1', '1', '305', '1540291891', null, '1540291891', '0', '1,1,1,', '56,57,54,', '0');
INSERT INTO `order` VALUES ('12', '1', '5', '6', '1', '1', '130', '1540292173', null, '1540292173', '0', '1,1,1,', '36,54,55,', '0');
INSERT INTO `order` VALUES ('13', '1', '5', '6', '1', '1', '426', '1540295621', null, '1540295621', '0', '1,1,1,1,', '54,55,56,57,', '0');
INSERT INTO `order` VALUES ('14', '1', '5', '6', '1', '1', '193', '1540296190', null, '1540296190', '0', '1,1,1,', '54,55,56,', '0');
INSERT INTO `order` VALUES ('15', '0', '5', '6', '1', '1', '97', null, null, null, null, '1,1,', '36,54,', '1');
INSERT INTO `order` VALUES ('16', '0', '5', '6', '1', '1', '193', null, null, null, null, '1,1,1,', '54,55,56,', '1');
INSERT INTO `order` VALUES ('17', '0', '5', '6', '1', '1', '193', null, null, '1540470030', '0', '1,1,1,', '54,55,56,', '1');

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `sex` int(1) NOT NULL,
  `age` int(2) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `start_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL,
  `grade_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------

-- ----------------------------
-- Table structure for teacher
-- ----------------------------
DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) NOT NULL,
  `degree` varchar(12) NOT NULL,
  `phone` int(11) NOT NULL,
  `school` varchar(12) NOT NULL,
  `hiredate` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `grade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacher
-- ----------------------------
INSERT INTO `teacher` VALUES ('1', 'YANG', '本科', '123', 'q中学', '1535732548', '0', '0', null, '0', '1', '1');
INSERT INTO `teacher` VALUES ('2', 'yu', '', '0', '', '0', '0', '0', null, '0', '0', '2');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(25) NOT NULL,
  `role` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `login_count` int(10) DEFAULT NULL,
  `is_delete` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1611337277@qq.com', '1', '1', '1535162577', '1535162577', null, '1535162577', '28', '0');
INSERT INTO `user` VALUES ('2', 'yang', '57cb5a26334a6c1d5e27c49def4a0f0d', '1611337277@qq.com', '0', '1', '1535162664', '1537094957', null, '1535162664', '3', '1');
INSERT INTO `user` VALUES ('3', 'yangyushen', 'c4ca4238a0b923820dcc509a6f75849b', '2914168379@qq.com', '0', '1', '1538151012', '1538151179', '1538151179', null, '0', '1');
INSERT INTO `user` VALUES ('4', 'yusheng', '3efddd6889e58cbaef31a72c2575b214', '29141683791@qq.com', '0', '1', '1538151043', '1538151179', '1538151179', null, '0', '1');
