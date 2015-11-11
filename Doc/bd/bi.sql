-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2015 a las 21:18:33
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biclientes`
--

INSERT INTO `biclientes` (`IDCliente`, `DESCCliente`) VALUES
(1, 'NSBS'),
(2, 'Filaxis');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bicuentas`
--

INSERT INTO `bicuentas` (`IDCuenta`, `DESCCuenta`, `IDCliente`) VALUES
(1, 'Adm sitio', 1),
(2, 'Cuenta de Filaxis', 2);

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
-- Estructura de tabla para la tabla `bipermisos`
--

CREATE TABLE IF NOT EXISTS `bipermisos` (
  `pantalla` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `accion` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `allow` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bipermisos`
--

INSERT INTO `bipermisos` (`pantalla`, `accion`, `allow`) VALUES
('ADM', 'VER', 'ADM'),
('Clave', 'VER', 'ADM'),
('Clave', 'VER', 'USU'),
('Clientes', 'ADD', 'ADM'),
('Clientes', 'MOD', 'ADM'),
('Clientes', 'VER', 'ADM'),
('Clientes', 'VER', 'USU'),
('Cuentas', 'ADD', 'ADM'),
('Cuentas', 'MOD', 'ADM'),
('Cuentas', 'VER', 'ADM'),
('Estados', 'VER', 'ADM'),
('Estados', 'VER', 'USU'),
('Etapas', 'VER', 'ADM'),
('Etapas', 'VER', 'USU'),
('Perfiles', 'ADD', 'ADM'),
('Perfiles', 'MOD', 'ADM'),
('Perfiles', 'VER', 'ADM'),
('Perfiles', 'VER', 'USU'),
('Proyectos', 'VER', 'ADM'),
('Proyectos', 'VER', 'USU'),
('Registros', 'VER', 'ADM'),
('Registros', 'VER', 'USU'),
('Registros', 'VIS', 'ADM'),
('Registros', 'VIS', 'USU'),
('Sistemas', 'VER', 'ADM'),
('Sistemas', 'VER', 'USU'),
('Tablas', 'ADD', 'ADM'),
('Tablas', 'MOD', 'ADM'),
('Tablas', 'VER', 'ADM'),
('Usuarios', 'ADD', 'ADM'),
('Usuarios', 'MOD', 'ADM'),
('Usuarios', 'VER', 'ADM'),
('Usuarios', 'VER', 'USU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biprocesos`
--

CREATE TABLE IF NOT EXISTS `biprocesos` (
  `IDPro` int(11) NOT NULL,
  `Archivo` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Tipo` varchar(4) COLLATE latin1_spanish_ci NOT NULL,
  `NOMOriginal` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `IDUsuario` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL,
  `FECCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ubicacion` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biprocesos`
--

INSERT INTO `biprocesos` (`IDPro`, `Archivo`, `Tipo`, `NOMOriginal`, `IDUsuario`, `IDCuenta`, `FECCreacion`, `Ubicacion`) VALUES
(20, 'archivo_1716837167.txt', 'txt', 'archivo_OK.txt', 'Prueba', 1, '2015-09-15 23:42:56', './assets/documents/process/'),
(21, 'archivo_891688775.txt', 'txt', 'archivo_ko3.txt', 'Prueba', 1, '2015-09-15 23:50:22', './assets/documents/process/'),
(22, 'archivo_527700776.txt', 'txt', 'calculo.xlsx', 'Prueba', 1, '2015-09-15 23:55:07', './assets/documents/process/'),
(23, 'archivo_360856198.xlsx', 'xlsx', 'archivo_OK.txt', 'Prueba', 1, '2015-09-15 23:55:35', './assets/documents/process/'),
(24, 'archivo_30272.csv', '', 'archivo_OK.txt', 'Prueba', 2, '2015-09-17 16:53:59', './assets/documents/process/'),
(25, 'archivo_31641.txt', '', 'archivo_OK.txt', 'cgerardi', 2, '2015-09-17 16:59:47', './assets/documents/process/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitablas`
--

CREATE TABLE IF NOT EXISTS `bitablas` (
  `IDTabla` int(11) NOT NULL,
  `NOMTabla` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `bitablas`
--

INSERT INTO `bitablas` (`IDTabla`, `NOMTabla`, `IDCuenta`) VALUES
(1, 'Prueba', 1),
(2, 'Prueba', 2),
(3, 'Prueba1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biusuarios`
--

CREATE TABLE IF NOT EXISTS `biusuarios` (
  `IDUsuarios` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `NOMBUsuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `CLAVUsuario` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `PERFUsuario` varchar(6) COLLATE latin1_spanish_ci NOT NULL,
  `IDCuenta` int(11) NOT NULL,
  `Cambia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `biusuarios`
--

INSERT INTO `biusuarios` (`IDUsuarios`, `NOMBUsuario`, `CLAVUsuario`, `PERFUsuario`, `IDCuenta`, `Cambia`) VALUES
('alopez', 'Alejandro Lopez Stanley', 'c4ca4238a0b923820dcc509a6f75849b', 'ADM', 1, 0),
('cgerardi', 'Celina Gerardi', 'c33367701511b4f6020ec61ded352059', 'USU', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `ip_address` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('01e6231092fd40951c42cb10ad3df42431486bdc', '::1', 1447270843, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237303831383b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('03b879b59abeb9f25036b22dc2d68c39c1ab1ca5', '::1', 1447271609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237313438303b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('0794a2975c5777cc1c2a64c3599d202e3778e03a', '::1', 1447263489, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236333336353b6e6f6d6272657c733a31343a2243656c696e612047657261726469223b70657266696c7c733a333a22555355223b49446375656e74617c733a313a2232223b6375656e74617c733a31373a224375656e74612064652046696c61786973223b7573756172696f7c733a383a226367657261726469223b63616d6269617c693a303b),
('0df5845fc62bad3decb19f30bdf06f2dbf398712', '::1', 1447271476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237313137373b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('1037fccabb83093df3af6a39e5b985d5d308eef4', '::1', 1447256251, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373235363234363b7573756172696f7c733a363a22616c6f70657a223b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b),
('3d176ea6b4f38c3d233c23b5ae74e1fa1841b27c', '::1', 1447272253, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237323235333b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('5dd1b623f659590ba4772131e6e4cdb01acbe936', '::1', 1447267434, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236373135383b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('62b7b670eb6d8b35616552eb0a0cde8cd401bd7d', '::1', 1447270489, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237303139303b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('6cb984924bfa27bf2da8b01a5b80fae7b716108f', '::1', 1447264078, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236333839323b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2231223b7573756172696f7c733a363a22616c6f70657a223b),
('88e7d0eb7975fe19a83913ca8f5959f6a0525c09', '::1', 1447264402, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236343338383b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2231223b),
('9ae5c00f870680008e54e4a55baac98dcebd3024', '::1', 1447266986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236363831303b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('a43dccb30f2bd345478344b411ca879b336b065b', '::1', 1447264961, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236343734363b6e6f6d6272657c733a31343a2243656c696e612047657261726469223b70657266696c7c733a333a22555355223b49446375656e74617c733a313a2232223b6375656e74617c733a31373a224375656e74612064652046696c61786973223b63616d6269617c733a313a2231223b),
('b4e6997c8879fb14e7e50a626d118be50fdad526', '::1', 1447270050, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236393834333b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('c76ff88a133e48e6ad1cb96b4687ac2146a953c2', '::1', 1447268092, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236373939373b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('d21d2d27220c8f7b8ee1f9134f5d236c6fdb2f84', '::1', 1447270784, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237303439313b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('d51a917a38b74fd756c3ec3280ac66b660d91fa3', '::1', 1447267892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236373636383b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('d894b3e2e065ba3b9bbe541dcb9c2de4396b1046', '::1', 1447269456, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236393337363b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('dc24253ec2a4184a70c473add076f75f40d97c7b', '::1', 1447262762, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373236323735333b6e6f6d6272657c733a31343a2243656c696e612047657261726469223b70657266696c7c733a333a22555355223b49446375656e74617c733a313a2232223b6375656e74617c733a31373a224375656e74612064652046696c61786973223b63616d6269617c733a313a2231223b7573756172696f7c733a383a226367657261726469223b),
('fbab5806b72a5571b4855708cd28699c00a724c5', '::1', 1447272982, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373237323836353b6e6f6d6272657c733a32333a22416c656a616e64726f204c6f70657a205374616e6c6579223b70657266696c7c733a333a2241444d223b49446375656e74617c733a313a2231223b6375656e74617c733a393a2241646d20736974696f223b63616d6269617c733a313a2230223b7573756172696f7c733a363a22616c6f70657a223b),
('fed52b1aadc9c213667aef50f091107e5ef5744d', '::1', 1447256745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313434373235363636323b6e6f6d6272657c733a31343a2243656c696e612047657261726469223b70657266696c7c733a333a22555355223b49446375656e74617c733a313a2232223b6375656e74617c733a31373a224375656e74612064652046696c61786973223b63616d6269617c733a313a2231223b7573756172696f7c733a383a226367657261726469223b);

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
-- Indices de la tabla `bipermisos`
--
ALTER TABLE `bipermisos`
  ADD PRIMARY KEY (`pantalla`,`accion`,`allow`);

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
-- Indices de la tabla `biusuarios`
--
ALTER TABLE `biusuarios`
  ADD PRIMARY KEY (`IDUsuarios`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

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
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `bicuentas`
--
ALTER TABLE `bicuentas`
  MODIFY `IDCuenta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `biprocesos`
--
ALTER TABLE `biprocesos`
  MODIFY `IDPro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `bitablas`
--
ALTER TABLE `bitablas`
  MODIFY `IDTabla` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
