<?php

include("conexion.php");

$campo = $_POST["campo"];

//$sql = "SELECT codigo_dane_sede, nombre_sede FROM datos_generales WHERE codigo_dane_sede LIKE $campo OR nombre_sede LIKE $campo ORDER BY codigo_dane_sede ASC LIMIT 0, 10";
$sql = "SELECT codigo_dane_sede, nombre_sede, departamento, municipio FROM datos_generales WHERE nombre_sede LIKE '%$campo%' ORDER BY codigo_dane_sede ASC LIMIT 0, 10";
$query = mysqli_query($conn, $sql);

$html = "";

while ($row = $query->fetch_assoc()) {
	$html .= "<li class='item' onclick=\"mostrar('" . $row["codigo_dane_sede"] .  "', '". $row["nombre_sede"] . " - " . $row["departamento"] . " - " . $row["municipio"] . "')\">" . $row["codigo_dane_sede"] . " - " . $row["nombre_sede"] .  " - " . $row["departamento"] . " - " . $row["municipio"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);