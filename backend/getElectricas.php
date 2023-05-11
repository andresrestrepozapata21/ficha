<?php

use function PHPSTORM_META\map;

include("conexion.php");

$sql = "SELECT cuenta_con_servicio FROM servicio_energia";
$query = mysqli_query($conn, $sql);

$sin_informacion = 0;
$si = 0;
$no = 0;

while ($row = mysqli_fetch_assoc($query)) {
    switch ($row["cuenta_con_servicio"]) {
        case 'SIN INFORMACIÓN':
            $sin_informacion++;
            break;
        case 'SI':
            $si++;
            break;
        case 'NO':
            $no++;
            break;
        default:
            # code...
            break;
    }
}

$json = array(
    "sin_informacion" => $sin_informacion,
    "si" => $si,
    "no" => $no
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
