<?php
class UsuariosAdmin {
    // VARIABLES DE GESTION
    private $ID_Admin;
    private $Cod_Admin;
    private $Nombre_Usuario;
    private $Contrasenias;
    private $Estado;
    private $TipoUsuarios;
    private $FotosPerfiles;

    // --- GETTERS & SETTERS ---
    public function setID($n){ $this->ID_Admin = $n; }
    public function getID(){ return $this->ID_Admin; }

    public function setCod($n){ $this->Cod_Admin = $n; }
    public function getCod(){ return $this->Cod_Admin; }

    public function setNombreU($n){ $this->Nombre_Usuario = $n; }
    public function getNombreU(){ return $this->Nombre_Usuario; }

    public function setPass($n){ $this->Contrasenias = $n; }
    public function getPass(){ return $this->Contrasenias; }

    public function setEstados($n){ $this->Estado = $n; }
    public function getEstados(){ return $this->Estado; }

    public function setTipoUser($n){ $this->TipoUsuarios = $n; }
    public function getTipoUser(){ return $this->TipoUsuarios; }

    public function setFotosUser($n){ $this->FotosPerfiles = $n; }
    public function getFotosUser(){ return $this->FotosPerfiles; }

    // --- CONSULTAR TODOS LOS ADMINISTRADORES ---
    public function ConsultarUsuariosAdmin($cnn) {
        $stmt = $cnn->prepare("CALL ConsultaUsuariosAdministradores()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // --- CONSULTA ESPECÍFICA POR ID ---
    public function ConsultarUnAdministrador($cnn, $IDAdministrador) {
        $stmt = $cnn->prepare("CALL ConsultaAdministradoresEspecifica(?)");
        $stmt->bind_param("i", $IDAdministrador); // INT
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCod($Usuarios['cod_admin']);
            $this->setNombreU($Usuarios['nombre_usuario']);
            $this->setPass($Usuarios['contrasenia']);
            $this->setEstados($Usuarios['estado']);
            $this->setTipoUser($Usuarios['tipo_usuario']);
            $this->setFotosUser($Usuarios['foto_perfil']);
        }
        $stmt->close();
    }

    // --- INSERTAR NUEVO ADMINISTRADOR ---
    public function InsertarUsuarioAdministradores($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins) {
        $stmt = $cnn->prepare("CALL InsertarAdministradores(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins);

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertado.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertado.html');
        }
    }

    // --- MODIFICAR PERFIL SIN FOTO ---
    public function ModificarPerfilUsuarioAdministradores($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilAdministradores(?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario);

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
        }
    }

    // --- MODIFICAR PERFIL CON FOTO ---
    public function ModificarPerfilUsuarioAdministradoresFotos($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins) {
        $stmt = $cnn->prepare("CALL ModificarPerfilAdministradoresFotoIncluida(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins);

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
        }
    }

    // --- ELIMINAR ADMINISTRADOR ---
    public function EliminarAdministradores($cnn, $IdUsuario) {
        $stmt = $cnn->prepare("CALL EliminarUsuariosAdministradores(?)");
        $stmt->bind_param("i", $IdUsuario); // INT
        $stmt->execute();
        $stmt->close();
    }

    // --- MODIFICAR USUARIO (CON FOTO OBLIGATORIA) ---
    public function ModificarAdministradores($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins) {
        $stmt = $cnn->prepare("CALL ModificarUsuariosAdministradores(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins);

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoUsuariosAdmins.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoUsuariosAdmins.html');
        }
    }
}
?>
