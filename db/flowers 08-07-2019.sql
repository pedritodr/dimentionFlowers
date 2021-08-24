-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2019 a las 03:21:56
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 5.6.36

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
  `identificator` varchar(45) NOT NULL,
  `max_number_of_item` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `box_type`
--

INSERT INTO `box_type` (`box_type_id`, `identificator`, `max_number_of_item`, `name`) VALUES
(1, 'HB-1', 10, 'HB'),
(2, 'QB', 52, 'QB'),
(3, 'EB', 100, 'EB');

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
(9, 1, 1);

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
  `request_variety_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `buy_element`
--

INSERT INTO `buy_element` (`buy_element_id`, `qty`, `price`, `provider_id`, `buy_id`, `request_variety_id`, `date`) VALUES
(89, 1, 12, 1, 9, 1, '2019-07-08'),
(90, 1, 11, 3, 9, 1, '2019-07-08'),
(91, 3, 12, 1, 9, 2, '2019-07-08'),
(92, 2, 12, 1, 9, 3, '2019-07-08');

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
(1, 'Envios Ecu', '02686504656', 'pablo duran', 'pedro@datalabcenter.com', 'skype_carguera', 'direccion de pueba');

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
  `logo` varchar(1024) NOT NULL,
  `paid_email` varchar(512) NOT NULL,
  `contact_person` varchar(1024) NOT NULL,
  `contact_email` varchar(512) NOT NULL,
  `additional` text NOT NULL,
  `skype_contact` varchar(128) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phone_contact` varchar(128) NOT NULL,
  `phone_person` varchar(128) NOT NULL,
  `skype_person` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_name`, `tax_id`, `user_id`, `user_vendedor_id`, `address`, `paid_person`, `phone`, `logo`, `paid_email`, `contact_person`, `contact_email`, `additional`, `skype_contact`, `country_id`, `phone_contact`, `phone_person`, `skype_person`) VALUES
(8, 'USA BQT', '123456789', 12, 1, '1500 LW 95 TH AVENIUM. MIAMI, FL 33172', 'pablo duran', '02686504656', './uploads/cliente/1561477875.png', 'pedroduran014@gmail.com', 'pablo duran', 'pedroduran014@gmail.com', '<p>hola</p>', 'prueba', 1, '222222', '2222222', 'pr');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `nombre` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'Ecuador'),
(3, 'Usa');

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
(1, 'manta', 1),
(2, 'Quito', 1),
(3, 'Miami', 3),
(4, 'Guayaquil', 1),
(5, 'Chicago', 3);

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
(12, '1PBLX', 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nunit`
--

