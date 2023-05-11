<?php
include("conexion.php");

$data = json_decode(file_get_contents("php://input"));

$cp = $data->cp;

$sentencia = "SELECT latitud AS lat, longitud AS lng, ig.`Nombre Sede` nombre_sede, ig.`Dirección Sede` direccion_sede, ig.`Zona` zona, ig.`Codigo Dane Sede` codigo_dane_sede, ig.Departamento departamento, ig.MUNICIPIO municipio, ig.SEDE_ID sede_id, ig.`MATRÍCULA TOTAL` total_matricula, ig.`Nombre EE` nombre_EE, ig.`Codigo Dane EE` codigo_dane_EE, ig.`EST_ID` est_id, ig.`BARRIO_VEREDA` FROM informacion_general ig INNER JOIN georeferenciaciones g ON ig.`Codigo Dane Sede`=g.codigo_dane_sede WHERE ig.`Codigo Dane EE` = '$cp'";
$resultado = mysqli_query($conn, $sentencia);

$filas = array();
while ($valor = mysqli_fetch_assoc($resultado)) {
    //Miro la cantidad de Docentes por Institucion
    $sentenciaDocentes = "SELECT count(*) cantidad_docentes FROM docentes WHERE codigo_dane = '" . $valor['codigo_dane_sede'] . "'";
    $resultadoDocentes = mysqli_query($conn, $sentenciaDocentes);
    $numero = mysqli_fetch_assoc($resultadoDocentes);
    //Agrego el numero de docentes por sede al arreglo
    $valor["numero_docentes"] = $numero["cantidad_docentes"];
    $filas[] = $valor;
}

echo json_encode($filas, JSON_NUMERIC_CHECK);
// But for this demo let return decoded data
http_response_code(200);
//echo json_encode(array('sql'=> $sentencia_listar));
