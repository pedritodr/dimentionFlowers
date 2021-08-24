-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2019 a las 23:56:10
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flowers`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `box_type`
--

CREATE TABLE `box_type` (
  `box_type_id` int(11) NOT NULL,
  `max_number_of_item` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `box_type`
--

INSERT INTO `box_type` (`box_type_id`, `max_number_of_item`, `name`) VALUES
(1, 100, 'QB'),
(2, 120, 'HB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buy`
--

INSERT INTO `buy` (`buy_id`, `request_id`, `user_id`) VALUES
(16, 20, 1),
(17, 22, 1),
(18, 21, 1),
(19, 23, 1),
(20, 24, 1),
(21, 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy_element`
--

CREATE TABLE `buy_element` (
  `buy_element_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `provider_id` int(11) NOT NULL,
  `buy_id` int(11) NOT NULL,
  `request_product_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `etiqueta` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buy_element`
--

INSERT INTO `buy_element` (`buy_element_id`, `qty`, `price`, `provider_id`, `buy_id`, `request_product_id`, `date`, `etiqueta`) VALUES
(37, 1, 1, 3, 16, 24, '2019-09-18', ''),
(38, 2, 11, 4, 16, 24, '2019-09-18', ''),
(39, 1, 2, 3, 16, 24, '2019-09-18', ''),
(40, 100, 1, 2, 16, 25, '2019-09-18', 'red'),
(41, 4, 0.25, 4, 17, 28, '2019-09-24', ''),
(42, 2, 0.5, 3, 17, 28, '2019-09-24', 'mia'),
(43, 6, 0.56, 4, 17, 29, '2019-09-24', 'mia2'),
(44, 1, 0.9, 4, 18, 26, '2019-10-15', ''),
(46, 80, 0.8, 2, 18, 27, '2019-10-15', ''),
(47, 2, 0.3, 4, 19, 30, '2019-10-15', ''),
(48, 3, 0.6, 3, 19, 30, '2019-10-15', ''),
(49, 2, 0.5, 4, 20, 31, '2019-10-15', ''),
(50, 1, 0.5, 2, 20, 31, '2019-10-15', ''),
(51, 5, 0.2, 4, 21, 32, '2019-10-26', ''),
(52, 1, 0.1, 4, 21, 32, '2019-10-26', ''),
(53, 5, 0.5, 4, 21, 36, '2019-10-26', ''),
(54, 2, 0.2, 4, 21, 37, '2019-10-26', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carguera`
--

CREATE TABLE `carguera` (
  `carguera_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `person_contact` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `skype` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `carguera`
--

INSERT INTO `carguera` (`carguera_id`, `name`, `phone`, `person_contact`, `email`, `skype`, `address`) VALUES
(1, 'Envios Usa', '02686504656', 'pablo duran', 'pedro@datalabcenter.com', 'prueba_skype', 'direccion de pueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_name` varchar(256) NOT NULL,
  `tax_id` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_vendedor_id` int(11) NOT NULL,
  `address` varchar(2048) NOT NULL,
  `paid_person` varchar(1024) NOT NULL,
  `phone` varchar(512) NOT NULL,
  `paid_email` varchar(512) NOT NULL,
  `contact_person` varchar(1024) NOT NULL,
  `contact_email` varchar(512) NOT NULL,
  `additional` text NOT NULL,
  `skype_contact` varchar(128) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_contact` varchar(128) NOT NULL,
  `phone_person` varchar(128) NOT NULL,
  `skype_person` varchar(128) NOT NULL,
  `cod_facturacion` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_name`, `tax_id`, `user_id`, `user_vendedor_id`, `address`, `paid_person`, `phone`, `paid_email`, `contact_person`, `contact_email`, `additional`, `skype_contact`, `country_id`, `phone_contact`, `phone_person`, `skype_person`, `cod_facturacion`) VALUES
(1, 'USA BQT', '123456789', 16, 1, 'direccion de pueba', 'persona de prueba', '02686504656', 'pedroduran014@gmail.com', 'pablo duran', 'pedroduran014@gmail.com', '<p><a target=\"_blank\" rel=\"nofollow\" href=\"http://google.com\">http://google.com/</a> <br></p>', 'usa_sskype', 1, '222222', '0980562425', 'usap_skype', 'UB');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `name_commercial` varchar(1024) NOT NULL,
  `address` varchar(1024) NOT NULL,
  `city_country` varchar(512) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `us_phone` varchar(128) NOT NULL,
  `mobile` varchar(128) NOT NULL,
  `logo` varchar(1024) NOT NULL,
  `email_contact` varchar(256) NOT NULL,
  `video` varchar(512) NOT NULL,
  `facebook` varchar(128) NOT NULL,
  `instagram` varchar(128) NOT NULL,
  `youtube` varchar(128) NOT NULL,
  `vision` text NOT NULL,
  `mision` text NOT NULL,
  `sobre_nosotros` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`company_id`, `name_commercial`, `address`, `city_country`, `phone`, `us_phone`, `mobile`, `logo`, `email_contact`, `video`, `facebook`, `instagram`, `youtube`, `vision`, `mision`, `sobre_nosotros`) VALUES
(1, 'Dimention flowers', 'Lizardo Garcia y 12 de octubre', 'QUITO-ECUADOR', '(593-2)2263742', '7864018355', '(593)98534367', '', 'correo@dimentionflower.com', 'www.dimentionflowers.com', '', '', '', '<p>mejores</p>', '<p>los</p>', '<p>somos</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`country_id`, `name`) VALUES
(1, 'Usa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destination`
--

CREATE TABLE `destination` (
  `destination_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `destination`
--

INSERT INTO `destination` (`destination_id`, `name`, `country_id`) VALUES
(1, 'Chicago', 1),
(2, 'Miami', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dialing`
--

CREATE TABLE `dialing` (
  `dialing_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dialing`
--

INSERT INTO `dialing` (`dialing_id`, `name`, `destination_id`, `cliente_id`) VALUES
(1, 'MH245U', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nro_invoice` varchar(128) NOT NULL,
  `awb` varchar(128) NOT NULL,
  `price_transporte` float NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `date`, `nro_invoice`, `awb`, `price_transporte`, `request_id`) VALUES
(5, '2019-09-18', 'factura-1', '406-65-65', 150, 20),
(6, '2019-09-24', 'factura-1', '406-65-65', 150, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_provider`
--

CREATE TABLE `invoice_provider` (
  `invoce_provider_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `nro_invoice` varchar(128) NOT NULL,
  `buy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invoice_provider`
--

INSERT INTO `invoice_provider` (`invoce_provider_id`, `provider_id`, `nro_invoice`, `buy_id`) VALUES
(16, 2, 'f1', 16),
(17, 3, 'f2', 16),
(18, 4, 'f3', 16),
(19, 3, 'ABC123', 17),
(20, 4, 'ABC123', 17),
(21, 2, 'finca0003', 18),
(22, 4, 'finca0004', 18),
(23, 4, 'finca321456987', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `measure`
--

CREATE TABLE `measure` (
  `measure_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `measure`
--

INSERT INTO `measure` (`measure_id`, `name`) VALUES
(2, '40 CM'),
(3, '50 CM'),
(4, '60 CM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo`
--

CREATE TABLE `motivo` (
  `motivo_id` int(11) NOT NULL,
  `motivo` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `motivo`
--

INSERT INTO `motivo` (`motivo_id`, `motivo`, `is_active`) VALUES
(1, 'motivo de prueba actualizado', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nunit`
--

CREATE TABLE `nunit` (
  `nunit_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pending`
--

CREATE TABLE `pending` (
  `pending_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `price` float NOT NULL,
  `product_id` int(11) NOT NULL,
  `measure_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pending`
--

INSERT INTO `pending` (`pending_id`, `request_id`, `qty`, `provider_id`, `reason`, `price`, `product_id`, `measure_id`) VALUES
(1, 21, 2, 2, 'no llegaron las cajas', 0, 2, 3),
(2, 21, 20, 2, 'solo llegaron 80 cajas', 0.8, 4, 2),
(3, 21, 1, 4, 'solo llego una caja en buen estado', 0.9, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `descriptions` text NOT NULL,
  `photo` varchar(256) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `stems_bunch` int(11) NOT NULL,
  `button_size` varchar(60) NOT NULL,
  `colour` varchar(60) NOT NULL,
  `commentary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `name`, `descriptions`, `photo`, `product_category_id`, `status`, `stems_bunch`, `button_size`, `colour`, `commentary`) VALUES
(1, 'Akito', '<p>\r\n\r\nRosa blanca, muy apreciada por diseñadores por su pureza y glamur.\r\n\r\n<br></p>', './uploads/product/1563207271.jpg', 3, 1, 12, '45cm', 'rojo', '<p>\r\n\r\nRosa blanca, muy apreciada por diseñadores por su pureza y glamur.\r\n\r\n\r\n</p>'),
(2, 'Blue mondial', '<p>\r\n\r\nTiene un color más crema que Akito y su tallo suele ser más largo.\r\n\r\n<br></p>', '', 2, 1, 25, '', 'rojo', ''),
(4, 'Deep Purple', '<p>\r\n\r\nSon flores color lavanda oscura y florecen en forma de estrella. También transmiten un sentimiento de realeza.\r\n\r\n<br></p>', './uploads/product/1563207516.jpg', 1, 1, 12, '', 'rojo', ''),
(9, 'Novia', '<p>asda</p>', './uploads/product/1564176456.jpg', 4, 1, 15, '15', 'rojo', '<p>asdas</p>'),
(10, 'clavel de prueba', '<p>asas</p>', './uploads/product/1565643424.jpg', 3, 1, 12, '34cm', 'rojo', '<p>asdas</p>'),
(11, 'Rosa nose', '<p>hola</p>', '', 2, 1, 12, '34cm', 'rojo', '<p>hola</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `name`, `is_active`) VALUES
(1, 'Rosas', 1),
(2, 'Girasol', 1),
(3, 'Claveles', 1),
(4, 'Orquideas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `tax_id` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `email_seller` varchar(256) NOT NULL,
  `person_payment` varchar(256) NOT NULL,
  `data_banking` text NOT NULL,
  `data_additional` text NOT NULL,
  `seller` varchar(250) NOT NULL,
  `skype_seller` varchar(250) NOT NULL,
  `phone_seller` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  `skype_payment` varchar(250) NOT NULL,
  `email_payment` varchar(250) NOT NULL,
  `phone_payment` varchar(128) NOT NULL,
  `name_commercial` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`provider_id`, `name`, `tax_id`, `email`, `phone`, `email_seller`, `person_payment`, `data_banking`, `data_additional`, `seller`, `skype_seller`, `phone_seller`, `address`, `skype_payment`, `email_payment`, `phone_payment`, `name_commercial`, `is_active`) VALUES
(1, 'finca 3', '6543214654', 'pedritodr14@gmail.com', '02686504656', 'pedroduran014@gmail.com', 'julio jaramillo', '<p>cta</p>', '<p><a target=\"_blank\" rel=\"nofollow\" href=\"http://youtube.com\">http://youtube.com/</a> <br></p>', 'pablito', 'ven_skype', '12233455', 'direccion de pueba', 'person_skype', 'pe@hl.com', '12121212', 'Rose CA', 0),
(2, 'finca 1', '6543214654', 'pedro@datalabcenter.com', '02686504656', 'pedroduran014@gmail.com', 'julio jaramillo', '<p>asdasd</p>', '<p>asdasd</p>', 'pablito', 'asasa', '12233455', 'direccion de pueba', 'port', 'pe@hl.com', '12121212', 'asdas', 0),
(3, 'finca 2', '6543214654', 'pedro@datalabcenter.com', '02686504656', 'pedroduran014@gmail.com', 'julio jaramillo', '<p>gjgf</p>', '<p>sasa</p>', 'pablito', 'asasa', '12233455', 'direccion de pueba', 'port', 'pe@hl.com', '12121212', 'asdas', 0),
(4, 'Rose color high & blue ', '6543214654', 'pedro@datalabcenter.com', '02686504656', 'pedroduran014@gmail.com', 'julio jaramillo', '', '', 'pablito', 'asasa', '12233455', 'direccion de pueba', 'skype_user2', 'pe@hl.com', '12121212', 'Rose CA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider_product`
--

CREATE TABLE `provider_product` (
  `provider_product_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider_product`
--

INSERT INTO `provider_product` (`provider_product_id`, `provider_id`, `product_id`) VALUES
(43, 3, 2),
(44, 3, 1),
(46, 4, 1),
(47, 4, 2),
(52, 4, 9),
(53, 4, 10),
(54, 2, 4),
(55, 2, 2),
(56, 2, 9),
(57, 2, 10),
(58, 2, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `date_time_reception` date NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `date_purchase` date NOT NULL,
  `purchase_order` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `request`
--

INSERT INTO `request` (`request_id`, `date_time_reception`, `cliente_id`, `state`, `date_purchase`, `purchase_order`) VALUES
(20, '2019-09-26', 1, 2, '2019-09-03', 'po1'),
(21, '2019-10-27', 1, 2, '2019-09-06', 'po2'),
(22, '2019-09-13', 1, 2, '2019-09-05', 'p30'),
(23, '2019-10-17', 1, 1, '2019-10-17', 'PO123'),
(24, '2019-10-24', 1, 1, '2019-10-11', 'po123'),
(25, '2019-10-27', 1, 2, '2019-10-17', 'po0123456789'),
(26, '2019-10-24', 1, 0, '2019-10-18', 'pedronuevamodificacion2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_product`
--

CREATE TABLE `request_product` (
  `request_product_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `dialing_name` varchar(65) NOT NULL,
  `qty_bunches` int(11) NOT NULL,
  `total_steams` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `total_price` float NOT NULL,
  `measure_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `carguera_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `request_product`
--

INSERT INTO `request_product` (`request_product_id`, `request_id`, `dialing_name`, `qty_bunches`, `total_steams`, `unit_price`, `total_price`, `measure_id`, `status`, `product_id`, `destination_id`, `carguera_id`) VALUES
(24, 20, 'qeqeq', 2, 50, 0.25, 50, 3, 0, 2, 1, 1),
(25, 20, 'qwrq', 12, 144, 0.01, 144, 2, 0, 4, 1, 1),
(26, 21, 'qeqeq', 2, 50, 0.25, 0.25, 3, 0, 2, 1, 1),
(27, 21, 'qwrq', 12, 144, 0.01, 0.8, 2, 0, 4, 1, 1),
(28, 22, 'poi0', 12, 300, 0.1, 180, 2, 0, 2, 1, 1),
(29, 22, 'qe77', 3, 45, 0.1, 27, 2, 0, 9, 1, 1),
(30, 23, 'qwe1', 12, 144, 0.3, 216, 2, 0, 1, 1, 1),
(31, 24, 'qwqwq1', 12, 300, 0.5, 450, 2, 0, 2, 1, 1),
(32, 25, 'qqqq', 10, 120, 0.5, 360, 2, 0, 1, 1, 1),
(33, 26, '111', 12, 144, 0.1, 144, 2, 0, 4, 2, 1),
(34, 25, 'qqqq', 10, 120, 0.5, 300, 2, 0, 0, 1, 1),
(35, 25, 'qqqq', 10, 120, 0.5, 300, 2, 0, 0, 1, 1),
(36, 25, 'aaaaa', 10, 120, 0.5, 300, 3, 0, 1, 2, 1),
(37, 25, 'sasa', 12, 180, 0.5, 180, 4, 0, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_product_box`
--

CREATE TABLE `request_product_box` (
  `request_product_box_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_product_id` int(11) NOT NULL,
  `box_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `request_product_box`
--

INSERT INTO `request_product_box` (`request_product_box_id`, `qty`, `request_product_id`, `box_type_id`) VALUES
(24, 4, 24, 1),
(25, 100, 25, 1),
(26, 1, 26, 1),
(27, 80, 27, 1),
(28, 6, 28, 1),
(29, 6, 29, 1),
(30, 5, 30, 1),
(31, 3, 31, 1),
(32, 6, 32, 1),
(33, 10, 33, 1),
(34, 5, 34, 1),
(35, 5, 35, 1),
(36, 5, 36, 1),
(37, 2, 37, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'Super Admin'),
(2, 'Administrador'),
(3, 'Cliente'),
(4, 'Comprador/Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `skype` varchar(128) DEFAULT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `role_id`, `skype`, `phone`) VALUES
(1, 'Pedro Duran', 'pedro@datalabcenter.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 1, '', ''),
(15, 'USA BQT', 'leonardoduran@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 3, '', ''),
(16, 'USA BQT', 'usa@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 3, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `box_type`
--
ALTER TABLE `box_type`
  ADD PRIMARY KEY (`box_type_id`);

--
-- Indices de la tabla `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`);

--
-- Indices de la tabla `buy_element`
--
ALTER TABLE `buy_element`
  ADD PRIMARY KEY (`buy_element_id`);

--
-- Indices de la tabla `carguera`
--
ALTER TABLE `carguera`
  ADD PRIMARY KEY (`carguera_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indices de la tabla `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`destination_id`);

--
-- Indices de la tabla `dialing`
--
ALTER TABLE `dialing`
  ADD PRIMARY KEY (`dialing_id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indices de la tabla `invoice_provider`
--
ALTER TABLE `invoice_provider`
  ADD PRIMARY KEY (`invoce_provider_id`);

--
-- Indices de la tabla `measure`
--
ALTER TABLE `measure`
  ADD PRIMARY KEY (`measure_id`);

--
-- Indices de la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD PRIMARY KEY (`motivo_id`);

--
-- Indices de la tabla `nunit`
--
ALTER TABLE `nunit`
  ADD PRIMARY KEY (`nunit_id`);

--
-- Indices de la tabla `pending`
--
ALTER TABLE `pending`
  ADD PRIMARY KEY (`pending_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`provider_id`);

--
-- Indices de la tabla `provider_product`
--
ALTER TABLE `provider_product`
  ADD PRIMARY KEY (`provider_product_id`);

--
-- Indices de la tabla `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indices de la tabla `request_product`
--
ALTER TABLE `request_product`
  ADD PRIMARY KEY (`request_product_id`);

--
-- Indices de la tabla `request_product_box`
--
ALTER TABLE `request_product_box`
  ADD PRIMARY KEY (`request_product_box_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `box_type`
--
ALTER TABLE `box_type`
  MODIFY `box_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `buy_element`
--
ALTER TABLE `buy_element`
  MODIFY `buy_element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `carguera`
--
ALTER TABLE `carguera`
  MODIFY `carguera_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `destination`
--
ALTER TABLE `destination`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dialing`
--
ALTER TABLE `dialing`
  MODIFY `dialing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `invoice_provider`
--
ALTER TABLE `invoice_provider`
  MODIFY `invoce_provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `measure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `motivo`
--
ALTER TABLE `motivo`
  MODIFY `motivo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nunit`
--
ALTER TABLE `nunit`
  MODIFY `nunit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pending`
--
ALTER TABLE `pending`
  MODIFY `pending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provider_product`
--
ALTER TABLE `provider_product`
  MODIFY `provider_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `request_product`
--
ALTER TABLE `request_product`
  MODIFY `request_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `request_product_box`
--
ALTER TABLE `request_product_box`
  MODIFY `request_product_box_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
