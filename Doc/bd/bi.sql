-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-09-2015 a las 22:25:12
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicampos`
--

CREATE TABLE IF NOT EXISTS `bicampos` (
  `IDCampo` int(11) NOT NULL,
  `IDTabla` int(11) NOT NULL,
  `NOMCampo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `TYPCampo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `LONGCampo` int(11) NOT NULL,
  `ORDER` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bicampos`
--

INSERT INTO `bicampos` (`IDCampo`, `IDTabla`, `NOMCampo`, `TYPCampo`, `LONGCampo`, `ORDER`) VALUES
(1, 1, 'Campo1', 'Fecha', 0, 1),
(2, 1, 'Campo2', 'Cadena', 25, 2),
(5, 1, 'Campo3', 'Entero', 11, 3),
(6, 1, 'Campo4', 'Flotante', 22, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biclientes`
--

CREATE TABLE IF NOT EXISTS `biclientes` (
  `IDCliente` int(11) NOT NULL,
  `DESCCliente` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biclientes`
--

INSERT INTO `biclientes` (`IDCliente`, `DESCCliente`) VALUES
(1, 'NSBS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biconfig`
--

CREATE TABLE IF NOT EXISTS `biconfig` (
  `IDClave` varchar(5) COLLATE latin1_spanish_ci NOT NULL,
  `VALOR` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `DESC` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `IDCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biconfig`
--

INSERT INTO `biconfig` (`IDClave`, `VALOR`, `DESC`, `IDCliente`) VALUES
('ALLTY', 'txt|csv|xls|xlsx', 'Tipos de mimes aceptados', 1),
('DATFO', 'Y-m-d', 'Formato de fecha', 1),
('DATSE', '$', 'Separador de datos', 1),
('FOLDO', './assets/documents/download/', 'Carpeta de archivos bajados', 1),
('FOLLG', './assets/documents/logs/', 'Carpta de logs', 1),
('FOLPR', './assets/documents/process/', 'Carpeta de subida de Archivos procesados', 1),
('FOLUP', './assets/documents/upload/', 'Carpeta de subida de Archivos', 1),
('NARCH', 'archivo_', 'Nombre del archivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bicuentas`
--

CREATE TABLE IF NOT EXISTS `bicuentas` (
  `IDCuenta` int(11) NOT NULL,
  `DESCCuenta` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `IDCliente` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bicuentas`
--

INSERT INTO `bicuentas` (`IDCuenta`, `DESCCuenta`, `IDCliente`) VALUES
(1, 'Adm sitio', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biperfil`
--

CREATE TABLE IF NOT EXISTS `biperfil` (
  `IDPerfil` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBPerfil` varchar(25) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biperfil`
--

INSERT INTO `biperfil` (`IDPerfil`, `NOMBPerfil`) VALUES
('ADM', 'Administrador'),
('USU', 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biprocesos`
--

CREATE TABLE IF NOT EXISTS `biprocesos` (
  `IDPro` int(11) NOT NULL,
  `Archivo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `NOMOriginal` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `IDUsuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL,
  `FECCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ubicacion` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitablas`
--

CREATE TABLE IF NOT EXISTS `bitablas` (
  `IDTabla` int(11) NOT NULL,
  `NOMTabla` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bitablas`
--

INSERT INTO `bitablas` (`IDTabla`, `NOMTabla`, `IDCuenta`) VALUES
(1, 'Prueba', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biusuarios`
--

CREATE TABLE IF NOT EXISTS `biusuarios` (
  `IDUsuarios` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBUsuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `CLAVUsuario` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `PERFUsuario` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biusuarios`
--

INSERT INTO `biusuarios` (`IDUsuarios`, `NOMBUsuario`, `CLAVUsuario`, `PERFUsuario`, `IDCuenta`) VALUES
('alopez', 'Alejandro Lopez Stanley', '1', 'ADM', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bicampos`
--
ALTER TABLE `bicampos`
  ADD PRIMARY KEY (`IDCampo`,`IDTabla`);

--
-- Indices de la tabla `biclientes`
--
ALTER TABLE `biclientes`
  ADD PRIMARY KEY (`IDCliente`);

--
-- Indices de la tabla `biconfig`
--
ALTER TABLE `biconfig`
  ADD PRIMARY KEY (`IDClave`);

--
-- Indices de la tabla `bicuentas`
--
ALTER TABLE `bicuentas`
  ADD PRIMARY KEY (`IDCuenta`);

--
-- Indices de la tabla `biperfil`
--
ALTER TABLE `biperfil`
  ADD PRIMARY KEY (`IDPerfil`);

--
-- Indices de la tabla `biprocesos`
--
ALTER TABLE `biprocesos`
  ADD PRIMARY KEY (`IDPro`,`Archivo`);

--
-- Indices de la tabla `bitablas`
--
ALTER TABLE `bitablas`
  ADD PRIMARY KEY (`IDTabla`,`NOMTabla`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bicampos`
--
ALTER TABLE `bicampos`
  MODIFY `IDCampo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `biclientes`
--
ALTER TABLE `biclientes`
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `bicuentas`
--
ALTER TABLE `bicuentas`
  MODIFY `IDCuenta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `biprocesos`
--
ALTER TABLE `biprocesos`
  MODIFY `IDPro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `bitablas`
--
ALTER TABLE `bitablas`
  MODIFY `IDTabla` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
