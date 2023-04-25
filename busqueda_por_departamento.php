<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Búsqueda por Departamento</h1>
                </span>
            </div>
        </div>

        <div class="card p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Seleccione el Departamento</h4>
            </div>
            <div class="table-responsive">
                <form class="col-6 my-3 ml-3 mt-5" id="formDpto">
                    <label class="">Seleccione el Departamento</label>
                    <?php
                    $sentenciaDptos = "SELECT * FROM departamentos ORDER BY departamento";
                    $consultaDptos = mysqli_query($conn, $sentenciaDptos);
                    ?>
                    <Select name="dpto" id="dpto" class="form-control">
                        <option value="selecciona">--- Seleccionar ---</option>
                        <?php while ($row = $consultaDptos->fetch_assoc()) { ?>
                            <option value="<?php echo $row['departamento']; ?>"><?php echo $row['departamento']; ?></option>
                        <?php } ?>
                    </Select>
                    <button class="btn btn-primary mt-4" type="submit">Buscar</button>
                </form>
            </div>
            <div class="answer px-4" id="answerDpto">
                <div class="alert alert-danger col-6" role="alert">
                    Seleccione un Departamento
                </div>
            </div>
        </div>

        <!-- Modal de carga -->
        <div id="loading-modal" class="modal">
            <div class="modal-content">
                <div class="loader"></div>
            </div>
        </div>

        <div id="contentResultDpto" style="display: none;">
            <hr>
            <div class="card-deck mb-3">
                <div class="col-6">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="result">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="result_2">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title">Visor Georeferenciado</h4>
                </div>
                <div class="table-responsive">
                    <div id="mapDpto" class="mapaColombia"></div>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Sedes Educativas por Departamento
                    </h4>
                </div>
                <div class="py-4">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código Dane</th>
                                    <th>ID</th>
                                    <th>Nombre EE</th>
                                    <th>Nombre Sede</th>
                                    <th>Total Matriculados en la sede</th>
                                    <th>Zona sede</th>
                                    <th>Dirección sede</th>
                                    <th>Departamento de la sede</th>
                                    <th>Municipio de la sede</th>
                                    <th>Latitud de la sede</th>
                                    <th>Longitud de la sede</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<!-- // END drawer-layout -->
</div>
<script src="assets/js/dpto.js"></script>
