<?php
include("backend/conexion.php");

//Calculamos la cantidad de matriculados
$sentenciaEstudiantes = "SELECT total_matricula FROM datos_generales";
$consultaEstudiantes = mysqli_query($conn, $sentenciaEstudiantes);
$contadorEstudiantes = 0;
while ($filaMatriculados = mysqli_fetch_assoc($consultaEstudiantes)) {
    $contadorEstudiantes+=$filaMatriculados["total_matricula"];
}
?>
<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll_estudiantes">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Analítica Estudiantes</h1>
                </span>
            </div>
        </div>

        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Información General de los Estudiantes</h1>
                </span>
            </div>
        </div>
        <!-- Modal de carga -->
        <div id="loading_modal_estudiantes" class="modal_estudiantes">
            <div class="modal_content_estudiantes">
                <div class="loader_estudiantes"></div>
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
                    <h3 class="card-title">Cantidades por Géneros Matriculados en Colombia</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartGenerosEstu" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad por Etnias</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartEtniasEstu" width="100%" height="100%"></canvas>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Interandos en Colombia</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <span class="table-responsive">
                            <canvas class="table-responsive" id="myChartInternadosEstu" width="100%" height="100%"></canvas>
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

<script src="assets/js/graficos_estudiantes.js" type="module"></script>