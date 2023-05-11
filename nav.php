<?php
include("backend/conexion.php");

$usuario = $_SESSION['user'];

$sentenciaAdministrador = "SELECT * FROM administradores WHERE usuario='$usuario'";
$consultaAdministrador = mysqli_query($conn, $sentenciaAdministrador);
$datosAdministrador = mysqli_fetch_assoc($consultaAdministrador);
?>
<div class="d-flex flex-column position-relative h-100">
    <nav class="navbar navbar-expand-md navbar-light d-print-none fondoLogoMen">
        <a class="navbar-brand" href="index.php">
            <img class="logoMEN" src="./images/logoMEN1.png" />
        </a>

        <!-- END DEMO  COLORS -->
        <button class="navbar-toggler navbar-toggler-right d-md-none d-lg-none" type="button" data-toggle="sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item align-self-center">
                    <div class="nav-link">
                        <div class="navbar--stats" role="group" aria-label="Basic example">
                            FICHA ACADÉMICA V 1.0
                        </div>
                        <div class="btn-group ml-2">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <a href="logout.php" class="btn btn-primary">Cerrar Sesion</a>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-has-scrolling-region>
        <!-- drawer -->
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content fondoMenu">
                <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">
                    <nav class="drawer drawer--dark">
                        <div class="drawer-spacer drawer-spacer-border">
                            <div class="media align-items-center">
                                <img src="<?php echo $datosAdministrador['foto_perfil']; ?>" class="img-fluid rounded-circle mr-2" width="40" alt="" />
                                <div class="media-body" style="line-height: 1.2">
                                    <a href=""><strong><?php echo $datosAdministrador['nombre_administrador']; ?></strong></a>
                                    <div>Administrador</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="index.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text"> Inicio</span>
                                </a>
                            </li>
                        </ul>
                        <!-- HEADING -->
                        <div class="drawer-heading">Búsqueda Georeferenciada</div>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_busqueda_por_departamento.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Búsqueda por Departam.</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_busqueda_por_municipio.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Búsqueda por Municipio</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_busqueda_por_EE.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Búsqueda por Entidad</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_busqueda_por_institucion.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Búsqueda por Institución</span>
                                </a>
                            </li>
                            <!--
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text"> Búsqueda por Territorio</span>
                                </a>
                            </li>
                        -->
                        </ul>
                        <!-- HEADING -->
                        <div class="drawer-heading">Estadísticas</div>
                        <!-- MENU -->
                        <ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_analitica_instituciones.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Analítica Instituciones</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_analitica_docentes.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Analítica Docentes</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item drawer-submenu">
                                <a data-parent="#mainMenu" href="contenedor_analitica_estudiantes.php" data-target="#dashboardMenu" aria-controls="dashboardMenu" aria-expanded="false">
                                    <i class="material-icons">home</i>
                                    <span class="drawer-menu-text">Analítica Estudiantes</span>
                                </a>
                            </li>

                        </ul>

                        <!-- HEADING -->
                        <div class="drawer-heading">Ministerio de Educación</div>
                        <!-- ACTIVITY -->
                        <div class="list-group list-group-flush drawer-activity"></div>
                    </nav>
                </div>
            </div>
        </div>