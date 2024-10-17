/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100428
Source Host           : localhost:3306
Source Database       : cajas_db

Target Server Type    : MYSQL
Target Server Version : 100428
File Encoding         : 65001

Date: 2024-07-29 09:41:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cajas
-- ----------------------------
DROP TABLE IF EXISTS `cajas`;
CREATE TABLE `cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_caja` varchar(255) NOT NULL,
  `estado_caja` enum('PENDIENTE','DISPONIBLE','EN TRANSITO') NOT NULL,
  `contenido` longtext DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of cajas
-- ----------------------------
INSERT INTO `cajas` VALUES ('1', 'Prueba', 'PENDIENTE', 'sdfdsfds', '1721836744_d417acda2ccf219b4751.png', null);
INSERT INTO `cajas` VALUES ('2', 'dsfsdfd', 'DISPONIBLE', 'dsfsd', '1721869223_777294dd7df549e68558.png', 'assets\\media\\qrcode\\383538343337.png');
INSERT INTO `cajas` VALUES ('3', 'dsfsdgfdg', 'DISPONIBLE', 'dsfsd', '1721869299_c167ffc97e37a1c4fa33.png', 'assets\\media\\qrcode\\343533323837.png');

-- ----------------------------
-- Table structure for grupos_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `grupos_usuarios`;
CREATE TABLE `grupos_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of grupos_usuarios
-- ----------------------------
INSERT INTO `grupos_usuarios` VALUES ('1', 'SUPER USUARIO');

-- ----------------------------
-- Table structure for movimientos
-- ----------------------------
DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caja_id` int(11) NOT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `fecha_entrada` datetime DEFAULT NULL,
  `paciente` varchar(255) NOT NULL,
  `medico` varchar(255) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `tipo_entrada` enum('Entrada','Salida') NOT NULL,
  `momento_retiro` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_despacho` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `caja_id` (`caja_id`),
  CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of movimientos
-- ----------------------------
INSERT INTO `movimientos` VALUES ('1', '1', '2024-07-25 14:04:00', '0000-00-00 00:00:00', 'sdffdsfsd', 'dsfdf', 'sdfsdf', 'Entrada', '2024-07-17 14:04:00', '2024-07-24 14:04:35', '2024-07-24 14:04:35', 'aaa');
INSERT INTO `movimientos` VALUES ('2', '1', '2024-07-24 00:00:00', '2024-07-25 00:00:00', 'dsf', 'dsfds', 'dsfds', 'Entrada', '2024-07-24 21:23:00', '2024-07-24 21:23:14', '2024-07-24 21:23:14', 'dsfds');

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_usuario_id` int(11) DEFAULT NULL,
  `permiso` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_usuario_id` (`grupo_usuario_id`),
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupos_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES ('2', '1', 'usuarios_permiso');
INSERT INTO `permisos` VALUES ('3', '1', 'grupos_usuarios_permiso');
INSERT INTO `permisos` VALUES ('4', '1', 'permisos_permiso');
INSERT INTO `permisos` VALUES ('5', '1', 'cajas_permiso');
INSERT INTO `permisos` VALUES ('6', '1', 'movimientos_permiso');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `habilitado` tinyint(1) DEFAULT 1,
  `grupo_usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_usuario_id` (`grupo_usuario_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`grupo_usuario_id`) REFERENCES `grupos_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Administrador', 'admin@bioprot.com', '$2y$10$PtJ/OcbPsj8TUN.5va9KqO.T2i.VdGTdVXlJGOLP/GJR6GVV9P3I2', '1', '1');
SET FOREIGN_KEY_CHECKS=1;
