/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100316
 Source Host           : 127.0.0.1:3306
 Source Schema         : catatan_keuangan

 Target Server Type    : MySQL
 Target Server Version : 100316
 File Encoding         : 65001

 Date: 14/11/2020 16:08:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` enum('in','out') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'in',
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'deposito', 'in', NULL);
INSERT INTO `categories` VALUES (2, 'deviden', 'in', NULL);
INSERT INTO `categories` VALUES (3, 'gaji', 'in', NULL);
INSERT INTO `categories` VALUES (4, 'hibah', 'in', NULL);
INSERT INTO `categories` VALUES (5, 'invenstasi', 'out', NULL);
INSERT INTO `categories` VALUES (6, 'pengemalian dana', 'in', NULL);
INSERT INTO `categories` VALUES (7, 'penjualan', 'in', NULL);
INSERT INTO `categories` VALUES (8, 'penyewaan', 'in', NULL);
INSERT INTO `categories` VALUES (9, 'dan lain-lain', 'in', NULL);
INSERT INTO `categories` VALUES (10, 'belanja umum', 'out', NULL);
INSERT INTO `categories` VALUES (11, 'cemilan dan jajan', 'out', NULL);
INSERT INTO `categories` VALUES (12, 'elektronik', 'out', NULL);
INSERT INTO `categories` VALUES (13, 'fashion', 'out', NULL);
INSERT INTO `categories` VALUES (14, 'hiburan', 'out', NULL);
INSERT INTO `categories` VALUES (15, 'kesehatan', 'out', NULL);
INSERT INTO `categories` VALUES (16, 'lain-lain', 'out', NULL);
INSERT INTO `categories` VALUES (17, 'makanan', 'out', NULL);
INSERT INTO `categories` VALUES (18, 'pendidikan', 'out', NULL);
INSERT INTO `categories` VALUES (19, 'tagihan', 'out', NULL);
INSERT INTO `categories` VALUES (20, 'transportasi', 'out', NULL);
INSERT INTO `categories` VALUES (21, 'aaa aye joss', 'in', NULL);

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `value` int(11) NULL DEFAULT NULL,
  `deleted_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES (1, 'box', 7, 12000, NULL);
INSERT INTO `logs` VALUES (2, 'box', 1, 1000, NULL);
INSERT INTO `logs` VALUES (3, 'box', 1, 9000, NULL);
INSERT INTO `logs` VALUES (4, 'test', 3, 6000000, NULL);
INSERT INTO `logs` VALUES (5, 'beras', 10, 10000, NULL);
INSERT INTO `logs` VALUES (6, 'gula', 10, 12500, NULL);
INSERT INTO `logs` VALUES (7, 'meja lesehan', 21, 6000000, NULL);
INSERT INTO `logs` VALUES (8, 'BCA', 2, 2000, NULL);
INSERT INTO `logs` VALUES (9, 'meja lesehan', 16, 100000, '2020-11-11 05:25:15');
INSERT INTO `logs` VALUES (10, 'test', 3, 10000000, NULL);
INSERT INTO `logs` VALUES (11, 'disko', 14, 100000, NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `session` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'neneng', '$2y$10$eBCW5JZRIz0J4T5k6G0iZ.QwjIyy6ZVjD/QIrJlUpMI7TahZ9Q6Mu', 'S5GdeT268ppST9HuXcMIL7mfxdeCBMNMOzMD8s9UBvWg0Oktqf');

SET FOREIGN_KEY_CHECKS = 1;
