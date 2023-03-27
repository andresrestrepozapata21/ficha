<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" id="content_scroll">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Búsqueda por Municipio</h1>
                </span>
            </div>
        </div>

        <div class="card p-2">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title">Seleccione el Municipio</h4>
            </div>
            <div class="table-responsive">
                <form class="col-6 my-3 ml-3 mt-5" id="formMunicipio">
                    <label class="">Seleccione el Departamento</label>
                    <?php
                    $sentenciaDptos = "SELECT * FROM departamentos ORDER BY departamento";
                    $consultaDptos = mysqli_query($conn, $sentenciaDptos);
                    ?>
                    <Select name="dpto" id="dpto" class="form-control">
                        <option value="selecciona">--- Seleccionar ---</option>
                        <?php while ($row = $consultaDptos->fetch_assoc()) { ?>
                            <option value="<?php echo $row['id_departamento']; ?>"><?php echo $row['departamento']; ?></option>
                        <?php } ?>
                    </Select>

                    <div class="mt-3" id="municipios"></div>

                    <button class="btn btn-primary mt-4" type="submit">Buscar</button>
                </form>
            </div>
            <div class="answer px-4" id="answerMunicipio">
                <div class="alert alert-danger col-6" role="alert">
                    Seleccione los Campos Requeridos
                </div>
            </div>
        </div>

        <!-- Modal de carga -->
        <div id="loading-modal" class="modal">
            <div class="modal-content">
                <div class="loader"></div>
            </div>
        </div>

        <hr>
        
        <div class="card-deck">
            <div class="card p-2 pl-3 pr-3">
                <div class="result media justify-items-center align-items-center h-md-100" id="resultMunicipio">
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
                <div id="mapMunicipio" class="mapaColombia"></div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Sedes Educativas por Municipio
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
<!-- // END drawer-layout -->
</div>

<script type="text/javascript">
    $(document).ready(function() {

        recargarLista();

        $('#dpto').change(function() {
            recargarLista();
        });
    });
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "backend/municipios.php",
            data: "departamento=" + $("#dpto").val(),
            success: function(r) {
                $('#municipios').html(r);
            }
        });
    }
</script>