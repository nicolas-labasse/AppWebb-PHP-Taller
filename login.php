<?php
session_start();
if (isset($_SESSION['isLogged']) && $_SESSION['isLogged'])
    header("Location: admin.php");

if (isset($_POST['usuario'])) {

    require_once 'conector.php';
    $conn = new Conector();

    $result = $conn->login($_POST['usuario'], $_POST['passwd']);
    if ($result->num_rows > 0) {
        $_SESSION['isLogged'] = true;
        header("Location: admin.php");    
    }else {            
        $loginIncorrecto = "El usuario fue dado de baja con fecha ";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<?php require_once 'head.php'; ?>

<body class="fondot">
    <section>
        <div class="container" style="height:100vh">
            <div class="row d-flex align-items-center justify-content-center" style="height: 100%;">
                <div class="col-10 col-lg-4 pb-3 pt-4 shadow-lg">
                    <div class="card">
                        <div class="card-body ">
                            <form action="login.php" method="POST">

                                <div class="text-center mb-5 pt-md-3">
                                    <img src="./images/logo.png" style="width:229; height:58;" alt="">
                                    <h1 class="my-2 mt-md-4" style="font-family: 'Share Tech Mono', monospace;">El Puente</h1>

                                </div>

                                <div class="form-outline mb-4">
                                    <input type="text" name="usuario" class="form-control" required />
                                    <label class="form-label" for="usuario">Usuario</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="passwd" class="form-control" required />
                                    <label class="form-label" for="passwd">Contraseña</label>
                                </div>



                                <div class="text-center">
                                    <input type="submit" class="btn btn-outline-dark" id="registrar" value="Ingresar"
                                        style="width: 80%;" tabindex="-1">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>