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
    private $Email;

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

    public function setEmail($n){ $this->Email = $n; }
    public function getEmail(){ return $this->Email; }

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
            $this->setEmail($Usuarios['email']);
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
    public function InsertarNuevosUsuarios($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL InsertarUsuariosGenerales(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssss",
            $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario,
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo '<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Registro Exitoso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Usuario registrado exitosamente.</p>
        <strong>Nombre:</strong> ' . $NomUsuario . '<br>
        <strong>Email:</strong> ' . $EmailUsuario . '<br>
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotosPerfilesEmpleados . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministrativos.php?acc=4\'">Ir a Gestionar Usuarios</button>
      </div>
    </div>
  </div>
</div>
<script>$("#successModal").modal("show");</script>';
        } else {
            echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error en el Registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Error al guardar el registro. Verifique los datos e intente nuevamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministrativos.php?acc=2\'">Volver al Formulario</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
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
    public function ModificarUsuariosEmpleados($cnn, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarUsuariosGenerales(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss",
            $CodUsuario, $NomUsuario, $PassUsuario,
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo '<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Usuario Modificado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Usuario modificado exitosamente.</p>
        <strong>Nombre:</strong> ' . $NomUsuario . '<br>
        <strong>Email:</strong> ' . $EmailUsuario . '<br>
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotosPerfilesEmpleados . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministrativos.php?acc=4\'">Ir a Gestionar Usuarios</button>
      </div>
    </div>
  </div>
</div>
<script>$("#successModal").modal("show");</script>';
        } else {
            echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error en la Modificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Error al modificar el usuario. Verifique los datos e intente nuevamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministrativos.php?acc=4\'">Volver a Gestionar Usuarios</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }

    // --- MODIFICAR PERFIL SIN FOTO ---
    public function ModificarPerfilUsuariosEmpleados($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilEmpleadosRegistrados(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss",
            $IdUsuario, $NomUsuario, $PassUsuario,
            $EstadoUsuario, $TipoUsuario, $EmailUsuario
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo '<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Perfil Modificado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Perfil modificado exitosamente.</p>
        <strong>Nombre:</strong> ' . $NomUsuario . '<br>
        <strong>Email:</strong> ' . $EmailUsuario . '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Vista/Empleados/PrincipalEmpleados.php?acc=1\'">Volver al Inicio</button>
      </div>
    </div>
  </div>
</div>
<script>$("#successModal").modal("show");</script>';
        } else {
            echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error en la Modificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Error al modificar el perfil. Verifique los datos e intente nuevamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Vista/Empleados/PrincipalEmpleados.php?acc=1\'">Volver al Inicio</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }

    // --- MODIFICAR PERFIL CON FOTO ---
    public function ModificarPerfilUsuariosEmpleadosConFoto($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilEmpleadosRegistradosConFoto(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss",
            $IdUsuario, $NomUsuario, $PassUsuario,
            $EstadoUsuario, $TipoUsuario, $FotosPerfilesEmpleados, $EmailUsuario
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo '<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Perfil Modificado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Perfil modificado exitosamente.</p>
        <strong>Nombre:</strong> ' . $NomUsuario . '<br>
        <strong>Email:</strong> ' . $EmailUsuario . '<br>
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotosPerfilesEmpleados . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Vista/Empleados/PrincipalEmpleados.php?acc=1\'">Volver al Inicio</button>
      </div>
    </div>
  </div>
</div>
<script>$("#successModal").modal("show");</script>';
        } else {
            echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Error en la Modificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Error al modificar el perfil. Verifique los datos e intente nuevamente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Vista/Empleados/PrincipalEmpleados.php?acc=1\'">Volver al Inicio</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }
}
?>
