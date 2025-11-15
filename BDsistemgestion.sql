-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gestion_inventario
CREATE DATABASE IF NOT EXISTS `gestion_inventario` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gestion_inventario`;

-- Volcando estructura para tabla gestion_inventario.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.categoria: ~1 rows (aproximadamente)
INSERT INTO `categoria` (`id_categoria`, `nombre`) VALUES
	(1, 'Lácteos y Refrigerados'),
	(2, 'Golosinas y Snacks'),
	(3, 'Bebidas e Infusiones'),
	(4, 'Conservas y Enlatados');

-- Volcando estructura para tabla gestion_inventario.marca
CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.marca: ~1 rows (aproximadamente)
INSERT INTO `marca` (`id_marca`, `nombre`) VALUES
	(1, 'Nestle'),
	(2, 'Arcor'),
	(3, 'Danone'),
	(4, 'Knorr');

-- Volcando estructura para tabla gestion_inventario.movimiento
CREATE TABLE IF NOT EXISTS `movimiento` (
  `id_movimiento` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_proveedor` int DEFAULT NULL,
  `cantidad` int NOT NULL,
  `ingreso` tinyint(1) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_movimiento`),
  KEY `movimiento_ibfk_1` (`id_producto`),
  KEY `movimiento_ibfk_2` (`id_usuario`),
  KEY `movimiento_ibfk_3` (`id_proveedor`),
  CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE SET NULL,
  CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL,
  CONSTRAINT `movimiento_ibfk_3` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.movimiento: ~6 rows (aproximadamente)
INSERT INTO `movimiento` (`id_movimiento`, `id_producto`, `id_usuario`, `id_proveedor`, `cantidad`, `ingreso`, `fecha`) VALUES
	(1, 1, NULL, NULL, 5, 1, '2025-11-14 19:03:16'),
	(2, 2, NULL, NULL, 2, 1, '2025-11-14 19:03:26'),
	(3, 3, NULL, NULL, 3, 1, '2025-11-14 19:03:34'),
	(4, 1, NULL, NULL, 1, 0, '2025-11-14 19:05:40'),
	(5, 2, NULL, NULL, 1, 0, '2025-11-14 19:05:52'),
	(6, 3, NULL, NULL, 2, 0, '2025-11-14 19:06:03');

-- Volcando estructura para tabla gestion_inventario.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `precio` decimal(10,2) NOT NULL,
  `id_marca` int DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  `id_proveedor` int DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `producto_ibfk_1` (`id_marca`),
  KEY `producto_ibfk_2` (`id_categoria`),
  KEY `fk_producto_proveedor` (`id_proveedor`),
  CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL,
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.producto: ~2 rows (aproximadamente)
INSERT INTO `producto` (`id_producto`, `codigo`, `nombre`, `descripcion`, `precio`, `id_marca`, `id_categoria`, `id_proveedor`) VALUES
	(1, '1', 'Palitos de la selva', 'paquete 500g', 7000.00, 1, 2, 2),
	(2, '2', 'Coca Cola', '2L', 4000.00, 2, 3, 3),
	(3, '3', 'Milanesas', 'kg', 13000.00, 4, 1, 2);

-- Volcando estructura para tabla gestion_inventario.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `cuit` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `cuit` (`cuit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.proveedor: ~0 rows (aproximadamente)
INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `telefono`, `direccion`, `cuit`) VALUES
	(2, 'Distribuidora La Central, S.A.', '11 4567-8901', 'Av. Rivadavia 1230, C.A.B.A.', '30-71234567-8'),
	(3, 'Abastecedora Mayorista S.R.L.', '261 543-2109', 'Ruta Nacional 7 Km 980, Mendoza', '33-70345670-9');

-- Volcando estructura para tabla gestion_inventario.proveedor_producto
CREATE TABLE IF NOT EXISTS `proveedor_producto` (
  `id_proveedor` int NOT NULL,
  `id_producto` int NOT NULL,
  PRIMARY KEY (`id_proveedor`,`id_producto`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.proveedor_producto: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestion_inventario.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.rol: ~0 rows (aproximadamente)
INSERT INTO `rol` (`id_rol`, `nombre`) VALUES
	(1, 'Usuario'),
	(2, 'Administrador'),
	(3, 'Gerente');

-- Volcando estructura para tabla gestion_inventario.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int NOT NULL AUTO_INCREMENT,
  `id_producto` int DEFAULT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `fecha_act` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stock`),
  KEY `stock_ibfk_1` (`id_producto`),
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.stock: ~7 rows (aproximadamente)
INSERT INTO `stock` (`id_stock`, `id_producto`, `cantidad`, `fecha_act`) VALUES
	(1, 1, 4, '2025-11-14 19:03:16'),
	(2, 2, 1, '2025-11-14 19:03:26'),
	(3, 3, 1, '2025-11-14 19:03:34');

-- Volcando estructura para tabla gestion_inventario.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `clave` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `id_rol` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla gestion_inventario.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`id_usuario`, `clave`, `email`, `nombre`, `apellido`, `id_rol`) VALUES
	(1, '$2y$10$xnYloix5NBgTwjWh/Q24BurxzPyxOvvbEI7TNDsDzA2HfTIs4LN/.', 'ejemplo1@gmail.com', 'Juan', 'Perez', 1),
	(2, '$2y$10$PmBTVGZwSqWCiKPP3VPWoO9B1aImhg.sT84NPbXq6SmMpE1cD6jsK', 'ejemplo2@gmail.com', 'Valeria', 'Romani', 2),
	(3, '$2y$10$NrPxgv2s.TT.RqGu5cTdx.uImKRt9W5JbVSB548tKjzlO1Hbzt2Ay', 'ejemplo3@gmail.com', 'Fernando Gabriel', 'Ramirez', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
