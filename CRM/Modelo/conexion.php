<?php
// Cargar variables de entorno
require_once __DIR__ . '/../envLoader.php';
cargarEnv();

class Conexion {
    private $servidor;
    private $usuario;
    private $clave;
    private $base;
    public  $conex;

    public function __construct() {
        // Tomar valores desde el archivo .env
        $this->servidor = env('DB_HOST', 'localhost');
        $this->usuario  = env('DB_USER', 'root');
        $this->clave    = env('DB_PASS', '');
        $this->base     = env('DB_NAME', 'crm');
    }

    public function setServidor($s) { $this->servidor = $s; }
    public function getServidor() { return $this->servidor; }

    public function conectar($bd = null) {
        $db = $bd ?? $this->base;
        $misql = new mysqli($this->servidor, $this->usuario, $this->clave, $db);

        if ($misql->connect_errno) {
            $mensaje = "Error de conexión: " . $misql->connect_error;
        } else {
            $mensaje = "Conexión exitosa.";
            $this->conex = $misql;
        }
        return $mensaje;
    }

    // ==== Tus métodos login() y loginEmpleados() se quedan IGUAL ====
    public function login($cnn, $Usuario, $Pass) {
        $stmt = $cnn->prepare("CALL ValidarLogin(?)");
        $stmt->bind_param("s", $Usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($resultado->num_rows === 1) {
            $usuarioData = $resultado->fetch_assoc();
            $hash = $usuarioData['contrasenia'];

            if (password_verify($Pass, $hash)) {
                return $usuarioData;
            }

            if ($Pass === $hash) {
                $nuevoHash = password_hash($Pass, PASSWORD_BCRYPT);
                $update = $cnn->prepare("UPDATE administradores SET contrasenia = ? WHERE id_admin = ?");
                $update->bind_param("si", $nuevoHash, $usuarioData['id_admin']);
                $update->execute();
                $update->close();

                $usuarioData['contrasenia'] = $nuevoHash;
                return $usuarioData;
            }
        }
        return null;
    }

    public function loginEmpleados($cnn, $Usuario, $Pass) {
        $stmt = $cnn->prepare("CALL ValidarLoginEmpleados(?)");
        $stmt->bind_param("s", $Usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($resultado->num_rows === 1) {
            $usuarioData = $resultado->fetch_assoc();
            $hash = $usuarioData['contrasenia'];

            if (password_verify($Pass, $hash)) {
                return $usuarioData;
            }

            if ($Pass === $hash) {
                $nuevoHash = password_hash($Pass, PASSWORD_BCRYPT);
                $update = $cnn->prepare("UPDATE logincliente SET contrasenia = ? WHERE id_cliente = ?");
                $update->bind_param("si", $nuevoHash, $usuarioData['id_cliente']);
                $update->execute();
                $update->close();

                $usuarioData['contrasenia'] = $nuevoHash;
                return $usuarioData;
            }
        }
        return null;
    }
}

// ================================
// CONEXIÓN PRINCIPAL DEL SISTEMA
// ================================
$con = new Conexion();
$con->conectar("crm");
$cnn = $con->conex;

// ================================
// CONEXIONES SECUNDARIAS
// ================================
$con1 = new Conexion(); $con1->conectar("crm"); $cnn1 = $con1->conex;
$con2 = new Conexion(); $con2->conectar("crm"); $cnn2 = $con2->conex;
$con3 = new Conexion(); $con3->conectar("crm"); $cnn3 = $con3->conex;
$con4 = new Conexion(); $con4->conectar("crm"); $cnn4 = $con4->conex;
$con5 = new Conexion(); $con5->conectar("crm"); $cnn5 = $con5->conex;
$con6 = new Conexion(); $con6->conectar("crm"); $cnn6 = $con6->conex;
$con7 = new Conexion(); $con7->conectar("crm"); $cnn7 = $con7->conex;
$con8 = new Conexion(); $con8->conectar("crm"); $cnn8 = $con8->conex;
