<?php
class UsuariosAdministrativos {
    // VARIABLES DE GESTION
    private $ID_UsuarioGeneral;
    private $Cod_UsuarioGeneral;
    private $Nombre_UsuarioGeneral;
    private $Pass_UsuarioGeneral;
    private $Estado_UsuarioGeneral;
    private $Tipo_UsuarioGeneral;
    private $FotosPerfilesEmpleados;

    // --- GETTERS & SETTERS ---
    public function setIDUsuarioGeneral($n){ $this->ID_UsuarioGeneral = $n; }
    public function getIDUsuarioGeneral(){ return $this->ID_UsuarioGeneral; }

    public function setCodUsuarioGeneral($n){ $this->Cod_UsuarioGeneral = $n; }
    public function getCodUsuarioGeneral(){ return $this->Cod_UsuarioGeneral; }

    public function setNombreDeUsuarioGeneral($n){ $this->Nombre_UsuarioGeneral = $n; }
    public function getNombreDeUsuarioGeneral(){ return $this->Nombre_UsuarioGeneral; }

    public function setContraseniaDeUsuarioGeneral($n){ $this->Pass_UsuarioGeneral = $n; }
    public function getContraseniaDeUsuarioGeneral(){ return $this->Pass_UsuarioGeneral; }

    public function setEstadoDeUsuarioGeneral($n){ $this->Estado_UsuarioGeneral = $n; }
    public function getEstadoDeUsuarioGeneral(){ return $this->Estado_UsuarioGeneral; }

    public function setTipoDeUsuarioGeneral($n){ $this->Tipo_UsuarioGeneral = $n; }
    public function getTipoDeUsuarioGeneral(){ return $this->Tipo_UsuarioGeneral; }

    public function setFotosEmpleados($n){ $this->FotosPerfilesEmpleados = $n; }
    public function getFotosEmpleados(){ return $this->FotosPerfilesEmpleados; }

    // --- CONSULTAR EMPLEADO POR ID ---
    public function ConsultarUnEmpleado($cnn, $IDEmpleados) {
        $stmt = $cnn->prepare("CALL ConsultaEmpleadosEspecifica(?)");
        $stmt->bind_param("i", $IDEmpleados); // ID = INT
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCodUsuarioGeneral($Usuarios['cod_cliente']);
            $this->setNombreDeUsuarioGeneral($Usuarios['nombreusuario']);
            $this->setContraseniaDeUsuarioGeneral($Usuarios['contrasenia']);
            $this->setEstadoDeUsuarioGeneral($Usuarios['estado']);
            $this->setTipoDeUsuarioGeneral($Usuarios['tipo_usuario']);
            $this->setFotosEmpleados($Usuarios['foto_perfil']);
        }
        $stmt->close();
    }

    // --- CONSULTAR TODOS LOS USUARIOS ---
    public function ConsultarUsuariosGeneral($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarUsuariosGenerales()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // --- INSERTAR NUEVO USUARIO ---
    public function InsertarNuevosUsuarios($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados) {
        $stmt = $cnn->prepare("CALL InsertarUsuariosGenerales(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssss", 
            $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, 
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertadoUsuarios.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertadoUsuarios.html');
        }
    }

    // --- ELIMINAR USUARIO ---
    public function EliminarEmpleados($cnn, $ID_UsuarioGeneral) {
        $stmt = $cnn->prepare("CALL EliminarUsuariosGenerales(?)");
        $stmt->bind_param("i", $ID_UsuarioGeneral); // INT
        $stmt->execute();
        $stmt->close();
    }

    // --- MODIFICAR USUARIO (CON FOTO OBLIGATORIA) ---
    public function ModificarUsuariosEmpleados($cnn, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados) {
        $stmt = $cnn->prepare("CALL ModificarUsuariosGenerales(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", 
            $CodUsuario, $NomUsuario, $PassUsuario, 
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoEmpleados.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoEmpleados.html');
        }
    }

    // --- MODIFICAR PERFIL SIN FOTO ---
    public function ModificarPerfilUsuariosEmpleados($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilEmpleadosRegistrados(?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", 
            $IdUsuario, $NomUsuario, $PassUsuario, 
            $EstadoUsuario, $TipoUsuario
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoPerfilEmpleados.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilEmpleados.html');
        }
    }

    // --- MODIFICAR PERFIL CON FOTO ---
    public function ModificarPerfilUsuariosEmpleadosConFoto($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados) {
        $stmt = $cnn->prepare("CALL ModificarPerfilEmpleadosRegistradosConFoto(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", 
            $IdUsuario, $NomUsuario, $PassUsuario, 
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoPerfilEmpleados.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoPerfilEmpleados.html');
        }
    }
}
?>
