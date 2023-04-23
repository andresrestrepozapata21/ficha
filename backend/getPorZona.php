<?php

include("conexion.php");

$sql = "SELECT nombre_sede FROM datos_generales WHERE zona='URBANA'";
$query = mysqli_query($conn, $sql);
$urbanas = mysqli_num_rows($query);

$sqlR = "SELECT nombre_sede FROM datos_generales WHERE zona='RURAL'";
$queryR = mysqli_query($conn, $sqlR);
$rurales = mysqli_num_rows($queryR);

$datos = array(
    "urbanas" => $urbanas,
    "rurales" => $rurales,
    
);

echo json_encode($datos, JSON_UNESCAPED_UNICODE);