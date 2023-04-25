<?php
include("conexion.php");

$sql = "SELECT DISTINCT grado_escalafon FROM docentes";
$query = mysqli_query($conn, $sql);

$json = array();
while ($row = mysqli_fetch_assoc($query)) {
    $escalafon = $row["grado_escalafon"];
    $sql2 = "SELECT COUNT(grado_escalafon) cantidad FROM docentes WHERE grado_escalafon='$escalafon'";
    $consulta = mysqli_query($conn, $sql2);
    $fila = mysqli_fetch_assoc($consulta);

    $json[$escalafon] = $fila["cantidad"];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
