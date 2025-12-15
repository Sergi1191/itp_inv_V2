-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql100.byetcluster.com
-- Tiempo de generación: 15-12-2025 a las 03:12:41
-- Versión del servidor: 10.6.22-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `b6_40533998_itp_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Activos`
--

CREATE TABLE `Activos` (
  `id_activo` int(11) NOT NULL,
  `no_inventario` varchar(12) NOT NULL,
  `no_serie` varchar(50) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `id_sub` int(11) DEFAULT NULL,
  `id_dep` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `id_modelo` int(11) DEFAULT NULL,
  `id_estatus` int(11) DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Activos`
--

INSERT INTO `Activos` (`id_activo`, `no_inventario`, `no_serie`, `fecha_adquisicion`, `id_sub`, `id_dep`, `id_tipo`, `id_marca`, `id_modelo`, `id_estatus`, `id_responsable`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'ITPINM0001', '6SE51F98', '2020-12-17', 3, 1, 1, 2, 2, 2, 3, '2025-11-16 02:47:57', NULL),
(2, 'ITPINM0002', '1258563525612', '0002-02-15', 2, 1, 1, 2, 2, 6, 3, '2025-11-19 12:31:24', NULL),
(3, 'ITPINM0003', '12345578', '2025-07-11', 4, 1, 1, 2, 2, 2, 3, '2025-12-05 08:40:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamentos`
--

CREATE TABLE `Departamentos` (
  `id_dep` int(11) NOT NULL,
  `nombre_dep` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Departamentos`
--

INSERT INTO `Departamentos` (`id_dep`, `nombre_dep`) VALUES
(1, 'DEPTO. DE DESARROLLO ACADEMICO'),
(2, 'Centro de Informacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estatus`
--

CREATE TABLE `Estatus` (
  `id_estatus` int(11) NOT NULL,
  `nombre_estatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Estatus`
--

INSERT INTO `Estatus` (`id_estatus`, `nombre_estatus`) VALUES
(2, 'ACTIVO'),
(4, 'PERDIDO'),
(5, 'EN REPARACION'),
(6, 'PRESTADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marcas`
--

CREATE TABLE `Marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Marcas`
--

INSERT INTO `Marcas` (`id_marca`, `nombre_marca`) VALUES
(2, 'ASUS'),
(3, 'LENOVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Modelos`
--

CREATE TABLE `Modelos` (
  `id_modelo` int(11) NOT NULL,
  `nombre_modelo` varchar(50) NOT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Modelos`
--

INSERT INTO `Modelos` (`id_modelo`, `nombre_modelo`, `id_marca`) VALUES
(2, 'VIVOBOOK', 2),
(4, 'A100 Ideacentre ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prestamos_historial`
--

CREATE TABLE `Prestamos_historial` (
  `id_prestamo` int(11) NOT NULL,
  `id_activo` int(11) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion_estimada` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `multa` decimal(10,2) DEFAULT 0.00,
  `id_usuario_prestatario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Prestamos_historial`
--

INSERT INTO `Prestamos_historial` (`id_prestamo`, `id_activo`, `fecha_prestamo`, `fecha_devolucion_estimada`, `fecha_devolucion`, `multa`, `id_usuario_prestatario`) VALUES
(1, 1, '2025-11-16', NULL, '2025-11-16', '0.00', 3),
(16, 2, '2025-12-08', NULL, '2025-12-08', '0.00', 5),
(17, 2, '2025-12-09', NULL, NULL, '0.00', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'ADMIN'),
(3, 'ENCARGADO DE AREA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Subdirecciones`
--

CREATE TABLE `Subdirecciones` (
  `id_sub` int(11) NOT NULL,
  `nombre_sub` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Subdirecciones`
--

INSERT INTO `Subdirecciones` (`id_sub`, `nombre_sub`) VALUES
(1, 'DIRECCION'),
(2, 'SUBDIRECCION'),
(3, 'SUBDIRECCION DE PLANEACION Y VINCULACION'),
(4, 'SUBDIRECCION DE SERVICIOS ADMINISTRATIVOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipos_activo`
--

CREATE TABLE `Tipos_activo` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tipos_activo`
--

INSERT INTO `Tipos_activo` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'INMUEBLE'),
(4, 'COMPUTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `rol_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `nombre`, `nombre_usuario`, `password`, `last_login`, `rol_usuario`) VALUES
(3, 'Sergio Sanchez Cruz', 'admin', 'admin', NULL, 1),
(4, 'Noriega Perez Jennifer', 'jennihochis', '12345678', NULL, 3),
(5, 'Valles Vite Dania Marisol', 'Dania', 'mipelonchis', NULL, NULL),
(6, 'samantha siomara ', 'sam', '12345678909', NULL, 3),
(7, 'samantha siomara ', 'sam', '12345678909', NULL, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Activos`
--
ALTER TABLE `Activos`
  ADD PRIMARY KEY (`id_activo`),
  ADD UNIQUE KEY `unique_no_inventario` (`no_inventario`),
  ADD KEY `id_sub` (`id_sub`),
  ADD KEY `id_dep` (`id_dep`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_modelo` (`id_modelo`),
  ADD KEY `id_estatus` (`id_estatus`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Indices de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indices de la tabla `Estatus`
--
ALTER TABLE `Estatus`
  ADD PRIMARY KEY (`id_estatus`);

--
-- Indices de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `Modelos`
--
ALTER TABLE `Modelos`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_activo` (`id_activo`),
  ADD KEY `id_usuario_prestatario` (`id_usuario_prestatario`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `Subdirecciones`
--
ALTER TABLE `Subdirecciones`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indices de la tabla `Tipos_activo`
--
ALTER TABLE `Tipos_activo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_usuario` (`rol_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Activos`
--
ALTER TABLE `Activos`
  MODIFY `id_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Estatus`
--
ALTER TABLE `Estatus`
  MODIFY `id_estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Marcas`
--
ALTER TABLE `Marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Modelos`
--
ALTER TABLE `Modelos`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Subdirecciones`
--
ALTER TABLE `Subdirecciones`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Tipos_activo`
--
ALTER TABLE `Tipos_activo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Activos`
--
ALTER TABLE `Activos`
  ADD CONSTRAINT `Activos_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `Subdirecciones` (`id_sub`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_2` FOREIGN KEY (`id_dep`) REFERENCES `Departamentos` (`id_dep`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `Tipos_activo` (`id_tipo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_4` FOREIGN KEY (`id_marca`) REFERENCES `Marcas` (`id_marca`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_5` FOREIGN KEY (`id_modelo`) REFERENCES `Modelos` (`id_modelo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_6` FOREIGN KEY (`id_estatus`) REFERENCES `Estatus` (`id_estatus`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Activos_ibfk_7` FOREIGN KEY (`id_responsable`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `Modelos`
--
ALTER TABLE `Modelos`
  ADD CONSTRAINT `Modelos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `Marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  ADD CONSTRAINT `Prestamos_historial_ibfk_1` FOREIGN KEY (`id_activo`) REFERENCES `Activos` (`id_activo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Prestamos_historial_ibfk_2` FOREIGN KEY (`id_usuario_prestatario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `Roles` (`id_rol`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
