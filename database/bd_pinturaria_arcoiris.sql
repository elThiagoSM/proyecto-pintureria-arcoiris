-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 17:37:48
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
  `medidas` varchar(20) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id_producto`, `medidas`, `tipo`) VALUES
(2, '5 cm', 'Brocha'),
(3, '10 cm', 'Espátula'),
(4, '15x10 cm', 'Lijadora'),
(5, 'Talla única', 'Mascarilla'),
(6, 'Talla única', 'Guantes'),
(7, '30x20 cm', 'Bandeja'),
(8, '5 cm', 'Cinta adhesiva'),
(9, '1-2 metros', 'Extensor'),
(10, '10 cm', 'Espátula'),
(11, '1x1 m', 'Protector'),
(12, '10 cm', 'Cuchillo'),
(13, '3 metros', 'Cinta métrica'),
(14, '30x30 cm', 'Paño'),
(15, '15 cm', 'Soporte'),
(16, '20x15 cm', 'Cubo'),
(17, '5 metros', 'Manguera'),
(18, '15 cm', 'Cepillo'),
(19, '1 litro', 'Cubo medidor'),
(20, '10 metros', 'Manguera'),
(62, '12', 'Soda'),
(66, '10xp', 'Brocha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL,
  `datos_contacto` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `cedula` varchar(8) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `correo`, `direccion`, `datos_contacto`, `fecha_nacimiento`, `cedula`, `fecha_actualizacion`, `id_usuario`) VALUES
(5, 'hack', 'h4ck3r3535@gmail.com', 'hh', '12451353', '2000-02-20', '57654281', '2024-11-10 04:17:03', 9),
(6, 'Thiago Silveira Machado', 'criptoarchy@gmail.com', 'Lucas Freee', '099904643', '2000-04-02', '76668962', '2024-11-10 04:52:57', 10),
(7, 'Sergio Sergio Sergio', 'alepertu@gmail.com', 'mv, 123, uy', '099084617', '1848-09-01', '34518475', '2024-11-10 04:59:46', 11),
(9, 'Thiago Silveira Machado', 'thiagosm2020@gmail.com', 'Lucas Caffre 600', '0998753712', '2000-04-02', '76661932', '2024-11-10 08:12:16', 13),
(10, 'Thiago Silveira Machado', 'thiagosm2019@gmail.com', 'Lucas Caffre 600', '099904643', '2000-04-02', '57956872', '2024-11-10 08:41:51', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miniferreteria`
--

