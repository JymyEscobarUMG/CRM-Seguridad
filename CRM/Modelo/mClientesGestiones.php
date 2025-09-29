<?php
/*  
    ------------------------------------------------
          INFORMACION TECNICA DEL SISTEMA
    ------------------------------------------------
        -> Autor: Daniel Rivera  
            https://github.com/DanielRivera03
    
        -> Sistema gestion de Casos [CRM]
            PHP Puro / MVC
        
        -> Inspirado bajo el software de codigo
            abierto VTiger Real, este sistema no
            tiene ninguna relacion directa con 
            el sistema mencionado previamente

        -> Creditos logo: https://www.vtiger.com/
    ---------------------------------------------------
    COMPARTIDO Y LIBERADO CON FINES ACADEMICOS 
    ---------------------------------------------------   
*/

class Clientes {
    // VARIABLES DE GESTION
    private $IdCliente;
    private $CodCliente;
    private $NombreCliente;
    private $ApellidoCliente;
    private $DuiCliente;
    private $TelefonoCliente;
    private $CiudadCliente;
    private $DireccionCliente;
    private $CorreoCliente;
    private $EstadoCliente;
    private $EstadoFacturaCliente;

    // GETTERS y SETTERS
    public function setIDClientesGestiones($n){ $this->IdCliente=$n; }
    public function getIDClientesGestiones(){ return $this->IdCliente; }

    public function setCodClientesGestiones($n){ $this->CodCliente=$n; }
    public function getCodClientesGestiones(){ return $this->CodCliente; }

    public function setNombreClientesGestiones($n){ $this->NombreCliente=$n; }
    public function getNombreClientesGestiones(){ return $this->NombreCliente; }

    public function setApellidoClientesGestiones($n){ $this->ApellidoCliente=$n; }
    public function getApellidoClientesGestiones(){ return $this->ApellidoCliente; }

    public function setDuiClientesGestiones($n){ $this->DuiCliente=$n; }
    public function getDuiClientesGestiones(){ return $this->DuiCliente; }

    public function setTelefonoClientesGestiones($n){ $this->TelefonoCliente=$n; }
    public function getTelefonoClientesGestiones(){ return $this->TelefonoCliente; }

    public function setCiudadClientesGestiones($n){ $this->CiudadCliente=$n; }
    public function getCiudadClientesGestiones(){ return $this->CiudadCliente; }

    public function setDireccionClientesGestiones($n){ $this->DireccionCliente=$n; }
    public function getDireccionClientesGestiones(){ return $this->DireccionCliente; }

    public function setCorreoClientesGestiones($n){ $this->CorreoCliente=$n; }
    public function getCorreoClientesGestiones(){ return $this->CorreoCliente; }

    public function setEstadoClientesGestiones($n){ $this->EstadoCliente=$n; }
    public function getEstadoClientesGestiones(){ return $this->EstadoCliente; }

    public function setEstadoFacturaClientesGestiones($n){ $this->EstadoFacturaCliente=$n; }
    public function getEstadoFacturaClientesGestiones(){ return $this->EstadoFacturaCliente; }

    // CONSULTA ESPECIFICA UN CLIENTE
    public function ConsultarUnCliente($cnn, $ID_Clientes){
        $stmt = $cnn->prepare("CALL ConsultaClientesEspecifica(?)");
        $stmt->bind_param("i", $ID_Clientes);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($Usuarios = $resultado->fetch_assoc()){
            $this->setCodClientesGestiones($Usuarios['cod_cliente']);
            $this->setNombreClientesGestiones($Usuarios['nombre']);
            $this->setApellidoClientesGestiones($Usuarios['apellido']);
            $this->setDuiClientesGestiones($Usuarios['DUI']);
            $this->setTelefonoClientesGestiones($Usuarios['telefono']);
            $this->setCiudadClientesGestiones($Usuarios['ciudad']);
            $this->setDireccionClientesGestiones($Usuarios['direccion']);
            $this->setCorreoClientesGestiones($Usuarios['correo']);
            $this->setEstadoClientesGestiones($Usuarios['estado']);
            $this->setEstadoFacturaClientesGestiones($Usuarios['EstadoFactura']);
        }
        $stmt->close();
    }

    // CONSULTAR TODOS LOS CLIENTES
    public function ConsultarClientes($cnn){
        $stmt = $cnn->prepare("CALL ConsultarClientes()");
        $stmt->execute();
        return $stmt->get_result();
    }

    // INSERTAR CLIENTES
    public function InsertarNuevosClientes($cnn,$IDCliente,$CodiCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente){
        $stmt = $cnn->prepare("CALL InsertarClientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssssssss", 
            $IDCliente,$CodiCliente,$NombCliente,$ApelCliente,
            $DUICliente,$TelCliente,$CiuCliente,$DirCliente,
            $EmailCliente,$EstCliente,$EstFCliente
        );
        if($stmt->execute()){
            include ('../Vista/MensajesUsuarios/RegistroInsertadoClientes.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoInsertadoClientes.html');
        }
        $stmt->close();
    }

    // ELIMINAR CLIENTES
    public function EliminarClientesSistema($cnn, $ID_Clientes){
        $stmt = $cnn->prepare("CALL EliminarClientes(?)");
        $stmt->bind_param("i", $ID_Clientes);
        $stmt->execute();
        $res = $stmt->get_result();
        $stmt->close();
        return $res;
    }

    // MODIFICAR CLIENTES
    public function ModificarClientesSistema($cnn,$IDCliente,$NombCliente,$ApelCliente,$DUICliente,$TelCliente,$CiuCliente,$DirCliente,$EmailCliente,$EstCliente,$EstFCliente){
        $stmt = $cnn->prepare("CALL ModificarClientes(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssss", 
            $IDCliente,$NombCliente,$ApelCliente,$DUICliente,
            $TelCliente,$CiuCliente,$DirCliente,$EmailCliente,
            $EstCliente,$EstFCliente
        );
        if($stmt->execute()){
            include ('../Vista/MensajesUsuarios/RegistroModificadoClientes.html');
        } else {
            include ('../Vista/MensajesUsuarios/RegistroNoModificadoClientes.html');
        }
        $stmt->close();
    }
} // CIERRE DE CLASE CLIENTES
?>
