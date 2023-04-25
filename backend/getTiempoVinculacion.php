<?php
date_default_timezone_set('America/Bogota');

$fecha_actual = new DateTime();

include("conexion.php");

$sql = "SELECT * FROM docentes";
$query = mysqli_query($conn, $sql);

$rango1 = 0;
$rango2 = 0;
$rango3 = 0;
$rango4 = 0;

while ($row = mysqli_fetch_assoc($query)) {

    $fecha_vinculacion = new DateTime($row["fecha_vinculacion"]);
    $tiempoVinculacion = date_diff($fecha_vinculacion, $fecha_actual);

    if ($tiempoVinculacion->y >= 0 && $tiempoVinculacion->y <= 1) {
        $rango1++;
    } else if ($tiempoVinculacion->y >= 1 && $tiempoVinculacion->y <= 3) {
        $rango2++;
    } else if ($tiempoVinculacion->y >= 3 && $tiempoVinculacion->y <= 6) {
        $rango3++;
    } else if ($tiempoVinculacion->y >= 6) {
        $rango4++;
    }
}

$json = array(
    "rango1" => $rango1,
    "rango2" => $rango2,
    "rango3" => $rango3,
    "rango4" => $rango4,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
