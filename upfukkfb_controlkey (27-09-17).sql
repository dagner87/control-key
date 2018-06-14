-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-09-2017 a las 23:23:55
-- Versión del servidor: 10.0.32-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `upfukkfb_controlkey`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `nombre_almacen` varchar(80) DEFAULT NULL,
  `direccion` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `nombre_almacen`, `direccion`) VALUES
(1, 'SANTA CRUZ', 'Barasea 414'),
(2, 'LA PAZ', 'ACHUMANI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_pedido_prov`
--

CREATE TABLE `almacen_pedido_prov` (
  `id_almacen` int(11) NOT NULL,
  `id_pedido_prov` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen_pedido_prov`
--

INSERT INTO `almacen_pedido_prov` (`id_almacen`, `id_pedido_prov`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(1, 11),
(1, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(1, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(1, 'PAPEL TERMICO\r\n'),
(2, 'PINES\r\n'),
(3, 'TARJETAS\r\n\r\n'),
(4, 'TARJETAS DE COORDENADAS\r\n'),
(5, 'PAPEL AUTOCOPIATIVO'),
(6, 'MUEBLES ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cli` varchar(100) DEFAULT NULL,
  `direccion_cli` text,
  `telefono_cli` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cli`, `direccion_cli`, `telefono_cli`) VALUES
(3, 'Banco Económico', '<p>\r\n	Ingavi, Santa Cruz de la Sierra, Bolivia</p>\r\n', '53270078'),
(4, 'Banco Mercantil Santa Cruz', NULL, NULL),
(5, 'Banco Sol', NULL, NULL),
(6, 'Banco Los Andes', NULL, NULL),
(7, 'Banco BNB', NULL, NULL),
(8, 'Banco Fassil S.A.', '<p>\r\n	Av.Uruguay&nbsp;</p>\r\n', '8001516'),
(9, 'Banco Solidario', NULL, NULL),
(10, 'Burger King', NULL, NULL),
(11, 'Cooperativa Jerusalén', NULL, NULL),
(12, 'Cooperativa La Trinidad', NULL, NULL),
(13, 'Cooperativa Samaritano', NULL, NULL),
(14, 'AFP Futuro', NULL, NULL),
(15, 'Banco Ecofuturo', NULL, NULL),
(18, 'Cooperativa Jesús Nazareno', 'Calle La Paz', '12345678'),
(19, 'Cooperativa Fatima', '<h2 style=\"box-sizing: border-box; font-family: &quot;Arial Narrow&quot;, sans-serif; line-height: 1.1; color: rgb(112, 0, 0); margin-top: 36px; margin-bottom: 10px; font-size: 17px; position: relative;\">\r\n	<a class=\"point current\" data-latitud=\"-17.798260\" data-longitud=\"-63.191203\" href=\"http://fatima.coop/contactenos/agencias\" style=\"box-sizing: border-box; background-color: rgb(245, 195, 89); color: rgb(112, 0, 0); text-decoration-line: none; padding: 10px 0px 10px 15px; display: inline-block; width: 390px; transition: all 0.3s ease; font-size: 14px;\"><span style=\"box-sizing: border-box; margin-top: 5px;\">Calle Obispo Pe&ntilde;a No. 63 Zona el Pari</span></a></h2>\r\n', '3537000'),
(20, 'Banco Union', '<p>\r\n	Calle Irala</p>\r\n', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_conf` int(11) NOT NULL,
  `parametro` varchar(50) NOT NULL,
  `valor` varchar(15) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id_conf`, `parametro`, `valor`, `descripcion`) VALUES
(3, 'pedido_inicial', '00000058', '<p>\r\n	Valor inicial del Pedido</p>\r\n'),
(4, 'alerta_correos', '2', '<p>\r\n	Muestra una Alerta del sistema al encargado <strong>(Valor)</strong> en dias antes de una accion.</p>\r\n'),
(5, 'pago_aduana', '7', '<p>\r\n	Rango de Dias para pagar facturas de la aduana.&nbsp;</p>\r\n'),
(6, 'pago_tramitador_aduanero', '7', '<p>\r\n	Tiempo de pago tramitador aduanero</p>\r\n'),
(7, 'transp_nac', '14', '<p>\r\n	tiempo de pago de facturas transporte nacional(Bolivian Express)</p>\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_productos`
--

CREATE TABLE `entrada_productos` (
  `fecha_entrada` date NOT NULL,
  `cantidad_inicial` int(20) NOT NULL,
  `id_almacen` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `id_paquete` int(11) NOT NULL,
  `no_factura` varchar(100) NOT NULL,
  `factura_doc` varchar(100) NOT NULL,
  `paquin_list` varchar(100) NOT NULL,
  `peso_total` varchar(100) NOT NULL,
  `fecha_tope_pago_fact` date NOT NULL,
  `via_transporte` varchar(10) NOT NULL,
  `fecha_llegadaAd` date NOT NULL,
  `fecha_salidaAd` date NOT NULL,
  `fecha_key` date NOT NULL,
  `no_poliza` varchar(100) NOT NULL,
  `respaldo_poliza` text NOT NULL,
  `monto_poliza` int(11) NOT NULL,
  `srt` text NOT NULL,
  `dui` text NOT NULL,
  `costo_aereo` varchar(20) NOT NULL,
  `no_factura_traext` varchar(50) NOT NULL,
  `costo_transp_ext` varchar(20) NOT NULL,
  `fecha_topepagofactrapext` date NOT NULL,
  `fechapago_factrapext` date NOT NULL,
  `costo_aduana_ext` varchar(20) NOT NULL,
  `costo_aduana_bol` varchar(20) NOT NULL,
  `no_factura_traint` varchar(50) NOT NULL,
  `costo_transporte_bol` varchar(20) NOT NULL,
  `costo_trans_bol_int` varchar(20) NOT NULL,
  `factura_transporte_int` text NOT NULL,
  `estado_pac_entransito` char(1) NOT NULL DEFAULT '0',
  `estado_entregado` varchar(1) NOT NULL,
  `fecha_pago_fact` date NOT NULL,
  `estado_pagado` int(1) NOT NULL DEFAULT '0',
  `estado_fatrapext` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`id_paquete`, `no_factura`, `factura_doc`, `paquin_list`, `peso_total`, `fecha_tope_pago_fact`, `via_transporte`, `fecha_llegadaAd`, `fecha_salidaAd`, `fecha_key`, `no_poliza`, `respaldo_poliza`, `monto_poliza`, `srt`, `dui`, `costo_aereo`, `no_factura_traext`, `costo_transp_ext`, `fecha_topepagofactrapext`, `fechapago_factrapext`, `costo_aduana_ext`, `costo_aduana_bol`, `no_factura_traint`, `costo_transporte_bol`, `costo_trans_bol_int`, `factura_transporte_int`, `estado_pac_entransito`, `estado_entregado`, `fecha_pago_fact`, `estado_pagado`, `estado_fatrapext`) VALUES
(6, '001-00008607', '4d49e-f001-no-00008607.pdf', '6c1e5-packing-8607.pdf', '2160', '2017-08-18', 'terrestre', '0000-00-00', '0000-00-00', '2017-09-09', '4508', '', 1133, '', '', '', '', '900', '0000-00-00', '0000-00-00', '100', '', '', '', '', '', '2', '1', '0000-00-00', 0, 0),
(4, '001-00008607', '1a255-f001-no-00008607.pdf', '34fd5-packing-8607.pdf', '2160', '2017-08-18', 'terrestre', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '1', '', '0000-00-00', 0, 0),
(5, '001-00013571', '', '', '213.395', '2017-09-25', 'terrestre', '0000-00-00', '0000-00-00', '0000-00-00', '4507', '', 612, '', '', '', '', '400', '0000-00-00', '0000-00-00', '100', '', '', '', '', '', '2', '1', '0000-00-00', 0, 0),
(7, '001-00014165', '64b20-3000-pines.pdf', '', '11.499', '2017-10-14', 'aereo', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '2', '1', '0000-00-00', 0, 0),
(8, '001-00014239', '53617-f-14239.pdf', '', '1744.8', '2017-10-14', 'terrestre', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '2', '1', '0000-00-00', 0, 0),
(9, '001-00014478', '86f6e-f001-00014478.pdf', '', '10', '2017-10-27', 'aereo', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '2', '1', '0000-00-00', 0, 0),
(12, '001-00014601', '1d884-658-21108555-keysolutions-lpb.pdf', '', '90', '2017-10-27', 'aereo', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '0', '', '0000-00-00', 0, 0),
(13, '10074324', 'a9cc7-fact10074324.docx', '', '1588', '2017-10-25', 'aereo', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '0', '', '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete_trans_ext`
--

CREATE TABLE `paquete_trans_ext` (
  `id_paquete` int(11) NOT NULL,
  `id_transporte_ext` int(11) NOT NULL,
  `prioridad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquete_trans_ext`
--

INSERT INTO `paquete_trans_ext` (`id_paquete`, `id_transporte_ext`, `prioridad`) VALUES
(2, 1, 0),
(6, 4, 0),
(5, 3, 0),
(8, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paq_ped_prov`
--

CREATE TABLE `paq_ped_prov` (
  `id_paquete` int(11) NOT NULL,
  `id_pedido_prov` int(11) NOT NULL,
  `prioridad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paq_ped_prov`
--

INSERT INTO `paq_ped_prov` (`id_paquete`, `id_pedido_prov`, `prioridad`) VALUES
(6, 14, 0),
(5, 13, 0),
(7, 10, 0),
(9, 17, 0),
(13, 33, 0),
(12, 18, 0),
(8, 7, 1),
(8, 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_proveedor`
--

CREATE TABLE `pedido_proveedor` (
  `id_pedido_prov` int(11) NOT NULL,
  `no_pedido` varchar(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `cantidad_solicitada` int(15) NOT NULL,
  `precio_unitario` varchar(20) NOT NULL,
  `costo_total` varchar(100) NOT NULL,
  `observacion` text NOT NULL,
  `estado_solicitado` int(1) NOT NULL DEFAULT '1',
  `estado_transito` int(1) NOT NULL DEFAULT '0',
  `estado_enaduana` int(1) NOT NULL DEFAULT '0',
  `estado_entregado` int(1) NOT NULL DEFAULT '0',
  `id_almacen` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido_proveedor`
--

INSERT INTO `pedido_proveedor` (`id_pedido_prov`, `no_pedido`, `fecha_pedido`, `fecha_entrega`, `id_proveedor`, `id_producto`, `nombre_producto`, `cantidad_solicitada`, `precio_unitario`, `costo_total`, `observacion`, `estado_solicitado`, `estado_transito`, `estado_enaduana`, `estado_entregado`, `id_almacen`) VALUES
(6, '00000034', '2017-08-14', '2017-08-30', 1, 21, 'PINES ATC', 300000, '', '12216.00', '', 1, 0, 0, 0, '2'),
(7, '00000035', '2017-08-04', '2017-08-30', 1, 22, 'Tarjeta PVC Banco Sol', 32000, '', '3154.24', '', 0, 2, 2, 1, '2'),
(9, '00000037', '2017-08-08', '2017-08-30', 1, 17, 'FORMATO CAJA', 900000, '', '6471.00', '', 0, 2, 2, 1, '2'),
(10, '00000038', '2017-07-26', '2017-08-30', 1, 23, 'Pines Fassil', 3000, '', '796.68', '', 0, 2, 2, 1, '2'),
(13, '00000041', '2017-06-23', '2017-08-11', 1, 21, 'PINES ATC', 65000, '', '2646.80', '', 0, 2, 2, 1, '2'),
(14, '00000042', '2017-08-04', '2017-08-11', 4, 13, 'ROLLOS 80X80', 6000, '', '5100.00', '', 0, 2, 2, 1, '2'),
(15, '00000043', '2017-09-06', '2017-09-27', 1, 17, 'FORMATO CAJA', 900000, '', '6471.00', '', 1, 0, 0, 0, '2'),
(17, '00000044', '2017-07-21', '2017-09-12', 1, 11, 'TARJETAS DE COORDENADAS BNB', 5000, '', '1004.45', '', 0, 2, 2, 1, '2'),
(18, '00000044', '2017-07-21', '2017-09-12', 1, 11, 'TARJETAS DE COORDENADAS BNB', 45000, '', '9040.05', '', 0, 1, 0, 0, '2'),
(19, '00000045', '2017-09-01', '2017-09-15', 1, 23, 'Pines Fassil', 6000, '', '1593.36', '', 1, 0, 0, 0, '2'),
(20, '00000046', '2017-09-15', '2017-09-29', 1, 21, 'PINES ATC', 200000, '', '8144.00', '', 1, 0, 0, 0, '2'),
(21, '00000047', '2017-09-15', '2017-09-29', 4, 13, 'ROLLOS 80X80', 3000, '', '2550.00', '', 1, 0, 0, 0, '2'),
(22, '00000048', '2017-09-15', '2017-09-29', 4, 14, 'ROLLO FASSIL ATM CHICO ', 150, '', '780.00', '', 1, 0, 0, 0, '2'),
(23, '00000049', '2017-09-15', '2017-09-29', 4, 15, 'ROLLO  FASSIL ATM GRANDE', 150, '', '1350.00', '', 1, 0, 0, 0, '2'),
(24, '00000050', '2017-09-15', '2017-09-29', 4, 24, 'Rollo 80x75 ', 1000, '', '780.00', '', 1, 0, 0, 0, '2'),
(28, '00000053', '2017-09-22', '2017-10-13', 2, 26, 'Tarj. Mastecard Chip JMV Ecofuturo', 2000, '', '3440.00', '', 1, 0, 0, 0, '2'),
(29, '00000054', '2017-09-25', '2017-10-10', 2, 7, 'TARJETAS DE DEBITO VISA - BANCO UNION', 200000, '', '201560.00', '', 1, 0, 0, 0, '2'),
(30, '00000055', '2017-09-25', '2017-10-10', 2, 27, 'Tarjetas Mastercard con Chip - Safi', 5000, '', '6750.00', '', 1, 0, 0, 0, '2'),
(31, '00000056', '2017-09-25', '2017-10-10', 2, 28, 'Tarj. Credito Mastercard con Chip - Ecofuturo', 200000, '', '180000.00', '', 1, 0, 0, 0, '2'),
(32, '00000057', '2017-09-25', '2017-10-10', 2, 29, 'Tarj chip Visa No Oda - BCO UNION', 3000, '', '3834.00', '', 1, 0, 0, 0, '2'),
(33, '00000058', '2017-08-16', '2017-09-25', 2, 30, 'Tarj Global. Visa Chip NO ODA - BNB', 39700, '', '24614.00', '', 0, 1, 0, 0, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `items` varchar(100) NOT NULL,
  `nombre_producto` varchar(250) NOT NULL,
  `precio_unitario` varchar(10) NOT NULL,
  `peso_neto` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_proveedor`, `id_categoria`, `items`, `nombre_producto`, `precio_unitario`, `peso_neto`) VALUES
(1, 1, 3, 'COOP-FAT-001\r\n\r\n', 'TARJETAS COOPERATIVA FATIMA\r\n', '1.45', '0.004'),
(2, 1, 3, 'TAR-CRED-ECO\r\n', 'TARJETAS VISA CREDITO - BCO ECONOMICO\r\n', '1.90', '0.004'),
(16, 1, 3, 'COOP-NAZ-001\r\n\r\n', 'TARJETAS COOPERATIVA JESUS NAZARENO\r\n', '1.45', '0.004'),
(5, 2, 3, 'T-DEB-MC-CHIP-CONAZ', 'TARJETAS DEBITO MASTERCARD COOP NAZARENO', '1.41', '0.004'),
(6, 2, 3, '', 'TARJETAS CON CHIP BNB', '1.41', '0.004'),
(7, 2, 3, '', 'TARJETAS DE DEBITO VISA - BANCO UNION', '1.0078', '0.004'),
(8, 2, 3, '', 'TARJETAS PROPIETARIAS CON CHIP', '3.20', '0.004'),
(9, 2, 3, 'T-BU-CRED-PRE', 'TARJETAS  BCO UNION CREDITO PREPAGO', '1.07', '0.004'),
(10, 2, 3, 'T-CRE-MC-BCO-PRODEM', 'TARJETAS DE CREDITO MC BCO PRODEM', '1.61', '0.004'),
(11, 1, 4, '', 'TARJETAS DE COORDENADAS BNB', '0.20089', '0.002'),
(13, 4, 1, 'R-80X80', 'ROLLOS 80X80', '0.85', '0.36'),
(14, 4, 1, 'ATM-CHI-001', 'ROLLO FASSIL ATM CHICO ', '5.20', '1.6'),
(15, 4, 1, 'ATM-G-002', 'ROLLO  FASSIL ATM GRANDE', '9', '2.85'),
(17, 1, 5, 'FC-001', 'FORMATO CAJA', '0.00719', '0.0018'),
(19, 2, 3, 'TARJ-DEB-MAST-BCO-FORT', 'TARJETAS DEBITO MASTERCARD Bco. Fortaleza', '1.646', '0.004'),
(20, 2, 3, 'CREDITO-VISA-PLATINUM BCO UNION', 'TARJETA  DE CRÉDITO VISA PLATINUM BCO UNION', '0.90', '0.004'),
(21, 1, 2, '', 'PINES ATC', '0.04072', '0.003283'),
(22, 1, 3, '', 'Tarjeta PVC Banco Sol', '0.09857', '0.0039'),
(23, 1, 2, '', 'Pines Fassil', '0.26556', '0.003833'),
(24, 4, 1, 'Rollo 80x75', 'Rollo 80x75 ', '0.78', '0.28'),
(25, 5, 6, 'MSF', 'MUEBLE METALICO', '130', '18'),
(26, 2, 3, 'Tarj.deb.master chip - ECO', 'Tarj. Mastecard Chip JMV Ecofuturo', '1.72', '0.004'),
(27, 2, 3, 'Tarjetas Mastercard con Chip - SAFI', 'Tarjetas Mastercard con Chip - Safi', '1.35', '0.004'),
(28, 2, 3, 'Tarj.Credito.Master con Chip - ECO', 'Tarj. Credito Mastercard con Chip - Ecofuturo', '0.9', '0.004'),
(29, 2, 3, 'Bco Union - NO ODA', 'Tarj chip Visa No Oda - BCO UNION', '1.278', '0.004'),
(30, 2, 3, 'BNB - Debito Global', 'Tarj Global. Visa Chip NO ODA - BNB', '0.62', '0.004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_prove` varchar(80) DEFAULT NULL,
  `direccion_prove` text,
  `telefono` varchar(20) NOT NULL,
  `tiemp_pag_facts` varchar(20) DEFAULT NULL,
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_prove`, `direccion_prove`, `telefono`, `tiemp_pag_facts`, `comentario`) VALUES
(1, 'ENOTRIA S.A', '<p>\r\n	Lima, Peru</p>\r\n', '78787', '45', '<p>\r\n	Somos una empresa dedicada a brindar soluciones integrales de comunicaci&oacute;n personalizada, fidelizaci&oacute;n, seguridad, loter&iacute;a, etiquetas y empaques digitales, haci&eacute;ndonos cargo de todas las etapas del proceso.</p>\r\n'),
(2, 'MORPHO CARD', '<p>\r\n	Colombia</p>\r\n', '78787', '30', '<p>\r\n	87878</p>\r\n'),
(3, 'NOVATRONIC SAC', '<p>\r\n	Av. Jos&eacute; Galvez Barrenechea No 1094 Lima 27 Per&uacute;</p>\r\n', '(511) 224-9099 ', '45', '<p style=\"margin-left:36.0pt;\">\r\n	<strong><em>Empresa peruana dedicada exclusivamente a este rubro (www.novatronic.com.pe).</em></strong></p>\r\n<p style=\"margin-left:36.0pt;\">\r\n	&nbsp;</p>\r\n'),
(4, 'ROTAPEL', '<p>\r\n	LIMA PERU</p>\r\n', '787878', '7', '<p>\r\n	PROVEEDOR DE PAPEL</p>\r\n'),
(5, 'PUGA SRL', '<p>\r\n	AV. ALEMANA ENTRE 4TO Y 5TO ANILLO</p>\r\n', '77653438', '7', '<p>\r\n	PROVEEDOR DE MUEBLES PARA SISTEMA DE FILAS</p>\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte_externo`
--

CREATE TABLE `transporte_externo` (
  `id_transporte_ext` int(11) NOT NULL,
  `fecha_salida_transporte` date NOT NULL,
  `fecha_llegada_aduana` date NOT NULL,
  `nombre_chofer` varchar(100) NOT NULL,
  `telefono_chofer` varchar(12) NOT NULL,
  `contrato_transporte_ext` text NOT NULL,
  `factura_transporte_ext` text NOT NULL,
  `estado_pagado` int(11) NOT NULL DEFAULT '0',
  `estado_transito` int(1) NOT NULL DEFAULT '1',
  `estado_enaduana` int(1) NOT NULL DEFAULT '0',
  `estado_entregado` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transporte_externo`
--

INSERT INTO `transporte_externo` (`id_transporte_ext`, `fecha_salida_transporte`, `fecha_llegada_aduana`, `nombre_chofer`, `telefono_chofer`, `contrato_transporte_ext`, `factura_transporte_ext`, `estado_pagado`, `estado_transito`, `estado_enaduana`, `estado_entregado`) VALUES
(3, '2017-08-14', '2017-08-18', 'German Leon', '67049188', '93248-contrato-transporte-pines-atc.jpg', 'ed4a6-factura-transporte-pines-atc.jpg', 0, 0, 0, 1),
(4, '2017-08-12', '2017-08-18', 'German Leon', '67049188', '95969-contrato-transporte-rollos-80x80.jpg', '2ce2a-factura-transporte-rollos-80x80.jpg', 0, 0, 0, 1),
(5, '2017-09-02', '2017-09-09', 'Jhony Coila', '12345678', '', '', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `pass` varchar(100) NOT NULL,
  `perfil` varchar(30) NOT NULL,
  `img` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `nombre`, `email`, `description`, `direccion`, `pass`, `perfil`, `img`) VALUES
(2, 'dagner87', 'Dagner Alena Guerra', 'dalena@keysolutions.com.bo', 'Web Developer  ', '<p>\r\n	Barasea 414, barrio Urbar&iacute;</p>\r\n', '69018bcc689a7e2fb14e7d9b35512e38', 'administrador', 'b9b7c-dagner.jpg'),
(3, 'gpestana', 'Gustavo Pestana Delgado', 'gpestana@keysolutions.com.bo', 'Gerente General', '<p>\r\n	Barasea 414&nbsp;</p>\r\n', 'c8b1c3573cb05148ab0f592b2e904499', 'comprador', '11a49-gustavo.png'),
(4, 'rpestana', 'Roberto Pestana', 'rpestana@keysolutions.com.bo', 'Gerente General', '<p>\r\n	Barrio Las Palmas, Dpto #2</p>\r\n', '99f85d005bf116ad3dbb629d60ddb7c4', 'gerencia', '5a5c5-roberto.png'),
(5, 'alfredo', 'Alfredo Luque', 'dalena@keysolutions.com.bo', 'Vendedor de La Paz', '<p>\r\n	Barasea 414 Urbar&iacute;</p>\r\n', '69018bcc689a7e2fb14e7d9b35512e38', 'ventas', '69051-alfre2.png'),
(6, 'fassil', 'Banco Fassil', 'ayabeta@fassil.com.bo', 'Aux.de Compras y Gestion de Proveedores ', '<p>\r\n	Av. Uruguay Santa Cruz</p>\r\n', '5e73f6eab62cc3e6991eea8c8ed8f1d5', 'cliente', 'a7d2a-fassil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_conf`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`id_paquete`);

--
-- Indices de la tabla `pedido_proveedor`
--
ALTER TABLE `pedido_proveedor`
  ADD PRIMARY KEY (`id_pedido_prov`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `transporte_externo`
--
ALTER TABLE `transporte_externo`
  ADD PRIMARY KEY (`id_transporte_ext`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_conf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `id_paquete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `pedido_proveedor`
--
ALTER TABLE `pedido_proveedor`
  MODIFY `id_pedido_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `transporte_externo`
--
ALTER TABLE `transporte_externo`
  MODIFY `id_transporte_ext` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
