-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2024 a las 05:05:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor_archivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo_archivo` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `nombre_archivo`, `ruta_archivo`, `fecha_subida`, `tipo_archivo`) VALUES
(584, 'PRUEBA', 'uploads/AGENCIA_CARROS.pdf', '2024-11-24 03:24:08', 'application/pdf'),
(585, 'nuevo', 'uploads/Captura de pantalla (161).png', '2024-11-24 03:33:45', 'image/png'),
(587, 'probando modal', 'uploads/1732422397_Captura_de_pantalla__169_.png', '2024-11-24 04:26:37', 'image/png'),
(588, 'Prueba Audio', 'uploads/1732493718_05_-_Wake_Me_Up_When_September_Ends.mp3', '2024-11-25 00:15:18', 'audio/mpeg'),
(590, 'Prueba video 2', 'uploads/1732493858_Gen-2_4213664938__man_dressed_as_a_tra__M_5.mp4', '2024-11-25 00:17:38', 'video/mp4'),
(591, 'PRUEBA', 'uploads/1732496571_P', '2024-11-25 01:02:51', 'application/vnd.openxmlformats-officedocument.presentat'),
(592, 'PRUEBA 9', 'uploads/1732496673_P', '2024-11-25 01:04:33', 'image/png'),
(593, 'PRUEBA67', 'uploads/1732496714_Captura_de_pantalla__161_.png', '2024-11-25 01:05:14', 'image/png'),
(594, 'audio', 'uploads/1732496890_09_-_Strip_That_Down__Feat._Quavo_.mp3', '2024-11-25 01:08:10', 'audio/mpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usuario_id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpeta`
--

CREATE TABLE `carpeta` (
  `id` int(11) NOT NULL,
  `nombre_carpeta` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `archivos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(55) NOT NULL,
  `nivel_acceso` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `nivel_acceso`) VALUES
(1, 'Admin', 1),
(2, 'SuperAdmin', 1),
(3, 'Personal', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `correo` varchar(64) NOT NULL,
  `telefono` varchar(64) NOT NULL,
  `clave` varchar(512) NOT NULL,
  `codigo_acceso` text NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `modifcado_clave` datetime NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_roles` int(11) NOT NULL,
  `id_permisos` int(11) NOT NULL,
  `intentos_fallidos` int(11) DEFAULT 0,
  `ultimo_intento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='usuarios administradores y empleados';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `telefono`, `clave`, `codigo_acceso`, `estado`, `modifcado_clave`, `fecha_creacion`, `id_roles`, `id_permisos`, `intentos_fallidos`, `ultimo_intento`) VALUES
(4, 'katherine', '', 'kathernandz97@gmail.com', '', '1b2c04df09478b5b1b366b24819284cc582b375f4aab40f0edda0bf74a9dd847a8da8b76624b906c7dd2451a368a31f5baa160a643a542d52116ed2dc4d36328', '', 0, '0000-00-00 00:00:00', '2024-11-11 03:14:44', 0, 0, 0, NULL),
(5, 'William', '', 'katherineghz97@gmail.com', '', '1b2c04df09478b5b1b366b24819284cc582b375f4aab40f0edda0bf74a9dd847a8da8b76624b906c7dd2451a368a31f5baa160a643a542d52116ed2dc4d36328', '', 0, '0000-00-00 00:00:00', '2024-11-11 03:17:41', 0, 0, 0, NULL),
(6, 'katherine', '', 'katherinehcontact@gmail.com', '', '1b2c04df09478b5b1b366b24819284cc582b375f4aab40f0edda0bf74a9dd847a8da8b76624b906c7dd2451a368a31f5baa160a643a542d52116ed2dc4d36328', '', 0, '0000-00-00 00:00:00', '2024-11-23 21:47:54', 0, 0, 0, NULL),
(7, 'katherine', 'hernandez', 'kathernandz97@gmail.com', '04146555532', '$2y$10$zbxObJweb/KNN/mEld3Wt.BrlUVXiBq23I5VCYVPmo9W4RlMRR0Ka', '', 0, '0000-00-00 00:00:00', '2024-11-25 02:09:04', 0, 0, 0, NULL),
(8, 'katherine', 'hernandez', 'kathernandz97@gmail.com', '04146555532', '$2y$10$R9.IB5tVq4xQ/n.7AOmkJOdcGCIVLTSB.gQor/anz/8Ps4HEEwtM.', '', 0, '0000-00-00 00:00:00', '2024-11-25 02:09:26', 0, 0, 0, NULL),
(9, 'katherine', 'hernandez', 'kathernandz97@gmail.com', '04146555532', '$2y$10$AMVGffca4BJhkBnP9rR7JOY7na.yiFOnvOAMrxozhKRvI2g5n/Du6', '', 0, '0000-00-00 00:00:00', '2024-11-25 02:10:00', 0, 0, 0, NULL),
(10, 'katherine', 'hernandez', 'kathernandz97@gmail.com', '04146555532', '$2y$10$BuPdVQ1HagSaadIehRn3ouYg1PxdIKlc.xBqQXQwNxPm003EqPZEm', '', 0, '0000-00-00 00:00:00', '2024-11-25 02:11:33', 0, 0, 0, NULL),
(11, 'Jose ', 'Prueba', 'katherinehcontact@gmail.com', '04146555532', '$2y$10$6LbqdpZAKlBGwyyG/m6yUOPQDz9Ahtw8ZgxIn78xG15BmM/EBP9pu', '', 1, '0000-00-00 00:00:00', '2024-11-25 02:56:05', 0, 0, 0, NULL),
(12, 'Jose ', 'Editar', 'katherinehcontact@gmail.com', '04146555532', '$2y$10$Wc/Ue4ssx05OwyUef8wV9.Bng3LCWDhAd9pED8mjhtS.aoCzCzPy2', '', 1, '0000-00-00 00:00:00', '2024-11-25 03:18:34', 1, 0, 0, NULL),
(13, 'Jose ', 'Lopez', 'katherinehcontact@gmail.com', '04146555532', '$2y$10$Wc/Ue4ssx05OwyUef8wV9.Bng3LCWDhAd9pED8mjhtS.aoCzCzPy2', '', 1, '0000-00-00 00:00:00', '2024-11-25 03:23:29', 1, 0, 0, NULL),
(14, 'Hector ', 'Pachano', 'katherinehcontact@gmail.com', '04146555532', '$2y$10$IQA5893WjBBGjz7FTnojBe0eDsaQSFUJk0oRz1SuGujDVeIoXkgfK', '', 1, '0000-00-00 00:00:00', '2024-11-25 02:59:27', 0, 0, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carpeta`
--
ALTER TABLE `carpeta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=595;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carpeta`
--
ALTER TABLE `carpeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
