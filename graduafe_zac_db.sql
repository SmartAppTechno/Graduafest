-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-04-2017 a las 15:53:21
-- Versión del servidor: 5.6.35
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `graduafe_zac_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE IF NOT EXISTS `tbl_categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `tipo_categoria` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_graduacion`
--

CREATE TABLE IF NOT EXISTS `tbl_graduacion` (
  `id_graduacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `fecha` datetime NOT NULL,
  `costo_10` float NOT NULL DEFAULT '0',
  `costo_12` float NOT NULL DEFAULT '0',
  `costo_18` float NOT NULL DEFAULT '0',
  `costo_infante` int(11) NOT NULL DEFAULT '0',
  `layout` varchar(200) NOT NULL DEFAULT 'NO_LAYOUT_AVILABLE.jpg',
  `id_lugar` int(11) NOT NULL DEFAULT '0',
  `numero_lugares` int(11) NOT NULL DEFAULT '0',
  `cotizada` tinyint(1) NOT NULL DEFAULT '0',
  `cupones` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_graduacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_graduacion_productos`
--

CREATE TABLE IF NOT EXISTS `tbl_graduacion_productos` (
  `id_graduacion_productos` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `id_graduacion` int(11) NOT NULL,
  PRIMARY KEY (`id_graduacion_productos`),
  KEY `id_persona` (`id_producto`,`id_graduacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesas`
--

CREATE TABLE IF NOT EXISTS `tbl_mesas` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `numero_mesa` int(11) NOT NULL,
  `numero_lugares` int(11) NOT NULL,
  `id_graduacion` int(11) NOT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `id_graduacion` (`id_graduacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesas_persona`
--

CREATE TABLE IF NOT EXISTS `tbl_mesas_persona` (
  `id_mesas_persona` int(11) NOT NULL AUTO_INCREMENT,
  `numero_lugares` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  PRIMARY KEY (`id_mesas_persona`),
  KEY `id_mesa` (`id_mesa`,`id_persona`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pagos`
--

CREATE TABLE IF NOT EXISTS `tbl_pagos` (
  `id_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(500) NOT NULL,
  `cantidad` float NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_graduacion` int(11) NOT NULL,
  PRIMARY KEY (`id_pagos`),
  KEY `id_persona` (`id_persona`),
  KEY `id_graduacion` (`id_graduacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE IF NOT EXISTS `tbl_persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `representante` tinyint(1) NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `contraseña` varchar(30) DEFAULT NULL,
  `id_graduacion` int(11) DEFAULT NULL,
  `cupones_descargados` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_graduacion` (`id_graduacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=365 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona_productos`
--

CREATE TABLE IF NOT EXISTS `tbl_persona_productos` (
  `id_persona_productos` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_graduacion` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_persona_productos`),
  KEY `id_persona` (`id_persona`,`id_producto`),
  KEY `id_producto` (`id_producto`),
  KEY `id_graduacion` (`id_graduacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `costo` float NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `extra` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_registro_lugares`
--

CREATE TABLE IF NOT EXISTS `tbl_registro_lugares` (
  `id_registro_lugares` int(11) NOT NULL AUTO_INCREMENT,
  `lugar_1` smallint(6) NOT NULL,
  `lugar_2` smallint(6) NOT NULL DEFAULT '0',
  `numero_infantes` int(11) NOT NULL DEFAULT '0',
  `id_graduacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_tipo_lugar` int(11) NOT NULL,
  PRIMARY KEY (`id_registro_lugares`),
  KEY `id_graduacion` (`id_graduacion`,`id_persona`,`id_tipo_lugar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_lugar`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_lugar` (
  `id_tipo_lugar` int(11) NOT NULL AUTO_INCREMENT,
  `numero_personas` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_tipo_lugar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
