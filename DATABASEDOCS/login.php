<?php
require_once "conexion.php";

$correo = $_POST["email"];
$password = $_POST["password"];
$loginSuccess = false;


if (!isset($correo) || empty($correo)){
    echo "Olvidaste tu correo, intenta otra vez";
} elseif (!isset($password) || empty($password)) {
    echo "Olvidaste tu contraseña, intenta otra vez";
} else {
    $consulta = "SELECT * FROM usuarios WHERE email = '$correo' AND password = '$password'";
    $resultado = mysqli_query($conex, $consulta);
    $registros = mysqli_num_rows($resultado); 
      
    if ($registros > 0) {
        echo "Bienvenido " . $correo;
        $loginSuccess = true;
    } else {
        echo "Usuario incorrecto";
        $loginSuccess = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Inicio de sesión</title>
</head>
</head>
<body class="d-flex justify-content-center vh-100 align-items-center">
<body class="d-flex justify-content-center vh-100 align-items-center">
<?php
if ($loginSuccess) {
   
    echo '<br>';
    echo '<a href="../lib/formulario.php" class="btn btn-primary mt-3">Buscar datos</a>';
} else {
    echo '<br>';
    echo '<a href="../index.php" class="btn btn-secondary mt-3">Regresar</a>';
}
?>
</body>
</html>














