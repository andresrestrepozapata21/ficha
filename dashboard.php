<?php
include("backend/conexion.php");

//Calculamos la cantidad de instituciones
$sentenciaInstituciones = "SELECT `Nombre Sede` FROM informacion_general";
$consultaInstituciones = mysqli_query($conn, $sentenciaInstituciones);
$contadorInst = 0;
while ($filaInst = mysqli_fetch_assoc($consultaInstituciones)) {
    $contadorInst++;
}

//Calculamos la cantidad de instituciones Urbanas
$sentenciaInstUrbanas = "SELECT `Nombre Sede` FROM informacion_general WHERE Zona='URBANA'";
$consultaInstUrbanas = mysqli_query($conn, $sentenciaInstUrbanas);
$contadorInstUrbanas = 0;
while ($filaInstUr = mysqli_fetch_assoc($consultaInstUrbanas)) {
    $contadorInstUrbanas++;
}

//Calculamos la cantidad de instituciones Rurales
$sentenciaInstRurales = "SELECT `Nombre Sede` FROM informacion_general WHERE Zona='RURAL'";
$consultaInstRurales = mysqli_query($conn, $sentenciaInstRurales);
$contadorInstRurales = 0;
while ($filaInstRu = mysqli_fetch_assoc($consultaInstRurales)) {
    $contadorInstRurales++;
}

//Calculamos la cantidad de docentes
$sentenciaDocentes = "SELECT count(*) cantidadDocentes FROM docentes";
$consultaDocentes = mysqli_query($conn, $sentenciaDocentes);
$filaDocentes = mysqli_fetch_assoc($consultaDocentes);
$contadorDocentes = $filaDocentes["cantidadDocentes"];

//Calculamos la cantidad de matriculados
$sentenciaEstudiantes = "SELECT `MATRÍCULA TOTAL` FROM informacion_general";
$consultaEstudiantes = mysqli_query($conn, $sentenciaEstudiantes);
$contadorEstudiantes = 0;
while ($filaMatriculados = mysqli_fetch_assoc($consultaEstudiantes)) {
    $contadorEstudiantes+=$filaMatriculados["MATRÍCULA TOTAL"];
}

?>
<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll_home">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="card p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge badge-warning mr-md-2">ÚLTIMA FECHA DE ACTUALIZACIÓN</span>
                <span> 25 de Abril de 2023</span>
                <span class="ml-auto">
                    <a href="#"><i class="material-icons align-middle">arrow_forward</i></a>
                </span>
            </div>
        </div>
        <!-- para borrar esto es lo quye hare mañana 
        <div class="card p-2">
            <div class="d-md-flex align-items-center justify-content-start table-responsive">
                <img src="assets/images/lista.PNG" alt="">
            </div>
        </div>-->
        <!-- Modal de carga -->
        <div id="loading_modal_home" class="modal_home">
            <div class="modal_content_home">
                <div class="loader_home"></div>
            </div>
        </div>
        <!-- INFORMACION GENERAL DE LAS INSTITUCIONES -->
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Información General de las Instituciones</h1>
                </span>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Cantidad de Instituciones por Departamento</h3>
            </div>
            <div class="p-4">
                <div class="table-responsive">
                    <span>
                        <canvas class="table-responsive" id="myChart" width="100%" height="30%"></canvas>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-deck">
            <div class="card p-2 pl-3 pr-3">
                <div class="media justify-items-center align-items-center h-md-100">
                    <i class="material-icons text-success md-48">check_circle</i>
                    <div class="media-body pl-2">
                        <h4 class="m-0"><?php echo number_format($contadorInst, 0, ",", "."); ?></h4>
                        <span>Instituciones Totales en Colombia</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card p-2 pl-3 pr-3">
                <div class="media justify-items-center align-items-center h-md-100">
                    <i class="material-icons text-success md-48">check_circle</i>
                    <div class="media-body pl-2">
                        <h4 class="m-0"><?php echo number_format($contadorInstUrbanas, 0, ",", "."); ?></h4>
                        <span>Instituciones Urbanas en Colombia</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card p-2 pl-3 pr-3">
                <div class="media justify-items-center align-items-center h-md-100">
                    <i class="material-icons text-success md-48">check_circle</i>
                    <div class="media-body pl-2">
                        <h4 class="m-0"><?php echo number_format($contadorInstRurales, 0, ",", "."); ?></h4>
                        <span>Instituciones Rurales en Colombia</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card col-12 py-3 d-flex align-items-center justify-content-between flex-row">
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Distribución Urbana y Rural</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Instituciones Conectadas</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartConectadas" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMACION GENERAL DE LOS DOCENTES -->
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Información General de los Docentes</h1>
                </span>
            </div>
        </div>
        <div class="card-deck">
            <div class="card p-2 pl-3 pr-3">
                <div class="media justify-items-center align-items-center h-md-100">
                    <i class="material-icons text-success md-48">check_circle</i>
                    <div class="media-body pl-2">
                        <h4 class="m-0"><?php echo number_format($contadorDocentes, 0, ",", "."); ?></h4>
                        <span>Total de Docentes en Colombia</span>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="card col-12 py-3 d-flex align-items-center justify-content-between flex-row">
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Rangos de Edades en Docentes</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie2" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Rangos Tiempo de Vinculación</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="tiempoVinculacion" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- INFORMACION GENERAL DE LOS ESTUDIANTES -->
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Información General de los Estudiantes</h1>
                </span>
            </div>
        </div>
        <div class="card p-2 pl-3 pr-3">
            <div class="media justify-items-center align-items-center h-md-100">
                <i class="material-icons text-success md-48">check_circle</i>
                <div class="media-body pl-2">
                    <h4 class="m-0"><?php echo number_format($contadorEstudiantes, 0, ",", "."); ?></h4>
                    <span>Total de Estudiantes Matriculados en Colombia</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card col-12 py-3 d-flex align-items-center justify-content-between flex-row">
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Estudiantes por Género Matriculados en Colombia</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartGeneros" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Estudiantes por Etnia</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartEtnias" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Internados en Colombia</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartInternados" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // END drawer-layout -->
</div>

<script src="assets/js/grafico.js" type="module"></script>