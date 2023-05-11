<?php

include("conexion.php");

$campo = $_POST["campo"];

//$sql = "SELECT codigo_dane_sede, nombre_sede FROM datos_generales WHERE codigo_dane_sede LIKE $campo OR nombre_sede LIKE $campo ORDER BY codigo_dane_sede ASC LIMIT 0, 10";
$sql = "SELECT DISTINCT(MUNICIPIO), `Codigo Dane EE` codigo_dane_EE, `Nombre EE` nombre_EE, Departamento departamento, MUNICIPIO municipio FROM informacion_general WHERE `Nombre EE` LIKE '%$campo%' ORDER BY `Codigo Dane EE` ASC LIMIT 0, 10";
$query = mysqli_query($conn, $sql);

$html = "";

while ($row = $query->fetch_assoc()) {
	$html .= "<li class='item' onclick=\"mostrar('" . $row["codigo_dane_EE"] .  "', '". $row["nombre_EE"] . " - " . $row["departamento"] . " - " . $row["municipio"] . "')\">" . $row["codigo_dane_EE"] . " - " . $row["nombre_EE"] .  " - " . $row["departamento"] . " - " . $row["municipio"] . "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);