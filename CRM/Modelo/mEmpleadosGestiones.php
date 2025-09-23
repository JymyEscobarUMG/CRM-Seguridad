<?php
class Empleados {
    // VARIABLES DE GESTION
    private $Id_Empleado;
    private $Cod_Empleado;
    private $Nombre_Empleado;
    private $Apellido_Empleado;
    private $Dui_Empleado;
    private $Telefono_Empleado;
    private $Direccion_Empleado;

    // ID
    public function setIDEmpleados($n) { $this->Id_Empleado = $n; }
    public function getIDEmpleados() { return $this->Id_Empleado; }

    // CODIGO
    public function setCODEmpleados($n) { $this->Cod_Empleado = $n; }
    public function getCODEmpleados() { return $this->Cod_Empleado; }

    // NOMBRE
    public function setNOMEmpleados($n) { $this->Nombre_Empleado = $n; }
    public function getNOMEmpleados() { return $this->Nombre_Empleado; }

    // APELLIDO
    public function setAPEEmpleados($n) { $this->Apellido_Empleado = $n; }
    public function getAPEEmpleados() { return $this->Apellido_Empleado; }

    // DUI
    public function setDUIEmpleados($n) { $this->Dui_Empleado = $n; }
    public function getDUIEmpleados() { return $this->Dui_Empleado; }

    // TELEFONO
    public function setTELEmpleados($n) { $this->Telefono_Empleado = $n; }
    public function getTELEmpleados() { return $this->Telefono_Empleado; }

    // DIRECCION
    public function setDIREmpleados($n) { $this->Direccion_Empleado = $n; }
    public function getDIREmpleados() { return $this->Direccion_Empleado; }

    // CONSULTA ESPECIFICA UN EMPLEADO SISTEMA
    public function ConsultarUnEmpleadoSistema($cnn, $ID_EmpleadosSistema) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaEmpleados(?)");
        $stmt->bind_param("i", $ID_EmpleadosSistema);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCODEmpleados($Usuarios['cod_empl']);
            $this->setNOMEmpleados($Usuarios['nombre']);
            $this->setAPEEmpleados($Usuarios['apellido']);
            $this->setDUIEmpleados($Usuarios['dui']);
            $this->setTELEmpleados($Usuarios['telefono']);
            $this->setDIREmpleados($Usuarios['direccion']);
        }
        $stmt->close();
    }

    // CONSULTAR TODOS LOS EMPLEADOS
    public function ConsultarEmpleados($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarEmpleados()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR EMPLEADOS
    public function InsertarNuevosEmpleados($cnn, $IDEmpleado, $CODEmpleado, $NOMBEmpleado, $APELEmpleado, $DUIEmpleado, $TELEmpleado, $DIREmpleado) {
        $stmt = $cnn->prepare("CALL RegistrarEmpleadosSistema(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $IDEmpleado, $CODEmpleado, $NOMBEmpleado, $APELEmpleado, $DUIEmpleado, $TELEmpleado, $DIREmpleado);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertadoEmpleados.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertadoEmpleados.html');
        }
    }

    // ELIMINAR EMPLEADOS
    public function EliminarEmpleadosSistema($cnn, $ID_EmpleadosSistema) {
        $stmt = $cnn->prepare("CALL EliminarEmpleados(?)");
        $stmt->bind_param("i", $ID_EmpleadosSistema);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR EMPLEADOS
    public function ModificarEmpleadosSistema($cnn, $IDEmpleado, $NOMBEmpleado, $APELEmpleado, $DUIEmpleado, $TELEmpleado, $DIREmpleado) {
        $stmt = $cnn->prepare("CALL ModificarEmpleados(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $IDEmpleado, $NOMBEmpleado, $APELEmpleado, $DUIEmpleado, $TELEmpleado, $DIREmpleado);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoEmpleadosSistema.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoEmpleadosSistema.html');
        }
    }
} // CIERRE DE CLASE EMPLEADOS
?>
