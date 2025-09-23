<?php
class Empresa {
    // VARIABLES DE GESTION
    private $Id_Empresa;
    private $Cod_Empresa;
    private $Cod_EmpresaSucursal;
    private $Cod_EmpresaMarcas;

    // ID
    public function setIDEmpresa($n){ $this->Id_Empresa = $n; }
    public function getIDEmpresa(){ return $this->Id_Empresa; }

    // CODIGO
    public function setCODEmpresa($n){ $this->Cod_Empresa = $n; }
    public function getCODEmpresa(){ return $this->Cod_Empresa; }

    // CODIGO SUCURSAL
    public function setCODSucursalEmpresa($n){ $this->Cod_EmpresaSucursal = $n; }
    public function getCODSucursalEmpresa(){ return $this->Cod_EmpresaSucursal; }

    // MARCA -> EMPRESA
    public function setMarcaEmpresa($n){ $this->Cod_EmpresaMarcas = $n; }
    public function getMarcaEmpresa(){ return $this->Cod_EmpresaMarcas; }

    // CONSULTA ESPECIFICA UNA EMPRESA
    public function ConsultarUnaEmpresaSistema($cnn, $ID_EmpresaRegistro) {
        $stmt = $cnn->prepare("CALL ConsultaEspecificaEmpresas(?)");
        $stmt->bind_param("i", $ID_EmpresaRegistro);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($Usuarios = $resultado->fetch_assoc()) {
            $this->setCODEmpresa($Usuarios['cod_empresa']);
            $this->setCODSucursalEmpresa($Usuarios['cod_sucursales']);
            $this->setMarcaEmpresa($Usuarios['marcas']);
        }
        $stmt->close();
    }

    // CONSULTAR TODAS LAS EMPRESAS
    public function ConsultarEmpresas($cnn) {
        $stmt = $cnn->prepare("CALL ConsultarEmpresas()");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado;
    }

    // INSERTAR NUEVAS EMPRESAS
    public function InsertarEmpresasSistema($cnn, $IDEEmpresa, $CODIEmpresa, $CODISUCEmpresa, $MARCEmpresa) {
        $stmt = $cnn->prepare("CALL InsertarNuevasEmpresas(?, ?, ?, ?)");
        $stmt->bind_param("isss", $IDEEmpresa, $CODIEmpresa, $CODISUCEmpresa, $MARCEmpresa);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroInsertadoEmpresas.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoInsertadoEmpresas.html');
        }
    }

    // ELIMINAR EMPRESAS
    public function EliminarEmpresasRegistradas($cnn, $ID_EmpresaRegistro) {
        $stmt = $cnn->prepare("CALL EliminarEmpresas(?)");
        $stmt->bind_param("i", $ID_EmpresaRegistro);
        $stmt->execute();
        $stmt->close();
    }

    // MODIFICAR EMPRESAS
    public function ModificarEmpresasRegistradas($cnn, $IDEEmpresa, $CODIEmpresa, $CODISUCEmpresa, $MARCEmpresa) {
        $stmt = $cnn->prepare("CALL ModificarEmpresas(?, ?, ?, ?)");
        $stmt->bind_param("isss", $IDEEmpresa, $CODIEmpresa, $CODISUCEmpresa, $MARCEmpresa);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            include('../Vista/MensajesUsuarios/RegistroModificadoEmpresas.html');
        } else {
            include('../Vista/MensajesUsuarios/RegistroNoModificadoEmpresas.html');
        }
    }
} // CIERRE DE CLASE EMPRESAS
?>
