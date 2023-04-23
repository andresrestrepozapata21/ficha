<?php
include("backend/conexion.php");

$sentenciaInstituciones = "SELECT nombre_sede FROM datos_generales";
$consultaInstituciones = mysqli_query($conn, $sentenciaInstituciones);
$contadorInst = 0;
while ($fila = mysqli_fetch_assoc($consultaInstituciones)) {
    $contadorInst++;
}

$sentenciaInstUrbanas = "SELECT nombre_sede FROM datos_generales WHERE zona='URBANA'";
$consultaInstUrbanas = mysqli_query($conn, $sentenciaInstUrbanas);
$contadorInstUrbanas = 0;
while ($fila = mysqli_fetch_assoc($consultaInstUrbanas)) {
    $contadorInstUrbanas++;
}

$sentenciaInstRurales = "SELECT nombre_sede FROM datos_generales WHERE zona='RURAL'";
$consultaInstRurales = mysqli_query($conn, $sentenciaInstRurales);
$contadorInstRurales = 0;
while ($fila = mysqli_fetch_assoc($consultaInstRurales)) {
    $contadorInstRurales++;
}

?>
<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="card p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge badge-warning mr-md-2">ULTIMA FECHA DE ACTUALIZACIÓN</span>
                <span> 23 de Enero de 2023 20:29 </span>
                <span class="ml-auto">
                    <a href="#"><i class="material-icons align-middle">arrow_forward</i></a>
                </span>
            </div>
        </div>
        <!-- para borrar esto es lo quye hare mañana -->
        <div class="card p-2">
            <div class="d-md-flex align-items-center justify-content-start table-responsive">
                <img src="assets/images/lista.PNG" alt="">
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
                    <span >
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
                    <h3 class="card-title">Distribucion Urbana y Rural</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie" width="100%" height="100%"></canvas>
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
        <div class="card col-12 py-3 d-flex align-items-center justify-content-between flex-row">
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Gráfico barras Horizontales</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie2" width="100%" height="100%"></canvas>
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
        <div class="card col-12 py-3 d-flex align-items-center justify-content-between flex-row">
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Gráfico barras Horizontales</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie2" width="100%" height="100%"></canvas>
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