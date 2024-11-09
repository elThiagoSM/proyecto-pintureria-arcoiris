-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2024 a las 20:23:02
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
-- Base de datos: `bd_pinturaria_arcoiris`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id_producto` int(11) NOT NULL,
  `medidas` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id_producto`, `medidas`, `tipo`) VALUES
(1, '5m', 'Metro'),
(2, '10x20cm', 'Lija'),
(3, 'Phillips', 'Destornillador'),
(4, '3 pulgadas', 'Espátula'),
(5, '8m', 'Cinta Métrica'),
(6, '12 pulgadas', 'Tijeras'),
(7, '250g', 'Martillo'),
(8, '1 pulgada', 'Pincel'),
(9, '18cm', 'Cutter'),
(10, '10cm', 'Cepillo de acero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `datos_contacto` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_actualización` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mini_ferreteria`
--

CREATE TABLE `mini_ferreteria` (
  `id_producto` int(11) NOT NULL,
  `garantia` varchar(50) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mini_ferreteria`
--

INSERT INTO `mini_ferreteria` (`id_producto`, `garantia`, `tipo`) VALUES
(11, '2 años', 'Taladro'),
(12, '2 años', 'Amoladora'),
(13, '1 año', 'Llave inglesa'),
(14, '1 año', 'Sierra caladora'),
(15, '6 meses', 'Multímetro'),
(16, '1 año', 'Atornillador'),
(17, '2 años', 'Taladro inalámbrico'),
(18, '6 meses', 'Soldador'),
(19, '2 años', 'Compresor'),
(20, '1 año', 'Pulidora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paleta_de_color`
--

CREATE TABLE `paleta_de_color` (
  `id_paleta` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `codigo_de_color` varchar(50) DEFAULT NULL,
  `nombre_color` varchar(100) DEFAULT NULL,
  `tintes_utilizados` text DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paleta_de_color`
--

INSERT INTO `paleta_de_color` (`id_paleta`, `marca`, `codigo_de_color`, `nombre_color`, `tintes_utilizados`, `id_producto`) VALUES
(1, 'Sherwin Williams', 'EX123', 'Rojo Pasión', 'Rojo, Magenta, Negro', 21),
(2, 'Inca', 'IN456', 'Blanco Nieve', 'Blanco, Gris Claro', 22),
(3, 'Pinturas Uruguayas', 'ME789', 'Azul Cielo', 'Azul, Cian, Blanco', 23),
(4, 'Kolor', 'MD012', 'Verde Selva', 'Verde, Negro', 24),
(5, 'Sherwin Williams', 'EX345', 'Amarillo Sol', 'Amarillo, Naranja, Blanco', 25),
(6, 'Inca', 'IN678', 'Gris Urbano', 'Gris, Negro, Blanco', 26),
(7, 'Pinturas Uruguayas', 'MD901', 'Marrón Tierra', 'Marrón, Negro', 27),
(8, 'Kolor', 'MB234', 'Naranja Fuego', 'Naranja, Rojo', 28),
(9, 'Sherwin Williams', 'SN567', 'Violeta Profundo', 'Violeta, Azul, Negro', 29),
(10, 'Inca', 'ME890', 'Verde Esmeralda', 'Verde, Azul, Blanco', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pinturas`
--

CREATE TABLE `pinturas` (
  `id_producto` int(11) NOT NULL,
  `litros` decimal(5,2) DEFAULT NULL,
  `funcion_aplicacion` enum('exterior','interior','metal','madera','sintética','membrana') NOT NULL,
  `codigo_de_color` varchar(50) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `terminacion` enum('mate','brillante','semimate','satinada') NOT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `fecha_actualización` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pinturas`
--

INSERT INTO `pinturas` (`id_producto`, `litros`, `funcion_aplicacion`, `codigo_de_color`, `fecha_vencimiento`, `terminacion`, `fecha_creacion`, `fecha_actualización`, `tipo`) VALUES
(21, 4.00, 'exterior', 'EX123', '2025-12-31', 'mate', '2024-01-01', '2024-09-27 21:52:32', 'Acrílica'),
(22, 3.50, 'interior', 'IN456', '2025-11-30', 'semimate', '2024-02-01', '2024-09-27 21:52:32', 'Vinílica'),
(23, 2.50, 'metal', 'ME789', '2025-10-30', 'brillante', '2024-03-01', '2024-09-27 21:52:32', 'Sintética'),
(24, 5.00, 'madera', 'MD012', '2025-09-30', 'mate', '2024-04-01', '2024-09-27 21:52:32', 'Acrílica'),
(25, 4.50, 'exterior', 'EX345', '2025-08-31', 'brillante', '2024-05-01', '2024-09-27 21:52:32', 'Vinílica'),
(26, 3.00, 'interior', 'IN678', '2025-07-31', 'satinada', '2024-06-01', '2024-09-27 21:52:32', 'Sintética'),
(27, 2.00, 'madera', 'MD901', '2025-06-30', 'mate', '2024-07-01', '2024-09-27 21:52:32', 'Acrílica'),
(28, 5.50, 'membrana', 'MB234', '2025-05-31', 'brillante', '2024-08-01', '2024-09-27 21:52:32', 'Vinílica'),
(29, 4.80, 'sintética', 'SN567', '2025-04-30', 'semimate', '2024-09-01', '2024-09-27 21:52:32', 'Sintética'),
(30, 3.30, 'metal', 'ME890', '2025-03-31', 'mate', '2024-10-01', '2024-09-27 21:52:32', 'Vinílica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock_cantidad` int(11) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripción` text DEFAULT NULL,
  `tipo_productos` enum('Pinturas','Accesorios','Mini-ferretería') NOT NULL,
  `fecha_ultima_actualización` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `precio`, `stock_cantidad`, `marca`, `imagen`, `descripción`, `tipo_productos`, `fecha_ultima_actualización`, `id_proveedor`) VALUES
(1, 350.00, 100, 'Stanley', 'stanley_metro.jpg', 'Metro de 5 metros', 'Accesorios', '2024-09-27 21:52:12', 2),
(2, 120.00, 200, 'Truper', 'truper_lija.jpg', 'Lija para madera', 'Accesorios', '2024-09-27 21:52:12', 1),
(3, 250.00, 150, 'Stanley', 'stanley_destornillador.jpg', 'Destornillador Phillips', 'Accesorios', '2024-09-27 21:52:12', 2),
(4, 90.00, 300, 'Tramontina', 'tramontina_espatula.jpg', 'Espátula para pintura', 'Accesorios', '2024-09-27 21:52:12', 3),
(5, 550.00, 80, 'Bosch', 'bosch_cinta.jpg', 'Cinta métrica de 8 metros', 'Accesorios', '2024-09-27 21:52:12', 4),
(6, 600.00, 90, 'DeWalt', 'dewalt_tijeras.jpg', 'Tijeras de chapa', 'Accesorios', '2024-09-27 21:52:12', 2),
(7, 75.00, 250, 'Truper', 'truper_martillo.jpg', 'Martillo de carpintero', 'Accesorios', '2024-09-27 21:52:12', 1),
(8, 45.00, 400, 'Ferplast', 'ferplast_pincel.jpg', 'Pincel de 1 pulgada', 'Accesorios', '2024-09-27 21:52:12', 5),
(9, 85.00, 300, 'Stanley', 'stanley_cutter.jpg', 'Cutter profesional', 'Accesorios', '2024-09-27 21:52:12', 2),
(10, 120.00, 350, 'Truper', 'truper_cepillo.jpg', 'Cepillo de acero', 'Accesorios', '2024-09-27 21:52:12', 1),
(11, 1500.00, 50, 'Truper', 'truper_taladro.jpg', 'Taladro percutor de 500W', 'Mini-ferretería', '2024-09-27 21:52:24', 2),
(12, 2500.00, 30, 'Bosch', 'bosch_amoladora.jpg', 'Amoladora de 1200W', 'Mini-ferretería', '2024-09-27 21:52:24', 4),
(13, 850.00, 70, 'DeWalt', 'dewalt_llave.jpg', 'Llave inglesa 10 pulgadas', 'Mini-ferretería', '2024-09-27 21:52:24', 3),
(14, 1300.00, 40, 'Makita', 'makita_sierra.jpg', 'Sierra caladora 450W', 'Mini-ferretería', '2024-09-27 21:52:24', 1),
(15, 900.00, 60, 'Stanley', 'stanley_multimetro.jpg', 'Multímetro digital', 'Mini-ferretería', '2024-09-27 21:52:24', 5),
(16, 600.00, 80, 'Black & Decker', 'blackdecker_atornillador.jpg', 'Atornillador eléctrico', 'Mini-ferretería', '2024-09-27 21:52:24', 2),
(17, 1750.00, 20, 'Bosch', 'bosch_taladro.jpg', 'Taladro inalámbrico 18V', 'Mini-ferretería', '2024-09-27 21:52:24', 4),
(18, 700.00, 90, 'Truper', 'truper_soldador.jpg', 'Soldador de estaño', 'Mini-ferretería', '2024-09-27 21:52:24', 1),
(19, 2300.00, 25, 'DeWalt', 'dewalt_compresor.jpg', 'Compresor de aire', 'Mini-ferretería', '2024-09-27 21:52:24', 3),
(20, 1900.00, 30, 'Makita', 'makita_pulidora.jpg', 'Pulidora 600W', 'Mini-ferretería', '2024-09-27 21:52:24', 2),
(21, 750.00, 100, 'Sherwin Williams', 'sherwin_exterior.jpg', 'Pintura para exterior', 'Pinturas', '2024-09-27 21:52:31', 3),
(22, 600.00, 120, 'Inca', 'inca_interior.jpg', 'Pintura para interior', 'Pinturas', '2024-09-27 21:52:31', 1),
(23, 850.00, 90, 'Pinturas Uruguayas', 'uru_sintetica.jpg', 'Pintura sintética', 'Pinturas', '2024-09-27 21:52:31', 2),
(24, 950.00, 80, 'Kolor', 'kolor_brillante.jpg', 'Pintura brillante', 'Pinturas', '2024-09-27 21:52:31', 5),
(25, 700.00, 110, 'Sherwin Williams', 'sherwin_madera.jpg', 'Pintura para madera', 'Pinturas', '2024-09-27 21:52:31', 3),
(26, 620.00, 130, 'Inca', 'inca_exterior.jpg', 'Pintura para metal', 'Pinturas', '2024-09-27 21:52:31', 1),
(27, 870.00, 75, 'Pinturas Uruguayas', 'uru_mate.jpg', 'Pintura mate', 'Pinturas', '2024-09-27 21:52:31', 2),
(28, 970.00, 60, 'Kolor', 'kolor_satinada.jpg', 'Pintura satinada', 'Pinturas', '2024-09-27 21:52:31', 5),
(29, 780.00, 95, 'Sherwin Williams', 'sherwin_membrana.jpg', 'Pintura para membranas', 'Pinturas', '2024-09-27 21:52:31', 3),
(30, 680.00, 105, 'Inca', 'inca_brillante.jpg', 'Pintura brillante', 'Pinturas', '2024-09-27 21:52:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `teléfono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `fecha_actualización` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `teléfono`, `correo`, `dirección`, `fecha_actualización`) VALUES
(1, 'Proveedora Colorart', '+598 2901 0000', 'contacto@colorart.uy', 'Av. Italia 1234, Montevideo', '2024-09-27 21:51:28'),
(2, 'Ferretería El Tornillo', '+598 2202 1000', 'info@eltornillo.uy', '18 de Julio 4321, Montevideo', '2024-09-27 21:51:28'),
(3, 'Pinturería Sol y Luna', '+598 2304 2222', 'ventas@solyluna.com.uy', 'Rambla República de México 1001, Canelones', '2024-09-27 21:51:28'),
(4, 'Distribuidora Uruguay', '+598 2905 3030', 'soporte@distr.uy', 'Bvar. Artigas 2020, Montevideo', '2024-09-27 21:51:28'),
(5, 'Casa de Pinturas', '+598 2706 0707', 'info@casapinturas.com.uy', 'Colonia 1234, Montevideo', '2024-09-27 21:51:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `clasificación` enum('Cliente','Administrador') NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualización` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo`, `contraseña`, `clasificación`, `fecha_ingreso`, `fecha_actualización`) VALUES
(1, 'ThiagoSM', 'thiagosm2019@gmail.com', '$2y$10$LCcFRME3/tMzyd2Q/oFLxOBvuPAy3IlC9OHY2x/DcJu62dKBj2Bwm', 'Cliente', '2024-09-26 17:21:08', '2024-09-26 17:21:08'),
(2, '123', '123@gmail.com', '$2y$10$g88dKcORNgIWXDjIwYoEleMPkR51e2ZU2RbSCsUdsYvwlupis5G1W', 'Cliente', '2024-09-26 20:29:23', '2024-09-26 20:29:23'),
(3, 'Thiago', 'thiago1@gmail.com', '$2y$10$dExll.hWPde8v3Sj.cRusOLAD0dW3vZPaUaNcHsaGOMBRbvbIFdIG', 'Cliente', '2024-09-26 21:42:11', '2024-09-26 21:42:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `forma_de_pago` enum('efectivo','tarjeta') NOT NULL,
  `fecha_de_venta` date DEFAULT NULL,
  `productos_vendidos` text DEFAULT NULL,
  `valor_de_venta` decimal(10,2) DEFAULT NULL,
  `estado` enum('en proceso','completado') NOT NULL,
  `direccion_de_envio` varchar(255) DEFAULT NULL,
  `datos_extra_notas` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mini_ferreteria`
--
ALTER TABLE `mini_ferreteria`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `paleta_de_color`
--
ALTER TABLE `paleta_de_color`
  ADD PRIMARY KEY (`id_paleta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pinturas`
--
ALTER TABLE `pinturas`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paleta_de_color`
--
ALTER TABLE `paleta_de_color`
  MODIFY `id_paleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `accesorios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `mini_ferreteria`
--
ALTER TABLE `mini_ferreteria`
  ADD CONSTRAINT `mini_ferreteria_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `paleta_de_color`
--
ALTER TABLE `paleta_de_color`
  ADD CONSTRAINT `paleta_de_color_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `pinturas` (`id_producto`);

--
-- Filtros para la tabla `pinturas`
--
ALTER TABLE `pinturas`
  ADD CONSTRAINT `pinturas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
