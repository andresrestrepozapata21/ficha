<?php
include("conexion.php");

$sql = "SELECT * FROM etnias";
$query = mysqli_query($conn, $sql);

$afrodescendientes = 0;
$indigenas = 0;
$wayu = 0;
$negritudes = 0;
$palenquero = 0;
$raizales = 0;
$rom = 0;
$otras_etnias = 0;
$no_aplica = 0;

while ($row = mysqli_fetch_assoc($query)) {
    
    $afrodescendientes += $row["afrodescendientes"];
    $indigenas += $row["indigenas"];
    $wayu += $row["wayu"];
    $negritudes += $row["negritudes"];
    $palenquero += $row["palenquero"];
    $raizales += $row["raizales"];
    $rom += $row["rom"];
    $otras_etnias += $row["otras_etnias"];
    $no_aplica += $row["no_aplica"];
}

$json = array(
    "afrodescendientes" => $afrodescendientes,
    "indigenas" => $indigenas,
    "wayu" => $wayu,
    "palenquero" => $palenquero,
    "negritudes" => $negritudes,
    "raizales" => $raizales,
    "rom" => $rom,
    "otras_etnias" => $otras_etnias,
    "no_aplica" => $no_aplica,
);

echo json_encode($json, JSON_UNESCAPED_UNICODE);
