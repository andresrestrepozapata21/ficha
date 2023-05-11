<?php
include("conexion.php");

$sentencia = "SELECT latitud lat, longitud lng, ig.`Nombre Sede` nombre_sede, ig.`Dirección Sede` direccion_sede, ig.`Zona` zona, ig.`Codigo Dane Sede` codigo_dane_sede, ig.Departamento departamento,  ig.MUNICIPIO municipio, ig.SEDE_ID sede_id, ig.`MATRÍCULA TOTAL` total_matricula, ig.`Nombre EE` nombre_EE FROM datos_generales ig INNER JOIN georeferenciaciones g ON ig.`Codigo Dane Sede`=g.codigo_dane_sede WHERE ig.MUNICIPIO LIKE 'SDAD'";
$resultado = mysqli_query($conn, $sentencia);

$filas = array();
while ($valor = mysqli_fetch_assoc($resultado)) {
    $filas[] = $valor;
}


echo json_encode($filas, JSON_NUMERIC_CHECK);
// But for this demo let return decoded data
http_response_code(200);
//echo json_encode(array('sql'=> $sentencia_listar));