CREATE TABLE `miniferreteria` (
  `id_producto` int(11) NOT NULL,
  `garantia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miniferreteria`
--

INSERT INTO `miniferreteria` (`id_producto`, `garantia`) VALUES
(21, '2 años'),
(22, '1 año'),
(23, '1 año'),
(24, '6 meses'),
(25, '2 años'),
(26, '1 año'),
(27, '6 meses'),
(28, '1 año'),
(29, '1 año'),
(30, '2 años'),
(31, '1 año'),
(32, '6 meses'),
(33, '1 año'),
(34, '2 años'),
(35, '1 año'),
(36, '1 año'),
(37, '2 años'),
(38, '6 meses'),
(39, '1 año'),
(40, '1 año'),
(63, '1 año');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paletacolor`
--

CREATE TABLE `paletacolor` (
  `id_paleta` int(11) NOT NULL,
  `codigo_de_color` varchar(6) DEFAULT NULL,
  `nombre_color` varchar(20) NOT NULL,
  `tintes_utilizados` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paletacolor`
--

INSERT INTO `paletacolor` (`id_paleta`, `codigo_de_color`, `nombre_color`, `tintes_utilizados`) VALUES
(1, 'FF5733', 'Rojo Coral', 'Rojo intenso, naranja cálido'),
(2, '33FF57', 'Verde Lima', 'Verde brillante, amarillo claro'),
(3, '3357FF', 'Azul Cielo', 'Azul claro, tonalidades celestes'),
(4, 'FF33A1', 'Rosa Fucsia', 'Rosa fuerte, morado vibrante'),
(5, 'FFFF33', 'Amarillo Sol', 'Amarillo brillante, dorado suave'),
(6, '33FFFF', 'Turquesa', 'Azul verdoso, verde pastel'),
(7, 'FF33FF', 'Púrpura', 'Violeta oscuro, morado profundo'),
(8, 'FF8000', 'Naranja Mandarina', 'Naranja cálido, dorado suave'),
(9, '00FF33', 'Verde Esmeralda', 'Verde oscuro, azul turquesa'),
(10, '8000FF', 'Azul Real', 'Azul intenso, tonos profundos de marino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pinturas`
--

CREATE TABLE `pinturas` (
  `id_producto` int(11) NOT NULL,
  `litros` decimal(5,2) DEFAULT NULL,
  `funcion_aplicacion` enum('exterior','interior','metal','madera','sintetica','membrana') NOT NULL,
  `id_paleta` int(11) DEFAULT NULL,
  `terminacion` enum('mate','brillante','semimate','satinada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pinturas`
--

INSERT INTO `pinturas` (`id_producto`, `litros`, `funcion_aplicacion`, `id_paleta`, `terminacion`) VALUES
(41, 1.00, 'interior', 1, 'mate'),
(42, 1.00, 'exterior', 2, 'brillante'),
(43, 1.00, 'interior', 3, 'mate'),
(44, 1.00, 'interior', 4, 'satinada'),
(45, 1.00, 'exterior', 5, 'brillante'),
(46, 1.00, 'interior', 6, 'mate'),
(47, 1.00, 'interior', 7, 'brillante'),
(48, 1.00, 'interior', 8, 'satinada'),
(49, 1.00, 'exterior', 9, 'mate'),
(50, 1.00, 'interior', 10, 'brillante'),
(51, 1.00, 'interior', 1, 'mate'),
(52, 1.00, 'exterior', 2, 'brillante'),
(53, 1.00, 'interior', 3, 'mate'),
(54, 1.00, 'interior', 4, 'satinada'),
(55, 1.00, 'exterior', 5, 'brillante'),
(56, 1.00, 'interior', 6, 'mate'),
(57, 1.00, 'interior', 7, 'brillante'),
(58, 1.00, 'interior', 8, 'satinada'),
(59, 1.00, 'exterior', 9, 'mate'),
(60, 1.00, 'interior', 10, 'brillante'),
(61, 2.00, 'exterior', 8, 'mate'),
(64, 1.00, 'exterior', 9, 'mate'),
(65, 2.00, 'exterior', 10, 'mate'),
(67, 2.00, 'exterior', 1, 'mate'),
(68, 2.00, 'exterior', 8, 'mate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT 'assets/imgs/productos/none.png',
  `nombre` varchar(30) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock_cantidad` int(11) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `unidad` enum('Litro','Kg','Cantidad') NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) DEFAULT NULL,
  `mostrar` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `imagen`, `nombre`, `descripcion`, `precio`, `stock_cantidad`, `marca`, `unidad`, `fecha_ingreso`, `fecha_actualizacion`, `id_proveedor`, `mostrar`) VALUES
(1, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Rodillo de Espuma', 'Rodillo ideal para pintura en superficies lisas', 320.00, 50, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 1, 1),
(2, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Brocha Angular', 'Brocha con cerdas suaves, ideal para detalles', 180.00, 30, 'Proveedora Sudameric', '', '2023-11-01', '2024-11-11 16:14:32', 2, 1),
(3, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Espátula Plástica', 'Espátula para preparación de paredes', 150.00, 40, 'Colorearte', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 3, 1),
(4, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Lijadora Manual', 'Lijadora ergonómica para trabajo en seco', 540.00, 25, 'Total', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 4, 1),
(5, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Mascarilla de Protección', 'Mascarilla respiratoria para trabajo con pintura', 120.00, 100, 'Olivares', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 5, 1),
(6, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Guantes de Látex', 'Guantes desechables para protección', 50.00, 200, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(7, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Bandeja para Pintura', 'Bandeja plástica para facilitar el pintado', 75.00, 60, 'Del Sol', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 7, 1),
(8, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cinta de Carrocero', 'Cinta adhesiva para delimitar zonas de pintura', 90.00, 80, 'Sudamericana', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(9, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Extensor para Rodillo', 'Extensor ajustable para rodillos de pintura', 600.00, 20, 'Pintal', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(10, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Espátula Metálica', 'Espátula de acero inoxidable para acabado', 250.00, 35, 'Otero', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 10, 1),
(11, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Protector de Piso', 'Protector de plástico para pisos durante la pintura', 150.00, 50, 'Proveedora Oriental', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 1, 1),
(12, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cuchillo Multiuso', 'Cuchillo para cortar plásticos y otros materiales', 90.00, 75, 'Colorearte', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 2, 1),
(13, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cinta Métrica', 'Cinta métrica de 3 metros', 120.00, 40, 'Del Sol', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 3, 1),
(14, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Paño de Microfibra', 'Paño para limpieza de superficies antes de pintar', 70.00, 150, 'Total', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 4, 1),
(15, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Soporte para Brochas', 'Soporte para evitar que la brocha toque el suelo', 110.00, 61, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-10 07:06:08', 5, 1),
(16, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cubo para Pintura', 'Cubo de plástico con asa para mezcla de pintura', 95.00, 45, 'Olivares', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(17, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Manguera para Compresor', 'Manguera de 5 metros para compresores de pintura', 780.00, 15, 'Otero', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 7, 1),
(18, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cepillo de Limpieza', 'Cepillo para limpiar superficies de polvo', 130.00, 65, 'Acabados Profesional', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(19, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cubo Medidor', 'Cubo con medición para diluir pintura', 85.00, 40, 'Distribuidora Orient', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(20, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Manguera para Agua', 'Manguera de 10 metros, ideal para limpiar', 220.00, 25, 'Pinturería Total', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 10, 1),
(21, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Taladro Eléctrico', 'Taladro eléctrico de 500W, ideal para trabajos de perforación', 1500.00, 25, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 1, 1),
(22, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Sierra Circular', 'Sierra circular portátil con hoja de 150mm', 2200.00, 14, 'Proveedora Sudameric', 'Cantidad', '2023-11-01', '2024-11-09 19:28:34', 2, 1),
(23, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Amoladora Angular', 'Amoladora angular de 100mm, con regulador de velocidad', 1800.00, 27, 'Colorearte', 'Cantidad', '2023-11-01', '2024-11-10 08:46:03', 3, 1),
(24, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Martillo de Goma', 'Martillo de goma para trabajos en madera y materiales delicados', 350.00, 39, 'Total', 'Cantidad', '2023-11-01', '2024-11-09 19:17:29', 4, 1),
(25, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Llave Ajustable', 'Llave ajustable de 8-22mm para trabajos de mecánica', 400.00, 50, 'Olivares', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 5, 1),
(26, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Alicate Universal', 'Alicate universal de 200mm, con mango ergonómico', 320.00, 60, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(27, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Destornillador de Precisión', 'Set de destornilladores de precisión, ideal para electrónica', 250.00, 84, 'Del Sol', 'Cantidad', '2023-11-01', '2024-11-10 08:25:51', 7, 1),
(28, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Lámpara LED Portátil', 'Lámpara LED recargable, portátil, ideal para trabajo nocturno', 650.00, 20, 'Sudamericana', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(29, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Caja de Herramientas', 'Caja de herramientas de 18 pulgadas, con compartimentos', 900.00, 40, 'Pintal', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(30, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Compresor de Aire', 'Compresor portátil de 12V, con manguera de 3 metros', 2500.00, 16, 'Otero', 'Cantidad', '2023-11-01', '2024-11-11 01:51:39', 10, 1),
(31, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Sierra de Mano', 'Sierra de mano de 300mm para corte de madera', 550.00, 30, 'Acabados Profesional', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 1, 1),
(32, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cinta Métrica de 5m', 'Cinta métrica de 5 metros con carcasa de acero', 180.00, 60, 'Proveedora Oriental', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 2, 1),
(33, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pistola de Calor', 'Pistola de calor regulable, ideal para trabajos de pintura', 1200.00, 25, 'Colorearte', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 3, 1),
(34, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Generador Eléctrico', 'Generador eléctrico portátil de 2.5 kW', 4800.00, 3, 'Distribuidora Orient', 'Cantidad', '2023-11-01', '2024-11-10 08:50:05', 4, 1),
(35, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Juego de Llaves de Tubo', 'Juego de 12 llaves de tubo, acero de alta resistencia', 850.00, 35, 'Pinturería Total', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 5, 1),
(36, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pistola de Pintura', 'Pistola de pintura tipo HVLP, ideal para acabados finos', 1500.00, 10, 'Otero', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(37, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Cortadora de Azulejos', 'Cortadora manual de azulejos, hasta 600mm', 1300.00, 20, 'Proveedora Sudameric', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 7, 1),
(38, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pico de Gallo', 'Pico de gallo de 20cm para corte de metales', 450.00, 40, 'Del Sol', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(39, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Carro de Herramientas', 'Carro de herramientas de 3 cajones, con ruedas', 2300.00, 15, 'Pintalux', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(40, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Bomba de Achique', 'Bomba de achique sumergible, 12V', 1100.00, 10, 'Sudamericana', 'Cantidad', '2023-11-01', '2024-11-08 21:02:01', 10, 1),
(41, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Rojo Coral - editado', 'Pintura de alta calidad para interiores y exteriores - editado', 450.00, 35, 'Pintalux', '', '2023-11-01', '2024-11-11 15:58:06', 1, 0),
(42, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Verde Lima', 'Pintura ecológica de acabado mate, ideal para paredes', 430.00, 30, 'Total', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 2, 1),
(43, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Azul Cielo', 'Ideal para interiores, crea ambientes relajantes', 400.00, 25, 'Colorearte', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 3, 1),
(44, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Rosa Fucsia', 'Perfecta para detalles y decoración creativa', 480.00, 15, 'Proveedora Sudameric', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 4, 1),
(45, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Amarillo Sol', 'Pintura brillante para exteriores, resistente al sol', 420.00, 40, 'Pintalux', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 5, 1),
(46, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Turquesa', 'Pintura para interiores y exteriores, acabado brillante', 460.00, 50, 'Pinturería Total', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(47, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Púrpura', 'Ideal para paredes y detalles decorativos', 500.00, 20, 'Distribuidora Otero', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 7, 1),
(48, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Naranja Mandarina', 'Color vibrante y duradero para interiores', 450.00, 35, 'Del Sol', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(49, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Verde Esmeralda', 'Pintura para interiores y exteriores, acabado mate', 470.00, 25, 'Olivares', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(50, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Azul Real', 'Pintura de acabado brillante, ideal para decoración moderna', 490.00, 15, 'Colorearte', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 10, 1),
(51, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Rojo Coral Mate', 'Pintura mate para paredes, con excelente cobertura', 440.00, 30, 'Pintalux', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 1, 1),
(52, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Verde Lima Brillante', 'Brillante y duradera, ideal para exteriores', 460.00, 45, 'Proveedora Sudameric', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 2, 1),
(53, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Azul Cielo Claro', 'Pintura ligera y relajante para ambientes interiores', 410.00, 55, 'Total', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 3, 1),
(54, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Rosa Pastel', 'Pintura para acabados suaves en habitaciones', 430.00, 30, 'Pinturería Total', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 4, 1),
(55, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Amarillo Pálido', 'Pintura mate para interiores, fácil de aplicar', 420.00, 60, 'Distribuidora Otero', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 5, 1),
(56, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Turquesa Claro', 'Ideal para ambientes frescos, combina bien con otros colores', 450.00, 40, 'Pintalux', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 6, 1),
(57, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Púrpura Claro', 'Pintura de acabado mate, suave y elegante', 480.00, 30, 'Del Sol', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 7, 1),
(58, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Naranja Claro', 'Pintura brillante y cálida para interiores', 440.00, 50, 'Olivares', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 8, 1),
(59, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Verde Esmeralda Mate', 'Color sofisticado para paredes interiores', 470.00, 45, 'Pintal', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 9, 1),
(60, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Azul Real Mate', 'Pintura mate de alta calidad para detalles decorativos', 480.00, 20, 'Proveedora Sudameric', 'Litro', '2023-11-01', '2024-11-08 21:02:01', 10, 1),
(61, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Pintura Prueba 1', 'sdkhisdg', 12.00, 22, 'hi', 'Litro', '2024-11-07', '2024-11-08 21:02:01', 4, 1),
(62, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Accesorio Prueba 2', 'sdgkjsdjgksd', 1241.00, 99, '123', 'Cantidad', '2024-11-07', '2024-11-08 21:02:01', 8, 1),
(63, 'http://localhost/proyecto-pintureria-arcoiris/assets/imgs/productos/none.png', 'Mini Ferreteria Prueba 3', 'iuinf2e', 1929.00, 52, 'kdkkd', 'Kg', '2024-11-07', '2024-11-08 21:02:01', 5, 1),
(64, './assets/imgs/productos/none.png', 'Pintura testeo v020201', 'hefwijehfwjegw', 2200.00, 30, 'Dell', 'Kg', '2024-11-10', '2024-11-11 01:56:54', 8, 1),
(65, './assets/imgs/productos/none.png', 'Pintura - test - v1', 'Esto es una prueba de pintura', 450.00, 25, 'Dooller', 'Litro', '2024-11-10', '2024-11-11 02:08:13', 5, 1),
(66, './assets/imgs/productos/none.png', 'Testeo Accesorio v1', 'Accesorio test', 320.00, 10, 'Dell', 'Cantidad', '2024-11-10', '2024-11-11 02:11:02', 10, 1),
(67, './assets/imgs/productos/none.png', 'producto nuevo - 11 11 2024', 'nuevo producto sin mostrar en tienda', 340.00, 20, 'pintura', '', '2024-11-11', '2024-11-11 16:04:12', 5, 0),
(68, './assets/imgs/productos/none.png', 'nuevo rpoducto 12312', 'descirpcion', 100.00, 10, 'dell', 'Litro', '2024-11-11', '2024-11-11 16:04:46', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `direccion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `telefono`, `correo`, `direccion`) VALUES
(1, 'Proveedora Sudamericana - edit', '091234567', 'contacto@sudamericana.com', 'Calle 1, Montevideo'),
(2, 'Materiales del Sol', '091234568', 'ventas@del-sol.com', 'Calle 2, Montevideo'),
(3, 'Industrias Pintal', '091234569', 'info@pintal.com', 'Calle 3, Montevideo'),
(4, 'Distribuidora Olivares', '091234570', 'olivares@distribuidora.com', 'Calle 4, Montevideo'),
(5, 'Pinturería Total', '091234571', 'total@pintureria.com', 'Calle 5, Montevideo'),
(6, 'Accesorios Pintalux', '091234572', 'soporte@pintalux.com', 'Calle 6, Montevideo'),
(7, 'Fábrica Colorearte', '091234573', 'ventas@colorearte.com', 'Calle 7, Montevideo'),
(8, 'Distribuciones Otero', '091234574', 'contacto@otero.com', 'Calle 8, Montevideo'),
(9, 'Acabados Profesionales', '091234575', 'info@acabadosprof.com', 'Calle 9, Montevideo'),
(10, 'Proveedora Oriental', '091234576', 'ventas@oriental.com', 'Calle 10, Montevideo'),
(11, 'pepeppe', '123456789', '1jgihfdgijdf@gmail.com', 'hhh 123'),
(12, 'Proveedores Oxidente Ori-', '099976542', 'provee-oxide@gmail.com', 'Avenida Free 123'),
(13, 'prueba test proveedor', '098765491', 'puruebatest@gmail.com', 'Free 123, Av Bueno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `contraseña` varchar(60) NOT NULL,
  `clasificacion` enum('Cliente','Administrador') NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `foto_perfil` varchar(100) DEFAULT 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg',
  `correo_verificado` tinyint(1) DEFAULT 0,
  `token_verificacion` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo`, `contraseña`, `clasificacion`, `fecha_ingreso`, `fecha_actualizacion`, `foto_perfil`, `correo_verificado`, `token_verificacion`) VALUES
(9, 'hack', 'h4ck3r3535@gmail.com', '$2y$10$tpQFWAQdUkY.HLJ14XIQvuju7NrJrWF35JHdtJw/6KUd.emFki6Nm', 'Cliente', '2024-11-10 04:17:03', '2024-11-10 04:17:47', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, 'fbfd3d'),
(10, 'thiagosmmm', 'criptoarchy@gmail.com', '$2y$10$e3FdC.gxZdvap2PxflKo7eROGPgc3dwTzQDUDDj67TBbqwqr1GByK', 'Cliente', '2024-11-10 04:52:57', '2024-11-10 04:54:43', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, 'ba2e6d'),
(11, 'serguito', 'alepertu@gmail.com', '$2y$10$R5X2x81Zp.WBmbLOLVO2Uu4qwMYmUX1rn5qxi1ocmq73V/8Hig5PS', 'Cliente', '2024-11-10 04:59:46', '2024-11-10 08:47:55', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, '548214'),
(13, 'pepe', 'thiagosm2020@gmail.com', '$2y$10$M/ycdqRDQ.Jr1QoMai/PGuLtA2WsaO3fEX3JuwsWk3dic/.ytpPIy', 'Cliente', '2024-11-10 08:12:16', '2024-11-10 08:12:28', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, 'b78cbd'),
(14, 'ThiagoSM', 'thiagosm2019@gmail.com', '$2y$10$GpDjmv2GEFc.IKYzCgP0nedpbee6hzw0Ik/hc7FN/P1t89k8Z9NWO', 'Cliente', '2024-11-10 08:41:51', '2024-11-10 08:42:05', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, '38bcfa'),
(15, 'admin', 'pintureriaacoiris@gmail.com', '$2y$10$Xf32MDhYrAaIAlQkBTmWG.AGWGuxLnFvTQRS3P7l1DuSzTOMVdnH.', 'Administrador', '2024-11-11 02:24:36', '2024-11-11 02:25:37', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, '128389'),
(16, 'equipo_phae', 'desarrollophae@gmail.com', '$2y$10$lj5a9gG/KN4eqiyrDYIBouEo/zYVgjpUocc8a.RLmLS1zPFgQ1qDa', 'Administrador', '2024-11-11 02:27:42', '2024-11-11 02:27:52', 'assets/imgs/fotos-perfiles/foto-perfil-por-defecto.jpg', 1, '9078d8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `forma_de_pago` enum('efectivo','transferencia') NOT NULL,
  `fecha_de_venta` date DEFAULT NULL,
  `valor_de_venta` decimal(10,2) DEFAULT NULL,
  `estado` enum('en proceso','completado') NOT NULL,
  `datos_extra_notas` text DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `forma_de_pago`, `fecha_de_venta`, `valor_de_venta`, `estado`, `datos_extra_notas`, `id_producto`, `cantidad`, `id_cliente`) VALUES
(16, 'efectivo', '2024-11-10', 150.00, 'completado', 'Nota: venta 1', 10, 2, 5),
(17, 'transferencia', '2024-11-09', 200.00, 'completado', 'Nota: venta 2', 25, 1, 5),
(18, 'efectivo', '2024-11-08', 75.00, 'completado', 'Nota: venta 3', 5, 3, 5),
(19, 'transferencia', '2024-11-07', 300.00, 'completado', 'Nota: venta 4', 40, 4, 6),
(21, 'efectivo', '2024-11-05', 500.00, 'completado', 'Nota: venta 6', 35, 10, 6),
(22, 'transferencia', '2024-11-04', 100.00, 'completado', 'Nota: venta 7', 60, 5, 7),
(23, 'efectivo', '2024-11-03', 250.00, 'completado', 'Nota: venta 8', 1, 8, 7),
(25, 'transferencia', '2024-11-10', 4000.00, 'en proceso', 'prueba test 1', 27, 16, 9),
(26, 'transferencia', '2024-11-10', 1800.00, 'en proceso', 'ddddd', 23, 1, 9),
(27, 'efectivo', '2024-11-10', 1800.00, 'en proceso', 'Esto es una prueba de compra para un producto', 23, 1, 10),
(28, 'transferencia', '2024-11-10', 1800.00, 'en proceso', 'Prueba v2 testeo web', 23, 1, 10),
(29, 'transferencia', '2024-11-10', 9600.00, 'en proceso', '...', 34, 2, 7);

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
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `miniferreteria`
--
ALTER TABLE `miniferreteria`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `paletacolor`
--
ALTER TABLE `paletacolor`
  ADD PRIMARY KEY (`id_paleta`);

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
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `fk_id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paletacolor`
--
ALTER TABLE `paletacolor`
  MODIFY `id_paleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- Filtros para la tabla `miniferreteria`
--
ALTER TABLE `miniferreteria`
  ADD CONSTRAINT `miniferreteria_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

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
  ADD CONSTRAINT `fk_id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
