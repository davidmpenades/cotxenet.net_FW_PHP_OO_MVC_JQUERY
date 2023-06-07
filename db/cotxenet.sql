-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2023 a las 19:01:13
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cotxenet`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkoutOK` (IN `username_e` VARCHAR(255), IN `id_car_e` VARCHAR(255), IN `precio_e` INT(255), IN `total_precio_e` INT(255))   BEGIN
    	DECLARE stock_car INT(255);
    	DECLARE stock_carrito INT(255);
        
        SELECT car.stock INTO stock_car
        FROM car
        WHERE car.id_car = id_car_e;
        
        SELECT cart.quanty INTO stock_carrito
        FROM cart 
        WHERE cart.username LIKE username_e AND cart.id_car = id_car_e;
    	
        IF stock_carrito <= stock_car THEN
        	INSERT INTO `pedidos`( `username`, `id_car`, `precio`, `precio_total`, `fecha`) 
                    VALUES (username_e,id_car_e,precio_e,total_precio_e,NOW());
        ELSE 
        	SELECT id_car_e;
        END IF;
        
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `car`
--

CREATE TABLE `car` (
  `id_car` varchar(11) NOT NULL,
  `num_bastidor` varchar(18) DEFAULT NULL,
  `num_matricula` varchar(8) DEFAULT NULL,
  `cod_modelo` varchar(25) DEFAULT NULL,
  `categoria` varchar(11) DEFAULT NULL,
  `Km` int(8) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `puertas` varchar(20) DEFAULT NULL,
  `cod_combustible` varchar(20) DEFAULT NULL,
  `cod_cil` varchar(20) NOT NULL,
  `cod_extra` varchar(50) NOT NULL,
  `cod_etiqueta` varchar(50) NOT NULL,
  `cod_potencia` varchar(50) NOT NULL,
  `carroceria` varchar(20) DEFAULT NULL,
  `f_mat` varchar(10) DEFAULT NULL,
  `precio` int(8) DEFAULT NULL,
  `img_car` varchar(200) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lon` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `visitas` int(25) DEFAULT NULL,
  `stock` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `car`
--

INSERT INTO `car` (`id_car`, `num_bastidor`, `num_matricula`, `cod_modelo`, `categoria`, `Km`, `color`, `puertas`, `cod_combustible`, `cod_cil`, `cod_extra`, `cod_etiqueta`, `cod_potencia`, `carroceria`, `f_mat`, `precio`, `img_car`, `lat`, `lon`, `city`, `observaciones`, `visitas`, `stock`) VALUES
('1', 'ALOEGLSEO34782341', '1393ABC', 'AA1', '1', 1500, 'Negro', '3', 'G', 'C12', 'NAV,AIC,SEA,SEL', 'E', '', 'BER', '10/01/2022', 15000, 'view\\img\\img_car\\audiA1\\audi-a1.png', '39.4697065', '-0.3763353', 'Valencia', 'Coche de gerencia es una gran oportunidad', 86, 0),
('2', 'BOOEGLSEO34122342', '2393HJC', 'AQ5', '1', 1500, 'Azul', '5', 'D', 'C20', 'NAV,AIC,SEA,SEL,TAC,LLA', 'C', '', 'SUV', '10/01/2023', 50000, 'view\\img\\img_car\\audiQ5\\audi-q5.png', '38.7656212468594', '-0.6130857883801205', 'Bocairent', 'Coche de gerencia', 44, 10),
('3', 'CEOEGLSEO34742343', '3393NRO', 'AA3', '1', 11000, 'Azul', '3', 'G', 'C16', 'NAV,AIC,SEA,SEL,LLA,KIE', 'C', '', 'BER', '10/01/2022', 20000, 'view\\img\\img_car\\audiA3\\audi-a3.png', '38.854234500954405', '-0.5014684763458933', 'Palomar', 'Con un kit deportivo y llantas de 18pulgadas', 182, 0),
('4', 'SUSEGLSEO12782344', '4393LOL', 'AA7', '2', 1000, 'Gris', '4', 'D', 'C22', 'NAV,AIC,SEA,SEL', 'C', '', 'BER', '10/01/2022', 25000, 'view\\img\\img_car\\audiA7\\audi-a7.png', '38.880331958800944', '-0.5885664385474597', 'Aielo de Malferit', 'Coche de km0', 47, 8),
('5', 'ZLOEGLSEO34782345', '5393ARA', 'BS3', '2', 0, 'GRIS', '3', 'D', 'C19', 'NAV,AIC,SEA,SEL', 'C', '', 'BER', '10/12/2023', 35000, 'view\\img\\img_car\\bmwS3\\bmw-serie3.png', '39.4697065', '-0.3763353', 'Valencia', 'Coche Nuevo', 27, 10),
('6', 'ALO4CLSEO34782378', '2356LMF', 'AR4', '3', 3000, 'Rojo', '3', 'G', 'C30', 'NAV,AIC,SEA,SEL,TAC,LLA', 'C', '', 'BER', '03/01/2022', 60000, '24', '38.8220082032162', '-0.6061397922715713', 'Ontinyent', 'Coche deportivo de segunda mano', 14, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carroceria`
--

CREATE TABLE `carroceria` (
  `cod_carroceria` varchar(20) NOT NULL,
  `descripcion` varchar(20) NOT NULL,
  `img_carroceria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carroceria`
--

INSERT INTO `carroceria` (`cod_carroceria`, `descripcion`, `img_carroceria`) VALUES
('BER', 'berlina', 'view/assets/img/berlina.png'),
('CAB', 'cabrio', 'view/assets/img/cabrio.png'),
('COU', 'coupe', 'view/assets/img/coupe.png'),
('FAM', 'familiar', 'view/assets/img/familiar.png'),
('MON', 'monovolumen', 'view/assets/img/monovolumen.png'),
('PIC', 'pickup', 'view/assets/img/pick-up.png'),
('SUV', '4x4/SUV', 'view/assets/img/SUV.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(30) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `id_car` varchar(25) DEFAULT NULL,
  `quanty` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `cart`
--
DELIMITER $$
CREATE TRIGGER `resta_stock_BD` BEFORE DELETE ON `cart` FOR EACH ROW BEGIN
        	UPDATE `car` SET stock = stock - old.quanty WHERE id_car = old.id_car;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `cod_categoria` varchar(20) NOT NULL,
  `nombre_cat` varchar(25) DEFAULT NULL,
  `img_cat` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nombre_cat`, `img_cat`) VALUES
('1', 'km0', 'VIEW/ASSETS/IMG/KM0.JPG'),
('2', 'nuevo', 'VIEW/ASSETS/IMG/NUEVO.JPG'),
('3', '2mano', 'VIEW/ASSETS/IMG/2MANO.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cilindrada`
--

CREATE TABLE `cilindrada` (
  `cod_cilindrada` varchar(20) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cilindrada`
--

INSERT INTO `cilindrada` (`cod_cilindrada`, `descripcion`) VALUES
('C10', '1000CC'),
('C12', '1200CC'),
('C14', '1400CCC'),
('C16', '1600CC'),
('C17', '1700CC'),
('C19', '1900C'),
('C20', '2000CC'),
('C22', '2200CC'),
('C24', '2400CC'),
('C30', '3000CC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combustible`
--

CREATE TABLE `combustible` (
  `cod_combustible` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `img_comb` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combustible`
--

INSERT INTO `combustible` (`cod_combustible`, `descripcion`, `img_comb`) VALUES
('D', 'diesel', 'VIEW/ASSETS/IMG/DIESEL.JPG'),
('E', 'Electrico', 'VIEW/ASSETS/IMG/electrico.JPG'),
('G', 'Gasolina', 'VIEW/ASSETS/IMG/gasolina.JPG'),
('H', 'Hybrid', 'VIEW/ASSETS/IMG/hibrido.JPG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiqueta`
--

CREATE TABLE `etiqueta` (
  `cod_etiqueta` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `etiqueta`
--

INSERT INTO `etiqueta` (`cod_etiqueta`, `descripcion`) VALUES
('0', 'cero'),
('B', 'amarilla'),
('C', 'verde'),
('E', 'ECO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `cod_extras` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`cod_extras`, `descripcion`) VALUES
('AIC', 'airbag cortina'),
('ASC', 'asientos calefactables'),
('CLI', 'climatizador'),
('COA', 'Control alumbrado'),
('COS', 'control sueño'),
('DTC', 'detector de carril'),
('DTP', 'detector peaton'),
('KID', 'kit deportivo'),
('LED', 'faros led'),
('LLA', 'llantas aleacion'),
('NAV', 'navegador'),
('SEA', 'Sensor aparcamiento'),
('SEL', 'sensor de lluvia'),
('TAC', 'tapiceria cuero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `cod_foto` varchar(200) NOT NULL,
  `img_car` varchar(200) NOT NULL,
  `num_bastidor` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`cod_foto`, `img_car`, `num_bastidor`) VALUES
('1', 'view\\img\\img_car\\audiA1\\pr-audi-a1.png', 'ALOEGLSEO34782341'),
('10', 'view\\img\\img_car\\audiA3\\audi-a3-1.png', 'CEOEGLSEO34742343'),
('11', 'view\\img\\img_car\\audiA3\\audi-a3-interior.png', 'CEOEGLSEO34742343'),
('12', 'view\\img\\img_car\\audiA3\\pr-audi-a3.png', 'CEOEGLSEO34742343'),
('13', 'view\\img\\img_car\\audiA7\\pr-audi-a7.png', 'SUSEGLSEO12782344'),
('14', 'view\\img\\img_car\\audiA7\\audi-a7-2.png', 'SUSEGLSEO12782344'),
('15', 'view\\img\\img_car\\audiA7\\audi-a7-interior.png', 'SUSEGLSEO12782344'),
('16', 'view\\img\\img_car\\audiA7\\audi-a7-interior2.png', 'SUSEGLSEO12782344'),
('17', 'view\\img\\img_car\\audiQ5\\pr-audi-q5.png', 'BOOEGLSEO34122342'),
('18', 'view\\img\\img_car\\audiQ5\\audi-q5-interior.png', 'BOOEGLSEO34122342'),
('19', 'view\\img\\img_car\\audiQ5\\audi-q5-interior2.png', 'BOOEGLSEO34122342'),
('2', 'view\\img\\img_car\\audiA1\\audi-a1-2.png', 'ALOEGLSEO34782341'),
('20', 'view\\img\\img_car\\bmwS3\\pr-bmw-serie3.png', 'ZLOEGLSEO34782345'),
('21', 'view\\img\\img_car\\bmwS3\\bmw-serie3-2.png', 'ZLOEGLSEO34782345'),
('22', 'view\\img\\img_car\\bmwS3\\bmw-serie3-interior.png', 'ZLOEGLSEO34782345'),
('23', 'view\\img\\img_car\\bmwS3\\bmw-serie3-interior2.png', 'ZLOEGLSEO34782345'),
('24', 'view\\img\\img_car\\alfa4c\\pr-alfa-4c.png', 'ALO4CLSEO34782378'),
('25', 'view\\img\\img_car\\alfa4c\\alfa-2.png', 'ALO4CLSEO34782378'),
('26', 'view\\img\\img_car\\alfa4c\\alfa-4C-interior.png', 'ALO4CLSEO34782378'),
('27', 'view\\img\\img_car\\alfa4c\\alfa-4C-interior1.png', 'ALO4CLSEO34782378'),
('28', 'view\\img\\img_car\\alfa4c\\alfa-4C-interior2.png', 'ALO4CLSEO34782378'),
('29', 'view\\img\\img_car\\alfa4c\\alfa-4C-interior3.png', 'ALO4CLSEO34782378'),
('3', 'view\\img\\img_car\\audiA1\\audi-a1-interior1.png', 'ALOEGLSEO34782341'),
('30', 'view\\img\\img_car\\alfa4c\\alfa-4C-interior4.png', 'ALO4CLSEO34782378'),
('4', 'view\\img\\img_car\\audiA1\\audi-a1-interior2.png', 'ALOEGLSEO34782341'),
('5', 'view\\img\\img_car\\audiA1\\audi-a1-interior3.png', 'ALOEGLSEO34782341'),
('6', 'view\\img\\img_car\\audiA1\\audi-a1-interior4.png', 'ALOEGLSEO34782341'),
('7', 'view\\img\\img_car\\audiA1\\audi-a1-interior5.png', 'ALOEGLSEO34782341'),
('8', 'view\\img\\img_car\\audiA1\\audi-a1-interior6.png', 'ALOEGLSEO34782341'),
('9', 'view\\img\\img_car\\audiA1\\audi-a1-interior7.png', 'ALOEGLSEO34782341');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(30) NOT NULL,
  `id_car` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_car`) VALUES
(168, 40, 1),
(203, 40, 5),
(211, 58, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maletero`
--

CREATE TABLE `maletero` (
  `cod_maletero` varchar(20) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `maletero`
--

INSERT INTO `maletero` (`cod_maletero`, `descripcion`) VALUES
('GRA', '>400'),
('MED', '200-400'),
('peq', '<200');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `cod_marca` varchar(25) NOT NULL,
  `img_marca` varchar(100) DEFAULT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`cod_marca`, `img_marca`, `descripcion`) VALUES
('ALF', 'view/img/img_marcas/alfaromeo.png', 'alfa_romeo'),
('AUD', 'view/img/img_marcas/audi.png', 'Audi'),
('BMW', 'view/img/img_marcas/bmw.png', 'Bmw'),
('CHE', 'view/img/img_marcas/chevrolet.png', 'Chevrolet'),
('CIT', 'view/img/img_marcas/citroen.png', 'Citroën'),
('FOR', 'view/img/img_marcas/ford.png', 'Ford'),
('HON', 'view/img/img_marcas/honda.png', 'Honda'),
('HYU', 'view/img/img_marcas/hyundai.png', 'Hyundai'),
('KIA', 'view/img/img_marcas/kia.png', 'Kia'),
('MAZ', 'view/img/img_marcas/mazda.png', 'Mazda'),
('MER', 'view/img/img_marcas/mercedes.png', 'Mercedes'),
('MIN', 'view/img/img_marcas/mini.png', 'Mini'),
('MIT', 'view/img/img_marcas/mitsubishi.png', 'Mitsubishi'),
('OPE', 'view/img/img_marcas/opel.png', 'Opel'),
('PEU', 'view/img/img_marcas/peugeot.png', 'Peugeot'),
('POR', 'view/img/img_marcas/porsche.png', 'Porsche'),
('REN', 'view/img/img_marcas/renault.png', 'Renault'),
('SEA', 'view/img/img_marcas/seat.png', 'Seat'),
('SUZ', 'view/img/img_marcas/suzuki.png', 'Suzuki'),
('VOW', 'view/img/img_marcas/vw.png', 'Volkswagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `cod_modelo` varchar(20) NOT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  `cod_marca` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`cod_modelo`, `descripcion`, `cod_marca`) VALUES
('AA1', 'A1', 'Audi'),
('AA3', 'A3', 'Audi'),
('AA7', 'A7', 'Audi'),
('AQ5', 'Q5', 'Audi'),
('AR4', '4C', 'alfa_romeo'),
('ATT', 'TT', 'Audi'),
('BS3', 'Serie3', 'BMW'),
('BX5', 'x5', 'BMW'),
('BX6', 'x6', 'BMW'),
('FFO', 'Focus', 'Ford'),
('FRA', 'Ranger', 'Ford'),
('HYI', 'i30', 'Hyundai'),
('HYT', 'Tucson', 'Hyundai'),
('MCA', 'Clase A', 'Mercedes'),
('MCC', 'Clase C', 'Mercedes'),
('MCG', 'Clase G', 'Mercedes'),
('MCO', 'Cooper', 'Mini'),
('MGL', 'GLE', 'Mercedes'),
('SEI', 'Ibiza', 'Seat'),
('SEL', 'Leon', 'Seat'),
('SVI', 'Vitara', 'Suzuki');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `id_car` varchar(11) DEFAULT NULL,
  `precio` int(20) DEFAULT NULL,
  `precio_total` int(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `username`, `id_car`, `precio`, `precio_total`, `fecha`) VALUES
(18, 'Capitanhomer', '1', 15000, 60000, '2023-06-03'),
(19, 'Capitanhomer', '3', 20000, 20000, '2023-06-03'),
(20, 'Capitanhomer', '3', 20000, 20000, '2023-06-03'),
(21, 'Capitanhomer', '3', 20000, 20000, '2023-06-03'),
(22, 'yomogan1', '1', 15000, 15000, '2023-06-05'),
(23, 'yomogan1', '3', 20000, 40000, '2023-06-05'),
(24, 'yomogan1', '1', 15000, 60000, '2023-06-05'),
(25, 'yomogan1', '4', 25000, 25000, '2023-06-05');

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `delete_cart_AI` AFTER INSERT ON `pedidos` FOR EACH ROW BEGIN
    DELETE FROM cart WHERE cart.username = NEW.username AND cart.id_car = NEW.id_car;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `potencia`
--

CREATE TABLE `potencia` (
  `cod_potencia` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puede`
--

CREATE TABLE `puede` (
  `num_bastidor` varchar(18) NOT NULL,
  `cod_extra` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(30) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `token_email` varchar(200) NOT NULL,
  `isActive` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `email`, `avatar`, `token_email`, `isActive`) VALUES
(40, 'Capitanhomer', '$2y$12$wnj13iv00/7dMJUSj5kRZ.prW5riB/hT4HaKcRJNxqT7y0.eXaME2', 'davidmpenades@gmail.com', 'https://i.pravatar.cc/500?u=83e648d80ddc44ea33ae803f9de1f327', '', 1),
(55, 'yomogan', '$2y$12$4tJlHUhTXkKga2baFbrKUuY22/d2uj3ooGVu64cen7wjKhjkZD9wG', 'yomogan@gmail.com', 'https://i.pravatar.cc/500?u=9154526c03ad3e327b28e3f1f7582e3a', '', 1),
(58, 'yomogan1', '$2y$12$c23t1bA9lqKyHJux5MAbt.9hA6BKXuRfTWd4IO57GA2DU6i0VY/JO', 'yomogan1@gmail.com', 'https://i.pravatar.cc/500?u=f2352c77e0e8592392a5bc3a17ad52a7', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id_car`),
  ADD UNIQUE KEY `num_bastidor` (`num_bastidor`),
  ADD UNIQUE KEY `num_matricula` (`num_matricula`),
  ADD KEY `carroceria` (`carroceria`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `cod_cil` (`cod_cil`),
  ADD KEY `cod_combustible` (`cod_combustible`),
  ADD KEY `cod_modelo` (`cod_modelo`),
  ADD KEY `img_car` (`img_car`);

--
-- Indices de la tabla `carroceria`
--
ALTER TABLE `carroceria`
  ADD PRIMARY KEY (`cod_carroceria`);

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `username` (`username`),
  ADD KEY `id_car` (`id_car`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Indices de la tabla `cilindrada`
--
ALTER TABLE `cilindrada`
  ADD PRIMARY KEY (`cod_cilindrada`);

--
-- Indices de la tabla `combustible`
--
ALTER TABLE `combustible`
  ADD PRIMARY KEY (`cod_combustible`);

--
-- Indices de la tabla `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`cod_etiqueta`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`cod_extras`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`cod_foto`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_car` (`id_car`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `maletero`
--
ALTER TABLE `maletero`
  ADD PRIMARY KEY (`cod_maletero`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`cod_marca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`cod_modelo`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `potencia`
--
ALTER TABLE `potencia`
  ADD PRIMARY KEY (`cod_potencia`);

--
-- Indices de la tabla `puede`
--
ALTER TABLE `puede`
  ADD PRIMARY KEY (`num_bastidor`,`cod_extra`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`carroceria`) REFERENCES `carroceria` (`cod_carroceria`),
  ADD CONSTRAINT `car_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`cod_categoria`),
  ADD CONSTRAINT `car_ibfk_3` FOREIGN KEY (`cod_cil`) REFERENCES `cilindrada` (`cod_cilindrada`),
  ADD CONSTRAINT `car_ibfk_4` FOREIGN KEY (`cod_combustible`) REFERENCES `combustible` (`cod_combustible`),
  ADD CONSTRAINT `car_ibfk_5` FOREIGN KEY (`cod_modelo`) REFERENCES `modelo` (`cod_modelo`),
  ADD CONSTRAINT `car_ibfk_6` FOREIGN KEY (`img_car`) REFERENCES `fotos` (`cod_foto`);

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_car`) REFERENCES `car` (`id_car`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
