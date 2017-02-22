-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2015 a las 19:56:19
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `muerto_sano`
--
CREATE DATABASE IF NOT EXISTS `muerto_sano` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `muerto_sano`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_receta`
--

CREATE TABLE IF NOT EXISTS `detalle_receta` (
  `id_receta` int(11) NOT NULL,
  `id_farmaco` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_receta`
--

INSERT INTO `detalle_receta` (`id_receta`, `id_farmaco`, `cantidad`, `subtotal`) VALUES
(1, 1, 1, 3500),
(1, 5, 1, 8390),
(2, 1, 1, 3500),
(2, 5, 3, 25170),
(3, 5, 3, 25170),
(4, 1, 10, 36000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacos`
--

CREATE TABLE IF NOT EXISTS `farmacos` (
`id_farmaco` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `unidad` int(11) NOT NULL,
  `id_tipoFarmaco` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `farmacos`
--

INSERT INTO `farmacos` (`id_farmaco`, `descripcion`, `precio`, `unidad`, `id_tipoFarmaco`) VALUES
(1, 'Desloratadina', 3600, 40, 1),
(5, 'Supracalm', 8390, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
`id_perfil` int(11) NOT NULL,
  `descripcion_perfil` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descripcion_perfil`) VALUES
(1, 'Administrador'),
(2, 'Consulta'),
(3, 'Paciente');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE IF NOT EXISTS `recetas` (
`id_receta` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `total_receta` int(11) NOT NULL,
  `estado` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `fecha_emision`, `total_receta`, `estado`, `id_usuario`) VALUES
(1, '2015-07-06', 11890, 'Retenida', 1),
(2, '2015-07-09', 28670, 'OK', 5),
(3, '2015-07-10', 25170, 'OK', 6),
(4, '2015-07-10', 36000, 'OK', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_farmaco`
--

CREATE TABLE IF NOT EXISTS `tipo_farmaco` (
`id_tipo` int(11) NOT NULL,
  `descripcion_tipo` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_farmaco`
--

INSERT INTO `tipo_farmaco` (`id_tipo`, `descripcion_tipo`) VALUES
(1, 'Antihistamínico'),
(2, 'Analgésico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `login_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pass_usuario` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `edad_usuario` int(11) DEFAULT NULL,
  `codigo_perfil` int(11) NOT NULL,
  `fechaNacimiento_usuario` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `login_usuario`, `pass_usuario`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `edad_usuario`, `codigo_perfil`, `fechaNacimiento_usuario`) VALUES
(1, 'prueba', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'F', 'Fuentes', 'gmail@gmail.com', NULL, 1, '1988-01-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
 ADD PRIMARY KEY (`id_receta`,`id_farmaco`), ADD KEY `FK_DETALLE_FARMACOS_idx` (`id_farmaco`);

--
-- Indices de la tabla `farmacos`
--
ALTER TABLE `farmacos`
 ADD PRIMARY KEY (`id_farmaco`), ADD KEY `FK_FARMACOS_TIPO_FARMACO_idx` (`id_tipoFarmaco`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
 ADD PRIMARY KEY (`id_receta`), ADD KEY `FK_RECETAS_USUARIOS_idx` (`id_usuario`);

--
-- Indices de la tabla `tipo_farmaco`
--
ALTER TABLE `tipo_farmaco`
 ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `login_usuario_UNIQUE` (`login_usuario`), ADD KEY `FK_USUARIOS_PERFIL_idx` (`codigo_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `farmacos`
--
ALTER TABLE `farmacos`
MODIFY `id_farmaco` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_farmaco`
--
ALTER TABLE `tipo_farmaco`
MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_receta`
--
ALTER TABLE `detalle_receta`
ADD CONSTRAINT `FK_DETALLE_FARMACOS` FOREIGN KEY (`id_farmaco`) REFERENCES `farmacos` (`id_farmaco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `FK_DETALLE_RECETA_RECETA` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `farmacos`
--
ALTER TABLE `farmacos`
ADD CONSTRAINT `FK_FARMACOS_TIPO_FARMACO` FOREIGN KEY (`id_tipoFarmaco`) REFERENCES `tipo_farmaco` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recetas`
--
ALTER TABLE `recetas`
ADD CONSTRAINT `FK_RECETAS_USUARIOS` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `FK_USUARIOS_PERFIL` FOREIGN KEY (`codigo_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
