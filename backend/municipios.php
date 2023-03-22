<?php
include("conexion.php");
$departamento = $_POST['departamento'];

$sql = "SELECT * FROM municipios WHERE departamento_id='" . $departamento . "'";
$resultado = mysqli_query($conn, $sql);

$cadena = '<div class="">
    <label>Selecciona tu Municipio:</label>
    </div>
    <select name="municipio" class="form-control">
    <option value="selecciona">--- Selecciona tu Municipio ---</option>';

while ($row = $resultado->fetch_assoc()) {
    $valor = $row['municipio'];
    $cadena = $cadena . '<option value="' . $valor . '">' . $row['municipio'] . '</option>';
}

echo $cadena . "</select>";
