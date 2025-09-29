-- Actualizar el stored procedure InsertarAdministradores para incluir email

DROP PROCEDURE IF EXISTS InsertarAdministradores;

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarAdministradores` (
    IN `IdAdmin` INT,
    IN `CodAdmin` CHAR(5),
    IN `NomAdmin` VARCHAR(50),
    IN `PassAdmin` VARCHAR(512),
    IN `EstadoAdmin` VARCHAR(15),
    IN `TipoAdmin` CHAR(20),
    IN `FotoAdmin` VARCHAR(150),
    IN `EmailAdmin` VARCHAR(100)
)
SQL SECURITY DEFINER
INSERT INTO administradores (id_admin, cod_admin, nombre_usuario, contrasenia, estado, tipo_usuario, foto_perfil, email) VALUES (IdAdmin, CodAdmin, NomAdmin, PassAdmin, EstadoAdmin, TipoAdmin, FotoAdmin, EmailAdmin);

-- Actualizar otros SPs si es necesario, como ModificarPerfilAdministradores, etc.

-- Para ModificarPerfilAdministradores
DROP PROCEDURE IF EXISTS ModificarPerfilAdministradores;

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilAdministradores` (
    IN `IdAdmin` INT,
    IN `NomAdmin` VARCHAR(50),
    IN `PassAdmin` VARCHAR(512),
    IN `EstadoAdmin` VARCHAR(15),
    IN `TipoAdmin` CHAR(20),
    IN `EmailAdmin` VARCHAR(100)
)
SQL SECURITY DEFINER
UPDATE administradores SET nombre_usuario = NomAdmin, contrasenia = PassAdmin, estado = EstadoAdmin, tipo_usuario = TipoAdmin, email = EmailAdmin WHERE id_admin = IdAdmin;

-- Para ModificarPerfilAdministradoresFotoIncluida
DROP PROCEDURE IF EXISTS ModificarPerfilAdministradoresFotoIncluida;

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarPerfilAdministradoresFotoIncluida` (
    IN `IdAdmin` INT,
    IN `NomAdmin` VARCHAR(50),
    IN `PassAdmin` VARCHAR(512),
    IN `EstadoAdmin` VARCHAR(15),
    IN `TipoAdmin` CHAR(20),
    IN `FotoAdmin` VARCHAR(150),
    IN `EmailAdmin` VARCHAR(100)
)
SQL SECURITY DEFINER
UPDATE administradores SET nombre_usuario = NomAdmin, contrasenia = PassAdmin, estado = EstadoAdmin, tipo_usuario = TipoAdmin, foto_perfil = FotoAdmin, email = EmailAdmin WHERE id_admin = IdAdmin;

-- Para ModificarUsuariosAdministradores
DROP PROCEDURE IF EXISTS ModificarUsuariosAdministradores;

CREATE DEFINER=`root`@`localhost` PROCEDURE `ModificarUsuariosAdministradores` (
    IN `IdAdmin` INT,
    IN `CodAdmin` CHAR(5),
    IN `NomAdmin` VARCHAR(50),
    IN `PassAdmin` VARCHAR(512),
    IN `EstadoAdmin` VARCHAR(15),
    IN `TipoAdmin` CHAR(20),
    IN `FotoAdmin` VARCHAR(150),
    IN `EmailAdmin` VARCHAR(100)
)
SQL SECURITY DEFINER
UPDATE administradores SET cod_admin = CodAdmin, nombre_usuario = NomAdmin, contrasenia = PassAdmin, estado = EstadoAdmin, tipo_usuario = TipoAdmin, foto_perfil = FotoAdmin, email = EmailAdmin WHERE id_admin = IdAdmin;