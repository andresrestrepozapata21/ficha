<?php
date_default_timezone_set('America/Bogota');

$fecha_actual = new DateTime();

include("conexion.php");

$sql = "SELECT * FROM docentes";
$query = mysqli_query($conn, $sql);

$rango1 = 0;
$rango2 = 0;
$rango3 = 0;

while ($row = mysqli_fetch_assoc($query)) {

    $fecha_nacimiento = new DateTime($row["fecha_nacimiento"]);
    $edad = date_diff($fecha_nacimiento, $fecha_actual);

    if ($edad->y >= 18 && $edad->y <= 30) {
        $rango1++;
    } else if ($edad->y >= 31 && $edad->y <= 50) {
        $rango2++;
    } else if ($edad->y >= 51) {
        $rango3++;
    }
}

$json = array(
    "rango1" => $rango1,
    "rango2" => $rango2,
    "rango3" => $rango3,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
