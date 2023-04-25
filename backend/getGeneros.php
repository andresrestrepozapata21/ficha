<?php
include("conexion.php");

$sql = "SELECT * FROM generos";
$query = mysqli_query($conn, $sql);

$femenino = 0;
$masculino = 0;

while ($row = mysqli_fetch_assoc($query)) {

    $femenino += $row["genero_femenino"];
    $masculino += $row["genero_masculino"];
}

$json = array(
    "femenino" => $femenino,
    "masculino" => $masculino,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
