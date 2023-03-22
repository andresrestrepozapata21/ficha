<div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable">
    <!-- CONTENT BODY -->

    <div class="container-fluid">
        <div class="p-2">
            <div class="d-md-flex align-items-center justify-content-start">
                <span class="badge mr-md-2">
                    <h1>Busqueda por Departamento</h1>
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
                <div id="mapDpto" class="mapaColombia"></div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- // END drawer-layout -->
</div>