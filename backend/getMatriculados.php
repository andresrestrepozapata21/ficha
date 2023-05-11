<?php

include("conexion.php");

$sql = "SELECT departamento FROM departamentos ORDER BY departamento";
$query = mysqli_query($conn, $sql);

$json = array();
$arrayJson = array();

while($row = mysqli_fetch_assoc($query)){
    $sentencia = "SELECT total_matricula FROM datos_generales WHERE departamento LIKE '" . $row["departamento"] . "'";
    $consulta = mysqli_query($conn, $sentencia);

    $acumulado = 0;
    while($fila = mysqli_fetch_assoc($consulta)){
        $acumulado += $fila["total_matricula"];
    }
    $json[$row["departamento"]] = $acumulado;
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);