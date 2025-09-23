<?php
function cargarEnv(string $ruta = __DIR__ . '/.env'): void {
    static $cargado = false;
    if ($cargado) return;

    if (!file_exists($ruta)) {
        throw new RuntimeException("No se encontró el archivo .env en: $ruta");
    }

    $lineas = file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lineas as $linea) {
        $linea = trim($linea);

        // Ignorar líneas vacías o comentarios
        if ($linea === '' || strpos($linea, '#') === 0) continue;

        [$clave, $valor] = array_map('trim', explode('=', $linea, 2));

        // Guardar en variables de entorno
        putenv("$clave=$valor");
        $_ENV[$clave] = $valor;
        $_SERVER[$clave] = $valor;
    }

    $cargado = true;
}

function env(string $key, $default = null) {
    return $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key) ?: $default;
}
