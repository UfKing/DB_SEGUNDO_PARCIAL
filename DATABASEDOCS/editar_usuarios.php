<?php
require_once 'conexion.php';

// Inicia variables para almacenar los datos del usuario
$nombre = $correo = $telefono = $direccion = $estado = "";

// Verificar si se ha pasado un ID por metodo GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conex->real_escape_string($_GET['id']);

    // Obtiene los datos del usuario
    $consulta = $conex->prepare("SELECT * FROM usuarios WHERE id = ?");
    $consulta->bind_param("i", $id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        // Carga los datos en variables
        $nombre = $usuario['nombre'];
        $correo = $usuario['correo'];
        $telefono = $usuario['telefono'];
        $direccion = $usuario['direccion'];
        $estado = $usuario['estado'];
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID de usuario no especificado.";
    exit;
}

// Procesa el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar datos del formulario
    $nombre = $conex->real_escape_string(trim($_POST['nombre']));
    $correo = $conex->real_escape_string(trim($_POST['correo']));
    $telefono = $conex->real_escape_string(trim($_POST['telefono']));
    $direccion = $conex->real_escape_string(trim($_POST['direccion']));
    $estado = $conex->real_escape_string(trim($_POST['estado']));

    // Prepara la consulta SQL para actualizar datos
    $actualizar = $conex->prepare("UPDATE usuarios SET nombre = ?, correo = ?, telefono = ?, direccion = ?, estado = ? WHERE id = ?");
    $actualizar->bind_param("ssssssi", $nombre, $correo, $telefono, $direccion, $estado, $id);

    // Ejecutar la consulta
    if ($actualizar->execute()) {
        echo "Datos actualizados con éxito.";
        // Redireccionar a usuarios.php 
    } else {
        echo "Error al actualizar: " . $conex->error;
    }

    // Cerrar la consulta y la conexión
    $actualizar->close();
    $conex->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>" method="post">
            <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" class="form-control" value="<?php echo $correo; ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono">Teléfono:</label>
                <input type="tel" name="telefono" class="form-control" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado">Estado:</label>
                <input type="text" name="estado" class="form-control" value="<?php echo $estado; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
