


<?php
require_once 'conexion.php';

// Manejar la solicitud de filtrado si existe
$filtro = '';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['filtro'])) {
    $filtro = $conex->real_escape_string($_GET['filtro']);
}

// Consulta SQL para obtener usuarios
$sql = "SELECT * FROM usuarios";
if (!empty($filtro)) {
    $sql .= " WHERE nombre LIKE '%$filtro%' OR correo LIKE '%$filtro%' OR ciudad LIKE '%$filtro%' OR estado LIKE '%$filtro%'";
}

$resultado = $conex->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuarios Registrados</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Usuarios Registrados</h2>

        <!-- Formulario para filtrar -->
        <form action="usuarios.php" method="get" class="mb-4">
            <input type="text" name="filtro" placeholder="Buscar usuarios" class="form-control" value="<?php echo $filtro; ?>">
            <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
        </form>

        <!-- Tabla para mostrar usuarios -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while($row = $resultado->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nombre']}</td>
                                <td>{$row['correo']}</td>
                                <td>{$row['telefono']}</td>
                                <td>{$row['direccion']}</td>
                                <td>{$row['ciudad']}</td>
                                <td>{$row['estado']}</td>
                                <td>
                                    <a href='editar_usuario.php?id={$row['id']}' class='btn btn-warning'>Editar</a>
                                    <a href='eliminar_usuario.php?id={$row['id']}' class='btn btn-danger'>Eliminar</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No se encontraron usuarios</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
