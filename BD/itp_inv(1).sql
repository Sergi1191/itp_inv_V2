-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-11-2025 a las 21:50:10
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
-- Base de datos: `itp_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Activos`
--

CREATE TABLE `Activos` (
  `no_inventario` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `no_serie` varchar(50) DEFAULT NULL,
  `estatus` varchar(50) DEFAULT NULL,
  `fecha_adquisicion` date DEFAULT NULL,
  `id_sub` int(11) DEFAULT NULL,
  `id_dep` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Activos`
--

INSERT INTO `Activos` (`no_inventario`, `marca`, `modelo`, `no_serie`, `estatus`, `fecha_adquisicion`, `id_sub`, `id_dep`, `id_tipo`, `id_responsable`, `fecha_creacion`, `fecha_modificacion`) VALUES
(1, 'ASUS', 'VIVOBOOK', 'AE6F544654', 'Activo', '2020-01-01', 1, 1, 1, 1, '2025-11-06 08:44:06', NULL);

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
(1, 'DEPTO. DE DESARROLLO ACADEMICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documentacion`
--

CREATE TABLE `Documentacion` (
  `id_documento` int(11) NOT NULL,
  `no_inventario` int(11) DEFAULT NULL,
  `tipo_documento` varchar(50) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `subido_por_usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prestamos_historial`
--

CREATE TABLE `Prestamos_historial` (
  `id_prestamo` int(11) NOT NULL,
  `no_inventario` int(11) DEFAULT NULL,
  `fecha_prestamo` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `id_usuario_prestatario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Prestamos_historial`
--

INSERT INTO `Prestamos_historial` (`id_prestamo`, `no_inventario`, `fecha_prestamo`, `fecha_devolucion`, `id_usuario_prestatario`) VALUES
(1, 1, '2025-11-06', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Roles`
--

CREATE TABLE `Roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'ADMINISTRADOR', 'Control total');

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
(1, 'SUBDIRECCION DE PLANEACION Y VINCULACION');

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
(1, 'COMPUTO');

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
(1, 'SERGIO SANCHEZ CRUZ', 'admin', 'admin', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Activos`
--
ALTER TABLE `Activos`
  ADD PRIMARY KEY (`no_inventario`),
  ADD KEY `id_sub` (`id_sub`),
  ADD KEY `id_dep` (`id_dep`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_responsable` (`id_responsable`);

--
-- Indices de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indices de la tabla `Documentacion`
--
ALTER TABLE `Documentacion`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `no_inventario` (`no_inventario`),
  ADD KEY `subido_por_usuario_id` (`subido_por_usuario_id`);

--
-- Indices de la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `no_inventario` (`no_inventario`),
  ADD KEY `id_usuario_prestatario` (`id_usuario_prestatario`);

--
-- Indices de la tabla `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

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
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `rol_usuario` (`rol_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Activos`
--
ALTER TABLE `Activos`
  MODIFY `no_inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Documentacion`
--
ALTER TABLE `Documentacion`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Subdirecciones`
--
ALTER TABLE `Subdirecciones`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Tipos_activo`
--
ALTER TABLE `Tipos_activo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Activos`
--
ALTER TABLE `Activos`
  ADD CONSTRAINT `Activos_ibfk_1` FOREIGN KEY (`id_sub`) REFERENCES `Subdirecciones` (`id_sub`),
  ADD CONSTRAINT `Activos_ibfk_2` FOREIGN KEY (`id_dep`) REFERENCES `Departamentos` (`id_dep`),
  ADD CONSTRAINT `Activos_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `Tipos_activo` (`id_tipo`),
  ADD CONSTRAINT `Activos_ibfk_4` FOREIGN KEY (`id_responsable`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `Documentacion`
--
ALTER TABLE `Documentacion`
  ADD CONSTRAINT `Documentacion_ibfk_1` FOREIGN KEY (`no_inventario`) REFERENCES `Activos` (`no_inventario`) ON DELETE SET NULL,
  ADD CONSTRAINT `Documentacion_ibfk_2` FOREIGN KEY (`subido_por_usuario_id`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `Prestamos_historial`
--
ALTER TABLE `Prestamos_historial`
  ADD CONSTRAINT `Prestamos_historial_ibfk_1` FOREIGN KEY (`no_inventario`) REFERENCES `Activos` (`no_inventario`) ON DELETE SET NULL,
  ADD CONSTRAINT `Prestamos_historial_ibfk_2` FOREIGN KEY (`id_usuario_prestatario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `Usuarios_ibfk_1` FOREIGN KEY (`rol_usuario`) REFERENCES `Roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
