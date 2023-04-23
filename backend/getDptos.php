<?php

include("conexion.php");

$sql = "SELECT departamento FROM departamentos ORDER BY departamento";
$query = mysqli_query($conn, $sql);

$json = array();
$arrayJson = array();
while($row = mysqli_fetch_assoc($query)){
    $sentencia = "SELECT count(*) cantidad FROM datos_generales WHERE departamento LIKE '" . $row["departamento"] . "'";
    $consulta = mysqli_query($conn, $sentencia);
    $fila = mysqli_fetch_assoc($consulta);

    $row["cantidad"] = $fila["cantidad"];

    $json[] = $row;
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);