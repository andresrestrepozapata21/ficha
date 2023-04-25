<?php
include("backend/conexion.php");

//Calculamos la cantidad de docentes
$sentenciaDocentes = "SELECT count(*) cantidadDocentes FROM docentes";
$consultaDocentes = mysqli_query($conn, $sentenciaDocentes);
$filaDocentes = mysqli_fetch_assoc($consultaDocentes);
$contadorDocentes = $filaDocentes["cantidadDocentes"];
?>
<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll_docentes">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Analítica Docentes</h1>
                </span>
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
        <!-- Modal de carga -->
        <div id="loading_modal_docentes" class="modal_docentes">
            <div class="modal_content_docentes">
                <div class="loader_docentes"></div>
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
                    <h3 class="card-title">Rangos de Edades de los Docentes</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartPie2Docentes" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Docentes por Escalafon</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="escalafonDocentes" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Rangos de Tiempos de Vinculación Transcurrida</h3>
                </div>
                <div class="">
                    <div class="">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="tiempoVinculacionDocentes" width="100%" height="100%"></canvas>
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

<script src="assets/js/graficos_docentes.js" type="module"></script>