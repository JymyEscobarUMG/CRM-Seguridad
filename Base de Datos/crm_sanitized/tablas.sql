-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 25-09-2025 a las 06:26:51
-- Versión del servidor: 8.0.43
-- Versión de PHP: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm`
--
use `crm`;

-- --------------------------------------------------------


CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarLogin` (
    IN `Usuario` VARCHAR(50)
)
NO SQL
SELECT * FROM administradores WHERE nombre_usuario = Usuario AND estado = 'Activo';


CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarLoginEmpleados` (
    IN `_Usuario` CHAR(25)
)
NO SQL
SELECT * FROM logincliente WHERE nombreusuario = _Usuario AND estado = 'Activo';

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int NOT NULL,
  `cod_admin` char(5) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(512) NOT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'Activo',
  `tipo_usuario` char(20) NOT NULL,
  `foto_perfil` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `cod_admin`, `nombre_usuario`, `contrasenia`, `estado`, `tipo_usuario`, `foto_perfil`) VALUES
(1, 'AD001', 'daniel.rivera', '12345', 'Activo', 'Administrador', 'b1.PNG'),
(2, 'AD002', 'tomas.urbina', '123456', 'Activo', 'Administrador', 'perfil3.jpg'),
(3, 'AD003', 'kenia.solanos', '123456', 'Activo', 'Administrador', 'perfil2.jpg'),
(4, 'AD004', 'fernando.pineda', '12345', 'Activo', 'Administrador', '850dc5c6-7051-4b1d-8460-3367a31601b0.jpg'),
(5, 'AD005', 'kevin.lopez', '12345', 'Activo', 'Administrador', '58eb568a-1e91-4668-854c-143bd5691a34.jpg'),
(6, 'AD006', 'cesar.raul', '12345', 'Activo', 'Administrador', 'dc32005b-31aa-495f-b330-64d8b2ea004c.jpg'),
(7, 'AD007', 'bertha.salazar', '123456$$$', 'Activo', 'Administrador', 'foto6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int NOT NULL,
  `cod_ciudad` char(3) NOT NULL,
  `nombre_ciu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `cod_ciudad`, `nombre_ciu`) VALUES
(1, 'AH1', 'Ahuachapán'),
(2, 'CPA', 'Concepción de Ataco'),
(3, 'ER1', 'El Refugio'),
(4, 'SFM', 'San Francisco Menéndez'),
(5, 'CJT', 'Cojutepeque'),
(6, 'SBP', 'San Bartolomé Perulapía'),
(7, 'SRC', 'San Rafael Cedros'),
(8, 'STM', 'Santa Cruz Michapa'),
(9, 'SCC', 'Suchitoto'),
(10, 'LUL', 'La Unión, Lislique'),
(11, 'NES', 'Nueva Esparta'),
(12, 'SRL', 'Santa Rosa de Lima'),
(13, 'SNA', 'San Alejo'),
(14, 'CC1', 'Cuscatancingo'),
(15, 'CDD', 'Ciudad Delgado'),
(16, 'EPI', 'El Paisnal'),
(17, 'ILL', 'Ilopango'),
(18, 'MJ1', 'Mejicanos'),
(19, 'PAN', 'Panchimalco'),
(20, 'SM1', 'San Marcos'),
(21, 'SM2', 'San Martín'),
(22, 'SS1', 'San Salvador'),
(23, 'STX', 'Santiago Texacuangos'),
(24, 'ST2', 'Santo Tomás'),
(25, 'SYP', 'Soyapango'),
(26, 'TNT', 'Tonacatepeque'),
(27, 'ACJ', 'Acajutla'),
(28, 'ARM', 'Armenia'),
(29, 'IZL', 'Izalco'),
(30, 'JUY', 'Juayúa'),
(31, 'SJL', 'San Julián'),
(32, 'SNS', 'Sonsonate'),
(33, 'ILB', 'Ilobasco'),
(34, 'SIS', 'San Isidro, Sensuntepeque'),
(35, 'ANC', 'Antiguo Cuscatlán'),
(36, 'CHL', 'Chiltiupán'),
(37, 'CDA', 'Ciudad Arce'),
(38, 'COL', 'Colón'),
(39, 'HUI', 'Huizúcar'),
(40, 'LLB', 'La Libertad'),
(41, 'NVC', 'Nuevo Cuscatlán'),
(42, 'OPI', 'Opico'),
(43, 'QUE', 'Quezaltepeque'),
(44, 'SAC', 'Sacacoyo'),
(45, 'SJV', 'San José Villanueva'),
(46, 'SMT', 'San Matías'),
(47, 'SPT', 'San Pablo Tacachico'),
(48, 'STT', 'Santa Tecla'),
(49, 'DLC', 'Delicias de Concepción'),
(50, 'EDE', 'El Divisadero, El Rosario'),
(51, 'LOL', 'Lolotiquillo'),
(52, 'OSI', 'Osicala'),
(53, 'PEQ', 'Perquín'),
(54, 'SFG', 'San Francisco Gotera'),
(55, 'TOR', 'Torola'),
(56, 'APA', 'Apastepeque'),
(57, 'GUA', 'Guadalupe'),
(58, 'SCY', 'San Cayetano Istepeque'),
(59, 'SLO', 'San Lorenzo'),
(60, 'SVI', 'San Vicente'),
(61, 'TCO', 'Tecoluca'),
(62, 'USU', 'Usulután'),
(63, 'CLH', 'Chalatenango'),
(64, 'CIT', 'Citalá'),
(65, 'ERO', 'El Rosario'),
(66, 'OLO', 'Olocuilta'),
(67, 'ZAC', 'Zacatecoluca'),
(68, 'SRO', 'San Pedro Nonualco'),
(69, 'NGU', 'Nueva Guadalupe'),
(70, 'SMG', 'San Miguel'),
(71, 'CAF', 'Candelaria de la Frontera'),
(72, 'CTE', 'Coatepeque'),
(73, 'ECG', 'El Congo'),
(74, 'STA', 'Santa Ana'),
(75, 'SFR', 'Santiago de la Frontera'),
(76, 'TEX', 'Texistepeque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL,
  `cod_cliente` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `DUI` char(12) NOT NULL,
  `telefono` char(9) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `EstadoFactura` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `cod_cliente`, `nombre`, `apellido`, `DUI`, `telefono`, `ciudad`, `direccion`, `correo`, `estado`, `EstadoFactura`) VALUES
