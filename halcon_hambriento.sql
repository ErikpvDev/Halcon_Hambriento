-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2025 a las 13:56:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `halcon_hambriento`
--
CREATE DATABASE IF NOT EXISTS `halcon_hambriento` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `halcon_hambriento`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`) VALUES
(1, 'Bebida'),
(3, 'Hamburguesa y Platos'),
(4, 'Acompañamientos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

DROP TABLE IF EXISTS `mesa`;
CREATE TABLE `mesa` (
  `numMesa` varchar(255) NOT NULL,
  `ocupado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`numMesa`, `ocupado`) VALUES
('1', 1),
('2', 0),
('3', 0),
('4', 0),
('5', 0),
('6', 0),
('7', 0),
('8', 0),
('9', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `pagado` tinyint(1) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `numMesa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `pagado`, `usuario`, `numMesa`) VALUES
(7, 1, '12345678a', '9'),
(8, 1, '12345678a', '9'),
(9, 1, '12345678a', '5'),
(10, 0, '12345678a', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoproducto`
--

DROP TABLE IF EXISTS `pedidoproducto`;
CREATE TABLE `pedidoproducto` (
  `idLinea` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `comentarios` varchar(255) NOT NULL,
  `servido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedidoproducto`
--

INSERT INTO `pedidoproducto` (`idLinea`, `idPedido`, `idProducto`, `cant`, `comentarios`, `servido`) VALUES
(32, 7, 13, 3, '', 1),
(33, 7, 15, 2, '', 1),
(34, 8, 13, 1, '', 1),
(35, 8, 15, 1, '', 1),
(36, 9, 13, 2, '', 1),
(37, 10, 16, 1, '', 1),
(38, 10, 17, 1, '', 1),
(39, 10, 13, 1, '', 1),
(40, 10, 13, 1, '', 1),
(41, 10, 16, 2, '', 1),
(42, 10, 15, 1, '', 1),
(43, 10, 16, 1, '', 1),
(44, 10, 17, 1, '', 1),
(45, 10, 13, 1, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `categoria` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `precio`, `stock`, `activo`, `categoria`, `img`) VALUES
(13, 'Refresco Coca-Cola 600ml', 3, 47, 1, 1, '../img_productos/1762971343.png'),
(15, 'Fanta', 3, 49, 1, 1, '../img_productos/1762969861.png'),
(16, 'Hamburguesa Clásica', 6.5, 46, 1, 3, '../img_productos/1763296530.png'),
(17, 'Aros de Cebolla', 4, 58, 1, 4, '../img_productos/1763296773.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `usuario` varchar(255) NOT NULL,
  `numMesa` varchar(255) NOT NULL,
  `fecha` varchar(255) NOT NULL,
  `hora` time NOT NULL,
  `numComensales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`usuario`, `numMesa`, `fecha`, `hora`, `numComensales`) VALUES
('12345678a', '1', '16-11-2025', '01:21:40', 3),
('12345678a', '5', '16-11-2025', '12:54:28', 5),
('12345678a', '9', '16-11-2025', '12:47:44', 5),
('12345678a', '9', '16-11-2025', '12:53:42', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `dni` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL COMMENT 'Usuario ->0\r\nCamarero->1\r\nEncargado->2',
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`dni`, `pass`, `nombre`, `apellidos`, `rol`, `email`, `telefono`, `direccion`, `activo`) VALUES
('12345678a', '1234', 'prueba', 'prueba', 0, 'prueba', 'prueba', 'prueba', 1),
('camarero', '1234', 'camarero', 'camarero', 1, 'camarero', 'camarero', 'camarero', 1),
('encargado', '1234', 'encargado', 'encargado', 2, 'encargado', 'encargado', 'encargado', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`numMesa`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `Pedido-Usuario` (`usuario`),
  ADD KEY `Pedido-Mesa` (`numMesa`);

--
-- Indices de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD PRIMARY KEY (`idLinea`),
  ADD KEY `ProductoRel` (`idProducto`),
  ADD KEY `PedidoRel` (`idPedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `producto-categoria` (`categoria`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`usuario`,`numMesa`,`fecha`,`hora`),
  ADD KEY `Reserva-Mesa` (`numMesa`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  MODIFY `idLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `Pedido-Mesa` FOREIGN KEY (`numMesa`) REFERENCES `mesa` (`numMesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Pedido-Usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidoproducto`
--
ALTER TABLE `pedidoproducto`
  ADD CONSTRAINT `PedidoRel` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto-categoria` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `Reserva-Mesa` FOREIGN KEY (`numMesa`) REFERENCES `mesa` (`numMesa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Reserva-Usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`dni`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
