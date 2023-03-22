<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Busqueda por Institución</h1>
                </span>
            </div>
        </div>

        <div class="card p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Seleccione el Institución</h4>
            </div>
            <div class="table-responsive">
                <form class="col-6 my-3 ml-3 mt-5" id="formInstitucion">
                    <label class="">Seleccione el Institución</label>
                    <br>
                    <input type="text" class="form-control" id="campo" name="campo" placeholder="Ingrese el nombre de la institución" required>
                    <button class="btn btn-primary mt-4" type="submit">Buscar</button>
                </form>
            </div>
            <ul id="lista"></ul>
        </div>


        <div class="card-deck">
            <div class="card p-2 pl-3 pr-3">
                <div class="result media justify-items-center align-items-center h-md-100" id="result">
                    <i class="material-icons text-success md-48">check_circle</i>
                </div>
                <div class="clearfix"></div>
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
    </div>
</div>
</div>
<!-- // END drawer-layout -->
</div>