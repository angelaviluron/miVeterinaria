-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2025 a las 03:17:13
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
-- Base de datos: `miveterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amo`
--

CREATE TABLE `amo` (
  `a_nombre` varchar(25) NOT NULL,
  `a_apellido` varchar(25) NOT NULL,
  `a_dir` varchar(50) NOT NULL,
  `a_tel` bigint(11) NOT NULL,
  `a_fechaAlta` date NOT NULL DEFAULT current_timestamp(),
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `amo`
--

INSERT INTO `amo` (`a_nombre`, `a_apellido`, `a_dir`, `a_tel`, `a_fechaAlta`, `a_id`) VALUES
('Nonie', 'Pérez', 'Calle Falsa 123', 1122334455, '2025-04-28', 1),
('María', 'Gómez', 'Av. Siempreviva 742', 2147483647, '2025-04-28', 2),
('Lorena', 'Baigorria', 'Las Heras 111', 2622666666, '2025-05-02', 5),
('Jose', 'Torres', 'Tomás Jofré 222', 2622222222, '2025-05-02', 6),
('Angela', 'Viluron', 'Las Heras 123', 2622454545, '2025-05-03', 7),
('Uriel', 'Villalobo', 'San Martin 111', 2665434343, '2025-05-04', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `m_nombre` varchar(25) NOT NULL,
  `m_especie` int(11) NOT NULL,
  `m_raza` varchar(25) NOT NULL,
  `m_nroRegistro` int(11) NOT NULL,
  `m_nac` date NOT NULL,
  `m_fechaAlta` date NOT NULL DEFAULT current_timestamp(),
  `m_fechaBaja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`m_nombre`, `m_especie`, `m_raza`, `m_nroRegistro`, `m_nac`, `m_fechaAlta`, `m_fechaBaja`) VALUES
('Luna', 0, 'Labrador', 1, '2021-05-10', '2021-06-01', NULL),
('Milo', 0, 'Siames', 2, '2020-03-22', '2020-04-15', NULL),
('Nina', 0, 'Mini Lop', 3, '2022-08-05', '2022-08-20', NULL),
('Toby', 0, 'Caniche', 4, '2019-11-30', '2019-12-10', '2024-03-01'),
('Kira', 0, 'Persa', 5, '2021-01-15', '2021-02-01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculo`
--

CREATE TABLE `vinculo` (
  `v_a_id` int(11) NOT NULL,
  `v_m_nroRegistro` int(11) NOT NULL,
  `v_estado` int(11) NOT NULL,
  `v_motivoBaja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vinculo`
--

INSERT INTO `vinculo` (`v_a_id`, `v_m_nroRegistro`, `v_estado`, `v_motivoBaja`) VALUES
(5, 1, 0, 0),
(2, 4, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amo`
--
ALTER TABLE `amo`
  ADD PRIMARY KEY (`a_id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`m_nroRegistro`);

--
-- Indices de la tabla `vinculo`
--
ALTER TABLE `vinculo`
  ADD PRIMARY KEY (`v_m_nroRegistro`,`v_a_id`),
  ADD KEY `v_a_id` (`v_a_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amo`
--
ALTER TABLE `amo`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `m_nroRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vinculo`
--
ALTER TABLE `vinculo`
  ADD CONSTRAINT `vinculo_ibfk_1` FOREIGN KEY (`v_a_id`) REFERENCES `amo` (`a_id`),
  ADD CONSTRAINT `vinculo_ibfk_2` FOREIGN KEY (`v_m_nroRegistro`) REFERENCES `mascota` (`m_nroRegistro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
