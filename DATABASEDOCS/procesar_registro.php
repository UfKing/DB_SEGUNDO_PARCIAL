<?php
// Conexión a la base de datos
require_once 'conexion.php';

// Validación si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar datos del formulario
    $nombre = $conex->real_escape_string(trim($_POST['nombre']));
    $correo = $conex->real_escape_string(trim($_POST['correo']));
    $telefono = $conex->real_escape_string(trim($_POST['telefono']));
    $direccion = $conex->real_escape_string(trim($_POST['direccion']));
    $estado = $conex->real_escape_string(trim($_POST['estado']));

    // Preparar la consulta SQL para insertar datos
    $query = $conex->prepare("INSERT INTO usuarios (nombre, correo, telefono, direccion, estado) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssss", $nombre, $correo, $telefono, $direccion, $estado);

    // Ejecutar la consulta
    if ($query->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error al registrar: " . $conex->error;
    }

    // Cerrar la consulta y la conexión
    $query->close();
    $conex->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
