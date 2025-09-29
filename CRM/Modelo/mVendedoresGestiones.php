<?php
class Vendedores {
    // VARIABLES DE GESTION
    private $Id_Empleado;
    private $Cod_Empleado;
    private $Tipo_Empleado;
    private $Nombre_Empleado;
    private $Area_Empleado;

    // --- GETTERS & SETTERS ---
    public function setIDVendedor($n){ $this->Id_Empleado = $n; }
    public function getIDVendedor(){ return $this->Id_Empleado; }

    public function setCODVendedor($n){ $this->Cod_Empleado = $n; }
    public function getCODVendedor(){ return $this->Cod_Empleado; }

    public function setTipoVendedor($n){ $this->Tipo_Empleado = $n; }
    public function getTipoVendedor(){ return $this->Tipo_Empleado; }

    public function setNombreVendedor($n){ $this->Nombre_Empleado = $n; }
    public function getNombreVendedor(){ return $this->Nombre_Empleado; }

    public function setAreaVendedor($n){ $this->Area_Empleado = $n; }
    public function getAreaVendedor(){ return $this->Area_Empleado; }

    // --- CONSULTAR VENDEDOR POR ID ---
    public function ConsultarUnVendedor($cnn, $ID_Vendedores) {
        $stmt = $cnn->prepare("CALL ConsultaVendedoresEspecifica(?)");
        $stmt->bind_param("i", $ID_Vendedores); // id_empleado = INT
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCODVendedor($Usuarios['cod_empleado']);
            $this->setTipoVendedor($Usuarios['tipo']);
            $this->setNombreVendedor($Usuarios['nombre']);
            $this->setAreaVendedor($Usuarios['area']);
        }
        $stmt->close();
    }

    // --- CONSULTAR TODOS LOS VENDEDORES ---
    public function ConsultarTodosVendedores($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarVendedoresDetalles()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // --- INSERTAR NUEVO VENDEDOR ---
    public function InsertarNuevosVendedores($cnn, $IDVendedores, $CODVendedores, $TIPOVendedores, $NOMVendedores, $AREAVendedores) {
        $stmt = $cnn->prepare("CALL InsertarDetallesVendedoresNuevos(?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", 
            $IDVendedores,    // INT
            $CODVendedores,   // INT
            $TIPOVendedores,  // VARCHAR(20)
            $NOMVendedores,   // VARCHAR(20)
            $AREAVendedores   // VARCHAR(20)
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertadoVendedores.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertadoVendedores.html');
        }
    }

    // --- ELIMINAR VENDEDOR ---
    public function EliminarVendedoresSistema($cnn, $ID_Vendedores) {
        $stmt = $cnn->prepare("CALL EliminarDetalleVendedor(?)");
        $stmt->bind_param("i", $ID_Vendedores); // id_empleado = INT
        $stmt->execute();
        $stmt->close();
    }

    // --- MODIFICAR VENDEDOR ---
    public function ModificarVendedor($cnn, $CODVendedores, $TIPOVendedores, $NOMVendedores, $AREAVendedores) {
        $stmt = $cnn->prepare("CALL ModificarDetalleVendedor(?, ?, ?, ?)");
        $stmt->bind_param("isss", 
            $CODVendedores,  // INT
            $TIPOVendedores, // VARCHAR(20)
            $NOMVendedores,  // VARCHAR(20)
            $AREAVendedores  // VARCHAR(20)
        );

        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoVendedores.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoVendedores.html');
        }
    }
}
?>
