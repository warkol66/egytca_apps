-- phpMyAdmin SQL Dump
-- version 2.6.4-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 23, 2006 at 03:11 PM
-- Server version: 4.1.13
-- PHP Version: 4.3.11
-- 
-- Database: `flamecar_sistemaayuda`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `MOD_MODULOS`
-- 

DROP TABLE IF EXISTS `MOD_MODULOS`;
CREATE TABLE `MOD_MODULOS` (
  `ID_MODULO` int(3) NOT NULL auto_increment,
  `NOMBRE` varchar(30) default NULL,
  `DESCRIPCION` text,
  `DIRECTORIO` varchar(15) default NULL,
  `ACTIVO` int(11) NOT NULL default '0',
  UNIQUE KEY `ID_MODULO` (`ID_MODULO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `MOD_MODULOS`
-- 

INSERT INTO `MOD_MODULOS` VALUES (1, 'Login', 'Administra el ingreso de usuarios al sitio', 'login', 1);
INSERT INTO `MOD_MODULOS` VALUES (2, 'Parámetros del Sistema', 'Administra los parámetros de configuración del sistema.', 'parametros', 1);
INSERT INTO `MOD_MODULOS` VALUES (3, 'Menú', 'Administra las acciones permitidas por cada tipo de usuario y genera el menú en forma automática en función de esos mismos permisos', 'menu', 1);
INSERT INTO `MOD_MODULOS` VALUES (4, 'Histórico de Transacciones', 'Administra el registro histórico de transacciones.', 'logs', 1);
INSERT INTO `MOD_MODULOS` VALUES (5, 'Concesionarios', 'Administra los datos de los concesionarios', 'concesionarios', 1);
INSERT INTO `MOD_MODULOS` VALUES (6, 'Usuarios', 'Administra los usuarios del sistema. (Requiere Módulo Concesionarios)', 'usuarios', 1);
INSERT INTO `MOD_MODULOS` VALUES (7, 'Maestro', 'Administra el maestro de las características de Unidades', 'maestro', 1);
INSERT INTO `MOD_MODULOS` VALUES (8, 'Unidades', 'Administra maestro de unidades y sus respectivas solicitudes.', 'unidades', 1);
INSERT INTO `MOD_MODULOS` VALUES (9, 'Repuestos', 'Administra maestro de repuestos y sus respectivas solicitudes de repuestos', 'repuestos', 1);
INSERT INTO `MOD_MODULOS` VALUES (10, 'Stock de Repuestos', 'Administra el maestro de partes para el Módulo de Búsqueda de Partes.', 'stock', 1);
INSERT INTO `MOD_MODULOS` VALUES (11, 'Búsqueda de Partes', 'Administra búsquedas sobre la base de repuestos de los concesionarios. Requiere del Módulo Stock de Repuestos', 'busquedas', 1);
INSERT INTO `MOD_MODULOS` VALUES (12, 'Solicitud de Repuestos', 'Administra solicitudes de Repuestos de la base de partes de los concesionarios', 'solicitudes', 1);
INSERT INTO `MOD_MODULOS` VALUES (13, 'Documentos', 'Administra documentos', 'documentos', 1);
INSERT INTO `MOD_MODULOS` VALUES (14, 'Parseador HTMLs', 'Administra archivos html. Requiere del módulo de parámetros', 'htmls', 1);
INSERT INTO `MOD_MODULOS` VALUES (15, 'Búsqueda Partes MDB', 'Administra la búsqueda de partes multibase de datos. (Requiere del Administrador de Marcas).', 'busquedas_mdb', 1);
INSERT INTO `MOD_MODULOS` VALUES (16, 'Administrador de Marcas MDB', 'Administra marcas para busquedas multibases de datos.', 'admin_marcas', 1);
INSERT INTO `MOD_MODULOS` VALUES (17, 'Solicitudes MBD', 'Administra solicitudes multibase de datos', 'solicitudes_mdb', 1);
INSERT INTO `MOD_MODULOS` VALUES (18, 'Módulos', 'Administración de Módulos', 'modulos', 1);
INSERT INTO `MOD_MODULOS` VALUES (19, 'Garantías', 'Administración de Garantías', 'garantias', 1);
