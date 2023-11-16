<?php
$conex= mysqli_connect ("localhost", "", "", "Escuela");

if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}
echo "Conexión exitosa";
?>