CREATE TABLE `nunit` (
  `nunit_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nunit`
--

INSERT INTO `nunit` (`nunit_id`, `name`) VALUES
(2, 'pack 100'),
(3, 'pack 150');

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
  `stems_bunch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `name`, `descriptions`, `photo`, `product_category_id`, `status`, `stems_bunch`) VALUES
(2, 'Rose color high & yellow', '<p><u></u>Rose color 50cm high & yellow </p>', './uploads/product/1558551344.jpg', 1, 1, 25),
(3, 'Rose color  high & red', '<p>Rose color 50cm high & red<br></p>', './uploads/product/1558551334.jpg', 2, 1, 18),
(5, 'ROSE COLOR RAINBOW', '<p>esta es una rosa natural</p>', './uploads/product/1558629184.jpg', 3, 1, 25),
(6, 'Rose color high & blue', '<p>Rose color 50cm high & blue<br></p>', './uploads/product/1559234370.jpg', 3, 1, 25),
(7, 'ROSE COLOR HIGT & YELLOW', '<p>esta es una etiqueta</p>', './uploads/product/1560351045.jpg', 3, 1, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `name`) VALUES
(1, 'Claveles'),
(2, 'Orquideas'),
(3, 'Rosas'),
(4, 'Clavel');

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
  `phone_payment` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`provider_id`, `name`, `tax_id`, `email`, `phone`, `email_seller`, `person_payment`, `data_banking`, `data_additional`, `seller`, `skype_seller`, `phone_seller`, `address`, `skype_payment`, `email_payment`, `phone_payment`) VALUES
(1, 'pedro duran', '12345678899', 'pedroduran014@gmail.com', '4264505884', 'pedroduran014@gmail.com', 'julio jaramillo', '<p>banco </p>', '<p>calle</p>', '', '', '', '', '', '', ''),
(2, 'la finca', 'f12424242', 'finca@gmail.com', '4264505884', 'pedroduran014@gmail.com', 'pablo duran', '<p>banco pichincha</p><p>nro de cuenta 17 </p>', '<p>direccion mi casa</p>', '', '', '', '', '', '', ''),
(3, 'finca2', '2finca6564', 'pedroduran014@gmail.com', '123456', 'pedroduran014@gmail.com', 'julio jaramillo', '<p>hola</p>', '<p>hhola</p>', 'pablito', 'asasa', '12233455', 'direccion de pueba', 'port', 'pe@hl.com', '12121212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider_variety`
--

CREATE TABLE `provider_variety` (
  `provider_variety_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `variety_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider_variety`
--

INSERT INTO `provider_variety` (`provider_variety_id`, `provider_id`, `variety_id`) VALUES
(25, 1, 26),
(26, 1, 27),
(27, 1, 28),
(56, 3, 24),
(57, 3, 25),
(58, 3, 26),
(59, 3, 27),
(60, 3, 28),
(61, 2, 27),
(62, 2, 28);

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
(1, '2019-10-30', 8, 1, '2019-10-27', 'PO20188901');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_variety`
--

CREATE TABLE `request_variety` (
  `request_variety_id` int(11) NOT NULL,
  `variety_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `dialing_id` int(11) NOT NULL,
  `qty_bunches` int(11) NOT NULL,
  `total_steams` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `total_price` float NOT NULL,
  `variety_measure_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `request_variety`
--

INSERT INTO `request_variety` (`request_variety_id`, `variety_id`, `request_id`, `dialing_id`, `qty_bunches`, `total_steams`, `unit_price`, `total_price`, `variety_measure_id`, `status`) VALUES
(1, 26, 1, 12, 6, 150, 45, 90, 18, 0),
(2, 26, 1, 12, 6, 150, 45, 135, 19, 0),
(3, 26, 1, 12, 6, 150, 54, 108, 20, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_variety_box`
--

CREATE TABLE `request_variety_box` (
  `request_variety_box_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_variety_id` int(11) NOT NULL,
  `box_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `request_variety_box`
--

INSERT INTO `request_variety_box` (`request_variety_box_id`, `qty`, `request_variety_id`, `box_type_id`) VALUES
(1, 2, 1, 1),
(2, 3, 2, 1),
(3, 2, 3, 1);

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
  `skype` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `role_id`, `skype`, `phone`) VALUES
(1, 'Pedro Duran', 'pedro@datalabcenter.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 1, '', ''),
(2, 'Luis Leo', 'luisduran@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2, '', ''),
(7, 'pedro duran', 'pedroduran@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 3, '', ''),
(12, 'user1', 'cliente1@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 4, 'skype_user1', '02686504656'),
(13, 'user2', 'user2@gmail.com', '5ed02a1a2533758ab19b62dd4baaed69', 4, 'skype_user2', '02686504656');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variety`
--

CREATE TABLE `variety` (
  `variety_id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `photo` varchar(1024) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `variety`
--

INSERT INTO `variety` (`variety_id`, `name`, `photo`, `product_id`, `description`, `status`) VALUES
(24, 'Rose color high & blue ', './uploads/variety/1561562336.jpg', 3, '<p>\r\n\r\n</p><div><div>Rose color high & blue </div></div>\r\n\r\n<br><p></p>', 1),
(25, 'Rose color high & blue ', './uploads/variety/1561562417.jpg', 6, '<p>\r\n\r\nRose color high & blue \r\n\r\n<br></p>', 0),
(26, 'Rose color high & yellow ', './uploads/variety/1561562643.jpg', 2, '<p>\r\n\r\nRose color high & yellow <br>\r\n\r\n<br></p>', 0),
(27, 'ROSE COLOR HIGT & YELLOW ', './uploads/variety/1561562714.jpg', 7, '<p>\r\n\r\nROSE COLOR HIGT & YELLOW \r\n\r\n<br></p>', 0),
(28, 'ROSE COLOR RAINBOW ', './uploads/variety/1561562757.jpg', 5, '<p>\r\n\r\nROSE COLOR RAINBOW <br>\r\n\r\n<br></p>', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variety_measure`
--

CREATE TABLE `variety_measure` (
  `variety_measure_id` int(11) NOT NULL,
  `variety_id` int(11) NOT NULL,
  `measure` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `variety_measure`
--

INSERT INTO `variety_measure` (`variety_measure_id`, `variety_id`, `measure`) VALUES
(15, 25, '60 CM'),
(16, 25, '50 CM'),
(17, 25, '40 CM'),
(18, 26, '40 CM'),
(19, 26, '50 CM'),
(20, 26, '60 CM'),
(21, 27, '60 CM'),
(22, 27, '50 CM'),
(23, 27, '40 CM'),
(24, 28, '60 CM'),
(25, 28, '50 CM'),
(26, 28, '40 CM'),
(27, 24, '40 CM'),
(28, 24, '50 CM'),
(29, 24, '60 CM'),
(30, 24, '70 CM');

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
-- Indices de la tabla `nunit`
--
ALTER TABLE `nunit`
  ADD PRIMARY KEY (`nunit_id`);

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
-- Indices de la tabla `provider_variety`
--
ALTER TABLE `provider_variety`
  ADD PRIMARY KEY (`provider_variety_id`);

--
-- Indices de la tabla `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indices de la tabla `request_variety`
--
ALTER TABLE `request_variety`
  ADD PRIMARY KEY (`request_variety_id`);

--
-- Indices de la tabla `request_variety_box`
--
ALTER TABLE `request_variety_box`
  ADD PRIMARY KEY (`request_variety_box_id`);

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
-- Indices de la tabla `variety`
--
ALTER TABLE `variety`
  ADD PRIMARY KEY (`variety_id`);

--
-- Indices de la tabla `variety_measure`
--
ALTER TABLE `variety_measure`
  ADD PRIMARY KEY (`variety_measure_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `box_type`
--
ALTER TABLE `box_type`
  MODIFY `box_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `buy_element`
--
ALTER TABLE `buy_element`
  MODIFY `buy_element_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `carguera`
--
ALTER TABLE `carguera`
  MODIFY `carguera_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `destination`
--
ALTER TABLE `destination`
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `dialing`
--
ALTER TABLE `dialing`
  MODIFY `dialing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `nunit`
--
ALTER TABLE `nunit`
  MODIFY `nunit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provider_variety`
--
ALTER TABLE `provider_variety`
  MODIFY `provider_variety_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `request_variety`
--
ALTER TABLE `request_variety`
  MODIFY `request_variety_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `request_variety_box`
--
ALTER TABLE `request_variety_box`
  MODIFY `request_variety_box_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `variety`
--
ALTER TABLE `variety`
  MODIFY `variety_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `variety_measure`
--
ALTER TABLE `variety_measure`
  MODIFY `variety_measure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
