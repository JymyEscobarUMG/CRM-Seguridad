-- Agregar columna email a las tablas de usuarios

ALTER TABLE administradores ADD COLUMN email VARCHAR(100) AFTER foto_perfil;

ALTER TABLE logincliente ADD COLUMN email VARCHAR(100) AFTER foto_perfil;

-- Actualizar datos de ejemplo (opcional)
UPDATE administradores SET email = CONCAT(nombre_usuario, '@example.com') WHERE email IS NULL;
UPDATE logincliente SET email = CONCAT(nombreusuario, '@example.com') WHERE email IS NULL;