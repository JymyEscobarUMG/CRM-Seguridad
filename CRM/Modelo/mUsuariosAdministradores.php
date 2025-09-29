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
    private $Email;

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

    public function setEmail($n){ $this->Email = $n; }
    public function getEmail(){ return $this->Email; }

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
            $this->setEmail($Usuarios['email']);
        }
        $stmt->close();
    }

    // --- INSERTAR NUEVO ADMINISTRADOR ---
    public function InsertarUsuarioAdministradores($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL InsertarAdministradores(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario);

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
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotoUsuarioAdmins . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=4\'">Ir a Gestionar Usuarios</button>
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
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=2\'">Volver al Formulario</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }

    // --- MODIFICAR PERFIL SIN FOTO ---
    public function ModificarPerfilUsuarioAdministradores($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilAdministradores(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $EmailUsuario);

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
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=7\'">Volver al Perfil</button>
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
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=7\'">Volver al Perfil</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }

    // --- MODIFICAR PERFIL CON FOTO ---
    public function ModificarPerfilUsuarioAdministradoresFotos($cnn, $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarPerfilAdministradoresFotoIncluida(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $IdUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario);

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
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotoUsuarioAdmins . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=7\'">Volver al Perfil</button>
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
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=7\'">Volver al Perfil</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
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
    public function ModificarAdministradores($cnn, $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario) {
        $stmt = $cnn->prepare("CALL ModificarUsuariosAdministradores(?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $IdUsuario, $CodUsuario, $NomUsuario, $PassUsuario, $EstadoUsuario, $TipoUsuario, $FotoUsuarioAdmins, $EmailUsuario);

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
        <strong>Foto de Perfil:</strong><br><img src="../Vista/dist/fotosperfiles/' . $FotoUsuarioAdmins . '" alt="Foto de Perfil" class="img-thumbnail" width="100">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=4\'">Ir a Gestionar Usuarios</button>
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
        <button type="button" class="btn btn-primary" onclick="window.location.href=\'../Controlador/cUsuariosAdministradores.php?acc=4\'">Volver a Gestionar Usuarios</button>
      </div>
    </div>
  </div>
</div>
<script>$("#errorModal").modal("show");</script>';
        }
    }
}
?>
