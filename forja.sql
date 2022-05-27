-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-04-2022 a las 14:01:21
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `forja`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `porcentaje_comision` int(11) NOT NULL DEFAULT '0',
  `porcentaje_anticipo` int(11) NOT NULL DEFAULT '0',
  `estado` int(11) NOT NULL DEFAULT '1',
  `visible` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `porcentaje_comision`, `porcentaje_anticipo`, `estado`, `visible`) VALUES
(1, 'Fiverr', 20, 1, 1, 1),
(2, 'Cliente', 20, 3, 1, 1),
(3, 'Cliente', 20, 3, 1, 1),
(4, 'Cliente', 20, 3, 1, 1),
(6, 'Francisco', 23, 17, 1, 1),
(7, 'ssssssssssss', 34, 6, 1, 1),
(8, 'Jefferson', 1, 1, 1, 1),
(9, 'aaa', 111, 11, 1, 1),
(11, 'Nuevo cliente', 18, 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo`
--

CREATE TABLE `codigo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `parametro` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `valor` varchar(64) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `parametro`, `valor`) VALUES
(1, 'porcentaje_administrativo', '30'),
(2, 'porcentaje_operativo', '70'),
(3, 'porcentaje_extra_arte_forja', '30'),
(4, 'porcentaje_extra_animacion_forja', '30'),
(5, 'porcentaje_extra_sonido_forja', '30'),
(6, 'porcentaje_anticipo_global', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisa`
--

CREATE TABLE `divisa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `iso_divisa` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `calcula_canje` tinyint(4) NOT NULL DEFAULT '1',
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `divisa`
--

INSERT INTO `divisa` (`id`, `nombre`, `iso_divisa`, `calcula_canje`, `estado`) VALUES
(1, 'Dólar americano', 'USD', 1, 1),
(2, 'Peso Colombiano', 'COP', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `nombre`, `estado`) VALUES
(1, 'Arte', 1),
(2, 'Animación', 1),
(3, 'Sonido', 1),
(4, 'Administración', 1),
(5, 'Extra Arte', 1),
(6, 'Extra Animación', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `estado`) VALUES
(1, 'Activo', 1),
(2, 'Pagado', 1),
(3, 'Terminado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maestra_pais`
--

CREATE TABLE `maestra_pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `iso` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `maestra_pais`
--

INSERT INTO `maestra_pais` (`id`, `nombre`, `iso`, `estado`) VALUES
(1, 'Colombia ', 'COP', 1),
(2, 'Argentina ', 'ARG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_proyecto`
--

CREATE TABLE `nivel_proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `valor_nivel` int(11) NOT NULL,
  `arte` int(11) NOT NULL,
  `animacion` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivel_proyecto`
--

INSERT INTO `nivel_proyecto` (`id`, `nombre`, `valor_nivel`, `arte`, `animacion`, `estado`) VALUES
(1, 'Nivel 1', 270, 55, 45, 1),
(2, 'Nivel 2', 380, 56, 44, 1),
(3, 'Nivel 3', 520, 57, 43, 1),
(4, 'Nivel 4', 720, 57, 43, 1),
(5, 'Otro Nivel', 1000, 50, 50, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `es_direccion` tinyint(4) NOT NULL DEFAULT '0',
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `id_especialidad`, `es_direccion`, `estado`) VALUES
(1, 'Administrativo', 4, 1, 1),
(2, 'Director de arte ', 1, 1, 1),
(3, 'Director de animación', 2, 1, 1),
(4, 'Director de sonido ', 3, 1, 1),
(5, 'Artista ', 1, 0, 1),
(6, 'Animador ', 2, 0, 1),
(7, 'Sonido', 3, 0, 1),
(8, 'Extra Arte', 5, 0, 1),
(9, 'Extra Animación', 6, 0, 1),
(10, 'Extra Sonido', 3, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_de_pago`
--

CREATE TABLE `periodo_de_pago` (
  `id` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `quincena` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo_de_pago`
--

INSERT INTO `periodo_de_pago` (`id`, `anio`, `mes`, `quincena`, `estado`) VALUES
(1, 1900, 1, 1, 0),
(2, 2022, 1, 2, 1),
(3, 2022, 2, 1, 1),
(4, 2022, 2, 2, 1),
(5, 2022, 3, 1, 1),
(6, 2022, 3, 2, 1),
(7, 2022, 4, 1, 1),
(8, 2022, 4, 2, 1),
(9, 2022, 5, 1, 1),
(10, 2022, 5, 2, 1),
(11, 2022, 6, 1, 1),
(12, 2022, 6, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes_operativos`
--

CREATE TABLE `porcentajes_operativos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `arte` int(11) NOT NULL,
  `animacion` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `porcentajes_operativos`
--

INSERT INTO `porcentajes_operativos` (`id`, `nombre`, `arte`, `animacion`, `estado`) VALUES
(1, 'Nivel 1', 55, 45, 1),
(2, 'Nivel 2', 56, 44, 1),
(3, 'Nivel 3', 57, 43, 1),
(4, 'Otro Nivel', 50, 50, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `detalle` varchar(512) COLLATE utf8_spanish_ci NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_periodo_de_pago` int(11) NOT NULL DEFAULT '1',
  `nivel` tinyint(4) NOT NULL DEFAULT '0',
  `valor_proyecto` float NOT NULL DEFAULT '0',
  `valor_proyecto_comision` float NOT NULL DEFAULT '0',
  `valor_proyecto_menos_comision` float NOT NULL DEFAULT '0',
  `valor_final_proyecto` float NOT NULL DEFAULT '0' COMMENT 'Valor del proyecto menos las comisiones (cliente y avance si tiene))',
  `valor_proyecto_cop` float NOT NULL DEFAULT '0',
  `valor_arte` float NOT NULL DEFAULT '0',
  `valor_arte_final` float NOT NULL DEFAULT '0' COMMENT 'Valor arte + valor tip arte ',
  `valor_animacion` float NOT NULL DEFAULT '0',
  `valor_animacion_final` float NOT NULL DEFAULT '0' COMMENT 'Valor animación + valor tip animación',
  `valor_avance` float NOT NULL DEFAULT '0' COMMENT 'Indica si el proyecto tiene o no adelanto',
  `valor_avance_comision` float NOT NULL DEFAULT '0',
  `valor_avance_tasa` float NOT NULL DEFAULT '0',
  `valor_extra_arte` float NOT NULL DEFAULT '0',
  `valor_extra_arte_comision` float NOT NULL DEFAULT '0',
  `valor_extra_arte_comision_adelanto` float NOT NULL DEFAULT '0',
  `valor_extra_arte_menos_comision` float NOT NULL DEFAULT '0',
  `valor_extra_arte_final` float NOT NULL DEFAULT '0',
  `valor_extra_arte_forja` float NOT NULL DEFAULT '0',
  `valor_extra_animacion` float NOT NULL DEFAULT '0',
  `valor_extra_animacion_comision` float NOT NULL DEFAULT '0',
  `valor_extra_animacion_comision_adelanto` float NOT NULL DEFAULT '0',
  `valor_extra_animacion_menos_comision` float NOT NULL DEFAULT '0',
  `valor_extra_animacion_final` float NOT NULL DEFAULT '0',
  `valor_extra_animacion_forja` float NOT NULL DEFAULT '0',
  `valor_extra_sonido` float NOT NULL DEFAULT '0',
  `valor_extra_sonido_comision` float NOT NULL DEFAULT '0',
  `valor_extra_sonido_adelanto` float NOT NULL DEFAULT '0',
  `valor_extra_sonido_menos_comision` float NOT NULL DEFAULT '0',
  `valor_extra_sonido_final` float NOT NULL DEFAULT '0',
  `valor_extra_sonido_forja` float NOT NULL DEFAULT '0',
  `valor_tip` float NOT NULL DEFAULT '0',
  `valor_tip_comision` float NOT NULL DEFAULT '0',
  `valor_tip_comision_adelanto` float NOT NULL DEFAULT '0',
  `valor_tip_menos_comision` float NOT NULL DEFAULT '0',
  `valor_tip_final` float NOT NULL DEFAULT '0',
  `valor_tip_base_calculo` float NOT NULL DEFAULT '0',
  `valor_tip_arte` float NOT NULL DEFAULT '0',
  `valor_tip_animacion` float NOT NULL DEFAULT '0',
  `valor_tip_sonido` float NOT NULL DEFAULT '0',
  `valor_adminstrativo` float NOT NULL DEFAULT '0',
  `valor_administrativo_para_forja` float NOT NULL DEFAULT '0',
  `valor_operativo` float NOT NULL DEFAULT '0',
  `valor_pago_eps` bigint(20) NOT NULL DEFAULT '0',
  `valor_pago_retencion` bigint(20) NOT NULL DEFAULT '0',
  `porcentaje_comision` int(11) NOT NULL DEFAULT '0',
  `porcentaje_descuento_avance` int(11) NOT NULL DEFAULT '0',
  `porcentaje_administrativo` int(11) NOT NULL DEFAULT '0',
  `porcentaje_operativo` int(11) NOT NULL DEFAULT '0',
  `porcentaje_arte` int(11) NOT NULL DEFAULT '0',
  `porcenteje_animacion` int(11) NOT NULL DEFAULT '0',
  `porcentaje_tip_arte` float NOT NULL DEFAULT '0',
  `porcentaje_tip_animacion` float NOT NULL DEFAULT '0',
  `porcentaje_tip_sonido` float NOT NULL DEFAULT '0',
  `porcentaje_extra_arte_forja` int(11) NOT NULL DEFAULT '0',
  `porcentaje_extra_animacion_forja` int(11) NOT NULL DEFAULT '0',
  `porcentaje_extra_sonido_forja` int(11) NOT NULL DEFAULT '0',
  `fecha_inicio` date NOT NULL DEFAULT '2000-01-01',
  `fecha_posible_fin` date NOT NULL DEFAULT '2000-01-01',
  `fecha_fin` date NOT NULL DEFAULT '2000-01-01',
  `fecha_registro` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `nombre`, `detalle`, `id_moneda`, `id_cliente`, `id_usuario`, `id_periodo_de_pago`, `nivel`, `valor_proyecto`, `valor_proyecto_comision`, `valor_proyecto_menos_comision`, `valor_final_proyecto`, `valor_proyecto_cop`, `valor_arte`, `valor_arte_final`, `valor_animacion`, `valor_animacion_final`, `valor_avance`, `valor_avance_comision`, `valor_avance_tasa`, `valor_extra_arte`, `valor_extra_arte_comision`, `valor_extra_arte_comision_adelanto`, `valor_extra_arte_menos_comision`, `valor_extra_arte_final`, `valor_extra_arte_forja`, `valor_extra_animacion`, `valor_extra_animacion_comision`, `valor_extra_animacion_comision_adelanto`, `valor_extra_animacion_menos_comision`, `valor_extra_animacion_final`, `valor_extra_animacion_forja`, `valor_extra_sonido`, `valor_extra_sonido_comision`, `valor_extra_sonido_adelanto`, `valor_extra_sonido_menos_comision`, `valor_extra_sonido_final`, `valor_extra_sonido_forja`, `valor_tip`, `valor_tip_comision`, `valor_tip_comision_adelanto`, `valor_tip_menos_comision`, `valor_tip_final`, `valor_tip_base_calculo`, `valor_tip_arte`, `valor_tip_animacion`, `valor_tip_sonido`, `valor_adminstrativo`, `valor_administrativo_para_forja`, `valor_operativo`, `valor_pago_eps`, `valor_pago_retencion`, `porcentaje_comision`, `porcentaje_descuento_avance`, `porcentaje_administrativo`, `porcentaje_operativo`, `porcentaje_arte`, `porcenteje_animacion`, `porcentaje_tip_arte`, `porcentaje_tip_animacion`, `porcentaje_tip_sonido`, `porcentaje_extra_arte_forja`, `porcentaje_extra_animacion_forja`, `porcentaje_extra_sonido_forja`, `fecha_inicio`, `fecha_posible_fin`, `fecha_fin`, `fecha_registro`, `estado`, `visible`) VALUES
(11, 'Arte y animación', '', 1, 1, 1, 1, 2, 380, 76, 304, 0, 0, 119.168, 0, 93.632, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 91.2, 0, 212.8, 0, 0, 20, 0, 30, 70, 56, 44, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-01-25 01:25:29', 1, 1),
(12, 'Proyecto extras', '', 1, 1, 1, 1, 3, 520, 104, 416, 0, 0, 291.2, 0, 0, 0, 1, 4.16, 0, 40, 8, 0, 32, 0, 9.6, 40, 8, 0, 32, 0, 9.6, 48, 9.6, 0, 38.4, 0, 11.52, 0, 0, 0, 0, 0, 0, 0, 0, 0, 120.64, 0, 291.2, 0, 0, 20, 1, 30, 70, 100, 0, 0, 0, 0, 30, 30, 30, '1900-01-01', '1900-01-01', '2000-01-01', '2022-01-25 01:35:39', 1, 1),
(15, 'SHELDAN', '', 1, 1, 1, 1, 3, 520, 104, 416, 0, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-01-26 22:13:11', 1, 1),
(16, 'Proycto con tip', '', 1, 1, 1, 1, 3, 520, 104, 411.84, 0, 0, 165.984, 0, 125.216, 0, 1, 4.16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150, 30, 0, 120, 0, 0, 0, 0, 0, 123.552, 0, 288.288, 0, 0, 20, 1, 30, 70, 57, 43, 0, 0, 0, 0, 0, 0, '2022-03-08', '1900-01-01', '2000-01-01', '2022-03-01 00:12:10', 1, 1),
(17, 'Con TIP y sonido', '', 1, 1, 1, 1, 3, 520, 104, 416, 0, 0, 165.984, 0, 125.216, 0, 1, 4.16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 100, 20, 0, 80, 0, 24, 100, 20, 0, 80, 0, 0, 0, 0, 0, 120.64, 0, 291.2, 0, 0, 20, 1, 30, 70, 57, 43, 0, 0, 0, 0, 0, 30, '2022-03-02', '2022-03-21', '2000-01-01', '2022-03-01 00:42:33', 1, 1),
(23, 'Valor final Proyecto', '', 1, 3, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-13 17:09:12', 1, 1),
(25, 'Prueba insertar Extras Forja', '', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 100, 20, 0, 80, 0, 24, 100, 20, 0, 80, 0, 24, 149, 29.8, 0, 119.2, 119.2, 35.76, 100, 20, 0, 80, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 30, 30, 30, '2022-03-19', '2022-04-09', '2000-01-01', '2022-03-13 22:08:49', 1, 1),
(26, 'Todo - Validación', '', 1, 1, 1, 0, 3, 520, 104, 416, 416, 0, 0, 0, 0, 0, 0, 0, 0, 120, 24, 0, 96, 0, 0, 140, 28, 0, 112, 0, 0, 150, 30, 0, 120, 120, 0, 100, 20, 0, 80, 0, 0, 0, 0, 0, 124.8, 124.8, 291.2, 0, 0, 20, 0, 30, 70, 0, 0, 0, 0, 0, 30, 30, 30, '2022-03-19', '2022-04-09', '2000-01-01', '2022-03-19 15:01:31', 1, 1),
(27, 'Con todo V1', '', 1, 1, 1, 0, 3, 520, 104, 416, 416, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 120, 24, 0, 96, 0, 28.8, 140, 28, 0, 112, 0, 33.6, 150, 30, 0, 120, 120, 36, 100, 20, 0, 80, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 30, 30, 30, '2022-03-19', '2022-03-31', '2000-01-01', '2022-03-19 15:30:37', 1, 1),
(28, 'Solo Arte V1', '', 1, 1, 1, 0, 3, 520, 104, 416, 416, 0, 291.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 100, 0, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-19 15:36:52', 1, 1),
(29, 'xxx', '', 1, 3, 1, 0, 3, 520, 104, 416, 416, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 100, 20, 0, 80, 80, 24, 100, 20, 0, 80, 80, 24, 100, 20, 0, 80, 80, 24, 100, 20, 0, 80, 0, 0, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 30, 30, 30, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-19 16:02:24', 1, 1),
(30, 'xxxx', '', 1, 1, 1, 0, 3, 520, 104, 416, 416, 0, 165.984, 0, 125.216, 0, 0, 0, 0, 100, 20, 0, 80, 77.6239, 23.2872, 100, 20, 0, 77.6, 80, 23.2872, 100, 20, 0, 80, 80, 23.2872, 100, 20, 0, 77.6, 80, 0, 0, 0, 0, 124.8, 31.2, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 30, 30, 30, '2022-03-19', '2022-04-09', '2000-01-01', '2022-03-19 16:38:28', 1, 1),
(31, 'Nuevo Insert', 'Observación', 1, 1, 1, 0, 3, 520, 104, 416, 0, 0, 165.984, 199.584, 125.216, 151, 0, 0, 0, 120, 24, 0, 96, 96, 0, 140, 28, 0, 112, 112, 0, 130, 26, 0, 104, 125.053, 0, 100, 20, 0, 80, 0, 395.2, 33.6, 25.3474, 21.0526, 124.8, 0, 291.2, 150000, 320000, 20, 0, 30, 70, 57, 43, 42, 31.6842, 26.3158, 0, 0, 0, '2022-03-21', '2022-04-09', '2000-01-01', '0000-00-00 00:00:00', 1, 1),
(32, 'Nuevo Insert', 'Observación', 1, 1, 1, 0, 3, 520, 104, 416, 416, 0, 165.984, 199.584, 125.216, 151, 0, 0, 0, 120, 24, 0, 96, 96, 0, 140, 28, 0, 112, 112, 0, 130, 26, 0, 104, 125.053, 0, 100, 20, 0, 80, 0, 395.2, 33.6, 25.3474, 21.0526, 124.8, 0, 291.2, 150000, 320000, 20, 0, 30, 70, 57, 43, 42, 31.6842, 26.3158, 0, 0, 0, '2022-03-21', '2022-04-09', '2000-01-01', '2022-03-21 22:06:51', 1, 1),
(33, 'Nuevo Insert', 'Observación', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 199.584, 125.216, 151, 0, 0, 0, 120, 24, 0, 96, 96, 0, 140, 28, 0, 112, 112, 0, 130, 26, 0, 104, 125.053, 0, 100, 20, 0, 80, 0, 395.2, 33.6, 25.3474, 21.0526, 124.8, 0, 291.2, 150000, 320000, 20, 0, 30, 70, 57, 43, 42, 31.6842, 26.3158, 0, 0, 0, '2022-03-21', '2022-04-09', '2000-01-01', '2022-03-21 22:07:35', 1, 1),
(34, 'Nuevo Insert', 'Observación', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 199.584, 125.216, 150.563, 0, 0, 0, 120, 24, 0, 96, 96, 0, 139, 27.8, 0, 111.2, 111.2, 0, 130, 26, 0, 104, 125.053, 0, 100, 20, 0, 80, 0, 395.2, 33.6, 25.3474, 21.0526, 124.8, 0, 291.2, 150000, 320000, 20, 0, 30, 70, 57, 43, 42, 31.6842, 26.3158, 0, 0, 0, '2022-03-21', '2022-04-09', '2000-01-01', '2022-03-21 22:15:36', 1, 1),
(35, 'Todos los parametros', 'Observación', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 199.248, 125.216, 150.31, 0, 0, 0, 120, 24, 0, 96, 96, 28.8, 139, 27.8, 0, 110.088, 110.088, 33.0264, 130, 26, 0, 104, 124.842, 31.2, 100, 20, 0, 79.2, 79.2, 395.2, 33.264, 25.0939, 20.8421, 124.8, 62.4, 291.2, 150000, 320000, 20, 1, 30, 70, 57, 43, 42, 31.6842, 26.3158, 0, 0, 0, '2022-03-21', '2022-04-09', '2000-01-01', '2022-03-21 22:32:16', 1, 1),
(41, 'validar extra animación', '', 1, 1, 1, 1, 3, 520, 104, 416, 411.84, 0, 164.324, 196.2, 123.964, 148.01, 1, 4.16, 0, 120, 24, 0.96, 96, 95.04, 28.512, 140, 28, 1.12, 112, 110.88, 33.264, 150, 30, 1.2, 120, 142.078, 35.64, 100, 20, 0.8, 80, 79.2, 408.288, 31.8757, 24.0466, 23.2777, 123.552, 30.888, 288.288, 0, 0, 20, 0, 30, 70, 57, 43, 40.2471, 30.3619, 29.391, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-23 22:33:41', 1, 1),
(42, 'Validación de extra sonido', '', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 291.2, 291.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 149, 29.8, 0, 119.2, 119.2, 35.76, 0, 0, 0, 0, 0, 291.2, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 100, 0, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-23 23:11:00', 1, 1),
(43, 'Validación de extra sonido 5', '', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 291.2, 291.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 149, 29.8, 0, 119.2, 119.2, 35.76, 0, 0, 0, 0, 0, 410.4, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 100, 0, 0, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-23 23:15:13', 1, 1),
(44, 'Validación de extra sonido + tip', '', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 0, 0, 291.2, 347.854, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150, 30, 0, 120, 143.346, 59.3463, 100, 20, 0, 80, 80, 411.2, 0, 56.6537, 23.3463, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 0, 100, 0, 70.8171, 29.1829, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-23 23:19:28', 1, 1),
(45, 'Validación de extra sonido + tip 2', '', 1, 1, 1, 1, 3, 520, 104, 416, 411.84, 0, 288.288, 344.21, 0, 0, 1, 4.16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 150, 30, 1.2, 120, 142.078, 35.64, 100, 20, 0.8, 80, 79.2, 408.288, 55.9223, 0, 23.2777, 123.552, 61.776, 288.288, 0, 0, 20, 0, 30, 70, 100, 0, 70.609, 0, 29.391, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-23 23:37:51', 1, 1),
(46, 'p1', '', 1, 1, 1, 1, 3, 520, 104, 416, 416, 0, 165.984, 165.984, 125.216, 125.216, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 291.2, 0, 0, 0, 124.8, 0, 291.2, 0, 0, 20, 0, 30, 70, 57, 43, 0, 0, 0, 0, 0, 0, '2022-03-28', '2022-03-29', '2000-01-01', '2022-03-28 23:08:20', 1, 1),
(47, 'p2', '', 1, 1, 1, 1, 4, 1200, 240, 960, 950.4, 0, 665.28, 665.28, 0, 0, 1, 9.6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 665.28, 0, 0, 0, 285.12, 0, 665.28, 0, 0, 20, 0, 30, 70, 100, 0, 100, 0, 0, 0, 0, 0, '1900-01-01', '1900-01-01', '2000-01-01', '2022-03-29 19:14:50', 1, 1),
(48, 'P3', '', 1, 1, 1, 1, 3, 520, 104, 416, 411.84, 0, 164.324, 196.2, 123.964, 148.01, 1, 4.16, 0, 120, 24, 0.96, 96, 95.04, 38.016, 130, 26, 1.04, 104, 102.96, 51.48, 150, 30, 1.2, 120, 142.078, 35.64, 100, 20, 0.8, 80, 79.2, 408.288, 31.8757, 24.0466, 23.2777, 123.552, 61.776, 288.288, 350000, 380000, 20, 0, 30, 70, 57, 43, 40.2471, 30.3619, 29.391, 0, 0, 0, '2022-03-29', '2022-03-30', '2000-01-01', '2022-03-29 19:42:56', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retiros`
--

CREATE TABLE `retiros` (
  `id` int(11) NOT NULL,
  `id_periodo_de_pago` int(11) NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `retiro_no` int(11) NOT NULL DEFAULT '0',
  `detalle` varchar(512) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin detalle',
  `id_proyecto` int(11) NOT NULL DEFAULT '0',
  `cantidad_usd` float NOT NULL DEFAULT '0',
  `tasa` float NOT NULL DEFAULT '0',
  `pago_usd` float NOT NULL DEFAULT '0',
  `cambio_cop` float NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `retiros`
--

INSERT INTO `retiros` (`id`, `id_periodo_de_pago`, `fecha`, `retiro_no`, `detalle`, `id_proyecto`, `cantidad_usd`, `tasa`, `pago_usd`, `cambio_cop`, `fecha_registro`, `id_usuario`) VALUES
(2, 1, '2022-03-25', 1, '', 0, 1500, 3933.33, 0, 5900000, '2022-03-24 22:21:56', 1),
(3, 1, '2022-03-28', 2, '', 0, 600, 4000, 0, 2400000, '2022-03-28 21:52:32', 1),
(6, 1, '2022-03-28', 0, 'Proyecto', 45, -411.84, 3952.38, 0, -1627750, '0000-00-00 00:00:00', 0),
(7, 1, '2022-03-29', 0, 'Proyecto', 47, -950.4, 3952.38, 0, -3756340, '0000-00-00 00:00:00', 0),
(9, 1, '2022-03-29', 0, 'Proyecto', 48, -411.84, 3952.38, 0, -1627750, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `id_usuario`, `porcentaje`) VALUES
(1, 3, 50),
(2, 5, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `documento_identidad` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `lugar_expedicion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `id_pais` int(11) NOT NULL,
  `contrasena` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `token_recuperacion` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `estado_recuperacion` tinyint(4) NOT NULL DEFAULT '0',
  `codigo_registro` varchar(64) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `visible` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `documento_identidad`, `lugar_expedicion`, `correo`, `celular`, `id_pais`, `contrasena`, `token_recuperacion`, `estado_recuperacion`, `codigo_registro`, `fecha_registro`, `estado`, `visible`) VALUES
(1, 'Forja ', 'Group', '71267783', 'Medellín', 'monsalveuribe@gmail.com', '3174300508', 1, '12345', '0', 0, '0', '2022-01-25 00:00:00', 1, 1),
(2, 'Francisco', 'Monsalve', '80249678', 'Bogotá', 'exasleal@gmail.com', '3227339746', 1, '12345', '0', 0, '0', '2022-01-25 00:00:00', 1, 1),
(3, 'Oscar', 'Saldarriaga', '12345679', 'Medellín', 'oscar@forja.com', '321654987', 1, '132456', '0', 0, '0', '2022-01-02 00:00:00', 1, 1),
(4, 'Jhon Jairo ', 'Leal', '65498731', 'Medellín', 'david@forja.com', '32165498', 1, '123456', '0', 0, '0', '2022-01-02 00:00:00', 1, 1),
(5, 'David', 'Barreto', '321856454', 'Bogotá', 'mail@co.co', '3125654654', 1, '123465', '123465', 0, '0', '2022-03-09 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_perfil`
--

CREATE TABLE `usuario_perfil` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_perfil`
--

INSERT INTO `usuario_perfil` (`id`, `id_usuario`, `id_perfil`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 5),
(4, 3, 3),
(5, 3, 6),
(6, 3, 5),
(7, 4, 2),
(8, 5, 2),
(9, 5, 7),
(10, 3, 4),
(11, 1, 1),
(12, 1, 1),
(13, 4, 7),
(14, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_proyecto`
--

CREATE TABLE `usuario_proyecto` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `valor_ganado` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_proyecto`
--

INSERT INTO `usuario_proyecto` (`id`, `id_proyecto`, `id_usuario`, `id_perfil`, `porcentaje`, `valor_ganado`) VALUES
(190, 23, 1, 1, 0, 0),
(191, 23, 1, 4, 30, 0),
(196, 25, 1, 1, 0, 0),
(197, 25, 1, 10, 30, 35.76),
(198, 25, 1, 9, 50, 40),
(199, 25, 1, 9, 30, 24),
(201, 25, 2, 8, 0, 0),
(202, 25, 3, 3, 25, 31.2),
(203, 25, 3, 9, 60, 48),
(210, 25, 3, 5, 100, 254.34),
(211, 25, 3, 8, 0, 0),
(212, 25, 4, 7, 0, 0),
(213, 26, 1, 1, 100, 124.8),
(214, 26, 1, 10, 30, 36),
(215, 26, 1, 8, 30, 28.8),
(216, 26, 1, 9, 30, 33.6),
(217, 27, 1, 1, 0, 0),
(218, 27, 1, 10, 30, 36),
(219, 27, 1, 8, 30, 28.8),
(220, 27, 1, 9, 30, 33.6),
(221, 26, 2, 5, 100, 0),
(222, 26, 2, 8, 0, 0),
(223, 28, 1, 1, 100, 124.8),
(224, 28, 2, 5, 100, 291.2),
(225, 29, 1, 1, 0, 0),
(226, 29, 1, 10, 30, 24),
(227, 29, 1, 8, 30, 24),
(228, 29, 1, 9, 30, 24),
(229, 30, 1, 1, 25, 31.2),
(230, 30, 1, 10, 30, 24),
(231, 30, 1, 8, 30, 24),
(232, 30, 1, 9, 30, 24),
(234, 30, 2, 8, 0, 0),
(235, 30, 2, 5, 0, 0),
(236, 30, 3, 5, 0, 0),
(237, 30, 3, 8, 0, 0),
(238, 30, 3, 3, 25, 31.2),
(239, 30, 3, 9, 0, 0),
(240, 30, 2, 2, 5, 6.24),
(241, 30, 4, 2, 20, 24.96),
(242, 30, 4, 8, 0, 0),
(243, 29, 3, 6, 0, 0),
(244, 29, 3, 9, 0, 0),
(245, 31, 1, 1, 0, 0),
(246, 31, 1, 10, 30, 31.2),
(247, 31, 1, 8, 30, 28.8),
(248, 31, 1, 9, 30, 33.6),
(249, 32, 1, 1, 0, 0),
(250, 32, 1, 10, 30, 31.2),
(251, 32, 1, 8, 30, 28.8),
(252, 32, 1, 9, 30, 33.6),
(253, 33, 1, 1, 0, 0),
(254, 33, 1, 10, 30, 31.2),
(255, 33, 1, 8, 30, 28.8),
(256, 33, 1, 9, 30, 33.6),
(257, 34, 1, 1, 0, 0),
(258, 34, 1, 10, 30, 31.2),
(259, 34, 1, 8, 30, 28.8),
(260, 34, 1, 9, 30, 33.36),
(261, 35, 1, 1, 50, 62.4),
(262, 35, 1, 10, 30, 37.4526),
(263, 35, 1, 8, 30, 28.8),
(264, 35, 1, 9, 30, 33.0264),
(270, 35, 2, 2, 30, 37.44),
(271, 35, 2, 8, 0, 0),
(272, 41, 1, 1, 25, 30.888),
(273, 41, 1, 10, 30, 42.6233),
(274, 41, 1, 8, 30, 28.512),
(275, 41, 1, 9, 30, 33.264),
(278, 41, 2, 2, 40, 49.4208),
(279, 41, 2, 8, 70, 66.528),
(283, 41, 3, 9, 70, 77.616),
(284, 41, 3, 3, 25, 30.888),
(286, 41, 4, 10, 70, 99.4544),
(287, 41, 2, 5, 50, 98.0999),
(288, 41, 3, 5, 50, 98.0999),
(289, 41, 3, 8, 0, 0),
(290, 42, 1, 1, 0, 0),
(291, 42, 1, 10, 30, 35.76),
(292, 43, 1, 1, 0, 0),
(293, 43, 1, 10, 30, 35.76),
(294, 43, 2, 5, 0, 0),
(295, 43, 4, 10, 70, 83.44),
(296, 44, 1, 1, 0, 0),
(297, 44, 1, 10, 30, 59.3463),
(298, 45, 1, 1, 50, 61.776),
(299, 45, 1, 10, 30, 42.6233),
(300, 45, 4, 10, 70, 99.4544),
(301, 45, 2, 2, 50, 61.776),
(302, 45, 2, 8, 0, 0),
(303, 45, 2, 5, 40, 137.684),
(304, 45, 3, 5, 60, 206.526),
(305, 35, 3, 3, 20, 24.96),
(306, 35, 3, 9, 70, 77.0616),
(307, 35, 3, 5, 100, 199.248),
(308, 35, 3, 8, 70, 67.2),
(309, 35, 3, 6, 100, 150.31),
(310, 35, 4, 10, 70, 87.3895),
(311, 46, 1, 1, 50, 62.4),
(313, 46, 2, 8, 0, 0),
(314, 47, 1, 1, 0, 0),
(315, 48, 1, 1, 50, 61.776),
(316, 48, 1, 10, 30, 42.6233),
(317, 48, 1, 8, 40, 38.016),
(318, 48, 1, 9, 50, 51.48),
(320, 48, 2, 8, 0, 0),
(322, 48, 4, 8, 0, 0),
(324, 48, 3, 8, 0, 0),
(331, 48, 2, 2, 0, 0),
(332, 48, 4, 2, 0, 0),
(334, 48, 3, 6, 0, 0),
(335, 48, 3, 9, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codigo`
--
ALTER TABLE `codigo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `divisa`
--
ALTER TABLE `divisa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maestra_pais`
--
ALTER TABLE `maestra_pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nivel_proyecto`
--
ALTER TABLE `nivel_proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especialidad` (`id_especialidad`);

--
-- Indices de la tabla `periodo_de_pago`
--
ALTER TABLE `periodo_de_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `porcentajes_operativos`
--
ALTER TABLE `porcentajes_operativos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `retiros`
--
ALTER TABLE `retiros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_pais` (`id_pais`);

--
-- Indices de la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `perfil` (`id_perfil`);

--
-- Indices de la tabla `usuario_proyecto`
--
ALTER TABLE `usuario_proyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `codigo`
--
ALTER TABLE `codigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `divisa`
--
ALTER TABLE `divisa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `maestra_pais`
--
ALTER TABLE `maestra_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nivel_proyecto`
--
ALTER TABLE `nivel_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `periodo_de_pago`
--
ALTER TABLE `periodo_de_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `porcentajes_operativos`
--
ALTER TABLE `porcentajes_operativos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `retiros`
--
ALTER TABLE `retiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario_proyecto`
--
ALTER TABLE `usuario_proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidad` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_pais` FOREIGN KEY (`id_pais`) REFERENCES `maestra_pais` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD CONSTRAINT `perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_proyecto`
--
ALTER TABLE `usuario_proyecto`
  ADD CONSTRAINT `proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_proyecto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `usuario_proyecto_ibfk_2` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
