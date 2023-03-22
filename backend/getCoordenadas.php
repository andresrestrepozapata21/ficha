<?php
include("conexion.php");

$sentencia = "SELECT latitud AS lat, longitud AS lng, dg.nombre_sede, dg.direccion_sede, dg.zona, dg.codigo_dane_sede, dg.departamento,  dg.municipio, dg.sede_id, dg.total_matricula, dg.nombre_EE FROM datos_generales dg INNER JOIN georeferenciaciones g ON dg.codigo_dane_sede=g.codigo_dane_sede WHERE dg.municipio LIKE 'SDAD'";
$resultado = mysqli_query($conn, $sentencia);

$filas = array();
while ($valor = mysqli_fetch_assoc($resultado)) {
    $filas[] = $valor;
}


echo json_encode($filas, JSON_NUMERIC_CHECK);
// But for this demo let return decoded data
http_response_code(200);
//echo json_encode(array('sql'=> $sentencia_listar));
