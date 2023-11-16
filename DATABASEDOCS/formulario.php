<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Información de Usuarios</title>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">  <!-- Contenedor centrado -->
        <form action="procesar_registro.php" method="POST" class="mb-4">
            <!-- Selección de Estado -->
            <div class="mb-3">
            <label for="estado">Estado:</label><br>
                    <select id="estado" name="estado" required class="form-select mb-3">
                        <option value="None">Elegir...</option>
                        <option value="aguascalientes">Aguascalientes</option>
                        <option value="baja_california">Baja California</option>
                        <option value="baja_california_sur">Baja California Sur</option>
                        <option value="campeche">Campeche</option>
                        <option value="chiapas">Chiapas</option>
                        <option value="chihuahua">Chihuahua</option>
                        <option value="coahuila">Coahuila</option>
                        <option value="colima">Colima</option>
                        <option value="durango">Durango</option>
                        <option value="estado_de_mexico">Estado de México</option>
                        <option value="guanajuato">Guanajuato</option>
                        <option value="guerrero">Guerrero</option>
                        <option value="hidalgo">Hidalgo</option>
                        <option value="jalisco">Jalisco</option>
                        <option value="michoacan">Michoacán</option>
                        <option value="morelos">Morelos</option>
                        <option value="nayarit">Nayarit</option>
                        <option value="nuevo_leon">Nuevo León</option>
                        <option value="oaxaca">Oaxaca</option>
                        <option value="puebla">Puebla</option>
                        <option value="queretaro">Querétaro</option>
                        <option value="quintana_roo">Quintana Roo</option>
                        <option value="san_luis_potosi">San Luis Potosí</option>
                        <option value="sinaloa">Sinaloa</option>
                        <option value="sonora">Sonora</option>
                        <option value="tabasco">Tabasco</option>
                        <option value="tamaulipas">Tamaulipas</option>
                        <option value="tlaxcala">Tlaxcala</option>
                        <option value="veracruz">Veracruz</option>
                        <option value="yucatan">Yucatán</option>
                        <option value="zacatecas">Zacatecas</option>
                    </select>

<input type="submit" value="Mostrar Resultados" class="btn btn-primary">
        </form>

        <?php
        require_once "conexion.php";  

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estado = $_POST['estado'];

            $ubicacion = "SELECT * FROM usuarios WHERE state = '$estado'";
            $locacion = mysqli_query($conex, $ubicacion);
            $datosgeograficos = mysqli_num_rows($locacion);

            if ($datosgeograficos > 0) {
                echo "Existen " .  $datosgeograficos . " usuarios registrados en " . ucfirst($estado) . ".";
            } else {
                echo "No hay usuarios registrados en " . ucfirst($ciudad) . ", " . ucfirst($estado) . ".";
            }
        }
        ?>
    </div>
</body>
</html>
