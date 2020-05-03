-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-05-2020 a las 19:37:21
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `storenet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliado`
--

CREATE TABLE `afiliado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `afiliado`
--

INSERT INTO `afiliado` (`id`, `nombre`, `estado`) VALUES
(1, 'SoftCorp', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombres`, `apellidos`, `mail`, `password`, `direccion`, `telefono`, `estado`) VALUES
(1, 'Cliente', '', 'cliente@softcorp.com', 'adm', '', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idafiliado` int(11) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `rango` int(11) NOT NULL,
  `sueldo` double NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `idafiliado`, `mail`, `password`, `direccion`, `telefono`, `rango`, `sueldo`, `nombres`, `apellidos`, `estado`) VALUES
(1, 1, 'adm@softcorp.com', 'adm', '', 0, 4, 10000000, 'Adm', 'SoftCorp', 1);

--
-- Disparadores `empleado`
--
DELIMITER $$
CREATE TRIGGER `empleado_BEFORE_INSERT` BEFORE INSERT ON `empleado` FOR EACH ROW SET NEW.id = (SELECT IFNULL(MAX(id),0) FROM empleado WHERE idafiliado = NEW.idafiliado) + 1;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idafiliado` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `anulada` int(11) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idafiliado` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `dias` int(11) NOT NULL,
  `horasextras` int(11) NOT NULL,
  `recargonocturno` int(11) NOT NULL,
  `horasdyf` int(11) NOT NULL,
  `deducciones` double NOT NULL DEFAULT '0',
  `totaldevengado` double NOT NULL DEFAULT '0',
  `totaldeducido` double NOT NULL DEFAULT '0',
  `totalpago` double NOT NULL DEFAULT '0',
  `totalnomina` double NOT NULL DEFAULT '0',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `nomina`
--
DELIMITER $$
CREATE TRIGGER `nomina_BEFORE_INSERT` BEFORE INSERT ON `nomina` FOR EACH ROW SET NEW.id = (SELECT IFNULL(MAX(id),0) FROM nomina WHERE idafiliado = NEW.idafiliado) + 1;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idfactura` int(11) NOT NULL,
  `idafiliado` int(11) NOT NULL DEFAULT '0',
  `idcliente` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `pedido`
--
DELIMITER $$
CREATE TRIGGER `pedido_BEFORE_INSERT` BEFORE INSERT ON `pedido` FOR EACH ROW SET NEW.id = (SELECT IFNULL(MAX(id),0) FROM pedido WHERE idafiliado = NEW.idafiliado) + 1;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precioproveedor` double NOT NULL,
  `precioventa` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idafiliado` int(11) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `producto_BEFORE_INSERT` BEFORE INSERT ON `producto` FOR EACH ROW SET NEW.id = (SELECT IFNULL(MAX(id),0) FROM producto WHERE idafiliado = NEW.idafiliado) + 1;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `contenido` varchar(600) NOT NULL,
  `estado` int(11) NOT NULL,
  `mail` varchar(35) NOT NULL,
  `fecha` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id`, `titulo`, `contenido`, `estado`, `mail`, `fecha`) VALUES
(1, 'adm', 'adm', 1, 'adm@softcorp.com', '2020-04-23'),
(2, 'Error al crear', 'Hola mundo', 0, 'jhon71937@gmail.com', '2020-04-25'),
(3, 'Error al crear', 'Hola mundo', 0, 'jhon71937@gmail.com', '2020-04-25'),
(4, 'Error al crear', 'Hola mundo', 0, 'jhon71937@gmail.com', '2020-04-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

CREATE TABLE `tarjeta` (
  `id` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `saldo` double NOT NULL DEFAULT '0',
  `puntos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL DEFAULT '0',
  `idfactura` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idafiliado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `venta`
--
DELIMITER $$
CREATE TRIGGER `venta_BEFORE_INSERT` BEFORE INSERT ON `venta` FOR EACH ROW SET NEW.id = (SELECT IFNULL(MAX(id),0) FROM venta WHERE idafiliado = NEW.idafiliado) + 1
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliado`
--
ALTER TABLE `afiliado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idafiliado` (`idafiliado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idafiliado` (`idafiliado`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idempleado` (`idempleado`),
  ADD KEY `idafiliado` (`idafiliado`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idfactura` (`idfactura`),
  ADD KEY `idafiliado` (`idafiliado`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idafiliado` (`idafiliado`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`,`idafiliado`),
  ADD KEY `idfactura` (`idfactura`),
  ADD KEY `idproducto` (`idproducto`),
  ADD KEY `idafiliado` (`idafiliado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliado`
--
ALTER TABLE `afiliado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`);

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `nomina_ibfk_1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`id`),
  ADD CONSTRAINT `nomina_ibfk_2` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`);

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`id`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`idafiliado`) REFERENCES `afiliado` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
