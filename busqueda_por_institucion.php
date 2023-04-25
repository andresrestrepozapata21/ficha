<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Búsqueda por Institución</h1>
                </span>
            </div>
        </div>

        <div class="card p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Búsqueda por Nombre de Institución</h4>
            </div>
            <div class="table-responsive">
                <form class="col-6 my-3 ml-3 mt-5" id="formInstitucion">
                    <label class="">Ingrese el nombre de la institución deseada, luego seleccione la institución que deseada en la lista que le aparecerá:</label>
                    <br>
                    <input type="hidden" class="form-control" id="cp" name="cp">
                    <input type="text" class="form-control" id="campo" name="campo" placeholder="Ingrese el nombre de la institución" required>
                    <button class="btn btn-primary mt-4" type="submit">Buscar</button>
                </form>
            </div>
            <div class="table-responsive col-12 d-flex">
                <div class="col-6">
                    <ul id="lista" class="lista"></ul>
                </div>
                <div class="answer col-6" id="answerInsti">
                    <div class="px-4">
                        <div class="alert alert-danger col-6" role="alert">
                            Seleccione una institución de la lista
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de carga -->
        <div id="loading-modal-institution" class="modal">
            <div class="modal-content">
                <div class="loader"></div>
            </div>
        </div>

        <div id="contentResultInstitucion" style="display: none;">
            <hr>
            <div class="card-deck mb-3">
                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultInst">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultInst_2">
                            <i class="material-icons text-success md-48">check_circle</i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-2 pl-3 pr-3">
                        <div class="result media justify-items-center align-items-center h-md-100" id="resultInst_3">
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
                        Información de la Institución
                    </h4>
                </div>
                <div class="py-4">
                    <div class="table-responsive" id="info"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- // END drawer-layout -->
</div>

<script src="assets/js/instituciones.js"></script>