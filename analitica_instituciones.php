<?php
include("backend/conexion.php");

//Calculamos la cantidad de instituciones
$sentenciaInstituciones = "SELECT nombre_sede FROM datos_generales";
$consultaInstituciones = mysqli_query($conn, $sentenciaInstituciones);
$contadorInst = 0;
while ($filaInst = mysqli_fetch_assoc($consultaInstituciones)) {
    $contadorInst++;
}

//Calculamos la cantidad de instituciones Urbanas
$sentenciaInstUrbanas = "SELECT nombre_sede FROM datos_generales WHERE zona='URBANA'";
$consultaInstUrbanas = mysqli_query($conn, $sentenciaInstUrbanas);
$contadorInstUrbanas = 0;
while ($filaInstUr = mysqli_fetch_assoc($consultaInstUrbanas)) {
    $contadorInstUrbanas++;
}

//Calculamos la cantidad de instituciones Rurales
$sentenciaInstRurales = "SELECT nombre_sede FROM datos_generales WHERE zona='RURAL'";
$consultaInstRurales = mysqli_query($conn, $sentenciaInstRurales);
$contadorInstRurales = 0;
while ($filaInstRu = mysqli_fetch_assoc($consultaInstRurales)) {
    $contadorInstRurales++;
}
?>
<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll_instituciones">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Analítica Instituciones</h1>
                </span>
            </div>
        </div>
        <!-- Modal de carga -->
        <div id="loading_modal_instituciones" class="modal_instituciones">
            <div class="modal_content_instituciones">
                <div class="loader_instituciones"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Cantidad de Instituciones por Departamento</h3>
            </div>
            <div class="p-4">
                <div class="table-responsive">
                    <span>
                        <canvas class="table-responsive" id="myChartInstituciones" width="100%" height="30%"></canvas>
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
                            <canvas class="table-responsive" id="myChartPieInstituciones" width="100%" height="100%"></canvas>
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
                            <canvas class="table-responsive" id="myChartConectadasInstituciones" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- // END drawer-layout -->
</div>

<script src="assets/js/graficos_institucion.js" type="module"></script>
