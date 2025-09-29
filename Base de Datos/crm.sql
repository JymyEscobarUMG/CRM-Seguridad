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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaAdministradoresEspecifica` (IN `_id_admin` INT)  NO SQL SELECT * FROM vista_usuarios_administradores WHERE id_admin=_id_admin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaCiudadesEspecifica` (IN `_id_ciudad` INT)  NO SQL SELECT * FROM vista_ciudades WHERE id_ciudad = _id_ciudad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaClientesEspecifica` (IN `_id_cliente` INT)  NO SQL SELECT * FROM vista_clientes WHERE id_cliente = _id_cliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEmpleadosEspecifica` (IN `_id_cliente` INT)  NO SQL SELECT * FROM vista_usuariosgenerales WHERE id_cliente = _id_cliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaCasosClientes` (IN `_Id_reporte` INT)  NO SQL SELECT * FROM vista_reportes_clientes WHERE Id_reporte = _Id_reporte$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaEmpleados` (IN `_id_empleado` INT)  NO SQL SELECT * FROM vista_empleados WHERE id_empleado = _id_empleado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaEmpresas` (IN `_id_empresa` INT)  NO SQL SELECT * from vista_empresas WHERE id_empresa = _id_empresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaFacturaciones` (IN `_id_factura` INT)  NO SQL SELECT * FROM vista_detallesventas WHERE id_factura = _id_factura$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaLineas` (IN `_id_linea` INT)  NO SQL SELECT * FROM vista_lineas WHERE id_linea = _id_linea$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaEspecificaReportesPlataforma` (IN `_Id_reporte` CHAR(100))  NO SQL SELECT * FROM vista_reportes_plataforma WHERE Id_reporte = _Id_reporte$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaMarcasEspecifica` (IN `_id_marca` INT)  NO SQL SELECT * FROM vista_detalle_marcas WHERE id_marca = _id_marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaProductosEspecifica` (IN `_id_producto` INT)  NO SQL SELECT * FROM vista_productos WHERE id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarCiudadesRegistradas` ()  NO SQL SELECT * FROM vista_ciudades ORDER BY id_ciudad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarClientes` ()  NO SQL SELECT * FROM vista_clientes ORDER BY id_cliente$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarDetallesDeMarcas` ()  NO SQL SELECT * FROM vista_detalle_marcas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarDetallesVentas` ()  NO SQL SELECT * FROM vista_detallesventas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarEmpleados` ()  NO SQL SELECT * FROM vista_empleados$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarEmpresas` ()  NO SQL SELECT * FROM vista_empresas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarLineasRegistradas` ()  NO SQL SELECT * FROM vista_lineas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarProductosRegistrados` ()  NO SQL SELECT * FROM vista_productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarReportesPlataforma` ()  NO SQL SELECT * FROM vista_reportes_plataforma$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarReportesReclamosClientes` ()  NO SQL SELECT * FROM vista_reportes_clientes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarSucursales` ()  NO SQL SELECT * FROM vista_sucursales$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuariosGenerales` ()  NO SQL BEGIN 
	SELECT * FROM vista_usuariosgenerales ORDER BY id_cliente ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarVendedoresDetalles` ()  NO SQL SELECT * FROM vista_vendedores$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaSucursalesEspecifica` (IN `_id_sucursal` INT)  NO SQL SELECT * FROM vista_sucursales WHERE id_sucursal = _id_sucursal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaUsuariosAdministradores` ()  NO SQL BEGIN 
	SELECT * FROM vista_usuarios_administradores ORDER BY id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultaVendedoresEspecifica` (IN `_id_empleado` INT)  NO SQL SELECT * FROM vista_vendedores WHERE id_empleado = _id_empleado$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ContadorAdministradores` ()  NO SQL SELECT COUNT(id_admin) from administradores$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConteoCasosActivosEmpleados` ()  NO SQL SELECT * FROM vista_casos_procesando$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConteoCasosPendientesEmpleados` ()  NO SQL SELECT * FROM vista_casos_pendientes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConteoClientesRegistrados` ()  NO SQL SELECT * FROM vista_clientes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConteoProductosRegistrados` ()  NO SQL SELECT * FROM vista_productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ControlSesionesUsuariosAdmin` ()  NO SQL SELECT * FROM vista_sesionesadmin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarCiudades` (IN `_id_ciudad` INT)   BEGIN
    DELETE FROM ciudades WHERE id_ciudad=_id_ciudad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarClientes` (`_id_cliente` INT)   BEGIN
    DELETE FROM clientes WHERE id_cliente=_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarDetalleMarca` (IN `_id_marca` INT)   BEGIN
  DELETE FROM detallesmarcas WHERE id_marca=_id_marca;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarDetalleVendedor` (IN `_id_empleado` INT)   BEGIN
   DELETE FROM detallesvendedor WHERE id_empleado=_id_empleado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarDetalleVenta` (IN `_id_factura` INT)   BEGIN
  DELETE FROM detalleventa WHERE id_factura=_id_factura;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarEmpleados` (IN `_id_empleado` INT)   BEGIN
    DELETE FROM empleado WHERE id_empleado=_id_empleado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarEmpresas` (IN `_id_empresa` INT)   BEGIN
   DELETE FROM empresa WHERE id_empresa=_id_empresa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarLineas` (IN `_id_linea` INT)   BEGIN
   DELETE FROM lineas WHERE id_linea= _id_linea;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarProductosSistema` (IN `_id_producto` INT)   BEGIN
    DELETE FROM producto WHERE id_producto=_id_producto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarReportesDeClientes` (IN `_Id_reporte` INT(100))   BEGIN
	DELETE FROM reportesclientes WHERE Id_reporte=_Id_reporte;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarReportesDePlataforma` (IN `_Id_reporte` CHAR(100))   BEGIN
	DELETE FROM reporteplataforma WHERE Id_reporte=_Id_reporte;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarSucursalesSistema` (IN `_id_sucursal` INT)   BEGIN
     DELETE FROM sucursales WHERE id_sucursal=_id_sucursal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuariosAdministradores` (`_id_admin` INT)   BEGIN
   DELETE FROM administradores WHERE id_admin=_id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarUsuariosGenerales` (IN `_id_cliente` INT)   BEGIN
    DELETE FROM logincliente WHERE id_cliente=_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarAdministradores` (`_id_admin` INT, `_cod_admin` CHAR(5), `_nombreusuario` VARCHAR(50), `_contrasenia` VARCHAR(15), `_estado` VARCHAR(15), `_tipo_usuario` CHAR(20), `_foto_perfil` VARCHAR(100))   BEGIN
	INSERT INTO administradores (id_admin,cod_admin,nombre_usuario,contrasenia,estado,tipo_usuario,foto_perfil) VALUES (_id_admin,_cod_admin,_nombreusuario,_contrasenia,_estado,_tipo_usuario,_foto_perfil);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarClientes` (`_id_cliente` INT, `_cod_cliente` INT, `_nombre` VARCHAR(50), `_apellido` VARCHAR(50), `_DUI` CHAR(12), `_telefono` CHAR(9), `_ciudad` VARCHAR(100), `_direccion` VARCHAR(100), `_correo` VARCHAR(100), `_estado` CHAR(1), `_EstadoFactura` CHAR(15))   BEGIN
