<?php
include("conexion.php");

$sql = "SELECT * FROM consolidado_conectividad";
$query = mysqli_query($conn, $sql);

$conectadas = 0;
$noConectadas = 0;

while ($row = mysqli_fetch_assoc($query)) {
    $estado = $row["estado_actual"];
    if ($estado == "CONECTADO") {
        $conectadas++;
    } else if ($estado == "DESCONECTADO") {
        $noConectadas++;
    }
}

$json = array(
    "conectadas" => $conectadas,
    "noConectadas" => $noConectadas,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
