-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2018 a las 02:23:05
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciap`
--

CREATE TABLE `asistenciap` (
  `idap` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idcentro` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `leccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `otra` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asistenciap`
--

INSERT INTO `asistenciap` (`idap`, `fecha`, `idcentro`, `idusuario`, `leccion`, `otra`, `comentarios`, `estado`, `fechac`) VALUES
(9, '2018-03-02', 1, 1, 'INVENTARIO ESPIRITUAL 2', '', 'Solo hubo 2 participantes', 'Aceptado', '2018-03-01 14:57:06'),
(10, '2018-03-03', 1, 1, 'ADMITIR', '', 'Ninguno', 'Aceptado', '2018-03-01 17:26:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciaus`
--

CREATE TABLE `asistenciaus` (
  `idau` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idcentro` int(11) DEFAULT NULL,
  `nombrer` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `comentarios` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asistenciaus`
--

INSERT INTO `asistenciaus` (`idau`, `fecha`, `idcentro`, `nombrer`, `comentarios`, `fechac`) VALUES
(2, '2018-02-02', 1, 'OSCAR ENRIQUE GONZALEZ GOMEZ', 'Ninguno', '2018-03-03 15:06:06'),
(3, '2018-02-03', 1, 'OSCAR ENRIQUE GONZALEZ GOMEZ', NULL, '2018-03-03 15:06:14'),
(4, '2018-02-09', 1, 'OSCAR ENRIQUE GONZALEZ GOMEZ', NULL, '2018-03-03 15:06:21'),
(6, '2018-03-10', 1, 'OSCAR ENRIQUE GONZALEZ GOMEZ', NULL, '2018-03-03 15:06:30'),
(7, '2018-03-02', 1, 'OLGA CERVANTES', 'NINGUNO', '2018-03-03 15:29:01'),
(8, '2018-01-05', 1, 'CRUZ OLIVIA GUERRERO RAVELO', 'NINGUNO', '2018-03-03 15:37:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `idcentro` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `responsable` varchar(100) DEFAULT NULL,
  `telresponsable` varchar(15) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`idcentro`, `nombre`, `direccion`, `estado`, `localidad`, `telefono`, `correo`, `responsable`, `telresponsable`, `activo`, `fechac`) VALUES
(1, 'SALT CHURCH', 'BLVD. GONZALEZ #123', 'COAHUILA', 'SALTILLO', '8441234567', 'saltchurch@mimail.com', 'CESAR VILLARREAL', '8440987654', 1, '2018-02-15 19:33:25'),
(2, 'FUNDADORES', 'BLVD. FUNDADORES #345', 'COAHUILA', 'SALTILLO', '8449992315', 'fundadores@mimail.com', 'DAVIS SANCHEZ', '8443331232', 1, '2018-02-20 02:17:15'),
(3, 'MONCLOVA', 'AV. GIRASOLES #765 COL. JARDINES', 'COAHUILA', 'MONCLOVA', '8456541598', 'monclova@mimail.com', 'GUSTAVO MENDEZ', '8451478523', 1, '2018-02-20 01:57:49'),
(4, 'AGUASCALIENTES', 'BLVD. JUAREZ #876 CENTRO', 'AGUASCALIENTES', 'aguascalientes', '7895641236', 'aguascalientes@mimail.com', 'angel moreno', '7896541478', 1, '2018-02-20 02:17:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ap`
--

CREATE TABLE `detalle_ap` (
  `iddetalleap` int(11) NOT NULL,
  `idap` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `referencia` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_ap`
--

INSERT INTO `detalle_ap` (`iddetalleap`, `idap`, `idpersona`, `referencia`) VALUES
(15, 9, 1, '1234567890'),
(16, 9, 2, 'Sin Dato'),
(17, 10, 1, 'Sin Dato'),
(18, 10, 2, 'Sin Dato'),
(19, 10, 3, 'Sin Dato'),
(20, 10, 4, 'Sin Dato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_us`
--

CREATE TABLE `detalle_us` (
  `iddetalleus` int(11) NOT NULL,
  `idau` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_us`
--

INSERT INTO `detalle_us` (`iddetalleus`, `idau`, `idusuario`) VALUES
(1, 2, 1),
(2, 3, 4),
(3, 4, 4),
(4, 3, 1),
(5, 6, 1),
(6, 7, 1),
(7, 7, 4),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialpersona`
--

CREATE TABLE `historialpersona` (
  `idhp` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `comentarios` longtext NOT NULL,
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialusuario`
--

CREATE TABLE `historialusuario` (
  `idhu` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `comentarios` longtext NOT NULL,
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Administrador'),
(3, 'Centro'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL COMMENT 'Id de la entrevista',
  `idcentro` int(11) NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de la entrevista',
  `nombre` varchar(20) NOT NULL COMMENT 'Nombre del entrevistado',
  `papellido` varchar(20) NOT NULL COMMENT 'Apellido paterno del entrevistado',
  `sapellido` varchar(20) DEFAULT NULL COMMENT 'Apellido materno del entrevistado',
  `sexo` varchar(15) DEFAULT NULL,
  `fechanac` date DEFAULT NULL COMMENT 'Fecha de nacimiento del entrevistado',
  `ocupacion` varchar(100) DEFAULT NULL COMMENT 'Ocupación del entrevistado',
  `estudios` varchar(50) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL COMMENT 'Dirección del entrevistado',
  `telefono` varchar(15) DEFAULT NULL COMMENT 'Telefono (casa o trabajo) del entrevistado',
  `celular` varchar(15) DEFAULT NULL COMMENT 'Celular del entrevistado',
  `correo` varchar(60) DEFAULT NULL COMMENT 'Correo electronico del entrevistado',
  `facebook` varchar(100) DEFAULT NULL COMMENT 'Facebook del entrevistado',
  `edocivil` varchar(50) DEFAULT NULL,
  `hijos` varchar(200) DEFAULT NULL COMMENT 'Numero de hijos (varones) y edad del entrevistado',
  `hijas` varchar(200) DEFAULT NULL COMMENT 'Numero de hijas (mujeres) y edad del entrevistado',
  `resistol` varchar(2) DEFAULT 'NO' COMMENT 'Si consume resistol',
  `thiner` varchar(2) DEFAULT 'NO' COMMENT 'Si consume thiner',
  `marihuana` varchar(2) DEFAULT 'NO' COMMENT 'Si consume marihuana',
  `cocaina` varchar(2) DEFAULT 'NO' COMMENT 'Si consume cocaina',
  `piedra` varchar(2) DEFAULT 'NO' COMMENT 'Si consume piedra',
  `cristal` varchar(2) DEFAULT 'NO' COMMENT 'Si consume cristal',
  `lsd` varchar(2) DEFAULT 'NO' COMMENT 'Si consume LSD',
  `otras` varchar(100) DEFAULT NULL COMMENT 'Si consume otras drogas',
  `actualmente` varchar(100) DEFAULT NULL COMMENT 'Drogas que consume actualmente',
  `tiempo` varchar(100) DEFAULT NULL COMMENT 'Tiempo de consumirlas',
  `ayuda` varchar(200) DEFAULT NULL,
  `recomendaron` varchar(100) DEFAULT NULL,
  `coe` varchar(2) DEFAULT NULL,
  `imagen` varchar(60) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `idcentro`, `fecha`, `nombre`, `papellido`, `sapellido`, `sexo`, `fechanac`, `ocupacion`, `estudios`, `religion`, `direccion`, `telefono`, `celular`, `correo`, `facebook`, `edocivil`, `hijos`, `hijas`, `resistol`, `thiner`, `marihuana`, `cocaina`, `piedra`, `cristal`, `lsd`, `otras`, `actualmente`, `tiempo`, `ayuda`, `recomendaron`, `coe`, `imagen`, `idusuario`, `activo`, `fechac`) VALUES
(1, 1, '2018-02-01', 'JUAN JOSE', 'ROBLES', 'CERVANTES', 'MASCULINO', '1973-07-15', 'ALBAÑIL', 'SECUNDARIA', 'CREE EN DIOS', 'BONANZA #98, COL. SALTILLO 2000', '', '6543876934', 'juanjose@mimail.com', 'NO TIENE', 'CASADO (A)', '1 DE 12 AÑOS', '1 DE 11 AÑOS', 'NO', 'SI', 'NO', 'SI', 'NO', 'SI', 'NO', 'NINGUNA', '', '2 AÑOS', 'TAMBIEN NECESITA AYUDA CON EL ALCOHOL', 'FAMILIARES', 'NO', '', 1, 1, '2018-02-27 14:53:23'),
(2, 1, '2018-02-09', 'ALEJANDRA', 'LOPEZ', 'MORENO', 'FEMENINO', '1980-07-03', 'AMA DE CASA', 'SECUNDARIA', 'CATOLICO (A)', 'ABASOLO #45', '4678543', '', 'alejandralm@mimail.com', '', 'SELECCIONE', 'NO TIENE', 'NO TIENE', 'SI', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NINGUNA', 'ALCOHOL', '1 AÑO', 'TEMPERAMENTO', 'FAMILIARES', 'NO', '', 1, 1, '2018-02-27 14:53:32'),
(3, 1, '2018-02-05', 'JORGE', 'ALVAREZ', 'CERVANTES', 'MASCULINO', '1975-09-04', 'EMPLEADO', 'BACHILLERATO (PREPARATORIA)', 'CREE EN DIOS', 'ALDAMA #54 ZONA CENTRO', '4612987', '', 'jorgeac@mimail.com', '', 'SEPARADO (A)', '1 DE 14 AÑOS', '2 UNA DE 11 Y OTRA DE 10 AÑOS', 'NO', 'SI', 'SI', 'NO', 'NO', 'NO', 'NO', '', '', '', '', 'LA PROCURADURIA', 'SI', '', 1, 1, '2018-02-27 14:53:42'),
(4, 1, '2018-01-17', 'VALERIA', 'PEREZ', 'CASTAÑEDA', 'FEMENINO', '1990-10-17', 'EMPLEADA', 'BACHILLERATO (PREPARATORIA)', 'CRISTIANO (A)', 'EULALIO GUTIERREZ #612', '4697812', '', 'valeriapc@mimail.com', '', 'SOLTERO (A)', '1 DE 9 AÑOS', 'NO TIENE', 'NO', 'NO', 'SI', 'NO', 'SI', 'NO', 'NO', '', '', '3 meses', 'TEMPERAMENTO', 'FAMILIARES', 'NO', '', 1, 1, '2018-02-27 14:55:57'),
(5, 2, '2018-02-21', 'JUANA MARIA', 'HERNANDEZ', 'MELLADO', 'FEMENINO', '1975-09-11', 'EMPLEADA', 'BACHILLERATO (PREPARATORIA)', 'CATOLICO (A)', 'MORELOS #65 COL. PRESIDENTES', '4958745', '8446694512', 'jmariahm@mimail.com', 'Jana M', 'SOLTERO (A)', 'NO TIENE', 'NO TIENE', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NINGUNA', 'NINGUNA', '', 'ALCOHOLISMO', 'FAMILIAR', NULL, '', 2, 1, '2018-02-25 15:06:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idcentro` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `papellido` varchar(20) NOT NULL,
  `sapellido` varchar(20) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `imagen` varchar(60) DEFAULT NULL,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fechac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idcentro`, `nombre`, `papellido`, `sapellido`, `fechanacimiento`, `correo`, `telefono`, `direccion`, `imagen`, `usuario`, `password`, `activo`, `fechac`) VALUES
(1, 1, 'OSCAR ENRIQUE', 'GONZALEZ', 'GOMEZ', '1973-05-01', 'oegg@mimail.com', '8442345678', 'JUAREZ #234', '1519184283.jpg', 'admin', 'admin', 1, '2018-03-03 16:24:56'),
(2, 2, 'DAVID', 'SANCHEZ', 'GALINDO', '1980-03-03', 'davidsg@mimail.com', '8441597530', 'HIDALGO SUR #43', '1519183190.jpeg', 'david', 'david', 1, '2018-03-03 16:25:16'),
(3, 3, 'LUIS', 'PADILLA', 'RODRIGUEZ', '1975-11-10', 'luispr@mimail.com', '6754329876', 'HERNAN CORTEZ #54 FRACC. FUNDADORES', '1519237980.jpg', 'luispr', 'luispr', 1, '2018-03-03 16:25:38'),
(4, 1, 'CRUZ OLIVIA', 'GUERRERO', 'RAVELO', '1980-05-03', 'cruzoliviagr@mimail.com', '4527846', 'PRIV. ALAMOS #923 COL. ALAMOS', '1520086333.jpg', 'olivia', 'olivia', 1, '2018-03-03 16:25:56'),
(5, 2, 'ANDREA ANASTASIA', 'PEREZ', 'LOPEZ', '0000-00-00', 'andrea@mimail.com', '8443214587', 'POTREROS #56 COL. BUENA VISTA', '1520095932.jpeg', 'andrea', 'andrea', 1, '2018-03-03 16:52:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(13, 3, 1),
(14, 3, 4),
(15, 1, 1),
(16, 1, 2),
(17, 1, 3),
(18, 1, 4),
(25, 2, 1),
(26, 2, 4),
(29, 4, 1),
(30, 4, 4),
(33, 5, 1),
(34, 5, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistenciap`
--
ALTER TABLE `asistenciap`
  ADD PRIMARY KEY (`idap`),
  ADD KEY `fk_usuario_asistenciap` (`idusuario`) USING BTREE,
  ADD KEY `fk_centro_asistenciap` (`idcentro`) USING BTREE;

--
-- Indices de la tabla `asistenciaus`
--
ALTER TABLE `asistenciaus`
  ADD PRIMARY KEY (`idau`),
  ADD KEY `fk_centro_asistenciaus` (`idcentro`) USING BTREE,
  ADD KEY `fk_usuarios_asistenciaus` (`nombrer`) USING BTREE;

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`idcentro`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`);

--
-- Indices de la tabla `detalle_ap`
--
ALTER TABLE `detalle_ap`
  ADD PRIMARY KEY (`iddetalleap`),
  ADD KEY `fk_asistenciap_detalleap` (`idap`) USING BTREE,
  ADD KEY `fk_persona_detalleap` (`idpersona`) USING BTREE;

--
-- Indices de la tabla `detalle_us`
--
ALTER TABLE `detalle_us`
  ADD PRIMARY KEY (`iddetalleus`),
  ADD KEY `fk_usuarios_detalleus` (`idusuario`) USING BTREE,
  ADD KEY `fk_asistenciaus_detalleus` (`idau`) USING BTREE;

--
-- Indices de la tabla `historialpersona`
--
ALTER TABLE `historialpersona`
  ADD PRIMARY KEY (`idhp`),
  ADD KEY `fk_usuarios_historialp_idx` (`idusuario`),
  ADD KEY `fk_persona_historialp` (`idpersona`);

--
-- Indices de la tabla `historialusuario`
--
ALTER TABLE `historialusuario`
  ADD PRIMARY KEY (`idhu`),
  ADD KEY `fk_usuario_historialu_idx` (`idusuario`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_Entrevista_Entrevistador1_idx` (`idusuario`),
  ADD KEY `fk_entrevista_centro_idx` (`idcentro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fk_entrevistador_centro_idx` (`idcentro`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idpermiso` (`idpermiso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistenciap`
--
ALTER TABLE `asistenciap`
  MODIFY `idap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `asistenciaus`
--
ALTER TABLE `asistenciaus`
  MODIFY `idau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `idcentro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detalle_ap`
--
ALTER TABLE `detalle_ap`
  MODIFY `iddetalleap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalle_us`
--
ALTER TABLE `detalle_us`
  MODIFY `iddetalleus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `historialpersona`
--
ALTER TABLE `historialpersona`
  MODIFY `idhp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la entrevista', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistenciap`
--
ALTER TABLE `asistenciap`
  ADD CONSTRAINT `asistenciap_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `asistenciap_ibfk_2` FOREIGN KEY (`idcentro`) REFERENCES `centro` (`idcentro`);

--
-- Filtros para la tabla `asistenciaus`
--
ALTER TABLE `asistenciaus`
  ADD CONSTRAINT `asistenciaus_ibfk_2` FOREIGN KEY (`idcentro`) REFERENCES `centro` (`idcentro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ap`
--
ALTER TABLE `detalle_ap`
  ADD CONSTRAINT `detalle_ap_ibfk_1` FOREIGN KEY (`idap`) REFERENCES `asistenciap` (`idap`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detalle_ap_ibfk_2` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_us`
--
ALTER TABLE `detalle_us`
  ADD CONSTRAINT `detalle_us_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asistenciaus_detalleus` FOREIGN KEY (`idau`) REFERENCES `asistenciaus` (`idau`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historialpersona`
--
ALTER TABLE `historialpersona`
  ADD CONSTRAINT `fk_persona_historialp` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_historialp` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historialusuario`
--
ALTER TABLE `historialusuario`
  ADD CONSTRAINT `fk_usuario_historialu` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_centro_persona` FOREIGN KEY (`idcentro`) REFERENCES `centro` (`idcentro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_centro_usuarios` FOREIGN KEY (`idcentro`) REFERENCES `centro` (`idcentro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `usuario_permiso_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_permiso_ibfk_2` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
