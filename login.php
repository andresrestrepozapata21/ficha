<?php session_start();

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
    exit;
}
require_once 'backend/conexion.php';

$cadena = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login'])) {

    $email = trim($_POST['usuario']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = trim($_POST['contrasena']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $sentencia = "SELECT id_administrador, usuario, contraseña FROM administradores WHERE usuario='$email'";
    $res = mysqli_query($conn, $sentencia);
    $row = mysqli_fetch_array($res);

    if ($row == null) {
        $cadena = '<div class="alert alert-danger alert-dismissable">
        <strong>¡Error!</strong> Correo Incorrecto.
      </div>';
    } else {
        if ($row['contraseña'] == $password) {
            $_SESSION["user"] = $row["usuario"];
            $_SESSION["loggedin"] = true;
            $_SESSION["id_dependencia"] = $row["fk_id_dependencia"];
            header("Location: index.php");
        } else {
            $cadena = '<div class="alert alert-danger alert-dismissable">
            <strong>¡Error!</strong> Contraseña Incorrecta.
          </div>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr" class="theme-default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FICHA ACADÉMICA 2023</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Simplebar -->
    <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="assets/css/themes/default/app.css" rel="stylesheet">
</head>

<body>
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-has-scrolling-region>
        <div class="mdk-drawer-layout__content mdk-header-layout__content--scrollable" style="overflow-y: auto;" data-simplebar data-simplebar-force-enabled="true">


            <div class="container h-vh d-flex justify-content-center align-items-center flex-column">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <span><!-- SVG Logo -->

                        <!-- //End SVG Logo -->
                    </span>
                    <h2 class="ml-2 text-bg mb-0"><strong>Ficha</strong></h2>
                </div>
                <div class="row w-100 justify-content-center">
                    <div class="card card-login mb-3">
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="form-group">
                                    <label>Usuario</label>

                                    <div class="input-group input-group--inline">
                                        <div class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </div>
                                        <input type="text" class="form-control" name="usuario" placeholder="Ingrese su Usuario">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <label>Contraseña</label>
                                        <!--<span class="ml-auto"><a href="forgot-password.html">Forgot password?</a></span>-->
                                    </div>

                                    <div class="input-group input-group--inline">
                                        <div class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </div>
                                        <input type="password" class="form-control" name="contrasena" placeholder="Ingrese su Contraseña">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="btn-login" name="btn-login" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                        <div class="px-4"><?php echo $cadena ?></div>
                    </div>
                </div>

                <!--<div class="d-flex justify-content-center">
                    <span class="mr-2">Don't have an account?</span>
                    <a href="signup.html">Sign Up</a>
                </div>-->
            </div>

        </div>
    </div>
    <div class="footer">
        Copyright &copy;2023
    </div>


    <script>
        (function() {
            'use strict';

            // Self Initialize DOM Factory Components
            domFactory.handler.autoInit();
        });
    </script>
</body>

</html>