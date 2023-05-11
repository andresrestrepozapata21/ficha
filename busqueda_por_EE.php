<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Búsqueda por Entidad Territorial</h1>
                </span>
            </div>
        </div>

        <div class="card p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Búsqueda por Nombre de Entidad Territorial</h4>
            </div>
            <div class="table-responsive">
                <form class="col-6 my-3 ml-3 mt-5" id="formEntidad">
                    <label class="">Ingrese el nombre de la Entidad deseada, luego seleccione la Entidad que deseada en la lista que le aparecerá:</label>
                    <br>
                    <input type="hidden" class="form-control" id="cp" name="cp">
                    <input type="text" class="form-control" id="campo" name="campo" placeholder="Ingrese el nombre de la Entidad" required>
                    <button class="btn btn-primary mt-4" type="submit">Buscar</button>
                </form>
            </div>
            <div class="table-responsive col-12 d-flex">
                <div class="col-6">
                    <ul id="lista" class="lista"></ul>
                </div>
                <div class="answer col-6" id="answerEntidad">
                    <div class="px-4">
                        <div class="alert alert-danger col-6" role="alert">
                            Seleccione una Entidad de la lista
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de carga -->
        <div id="loading-modal-entidad" class="modal">
            <div class="modal-content">
                <div class="loader"></div>
            </div>
        </div>

        <div id="contentResultEntidad" style="display: none;">
            <hr>
            <div class="card-deck mb-3">
                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultEntidad">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultEntidad_2">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultEntidad_3">
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
                    <div id="mapInstitucion" class="mapaColombia"></div>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Información de la Entidad Territorial
                    </h4>
                </div>
                <div class="py-4">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Código Dane EE</th>
                                    <th>ID EE</th>
                                    <th>Nombre EE</th>
                                    <th>Código Dane Sede</th>
                                    <th>ID Sede</th>
                                    <th>Nombre Sede</th>
                                    <th>Departamento de la sede</th>
                                    <th>Municipio de la sede</th>
                                    <th>Zona sede</th>
                                    <th>Barrio/Vereda/Corregimiento</th>
                                    <th>Dirección sede</th>
                                    <th>Total Docentes en la sede</th>
                                    <th>Total Matriculados en la sede</th>
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
</div>
<!-- // END drawer-layout -->
</div>

<script src="assets/js/entidadTerritorial.js"></script>