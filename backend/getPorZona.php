<?php

include("conexion.php");

$sql = "SELECT `Nombre Sede` FROM informacion_general WHERE Zona='URBANA'";
$query = mysqli_query($conn, $sql);
$urbanas = mysqli_num_rows($query);

$sqlR = "SELECT `Nombre Sede` FROM informacion_general WHERE Zona='RURAL'";
$queryR = mysqli_query($conn, $sqlR);
$rurales = mysqli_num_rows($queryR);

$datos = array(
    "urbanas" => $urbanas,
    "rurales" => $rurales,
    
);

echo json_encode($datos, JSON_UNESCAPED_UNICODE);