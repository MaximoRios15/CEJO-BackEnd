-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-09-2025 a las 18:50:30
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
-- Base de datos: `cejo-db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_equipos`
--

CREATE TABLE `categorias_equipos` (
  `idCategorias` int(11) NOT NULL,
  `Nombres_Categorias` varchar(50) NOT NULL,
  `Activo_Categorias` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias_equipos`
--

INSERT INTO `categorias_equipos` (`idCategorias`, `Nombres_Categorias`, `Activo_Categorias`) VALUES
(1, 'Microondas', 1),
(2, 'Licuadoras', 1),
(3, 'Batidoras', 1),
(4, 'Procesadoras de alimentos', 1),
(5, 'Cafeteras', 1),
(6, 'Tostadoras', 1),
(7, 'Sandwicheras', 1),
(8, 'Hornitos electricos', 1),
(9, 'Pavas electricas', 1),
(10, 'Extractores de jugo', 1),
(11, 'Calefactores y estufas', 1),
(12, 'Televisores', 1),
(13, 'Parlantes y barras de sonido', 1),
(14, 'Reproductores de video', 1),
(15, 'Consolas de videojuegos', 1),
(16, 'Secadores de pelo', 1),
(17, 'Planchitas', 1),
(18, 'Rizadores', 1),
(19, 'Computadoras de escritorio', 1),
(20, 'Notebooks', 1),
(21, 'Laptops', 1),
(22, 'Tablets', 1),
(23, 'Teclados', 1),
(24, 'Mouse', 1),
(25, 'Scanners', 1),
(26, 'Microfonos', 1),
(27, 'Camaras web', 1),
(28, 'Monitores', 1),
(29, 'Impresoras', 1),
(30, 'Auriculares', 1),
(31, 'Estabilizadores y UPS', 1),
(32, 'Joysticks y mandos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idClientes` int(11) NOT NULL,
  `Nombres_Clientes` varchar(100) NOT NULL,
  `Apellidos_Clientes` varchar(100) NOT NULL,
  `DNI_Clientes` varchar(10) NOT NULL,
  `Telefono_Clientes` varchar(13) NOT NULL,
  `Email_Clientes` varchar(100) DEFAULT NULL,
  `Direccion_Clientes` varchar(255) NOT NULL,
  `CodigoPostal_Clientes` varchar(10) DEFAULT NULL,
  `Ciudad_Clientes` varchar(75) NOT NULL,
  `Provincia_Clientes` varchar(75) NOT NULL,
  `FechaRegistro_Clientes` datetime DEFAULT current_timestamp(),
  `Activo_Clientes` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `idEquipos` int(11) NOT NULL,
  `idClientes_Equipos` int(11) NOT NULL,
  `idCategorias_Equipos` int(11) NOT NULL,
  `Modelo_Equipos` varchar(100) NOT NULL,
  `DescripcionProblema_Equipos` varchar(255) NOT NULL,
  `idGarantias_Equipos` int(11) NOT NULL,
  `Accesorios_Equipos` varchar(100) DEFAULT NULL,
  `FechaIngreso_Equipos` datetime NOT NULL,
  `idEstados_Equipos` int(11) NOT NULL,
  `NroOrden_Equipo` varchar(45) DEFAULT NULL,
  `NroBR_Equipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_has_proveedor`
--

CREATE TABLE `equipos_has_proveedor` (
  `equipos_idEquipos` int(11) NOT NULL,
  `Proveedor_idProveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstados` int(11) NOT NULL,
  `Descripcion_Estados` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `idEquipo_Factura` int(11) NOT NULL,
  `FechaCompra_Factura` date DEFAULT NULL,
  `NroFactura_Factura` int(11) NOT NULL,
  `Comercio_Factura` varchar(75) NOT NULL,
  `Localidad_Factura` varchar(75) NOT NULL,
  `Pagador_Factura` varchar(75) NOT NULL,
  `FechaRegistro_Factura` datetime DEFAULT current_timestamp(),
  `Monto_Factura` decimal(10,2) DEFAULT NULL,
  `Fecha_Salida_Factura` datetime DEFAULT NULL,
  `Fecha_Entrada_Factura` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_equipos`
--

CREATE TABLE `fotos_equipos` (
  `idFotos` int(11) NOT NULL,
  `idEquipos_Fotos` int(11) NOT NULL,
  `RutaArchivo_Fotos` varchar(255) NOT NULL,
  `NombreOriginal_Fotos` varchar(255) NOT NULL,
  `FechaSubida_Fotos` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantias`
--

CREATE TABLE `garantias` (
  `idGarantias` int(11) NOT NULL,
  `Descripcion_Garantias` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `garantias`
--

INSERT INTO `garantias` (`idGarantias`, `Descripcion_Garantias`) VALUES
(1, 'T1: Reparacion normal'),
(2, 'T2: Garantia de fabrica'),
(3, 'T3: Garantia de comercio'),
(4, 'T4: Garantia interna (3 meses post-reparacion)'),
(5, 'T5: Seguro de hogar/garantia extendida'),
(6, 'T6: Reclamo de garantia (reparacion fallida)'),
(7, 'T7: Producto da??ado por terceros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `class` varchar(75) DEFAULT NULL,
  `group` varchar(50) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-01-26-200000', 'App\\Database\\Migrations\\CreateRolesTable', 'default', 'App', '20:25:00', 1),
(2, '2025-01-26-200001', 'App\\Database\\Migrations\\CreateCategoriasEquiposTable', 'default', 'App', '20:25:00', 1),
(3, '2025-01-26-200002', 'App\\Database\\Migrations\\CreateGarantiasTable', 'default', 'App', '20:25:00', 1),
(4, '2025-01-26-200003', 'App\\Database\\Migrations\\CreateProveedorTable', 'default', 'App', '20:25:00', 1),
(5, '2025-01-26-200004', 'App\\Database\\Migrations\\CreateEstadosTable', 'default', 'App', '20:25:00', 1),
(6, '2025-01-26-200005', 'App\\Database\\Migrations\\CreateClientesTable', 'default', 'App', '20:25:00', 1),
(7, '2025-01-26-200006', 'App\\Database\\Migrations\\CreateUsuariosTable', 'default', 'App', '20:25:00', 1),
(8, '2025-01-26-200007', 'App\\Database\\Migrations\\CreateEquiposTable', 'default', 'App', '20:25:00', 1),
(9, '2025-01-26-200008', 'App\\Database\\Migrations\\CreateEquiposHasProveedorTable', 'default', 'App', '20:25:00', 1),
(10, '2025-01-26-200009', 'App\\Database\\Migrations\\CreateFacturaTable', 'default', 'App', '20:25:00', 1),
(11, '2025-01-26-200010', 'App\\Database\\Migrations\\CreateFotosEquiposTable', 'default', 'App', '20:25:00', 1),
(12, '2025-01-26-200011', 'App\\Database\\Migrations\\CreatePresupuestoTable', 'default', 'App', '20:25:00', 1),
(13, '2025-01-26-200012', 'App\\Database\\Migrations\\CreateRepuestoTable', 'default', 'App', '20:25:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `idPresupuesto` int(11) NOT NULL,
  `N_orden` varchar(45) DEFAULT NULL,
  `presu_Precio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `Nombre_Proveedor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `Nombre_Proveedor`) VALUES
(1, '8BitDo'),
(2, 'AOC'),
(3, 'APC (Schneider Electric)'),
(4, 'Apple'),
(5, 'Asus'),
(6, 'Atma'),
(7, 'Audio-Technica'),
(8, 'Babyliss'),
(9, 'Bangho'),
(10, 'Behringer'),
(11, 'BenQ'),
(12, 'BGH'),
(13, 'Black+Decker'),
(14, 'Blue (Yeti)'),
(15, 'Bose'),
(16, 'Braun'),
(17, 'Brother'),
(18, 'Canon'),
(19, 'Carrier'),
(20, 'Conair'),
(21, 'Corsair'),
(22, 'Creative'),
(23, 'CyberPower'),
(24, 'Daewoo'),
(25, 'Daikin'),
(26, 'Dell'),
(27, 'Eaton'),
(28, 'Electrolux'),
(29, 'Epson'),
(30, 'Eskabe'),
(31, 'EXO'),
(32, 'Forza'),
(33, 'Fujitsu'),
(34, 'Gama Italy'),
(35, 'General Electric (GE)'),
(36, 'Genius'),
(37, 'Haier'),
(38, 'Hamilton Beach'),
(39, 'Harman Kardon'),
(40, 'Hisense'),
(41, 'Hitachi'),
(42, 'HP (Hewlett-Packard)'),
(43, 'Huawei'),
(44, 'HyperX'),
(45, 'Imusa'),
(46, 'Insignia'),
(47, 'James'),
(48, 'JBL'),
(49, 'JVC'),
(50, 'Kanji'),
(51, 'KitchenAid'),
(52, 'Klipsch'),
(53, 'Konka'),
(54, 'Lenovo'),
(55, 'Lexmark'),
(56, 'LG'),
(57, 'Liebert (Vertiv)'),
(58, 'Liliana'),
(59, 'Logitech'),
(60, 'Longvie'),
(61, 'Marshall'),
(62, 'Microsoft'),
(63, 'Midea'),
(64, 'MSI'),
(65, 'Moulinex'),
(66, 'Nintendo'),
(67, 'Noblex'),
(68, 'Nokia (historico en algunos perifericos/tablets)'),
(69, 'Oculus/Meta (VR, controles)'),
(70, 'Orbis'),
(71, 'Oster'),
(72, 'Panasonic'),
(73, 'Peabody'),
(74, 'Philips'),
(75, 'Philco'),
(76, 'Pioneer'),
(77, 'PlayStation (Sony)'),
(78, 'Razer'),
(79, 'RCA'),
(80, 'Redragon'),
(81, 'Remington'),
(82, 'Revlon'),
(83, 'Ricoh'),
(84, 'Rode'),
(85, 'Rowenta'),
(86, 'Russell Hobbs'),
(87, 'Samsung'),
(88, 'Sanyo (historico en TV/audio)'),
(89, 'Sennheiser'),
(90, 'Sharp'),
(91, 'Shure'),
(92, 'Siemens'),
(93, 'Singer'),
(94, 'Smeg'),
(95, 'Snaige (refrigeracion europeo)'),
(96, 'Somela'),
(97, 'Sony'),
(98, 'Sordini (local, climatizacion)'),
(99, 'Steam (Valve/Steam Deck)'),
(100, 'SteelSeries'),
(101, 'Sthor (accesorios electricos)'),
(102, 'Surrey'),
(103, 'TCL'),
(104, 'Tefal'),
(105, 'Toshiba'),
(106, 'Tripp Lite'),
(107, 'Trust'),
(108, 'ViewSonic'),
(109, 'Visuar'),
(110, 'Vizio'),
(111, 'Volcan'),
(112, 'Wahl'),
(113, 'Whirlpool'),
(114, 'Xiaomi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuesto`
--

CREATE TABLE `repuesto` (
  `id_Repuesto` int(11) NOT NULL,
  `Descripcion_Repuesto` varchar(45) DEFAULT NULL,
  `Cantidad_Repuesto` int(11) DEFAULT NULL,
  `Prioridad_Repuesto` varchar(45) DEFAULT NULL,
  `Repuesto_Solicitado_` varchar(45) DEFAULT NULL,
  `categorias_equipos_idCategorias` int(11) NOT NULL,
  `usuarios_idUsuarios` int(11) NOT NULL,
  `usuarios_idRoles_Usuarios` int(11) NOT NULL,
  `Factura_idFactura` int(11) NOT NULL,
  `estados_idEstados` int(11) NOT NULL,
  `Fecha_Solicitud_Respuesto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRoles` int(11) NOT NULL,
  `Descripcion_Roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRoles`, `Descripcion_Roles`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista'),
(3, 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `Nombres_Usuarios` varchar(100) NOT NULL,
  `Apellidos_Usuarios` varchar(100) NOT NULL,
  `DNI_Usuarios` int(25) NOT NULL,
  `Password_Usuarios` varchar(255) NOT NULL,
  `FechaCreacion_Usuarios` datetime DEFAULT NULL,
  `UltimoAcceso_Usuarios` datetime DEFAULT NULL,
  `idRoles_Usuarios` int(11) NOT NULL,
  `Activo_Usuarios` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `Nombres_Usuarios`, `Apellidos_Usuarios`, `DNI_Usuarios`, `Password_Usuarios`, `FechaCreacion_Usuarios`, `UltimoAcceso_Usuarios`, `idRoles_Usuarios`, `Activo_Usuarios`) VALUES
(1, 'Maximo Jesus', 'Rios', 45026308, '$2y$10$Yt/FbOhW6GpPDd113TlJu.QfH3pZuJUjhrxpaadaWgiHXV3bt7ml2', '2025-09-03 19:21:14', '2025-09-03 19:21:14', 2, 1),
(2, 'Bruno Gaston', 'Rios', 45390354, 'Ramos2025', '2025-09-03 19:21:14', '2025-09-03 19:21:14', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_equipos`
--
ALTER TABLE `categorias_equipos`
  ADD PRIMARY KEY (`idCategorias`),
  ADD UNIQUE KEY `Nombres_Categorias` (`Nombres_Categorias`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idClientes`),
  ADD KEY `idx_clientes_documento` (`DNI_Clientes`),
  ADD KEY `idx_clientes_telefono` (`Telefono_Clientes`),
  ADD KEY `idx_clientes_email` (`Email_Clientes`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`idEquipos`),
  ADD KEY `idx_equipos_cliente` (`idClientes_Equipos`),
  ADD KEY `idx_equipos_fecha_ingreso` (`FechaIngreso_Equipos`),
  ADD KEY `idx_equipos_categoria` (`idCategorias_Equipos`),
  ADD KEY `fk_equipos_garantias1_idx` (`idGarantias_Equipos`),
  ADD KEY `fk_equipos_estados1_idx` (`idEstados_Equipos`);

--
-- Indices de la tabla `equipos_has_proveedor`
--
ALTER TABLE `equipos_has_proveedor`
  ADD PRIMARY KEY (`equipos_idEquipos`,`Proveedor_idProveedor`),
  ADD KEY `fk_equipos_has_Proveedor_Proveedor1_idx` (`Proveedor_idProveedor`),
  ADD KEY `fk_equipos_has_Proveedor_equipos1_idx` (`equipos_idEquipos`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstados`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_facturacion_equipos1_idx` (`idEquipo_Factura`);

--
-- Indices de la tabla `fotos_equipos`
--
ALTER TABLE `fotos_equipos`
  ADD PRIMARY KEY (`idFotos`),
  ADD KEY `idx_fotos_equipo` (`idEquipos_Fotos`);

--
-- Indices de la tabla `garantias`
--
ALTER TABLE `garantias`
  ADD PRIMARY KEY (`idGarantias`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`idPresupuesto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  ADD PRIMARY KEY (`id_Repuesto`),
  ADD KEY `fk_Repuesto_categorias_equipos1_idx` (`categorias_equipos_idCategorias`),
  ADD KEY `fk_Repuesto_usuarios1_idx` (`usuarios_idUsuarios`,`usuarios_idRoles_Usuarios`),
  ADD KEY `fk_Repuesto_Factura1_idx` (`Factura_idFactura`),
  ADD KEY `fk_Repuesto_estados1_idx` (`estados_idEstados`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRoles`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`,`idRoles_Usuarios`),
  ADD KEY `fk_usuarios_roles_idx` (`idRoles_Usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_equipos`
--
ALTER TABLE `categorias_equipos`
  MODIFY `idCategorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idClientes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `idEquipos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstados` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos_equipos`
--
ALTER TABLE `fotos_equipos`
  MODIFY `idFotos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `garantias`
--
ALTER TABLE `garantias`
  MODIFY `idGarantias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `idPresupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  MODIFY `id_Repuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRoles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_equipos_categorias1` FOREIGN KEY (`idCategorias_Equipos`) REFERENCES `categorias_equipos` (`idCategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipos_clientes1` FOREIGN KEY (`idClientes_Equipos`) REFERENCES `clientes` (`idClientes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipos_estados1` FOREIGN KEY (`idEstados_Equipos`) REFERENCES `estados` (`idEstados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipos_garantias1` FOREIGN KEY (`idGarantias_Equipos`) REFERENCES `garantias` (`idGarantias`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `equipos_has_proveedor`
--
ALTER TABLE `equipos_has_proveedor`
  ADD CONSTRAINT `fk_equipos_has_Proveedor_Proveedor1` FOREIGN KEY (`Proveedor_idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipos_has_Proveedor_equipos1` FOREIGN KEY (`equipos_idEquipos`) REFERENCES `equipos` (`idEquipos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_facturacion_equipos1` FOREIGN KEY (`idEquipo_Factura`) REFERENCES `equipos` (`idEquipos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fotos_equipos`
--
ALTER TABLE `fotos_equipos`
  ADD CONSTRAINT `fk_fotos_equipos1` FOREIGN KEY (`idEquipos_Fotos`) REFERENCES `equipos` (`idEquipos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `repuesto`
--
ALTER TABLE `repuesto`
  ADD CONSTRAINT `fk_Repuesto_Factura1` FOREIGN KEY (`Factura_idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Repuesto_categorias_equipos1` FOREIGN KEY (`categorias_equipos_idCategorias`) REFERENCES `categorias_equipos` (`idCategorias`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Repuesto_estados1` FOREIGN KEY (`estados_idEstados`) REFERENCES `estados` (`idEstados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Repuesto_usuarios1` FOREIGN KEY (`usuarios_idUsuarios`,`usuarios_idRoles_Usuarios`) REFERENCES `usuarios` (`idUsuarios`, `idRoles_Usuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`idRoles_Usuarios`) REFERENCES `roles` (`idRoles`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
