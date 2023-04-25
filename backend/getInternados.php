<?php
include("conexion.php");

$sql = "SELECT * FROM internados";
$query = mysqli_query($conn, $sql);

$internado = 0;
$semi_internado = 0;
$ninguno = 0;
$no_reportado = 0;


while ($row = mysqli_fetch_assoc($query)) {
    
    $internado += $row["internado"];
    $semi_internado += $row["semi_internado"];
    $ninguno += $row["ninguno"];
    $no_reportado += $row["no_reportado"];
}

$json = array(
    "internado" => $internado,
    "semi_internado" => $semi_internado,
    "ninguno" => $ninguno,
    "no_reportado" => $no_reportado,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
