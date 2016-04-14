
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2015 a las 07:48:12
-- Versión del servidor: 10.0.20-MariaDB
-- Versión de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `u432294351_quiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE IF NOT EXISTS `acciones` (
  `id_accion` int(255) NOT NULL,
  `id_conexion` int(255) DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_accion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conexiones`
--

CREATE TABLE IF NOT EXISTS `conexiones` (
  `id` int(255) NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE IF NOT EXISTS `pregunta` (
  `id` int(255) NOT NULL,
  `pregunta` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `respuesta` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `complejidad` int(11) NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pregunta` (`pregunta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Email` varchar(256) COLLATE latin1_spanish_ci NOT NULL,
  `Nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido1` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Apellido2` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `Password` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Teléfono` int(9) NOT NULL,
  `Especialidad` varchar(140) COLLATE latin1_spanish_ci NOT NULL,
  `Intereses` varchar(300) COLLATE latin1_spanish_ci DEFAULT NULL,
  `Foto` blob,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Email`, `Nombre`, `Apellido1`, `Apellido2`, `Password`, `Teléfono`, `Especialidad`, `Intereses`, `Foto`) VALUES
('deloranus001@ikasle.ehu.es', 'Deepin', 'Love', 'Withuranus', '123456', 123456789, 'Computacion', '', 0x75706c6f6164732f757365722e706e67),
('mvestrada001@ikasle.ehu.eus', 'Maria', 'Vaca', 'Estrada', '1123456789', 123456789, 'Computacion', '', 0x75706c6f6164732f757365722e706e67),
('jagumiel001@ikasle.ehu.eus', 'Prueba', 'Multiple', 'Select', '1234567', 123456789, 'Software', '', 0x75706c6f6164732f757365722e706e67),
('dlwithuranus001@ikasle.ehu.es', 'Deepin', 'Love', 'Withuranus', '123456', 123456789, 'Computacion', '', 0x75706c6f6164732f646c776974687572616e757330303140696b61736c652e6568752e65736e646963652e6a7067);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
