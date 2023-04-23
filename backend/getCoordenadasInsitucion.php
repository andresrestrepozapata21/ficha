<?php
include("conexion.php");

$data = json_decode(file_get_contents("php://input"));

$cp = $data->cp;

$sentencia = "SELECT latitud AS lat, longitud AS lng, dg.nombre_sede, dg.direccion_sede, dg.zona, dg.codigo_dane_sede, dg.departamento,  dg.municipio, dg.sede_id, dg.total_matricula, dg.nombre_EE FROM datos_generales dg INNER JOIN georeferenciaciones g ON dg.codigo_dane_sede=g.codigo_dane_sede WHERE dg.codigo_dane_sede = '$cp'";
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