INSERT INTO clientes (id_cliente,cod_cliente,nombre,apellido,DUI,telefono,ciudad,direccion,correo,estado,EstadoFactura) VALUES (_id_cliente,_cod_cliente,_nombre,_apellido,_DUI,_telefono,_ciudad,_direccion,_correo,_estado,_EstadoFactura);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarDetallesVendedoresNuevos` (`_id_empleado` INT, `_cod_empleado` INT, `_tipo` VARCHAR(20), `_nombre` VARCHAR(20), `_area` VARCHAR(20))   BEGIN
		INSERT INTO detallesvendedor (id_empleado,cod_empleado,tipo,nombre,area) VALUES (_id_empleado,_cod_empleado,_tipo,_nombre,_area);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarNuevasCiudades` (`_id_ciudad` INT, `_cod_ciudad` CHAR(3), `_nombre_ciu` VARCHAR(50))   BEGIN
	INSERT INTO ciudades (id_ciudad, cod_ciudad, nombre_ciu) VALUES (_id_ciudad, _cod_ciudad, _nombre_ciu);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarNuevasEmpresas` (`_id_empresa` INT, `_cod_empresa` CHAR(3), `_cod_sucursales` CHAR(3), `_marcas` VARCHAR(50))   BEGIN
	INSERT INTO empresa (id_empresa , cod_empresa, cod_sucursales, marcas) VALUES (_id_empresa , _cod_empresa, _cod_sucursales, _marcas);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarNuevasFacturas` (`_id_factura` INT, `_cod_factura` INT, `_pago` DOUBLE, `_modelo` VARCHAR(50), `_licencia` CHAR(10), `_tipoSI` VARCHAR(25))   BEGIN
	INSERT INTO detalleventa (id_factura,cod_factura,pago,modelo,licencia,tipoSI) VALUES (_id_factura,_cod_factura,_pago,_modelo,_licencia,_tipoSI);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarNuevosDetallesMarcas` (`_id_marca` INT, `_cod_marca` INT, `_marca` VARCHAR(50), `_tipo` VARCHAR(20))   BEGIN
	INSERT INTO detallesmarcas (id_marca,cod_marca,marca,tipo) VALUES (_id_marca,_cod_marca,_marca,_tipo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarProductosSistema` (`_id_producto` INT, `_cod_producto` CHAR(3), `_nombre` VARCHAR(50), `_tipo` VARCHAR(15), `_Cantidad` INT, `_marca` VARCHAR(20), `_garantia` CHAR(1))   BEGIN
	INSERT INTO producto (id_producto,cod_producto,nombre,tipo,Cantidad,marca,garantia) VALUES (_id_producto,_cod_producto,_nombre,_tipo,_Cantidad,_marca,_garantia);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarSucursalesNuevas` (`_id_sucursal` INT, `_cod_sucursal` INT, `_nombre_suc` VARCHAR(50), `_telefono` CHAR(9), `_direccion` VARCHAR(50), `_correo` VARCHAR(50))   BEGIN
	INSERT INTO sucursales (id_sucursal,cod_sucursal,nombre_suc,telefono,direccion,correo) VALUES (_id_sucursal,_cod_sucursal,_nombre_suc,_telefono,_direccion,_correo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarUsuariosGenerales` (`_id_cliente` INT, `_cod_cliente` INT, `_nombreusuario` CHAR(25), `_contrasenia` CHAR(255), `_estado` CHAR(15), `_tipo_usuario` CHAR(25), `_foto_perfil` VARCHAR(150))   BEGIN
	INSERT INTO logincliente (id_cliente,cod_cliente,nombreusuario,contrasenia,estado,tipo_usuario,foto_perfil) VALUES (_id_cliente,_cod_cliente,_nombreusuario,_contrasenia,_estado,_tipo_usuario,_foto_perfil);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarCiudades` (IN `_id_ciudad` INT, IN `_cod_ciudad` CHAR(3), IN `_nombre_ciu` VARCHAR(50))   BEGIN
   UPDATE ciudades SET id_ciudad = _id_ciudad, cod_ciudad = _cod_ciudad, nombre_ciu = _nombre_ciu WHERE id_ciudad = _id_ciudad;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarClientes` (IN `_cod_cliente` INT, IN `_nombre` VARCHAR(50), IN `_apellido` VARCHAR(50), IN `_DUI` CHAR(12), IN `_telefono` CHAR(9), IN `_ciudad` VARCHAR(100), IN `_direccion` VARCHAR(100), IN `_correo` VARCHAR(100), IN `_estado` CHAR(1), IN `_EstadoFactura` CHAR(15))   BEGIN
    UPDATE clientes SET cod_cliente = _cod_cliente,nombre = _nombre,apellido = _apellido, DUI = _DUI,telefono = _telefono,ciudad = _ciudad,direccion = _direccion,correo = _correo,estado = _estado,EstadoFactura = _EstadoFactura WHERE cod_cliente = _cod_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarDetalleMarcas` (IN `_id_marca` INT, IN `_cod_marca` INT, IN `_marca` VARCHAR(50), IN `_tipo` VARCHAR(20))   BEGIN
   UPDATE detallesmarcas SET id_marca = _id_marca, cod_marca = _cod_marca,marca = _marca,tipo = _tipo WHERE id_marca = _id_marca;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarDetalleVendedor` (IN `_cod_empleado` INT, IN `_tipo` VARCHAR(20), IN `_nombre` VARCHAR(20), IN `_area` VARCHAR(20))   BEGIN
   UPDATE detallesvendedor SET cod_empleado = _cod_empleado,tipo = _tipo,nombre = _nombre,area = _area WHERE cod_empleado = _cod_empleado;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarDetalleVenta` (IN `_cod_factura` INT, IN `_pago` DOUBLE, IN `_modelo` VARCHAR(50), IN `_licencia` CHAR(10), IN `_tipoSI` VARCHAR(25))   BEGIN
   UPDATE detalleventa SET cod_factura = _cod_factura ,pago = _pago,modelo = _modelo,licencia = _licencia,tipoSI = _tipoSI WHERE cod_factura = _cod_factura;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarEmpleados` (IN `_cod_empl` CHAR(3), IN `_nombre` VARCHAR(50), IN `_apellido` VARCHAR(50), IN `_dui` VARCHAR(12), IN `_telefono` CHAR(9), IN `_direccion` VARCHAR(100))   BEGIN
  UPDATE empleado SET cod_empl = _cod_empl, nombre = _nombre, apellido = _apellido, dui = _dui, telefono = _telefono, direccion = _direccion WHERE cod_empl = _cod_empl;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarEmpresas` (IN `_id_empresa` INT, IN `_cod_empresa` CHAR(3), IN `_cod_sucursales` CHAR(3), IN `_marcas` VARCHAR(50))   BEGIN
    UPDATE empresa SET id_empresa = _id_empresa, cod_empresa = _cod_empresa, cod_sucursales = _cod_sucursales, marcas = _marcas WHERE id_empresa = _id_empresa;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarLineas` (IN `_cod_linea` INT, IN `_tipo` VARCHAR(50))   BEGIN
  UPDATE lineas SET cod_linea = _cod_linea, tipo = _tipo WHERE cod_linea = _cod_linea;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilAdministradores` (`_id_admin` INT, `_nombre_usuario` VARCHAR(50), `_contrasenia` VARCHAR(15), `_estado` VARCHAR(15), `_tipo_usuario` CHAR(20))   BEGIN
	UPDATE administradores SET nombre_usuario = _nombre_usuario, contrasenia = _contrasenia, estado = _estado, tipo_usuario = _tipo_usuario WHERE id_admin = _id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilAdministradoresFotoIncluida` (`_id_admin` INT, `_nombre_usuario` VARCHAR(50), `_contrasenia` VARCHAR(15), `_estado` VARCHAR(15), `_tipo_usuario` CHAR(20), `_foto_perfil` VARCHAR(100))   BEGIN
	UPDATE administradores SET nombre_usuario = _nombre_usuario, contrasenia = _contrasenia, estado = _estado, tipo_usuario = _tipo_usuario, foto_perfil = _foto_perfil WHERE id_admin = _id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilEmpleadosRegistrados` (IN `_id_cliente` INT, IN `_nombreusuario` CHAR(25), IN `_contrasenia` CHAR(15), IN `_estado` CHAR(15), IN `_tipo_usuario` CHAR(25))  NO SQL BEGIN
	UPDATE logincliente SET nombreusuario = _nombreusuario, contrasenia = _contrasenia, estado = _estado, tipo_usuario = _tipo_usuario WHERE id_cliente = _id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilEmpleadosRegistradosConFoto` (IN `_id_cliente` INT, IN `_nombreusuario` CHAR(25), IN `_contrasenia` CHAR(255), IN `_estado` CHAR(15), IN `_tipo_usuario` CHAR(25), IN `_foto_perfil` VARCHAR(150))  NO SQL BEGIN
	UPDATE logincliente SET nombreusuario = _nombreusuario, contrasenia = _contrasenia, estado = _estado, tipo_usuario = _tipo_usuario, foto_perfil = _foto_perfil WHERE id_cliente = _id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarProductosSistema` (IN `_id_producto` INT, IN `_cod_producto` CHAR(3), IN `_nombre` VARCHAR(50), IN `_tipo` VARCHAR(15), IN `_Cantidad` INT, IN `_marca` VARCHAR(20), IN `_garantia` CHAR(1))   BEGIN
    UPDATE producto SET id_producto = _id_producto, cod_producto = _cod_producto, nombre = _nombre, tipo = _tipo, Cantidad = _Cantidad, marca = _marca, garantia = _garantia WHERE id_producto = _id_producto;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarReportesDeClientes` (IN `_Id_reporte` INT, IN `_Id_cliente` VARCHAR(20), IN `_Nombre_cliente` VARCHAR(100), IN `_nombre_empleado_registro` VARCHAR(50), IN `_nombre_empleado_gestionando` VARCHAR(50), IN `_Producto` VARCHAR(100), IN `_Marca` VARCHAR(100), IN `_Detalle_de_problema` VARCHAR(1000), IN `_Urgencia` CHAR(100), IN `_Estado_de_reporte` VARCHAR(50), IN `_Comentarios_EmpleadoGestionando` VARCHAR(1000))   BEGIN
	UPDATE reportesclientes SET Id_reporte = _Id_reporte, Id_cliente = _Id_cliente,Nombre_cliente = _Nombre_cliente, nombre_empleado_registro = _nombre_empleado_registro, nombre_empleado_gestionando = _nombre_empleado_gestionando, Producto = _Producto,Marca = _Marca,Detalle_de_problema = _Detalle_de_problema,Urgencia = _Urgencia,Estado_de_reporte = _Estado_de_reporte, Comentarios_EmpleadoGestionando = _Comentarios_EmpleadoGestionando WHERE Id_reporte = _Id_reporte;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarReportesDePlataforma` (IN `_Id_reporte` CHAR(100), IN `_Id_cliente` INT, IN `_nombre_usuario` VARCHAR(50), IN `_usuario_gestion` VARCHAR(50), IN `_DetallesReporte` VARCHAR(1000), IN `_Urgencia` VARCHAR(50), IN `_EstadoReporte` VARCHAR(50), IN `_Comentarios_Finales` VARCHAR(1000))   BEGIN
	UPDATE reporteplataforma SET Id_reporte = _Id_reporte,Id_cliente = _Id_cliente, nombre_usuario = _nombre_usuario, usuario_gestion = _usuario_gestion, DetallesReporte = _DetallesReporte,Urgencia =_Urgencia ,EstadoReporte = _EstadoReporte, Comentarios_Finales = _Comentarios_Finales WHERE Id_reporte = _Id_reporte;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarSucursalesSistema` (IN `_cod_sucursal` INT, IN `_nombre_suc` VARCHAR(50), IN `_telefono` CHAR(9), IN `_direccion` VARCHAR(50), IN `_correo` VARCHAR(50))   BEGIN
   	UPDATE sucursales SET cod_sucursal = _cod_sucursal, nombre_suc = _nombre_suc, telefono = _telefono, direccion = _direccion, correo = _correo WHERE cod_sucursal = _cod_sucursal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarUsuariosAdministradores` (IN `_id_admin` INT, IN `_cod_admin` CHAR(5), IN `_nombre_usuario` VARCHAR(50), IN `_contrasenia` VARCHAR(15), IN `_estado` VARCHAR(15), IN `_tipo_usuario` CHAR(20), IN `_foto_perfil` VARCHAR(100))   BEGIN
	UPDATE administradores SET id_admin = _id_admin, cod_admin = _cod_admin,nombre_usuario = _nombre_usuario,contrasenia = _contrasenia,estado = _estado,tipo_usuario = _tipo_usuario,foto_perfil = _foto_perfil WHERE id_admin = _id_admin;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarUsuariosGenerales` (IN `_cod_cliente` INT, IN `_nombreusuario` CHAR(25), IN `_contrasenia` CHAR(255), IN `_estado` CHAR(15), IN `_tipo_usuario` CHAR(25), IN `_foto_perfil` VARCHAR(150))   BEGIN
   UPDATE logincliente SET cod_cliente = _cod_cliente , nombreusuario = _nombreusuario, contrasenia = _contrasenia, estado = _estado, tipo_usuario = _tipo_usuario,  foto_perfil = _foto_perfil WHERE cod_cliente = _cod_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarEmpleadosSistema` (`_id_empleado` INT, `_cod_empl` CHAR(3), `_nombre` VARCHAR(50), `_apellido` VARCHAR(50), `_dui` VARCHAR(12), `_telefono` CHAR(9), `_direccion` VARCHAR(100))   BEGIN
	INSERT INTO empleado (id_empleado,cod_empl,nombre,apellido,dui,telefono,direccion) VALUES (_id_empleado,_cod_empl,_nombre,_apellido,_dui,_telefono,_direccion);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistroNuevasLineas` (`_id_linea` INT, `_cod_linea` INT, `_tipo` VARCHAR(50))   BEGIN
	INSERT INTO lineas (id_linea, cod_linea, tipo) VALUES (_id_linea,_cod_linea,_tipo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistroNuevosReportesDeClientes` (IN `_Id_reporte` INT, IN `_Id_cliente` VARCHAR(20), IN `_Nombre_cliente` VARCHAR(100), IN `_nombre_empleado_registro` VARCHAR(50), IN `_Producto` VARCHAR(100), IN `_Marca` VARCHAR(100), IN `_Fecha_Registro_Caso` DATE, IN `_Detalle_de_problema` VARCHAR(1000), IN `_Urgencia` CHAR(100), IN `_Estado_de_reporte` VARCHAR(50))   BEGIN
	INSERT INTO reportesclientes (Id_reporte,Id_cliente,Nombre_cliente,Producto,nombre_empleado_registro,Marca,Fecha_Registro_Caso,Detalle_de_problema,Urgencia,Estado_de_reporte) VALUES (_Id_reporte,_Id_cliente,_Nombre_cliente,_Producto,_nombre_empleado_registro,_Marca,_Fecha_Registro_Caso,_Detalle_de_problema,_Urgencia,_Estado_de_reporte);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistroNuevosReportesDePlataforma` (IN `_Id_reporte` CHAR(100), IN `_Id_cliente` INT, IN `_nombre_usuario` VARCHAR(50), IN `_DetallesReporte` VARCHAR(1000), IN `_Urgencia` VARCHAR(50), IN `_EstadoReporte` VARCHAR(50))   BEGIN
	INSERT INTO reporteplataforma (Id_reporte,Id_cliente,nombre_usuario,DetallesReporte,Urgencia,EstadoReporte) VALUES (_Id_reporte,_Id_cliente,_nombre_usuario,_DetallesReporte,_Urgencia,_EstadoReporte);
END$$

DELIMITER ;
