-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2019 a las 21:17:11
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
(1, 'caja-01', 10, 'caja1'),
(2, 'caja-02', 52, 'Caja2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buy_element`
--

CREATE TABLE `buy_element` (
  `buy_element_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `provider_id` int(11) NOT NULL,
  `buy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `contact_email` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_name`, `tax_id`, `user_id`, `user_vendedor_id`, `address`, `paid_person`, `phone`, `logo`, `paid_email`, `contact_person`, `contact_email`) VALUES
(6, 'pedro duran', 'cmdelgador@gmail.com', 10, 1, 'av principal', 'pablo duran', '4264505884', './uploads/cliente/1560021411.png', 'pedroduran014@gmail.com', 'pablo duran', 'pedroduran014@gmail.com');

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
(3, 'venezuela');

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
(3, 'Lara', 3),
(4, 'Guayaquil', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dialing`
--

CREATE TABLE `dialing` (
  `dialing_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` varchar(45) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `price` float NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `nunit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `name`, `descriptions`, `photo`, `price`, `product_category_id`, `nunit_id`) VALUES
(2, 'Rose color 50cm high & yellow', '<p><u></u>Rose color 50cm high & yellow </p>', './uploads/product/1558551344.jpg', 12.5, 1, 2),
(3, 'Rose color 50cm high & red', '<p>Rose color 50cm high & red<br></p>', './uploads/product/1558551334.jpg', 15, 2, 2),
(4, 'rosa de primavera', '<p>esta es una rosa de primavera</p>', './uploads/product/1558629110.jpg', 43, 3, 3),
(5, 'rosa natural', '<p>esta es una rosa natural</p>', './uploads/product/1558629184.jpg', 45, 3, 2),
(6, 'Rose color 50cm high & blue', '<p>Rose color 50cm high & blue<br></p>', './uploads/product/1559234370.jpg', 15, 3, 3);

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
(1, 'Claveles ma'),
(2, 'Orquideas'),
(3, 'Rosas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `provider_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `identificacion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`provider_id`, `name`, `identificacion`) VALUES
(1, 'La rosas mas lindas', '12345678899');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `date_time_reception` datetime NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `date_delivery` date NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_box`
--

CREATE TABLE `request_box` (
  `request_box_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `box_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_product`
--

CREATE TABLE `request_product` (
  `request_product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `role_id`) VALUES
(1, 'Pedro Duran', 'pedro@datalabcenter.com', 'dc1b859c6c5d92073cb0ec8cf9bdb6f6', 1),
(2, 'Luis Leo', 'luisduran@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 2),
(7, 'pedro duran', 'pedroduran@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 3),
(10, 'pedro duran', 'pedroduran014@gmail.com', '4983a0ab83ed86e0e7213c8783940193', 3);

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
-- Indices de la tabla `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indices de la tabla `request_box`
--
ALTER TABLE `request_box`
  ADD PRIMARY KEY (`request_box_id`);

--
-- Indices de la tabla `request_product`
--
ALTER TABLE `request_product`
  ADD PRIMARY KEY (`request_product_id`);

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
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `buy_element`
--
ALTER TABLE `buy_element`
  MODIFY `buy_element_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `destination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dialing`
--
ALTER TABLE `dialing`
  MODIFY `dialing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nunit`
--
ALTER TABLE `nunit`
  MODIFY `nunit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `request_box`
--
ALTER TABLE `request_box`
  MODIFY `request_box_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `request_product`
--
ALTER TABLE `request_product`
  MODIFY `request_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