(1, 1, 'Marcos', 'Lopez', '03322334-6', '2211-4444', 'San Salvador', 'Av La Reforma, Calle Las Amapolas #842 Block D-E1', 'marco@gmail.com', 'I', 'Moroso'),
(2, 2, 'Santiago', 'Bermudez', '02453345-6', '1234-5678', 'San Marcos', 'Av. Principal, Colonia Santa María No 915, San Marcos', 'santiagobr@gmail.com', 'A', 'Solvente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesmarcas`
--

CREATE TABLE `detallesmarcas` (
  `id_marca` int NOT NULL,
  `cod_marca` int NOT NULL,
  `marca` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detallesmarcas`
--

INSERT INTO `detallesmarcas` (`id_marca`, `cod_marca`, `marca`, `tipo`) VALUES
(1, 1, 'Detergentes RINSO', 'Detergentes'),
(2, 2, 'Repuestos Varios Electricos', 'Repuestos Eléctricos'),
(3, 3, 'Suavitel', 'Desinfectante'),
(4, 4, 'Chips Prepago / Postpago', 'Comunicaciones'),
(5, 5, 'Promociones Pizza Hut', 'Todo Consumos'),
(6, 6, 'Productos Construcción Cementos', 'CEMEX Cementos'),
(7, 7, 'Griferías PCO', 'Griferías Repuestos'),
(8, 8, 'Seguros Azul', 'Seguros Daños 3°'),
(9, 9, 'Mensajería Express', 'Postales Mensajerías');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesvendedor`
--

CREATE TABLE `detallesvendedor` (
  `id_empleado` int NOT NULL,
  `cod_empleado` int NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `area` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detallesvendedor`
--

INSERT INTO `detallesvendedor` (`id_empleado`, `cod_empleado`, `tipo`, `nombre`, `area`) VALUES
(1, 1, 'Vendedor Detalles', 'Marcos García', 'Atención al Clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventa`
--

CREATE TABLE `detalleventa` (
  `id_factura` int NOT NULL,
  `cod_factura` int NOT NULL,
  `pago` double NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `licencia` char(10) NOT NULL DEFAULT 'no',
  `tipoSI` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalleventa`
--

INSERT INTO `detalleventa` (`id_factura`, `cod_factura`, `pago`, `modelo`, `licencia`, `tipoSI`) VALUES
(1, 1, 2200, 'Efectivo', 'Si', 'Automatico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int NOT NULL,
  `cod_empl` char(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dui` varchar(12) NOT NULL,
  `telefono` char(9) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `cod_empl`, `nombre`, `apellido`, `dui`, `telefono`, `direccion`) VALUES
(14, 'ER1', 'Estefany Ana', 'Aguilar Serrano', '004345632-3', '2211-4464', 'Av las amapolas, Calle satélite No 45, San Salvador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int NOT NULL,
  `cod_empresa` char(3) NOT NULL,
  `cod_sucursales` char(3) NOT NULL,
  `marcas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `cod_empresa`, `cod_sucursales`, `marcas`) VALUES
(1, 'GGV', 'GDA', 'Galvanissa Suministros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id_linea` int NOT NULL,
  `cod_linea` int NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`id_linea`, `cod_linea`, `tipo`) VALUES
(1, 1, 'Línea de Enseres Hogar'),
(2, 2, 'Repuestos Eléctricos'),
(3, 3, 'Productos de Limpiezas'),
(4, 4, 'Telecomunicaciones'),
(5, 5, 'Comidas Rápidas Delivery'),
(6, 6, 'Construcciones'),
(7, 7, 'Servicios de Fontanería'),
(8, 8, 'Banca y Seguros'),
(9, 9, 'Administrativos y Secretariados'),
(10, 10, 'Atención al Cliente (Todos)'),
(11, 11, 'Hostelería y Turismo'),
(12, 12, 'Marketing y Ventas'),
(13, 13, 'RR.HH'),
(14, 14, 'Soporte Técnico'),
(15, 15, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logincliente`
--

CREATE TABLE `logincliente` (
  `id_cliente` int NOT NULL,
  `cod_cliente` int NOT NULL,
  `nombreusuario` char(25) NOT NULL,
  `contrasenia` char(255) NOT NULL,
  `estado` char(15) NOT NULL,
  `tipo_usuario` char(25) NOT NULL,
  `foto_perfil` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logincliente`
--

INSERT INTO `logincliente` (`id_cliente`, `cod_cliente`, `nombreusuario`, `contrasenia`, `estado`, `tipo_usuario`, `foto_perfil`) VALUES
(1, 1, 'lorena.martinez', '12345', 'Activo', 'Usuario', '4349bb49-d45d-477c-a94b-82a925f45887.jpg'),
(2, 2, 'kenia.solano', 'Lorem123$', 'Activo', 'Usuario', '82b049da-293f-4092-aec5-a483a5754c0b.jpg'),
(3, 3, 'laura.rosales', 'Lauras123$$$', 'Activo', 'Usuario', '2e67f1ef-b99a-492e-8176-e939881a607c.jpg'),
(4, 4, 'joaquin.bonifacio', 'Joaquin123$1$', 'Activo', 'Usuario', '6bacd1e8-b621-4d14-96e4-4147a90a8b00.jpg'),
(5, 5, 'santiago.ramirez', '1234567890$$$', 'Inactivo', 'Usuario', '9a1fc9d7-6540-4659-8db3-de176aaf50b1.jpg'),
(6, 6, 'carolina.guzman', 'Caro$$$$Lorem12', 'Activo', 'Usuario', '86acb344-e8fb-48cc-8e55-7bf898659c6b.jpg'),
(7, 7, 'omar.torres', '11111234$%$%', 'Activo', 'Usuario', '33704ccf-879c-4e8f-8044-c70fc5efd16d.jpg'),
(8, 8, 'mariana.paz', 'marianas!\"#$%&/', 'Activo', 'Usuario', '490127cb-b46e-4dbb-90a9-486bfcf67211.jpg'),
(9, 9, 'jazmin.serrano', 'lorem12#$%&/(/&', 'Activo', 'Usuario', 'b2fe4218-1776-4a2e-b487-1712b07ff5e8.jpg'),
(10, 10, 'carlos.cruz', ';::[DERSFE#TGB%', 'Activo', 'Usuario', 'b116a294-47bc-4014-b959-75a0b186fc24.jpg'),
(11, 11, 'javier.argueta', '!\"WE$#WR$#$%R$$', 'Activo', 'Usuario', 'c4b79675-679d-4ef8-ac91-6a22f10064e5.jpg'),
(12, 12, 'jeremias.torres', 'lknslkndskds$##', 'Activo', 'Usuario', 'c7db4386-3f50-4663-90e9-cf22c199cae3.jpg'),
(13, 13, 'mardoqueo.diaz', 'lfjolsd#\"#\"#\"#\"', 'Activo', 'Usuario', 'c2874f24-9e37-45c1-9f0b-1e6d12d3fcf5.jpg'),
(14, 14, 'miriam.sanchez', '3223ds#DWST$$SD', 'Activo', 'Usuario', 'f0d251cd-5c3b-4532-a410-529cc72b5c7a.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int NOT NULL,
  `cod_producto` char(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `Cantidad` int NOT NULL,
  `marca` varchar(20) NOT NULL,
  `garantia` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_producto`, `nombre`, `tipo`, `Cantidad`, `marca`, `garantia`) VALUES
(1, 'DET', 'Detergentes RINSO', 'Detergentes', 12400, 'RINSO', 'I'),
(2, 'ELJ', 'Repuestos Varios Electricos', 'Varios', 67000, 'Electronica Japonesa', 'A'),
(3, 'SVT', 'Suavitel', 'Desinfectante', 2100, 'Suavitel', 'I'),
(4, 'CTE', 'Chips PS/PRE', 'Comunicaciones', 1560000, 'CLARO', 'A'),
(5, 'PZH', 'Promociones HUT', 'Pizza Hut', 4560000, 'HUT', 'I'),
(6, 'CMX', 'CEMEX', 'Cementos', 8904, 'CEMEX', 'I'),
(7, 'GRF', 'Griferias PCO', 'Repuestos GRF', 1200, 'PCO', 'I'),
(8, 'SDT', 'Seguro Daños a Terceros', 'Seguros', 500, 'Azul', 'A'),
(9, 'SVM', 'Mensajerias Express', 'Mensajeros', 7500, 'Postales de Mensajes', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteplataforma`
--

CREATE TABLE `reporteplataforma` (
  `Id_reporte` char(100) NOT NULL,
  `Id_cliente` int NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `usuario_gestion` varchar(50) DEFAULT NULL,
  `DetallesReporte` varchar(1000) NOT NULL,
  `Urgencia` varchar(50) NOT NULL DEFAULT 'Estandar',
  `EstadoReporte` varchar(50) NOT NULL DEFAULT 'pediente',
  `Comentarios_Finales` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reporteplataforma`
--

INSERT INTO `reporteplataforma` (`Id_reporte`, `Id_cliente`, `nombre_usuario`, `usuario_gestion`, `DetallesReporte`, `Urgencia`, `EstadoReporte`, `Comentarios_Finales`) VALUES
('Fallo foto de perfil', 1, 'daniel.rivera', NULL, 'Al momento de modificar foto de perfil, no se actualiza en el momento solo cerrando sesión e ingresando nuevamente al sistema', 'Estandar', 'cerrado', 'Problema solventado por administrador daniel.rivera, ESTADO CERRADO. '),
('Problemas Menú de Navegación', 1, 'tomas.urbina', 'daniel.rivera', 'El menú de navegación oculta todos los elementos de visualización, afecta muchísimo el tiempo / repuesta de los clientes que nos realizan solicitudes de casos, ya que algunos elementos se ocultan casi en su totalidad.', 'Media', 'cerrado', 'Administrador daniel.rivera procederá a verificar reporte ingresado por el usuario previamente...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportesclientes`
--

CREATE TABLE `reportesclientes` (
  `Id_reporte` int NOT NULL,
  `Id_cliente` varchar(20) NOT NULL,
  `Nombre_cliente` varchar(100) NOT NULL,
  `nombre_empleado_registro` varchar(50) NOT NULL,
  `nombre_empleado_gestionando` varchar(50) DEFAULT NULL,
  `Producto` varchar(100) NOT NULL,
  `Marca` varchar(100) NOT NULL,
  `Fecha_Registro_Caso` date NOT NULL,
  `Ultima_Actualizacion_Caso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Detalle_de_problema` varchar(1000) NOT NULL,
  `Urgencia` char(100) NOT NULL DEFAULT 'Estandar',
  `Estado_de_reporte` varchar(50) NOT NULL DEFAULT 'pendiente',
  `Comentarios_EmpleadoGestionando` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reportesclientes`
--

INSERT INTO `reportesclientes` (`Id_reporte`, `Id_cliente`, `Nombre_cliente`, `nombre_empleado_registro`, `nombre_empleado_gestionando`, `Producto`, `Marca`, `Fecha_Registro_Caso`, `Ultima_Actualizacion_Caso`, `Detalle_de_problema`, `Urgencia`, `Estado_de_reporte`, `Comentarios_EmpleadoGestionando`) VALUES
(1, 'AES001', 'Antonio Marroquín', 'daniel.rivera', 'lorena.martinez', 'AES Servicios', 'Factura electrónica errónea', '2020-06-02', '2020-06-03 23:59:51', 'Cliente notifica que el NPE presentado en dicha factura correspondía a otra factura de otro cliente, por lo cual su cancelación no se hizo efectiva en su cuenta de titular. Su número de servicio es 2355449. Contácto 2233-2222', 'Alta', 'en proceso', 'Procediendo a verificar reporte ingresado previamente, kenia.solano en este momento empezará a gestionar este caso'),
(2, 'TLC01', 'Juan López', 'daniel.rivera', 'daniel.rivera', 'Línea Teléfonica Móvil TELCEL', 'Servicios PostPago TELCEL', '2020-06-02', '2020-06-03 05:15:33', 'El cliente ha informado que su plan de datos según contrato TELCEL de 30GB mensuales, no llega ni siquiera a la mitad de lo adquirido. Su plan es mucho menor al contratado. Su contácto es 2233-4455', 'Media', 'cerrado', 'Caso de cliente cerrado, la solicitud se ha transferido al departamento financiero donde han procedido a realizar el desembolso a la cuenta mencionada, por lo cual ya no presenta problemas por impago. Cliente notificado y resolución exitosa.'),
(3, 'CTE001', 'Juan Guzman', 'lorena.martinez', NULL, 'Servicio Residencial Claro Hogar', 'Claro Hogar Triple', '2020-06-04', '2020-06-05 00:43:28', 'Transcripción del cliente: Tengo 6 días de estar sin Internet, ayer hago cola desde las 3 de la tarde para que luego salieran a decir que ya no me van a atender, ahora no me pueden atender por la terminación del número de DUI, pero la factura llega igual, solucionen los problemas.', 'Media', 'pendiente', NULL),
(4, 'CTE002', 'Douglas Mendez', 'lorena.martinez', NULL, 'Problema telefonía móvil', 'Planes Postpago Claro', '2020-06-04', '2020-06-05 00:44:52', 'Transcripción del cliente: Señores. De Claro El Salvador durante todo estos meses anteriores an estado cobrando intereses en mi caso por unos días de retraso y cuando unos les llama solo dicen que son directamente solo a las. Personas afectadas por la cuarentena y ustedes como saben quien no y quien si esta afectado ustedes están haciendo cobros por mora a todo mundo cuando por la cuarentena hasta el trabajo nos han suspendido', 'Estandar', 'pendiente', NULL),
(5, 'PBEN01', 'Yami Deras', 'lorena.martinez', NULL, 'Problemas registro banca el línea (Banco Agrícola)', 'Banca En Línea', '2020-06-04', '2020-06-05 00:48:23', 'Transcripción del cliente: Necesito registrarme en Banca en Línea pero no he podido. Creo que es por el número de teléfono que tenía el cuál lo cambié recientemente. Y al entrar a ese link me piden datos que no puedo completar y no puedo registrarme tampoco.', 'Media', 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int NOT NULL,
  `cod_sucursal` int NOT NULL,
  `nombre_suc` varchar(50) NOT NULL,
  `telefono` char(9) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id_sucursal`, `cod_sucursal`, `nombre_suc`, `telefono`, `direccion`, `correo`) VALUES
(14, 2, 'Electrónica Japonesa', '2121-6644', '20 Ave Norte, No 445 Cuscatancingo', 'contactanos@electronicajaponesa.com'),
(18, 3, 'Galvanissa', '2566-7722', 'Prolongación Boulevard Constitución, No 456', 'contactogalvanissa@galvanissa.com'),
(22, 1, 'Ferreterías FREUND', '2233-0199', 'Av. La revolución, Block E Calle Concepción No 122', 'ferreteriaconcepcion@freund.com');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_casos_pendientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_casos_pendientes` (
`Id_reporte` int
,`Id_cliente` varchar(20)
,`Nombre_cliente` varchar(100)
,`nombre_empleado_registro` varchar(50)
,`nombre_empleado_gestionando` varchar(50)
,`Producto` varchar(100)
,`Marca` varchar(100)
,`Fecha_Registro_Caso` date
,`Ultima_Actualizacion_Caso` timestamp
,`Detalle_de_problema` varchar(1000)
,`Urgencia` char(100)
,`Estado_de_reporte` varchar(50)
,`Comentarios_EmpleadoGestionando` varchar(1000)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_casos_procesando`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_casos_procesando` (
`Id_reporte` int
,`Id_cliente` varchar(20)
,`Nombre_cliente` varchar(100)
,`nombre_empleado_registro` varchar(50)
,`nombre_empleado_gestionando` varchar(50)
,`Producto` varchar(100)
,`Marca` varchar(100)
,`Fecha_Registro_Caso` date
,`Ultima_Actualizacion_Caso` timestamp
,`Detalle_de_problema` varchar(1000)
,`Urgencia` char(100)
,`Estado_de_reporte` varchar(50)
,`Comentarios_EmpleadoGestionando` varchar(1000)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_ciudades`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_ciudades` (
`id_ciudad` int
,`cod_ciudad` char(3)
,`nombre_ciu` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_clientes` (
`id_cliente` int
,`cod_cliente` int
,`nombre` varchar(50)
,`apellido` varchar(50)
,`DUI` char(12)
,`telefono` char(9)
,`ciudad` varchar(100)
,`direccion` varchar(100)
,`correo` varchar(100)
,`estado` char(1)
,`EstadoFactura` char(15)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_detallesventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_detallesventas` (
`id_factura` int
,`cod_factura` int
,`pago` double
,`modelo` varchar(50)
,`licencia` char(10)
,`tipoSI` varchar(25)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_detalle_marcas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_detalle_marcas` (
`id_marca` int
,`cod_marca` int
,`marca` varchar(50)
,`tipo` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_empleados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_empleados` (
`id_empleado` int
,`cod_empl` char(3)
,`nombre` varchar(50)
,`apellido` varchar(50)
,`dui` varchar(12)
,`telefono` char(9)
,`direccion` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_empresas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_empresas` (
`id_empresa` int
,`cod_empresa` char(3)
,`cod_sucursales` char(3)
,`marcas` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_lineas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_lineas` (
`id_linea` int
,`cod_linea` int
,`tipo` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_productos` (
`id_producto` int
,`cod_producto` char(3)
,`nombre` varchar(50)
,`tipo` varchar(15)
,`Cantidad` int
,`marca` varchar(20)
,`garantia` char(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_reportes_clientes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_reportes_clientes` (
`Id_reporte` int
,`Id_cliente` varchar(20)
,`Nombre_cliente` varchar(100)
,`nombre_empleado_registro` varchar(50)
,`nombre_empleado_gestionando` varchar(50)
,`Producto` varchar(100)
,`Marca` varchar(100)
,`Fecha_Registro_Caso` date
,`Ultima_Actualizacion_Caso` timestamp
,`Detalle_de_problema` varchar(1000)
,`Urgencia` char(100)
,`Estado_de_reporte` varchar(50)
,`Comentarios_EmpleadoGestionando` varchar(1000)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_reportes_plataforma`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_reportes_plataforma` (
`Id_reporte` char(100)
,`Id_cliente` int
,`nombre_usuario` varchar(50)
,`usuario_gestion` varchar(50)
,`DetallesReporte` varchar(1000)
,`Urgencia` varchar(50)
,`EstadoReporte` varchar(50)
,`Comentarios_Finales` varchar(1000)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_sesionesadmin`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_sesionesadmin` (
`nombre_usuario` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_sucursales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_sucursales` (
`id_sucursal` int
,`cod_sucursal` int
,`nombre_suc` varchar(50)
,`telefono` char(9)
,`direccion` varchar(50)
,`correo` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuariosgenerales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuariosgenerales` (
`id_cliente` int
,`cod_cliente` int
,`nombreusuario` char(25)
,`contrasenia` char(255)
,`estado` char(15)
,`tipo_usuario` char(25)
,`foto_perfil` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios_administradores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios_administradores` (
`id_admin` int
,`cod_admin` char(5)
,`nombre_usuario` varchar(50)
,`contrasenia` varchar(512)
,`estado` varchar(15)
,`tipo_usuario` char(20)
,`foto_perfil` varchar(150)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_vendedores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_vendedores` (
`id_empleado` int
,`cod_empleado` int
,`tipo` varchar(20)
,`nombre` varchar(20)
,`area` varchar(20)
);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `cod_admin` (`cod_admin`,`nombre_usuario`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`),
  ADD UNIQUE KEY `cod_ciudad` (`cod_ciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `DUI` (`DUI`);

--
-- Indices de la tabla `detallesmarcas`
--
ALTER TABLE `detallesmarcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `detallesvendedor`
--
ALTER TABLE `detallesvendedor`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `dui` (`dui`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD UNIQUE KEY `cod_empresa` (`cod_empresa`),
  ADD UNIQUE KEY `cod_sucursales` (`cod_sucursales`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id_linea`);

--
-- Indices de la tabla `logincliente`
--
ALTER TABLE `logincliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nombreusuario` (`nombreusuario`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `reporteplataforma`
--
ALTER TABLE `reporteplataforma`
  ADD PRIMARY KEY (`Id_reporte`);

--
-- Indices de la tabla `reportesclientes`
--
ALTER TABLE `reportesclientes`
  ADD PRIMARY KEY (`Id_reporte`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`),
  ADD UNIQUE KEY `cod_sucursal` (`cod_sucursal`);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_casos_pendientes`
--
DROP TABLE IF EXISTS `vista_casos_pendientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_casos_pendientes`  AS SELECT `reportesclientes`.`Id_reporte` AS `Id_reporte`, `reportesclientes`.`Id_cliente` AS `Id_cliente`, `reportesclientes`.`Nombre_cliente` AS `Nombre_cliente`, `reportesclientes`.`nombre_empleado_registro` AS `nombre_empleado_registro`, `reportesclientes`.`nombre_empleado_gestionando` AS `nombre_empleado_gestionando`, `reportesclientes`.`Producto` AS `Producto`, `reportesclientes`.`Marca` AS `Marca`, `reportesclientes`.`Fecha_Registro_Caso` AS `Fecha_Registro_Caso`, `reportesclientes`.`Ultima_Actualizacion_Caso` AS `Ultima_Actualizacion_Caso`, `reportesclientes`.`Detalle_de_problema` AS `Detalle_de_problema`, `reportesclientes`.`Urgencia` AS `Urgencia`, `reportesclientes`.`Estado_de_reporte` AS `Estado_de_reporte`, `reportesclientes`.`Comentarios_EmpleadoGestionando` AS `Comentarios_EmpleadoGestionando` FROM `reportesclientes` WHERE (`reportesclientes`.`Estado_de_reporte` = 'pendiente') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_casos_procesando`
--
DROP TABLE IF EXISTS `vista_casos_procesando`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_casos_procesando`  AS SELECT `reportesclientes`.`Id_reporte` AS `Id_reporte`, `reportesclientes`.`Id_cliente` AS `Id_cliente`, `reportesclientes`.`Nombre_cliente` AS `Nombre_cliente`, `reportesclientes`.`nombre_empleado_registro` AS `nombre_empleado_registro`, `reportesclientes`.`nombre_empleado_gestionando` AS `nombre_empleado_gestionando`, `reportesclientes`.`Producto` AS `Producto`, `reportesclientes`.`Marca` AS `Marca`, `reportesclientes`.`Fecha_Registro_Caso` AS `Fecha_Registro_Caso`, `reportesclientes`.`Ultima_Actualizacion_Caso` AS `Ultima_Actualizacion_Caso`, `reportesclientes`.`Detalle_de_problema` AS `Detalle_de_problema`, `reportesclientes`.`Urgencia` AS `Urgencia`, `reportesclientes`.`Estado_de_reporte` AS `Estado_de_reporte`, `reportesclientes`.`Comentarios_EmpleadoGestionando` AS `Comentarios_EmpleadoGestionando` FROM `reportesclientes` WHERE (`reportesclientes`.`Estado_de_reporte` = 'en proceso') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_ciudades`
--
DROP TABLE IF EXISTS `vista_ciudades`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_ciudades`  AS SELECT `ciudades`.`id_ciudad` AS `id_ciudad`, `ciudades`.`cod_ciudad` AS `cod_ciudad`, `ciudades`.`nombre_ciu` AS `nombre_ciu` FROM `ciudades` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_clientes`
--
DROP TABLE IF EXISTS `vista_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_clientes`  AS SELECT `clientes`.`id_cliente` AS `id_cliente`, `clientes`.`cod_cliente` AS `cod_cliente`, `clientes`.`nombre` AS `nombre`, `clientes`.`apellido` AS `apellido`, `clientes`.`DUI` AS `DUI`, `clientes`.`telefono` AS `telefono`, `clientes`.`ciudad` AS `ciudad`, `clientes`.`direccion` AS `direccion`, `clientes`.`correo` AS `correo`, `clientes`.`estado` AS `estado`, `clientes`.`EstadoFactura` AS `EstadoFactura` FROM `clientes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_detallesventas`
--
DROP TABLE IF EXISTS `vista_detallesventas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_detallesventas`  AS SELECT `detalleventa`.`id_factura` AS `id_factura`, `detalleventa`.`cod_factura` AS `cod_factura`, `detalleventa`.`pago` AS `pago`, `detalleventa`.`modelo` AS `modelo`, `detalleventa`.`licencia` AS `licencia`, `detalleventa`.`tipoSI` AS `tipoSI` FROM `detalleventa` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_detalle_marcas`
--
DROP TABLE IF EXISTS `vista_detalle_marcas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_detalle_marcas`  AS SELECT `detallesmarcas`.`id_marca` AS `id_marca`, `detallesmarcas`.`cod_marca` AS `cod_marca`, `detallesmarcas`.`marca` AS `marca`, `detallesmarcas`.`tipo` AS `tipo` FROM `detallesmarcas` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_empleados`
--
DROP TABLE IF EXISTS `vista_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_empleados`  AS SELECT `empleado`.`id_empleado` AS `id_empleado`, `empleado`.`cod_empl` AS `cod_empl`, `empleado`.`nombre` AS `nombre`, `empleado`.`apellido` AS `apellido`, `empleado`.`dui` AS `dui`, `empleado`.`telefono` AS `telefono`, `empleado`.`direccion` AS `direccion` FROM `empleado` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_empresas`
--
DROP TABLE IF EXISTS `vista_empresas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_empresas`  AS SELECT `empresa`.`id_empresa` AS `id_empresa`, `empresa`.`cod_empresa` AS `cod_empresa`, `empresa`.`cod_sucursales` AS `cod_sucursales`, `empresa`.`marcas` AS `marcas` FROM `empresa` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_lineas`
--
DROP TABLE IF EXISTS `vista_lineas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_lineas`  AS SELECT `lineas`.`id_linea` AS `id_linea`, `lineas`.`cod_linea` AS `cod_linea`, `lineas`.`tipo` AS `tipo` FROM `lineas` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_productos`
--
DROP TABLE IF EXISTS `vista_productos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_productos`  AS SELECT `producto`.`id_producto` AS `id_producto`, `producto`.`cod_producto` AS `cod_producto`, `producto`.`nombre` AS `nombre`, `producto`.`tipo` AS `tipo`, `producto`.`Cantidad` AS `Cantidad`, `producto`.`marca` AS `marca`, `producto`.`garantia` AS `garantia` FROM `producto` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_reportes_clientes`
--
DROP TABLE IF EXISTS `vista_reportes_clientes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_reportes_clientes`  AS SELECT `reportesclientes`.`Id_reporte` AS `Id_reporte`, `reportesclientes`.`Id_cliente` AS `Id_cliente`, `reportesclientes`.`Nombre_cliente` AS `Nombre_cliente`, `reportesclientes`.`nombre_empleado_registro` AS `nombre_empleado_registro`, `reportesclientes`.`nombre_empleado_gestionando` AS `nombre_empleado_gestionando`, `reportesclientes`.`Producto` AS `Producto`, `reportesclientes`.`Marca` AS `Marca`, `reportesclientes`.`Fecha_Registro_Caso` AS `Fecha_Registro_Caso`, `reportesclientes`.`Ultima_Actualizacion_Caso` AS `Ultima_Actualizacion_Caso`, `reportesclientes`.`Detalle_de_problema` AS `Detalle_de_problema`, `reportesclientes`.`Urgencia` AS `Urgencia`, `reportesclientes`.`Estado_de_reporte` AS `Estado_de_reporte`, `reportesclientes`.`Comentarios_EmpleadoGestionando` AS `Comentarios_EmpleadoGestionando` FROM `reportesclientes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_reportes_plataforma`
--
DROP TABLE IF EXISTS `vista_reportes_plataforma`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_reportes_plataforma`  AS SELECT `reporteplataforma`.`Id_reporte` AS `Id_reporte`, `reporteplataforma`.`Id_cliente` AS `Id_cliente`, `reporteplataforma`.`nombre_usuario` AS `nombre_usuario`, `reporteplataforma`.`usuario_gestion` AS `usuario_gestion`, `reporteplataforma`.`DetallesReporte` AS `DetallesReporte`, `reporteplataforma`.`Urgencia` AS `Urgencia`, `reporteplataforma`.`EstadoReporte` AS `EstadoReporte`, `reporteplataforma`.`Comentarios_Finales` AS `Comentarios_Finales` FROM `reporteplataforma` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_sesionesadmin`
--
DROP TABLE IF EXISTS `vista_sesionesadmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_sesionesadmin`  AS SELECT `administradores`.`nombre_usuario` AS `nombre_usuario` FROM `administradores` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_sucursales`
--
DROP TABLE IF EXISTS `vista_sucursales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_sucursales`  AS SELECT `sucursales`.`id_sucursal` AS `id_sucursal`, `sucursales`.`cod_sucursal` AS `cod_sucursal`, `sucursales`.`nombre_suc` AS `nombre_suc`, `sucursales`.`telefono` AS `telefono`, `sucursales`.`direccion` AS `direccion`, `sucursales`.`correo` AS `correo` FROM `sucursales` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuariosgenerales`
--
DROP TABLE IF EXISTS `vista_usuariosgenerales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuariosgenerales`  AS SELECT `logincliente`.`id_cliente` AS `id_cliente`, `logincliente`.`cod_cliente` AS `cod_cliente`, `logincliente`.`nombreusuario` AS `nombreusuario`, `logincliente`.`contrasenia` AS `contrasenia`, `logincliente`.`estado` AS `estado`, `logincliente`.`tipo_usuario` AS `tipo_usuario`, `logincliente`.`foto_perfil` AS `foto_perfil` FROM `logincliente` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios_administradores`
--
DROP TABLE IF EXISTS `vista_usuarios_administradores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios_administradores`  AS SELECT `administradores`.`id_admin` AS `id_admin`, `administradores`.`cod_admin` AS `cod_admin`, `administradores`.`nombre_usuario` AS `nombre_usuario`, `administradores`.`contrasenia` AS `contrasenia`, `administradores`.`estado` AS `estado`, `administradores`.`tipo_usuario` AS `tipo_usuario`, `administradores`.`foto_perfil` AS `foto_perfil` FROM `administradores` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_vendedores`
--
DROP TABLE IF EXISTS `vista_vendedores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_vendedores`  AS SELECT `detallesvendedor`.`id_empleado` AS `id_empleado`, `detallesvendedor`.`cod_empleado` AS `cod_empleado`, `detallesvendedor`.`tipo` AS `tipo`, `detallesvendedor`.`nombre` AS `nombre`, `detallesvendedor`.`area` AS `area` FROM `detallesvendedor` ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `logincliente` (`id_cliente`);

--
-- Filtros para la tabla `detallesmarcas`
--
ALTER TABLE `detallesmarcas`
  ADD CONSTRAINT `detallesmarcas_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `detallesvendedor`
--
ALTER TABLE `detallesvendedor`
  ADD CONSTRAINT `detallesvendedor_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `detalleventa` (`id_factura`);

--
-- Filtros para la tabla `detalleventa`
--
ALTER TABLE `detalleventa`
  ADD CONSTRAINT `detalleventa_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `sucursales` (`id_sucursal`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `ciudades` (`id_ciudad`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `lineas` (`id_linea`);

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `ciudades` (`id_ciudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
