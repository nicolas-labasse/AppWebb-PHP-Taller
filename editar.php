<!doctype html>
<html lang="es">

<?php require_once 'head.php';?>

<body class="fondot">
    <?php require_once 'header.php';
  ?>
   <section style="height: 100vh;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <nav class="nav nav-pills nav-fill">
                                    <li class="list-group-item"><a href="admin.php?tab=registro"
                                            class=" <?php if ($_GET['tab'] == 'registro' || !isset($_GET['tab'])) echo 'active fw-bold';?>">
                                            Registrar Trabajos</a></li>
                                    <li class="list-group-item"><a href="admin.php?tab=trabajos"
                                            class=" <?php if ($_GET['tab'] == 'trabajos' || !isset($_GET['tab'])) echo 'active fw-bold';?>">
                                            Buscar Trabajos</a></li>
                                    <li class="list-group-item"><a href="admin.php?tab=semana"
                                            class=" <?php if ($_GET['tab'] == 'semana' || !isset($_GET['tab'])) echo 'active fw-bold';?>">
                                            Ultimos Trabajos</a></li>
                                </nav>
                            </div>
                            <div class="col-12">
                                <form action="actualizarTrabajo.php" method="POST"
                                    class="<?php echo ($_GET['tab'] == 'registro' || !isset($_GET['tab'])) ? : 'd-none'?> me-5">
                                    <?Php
                                    
                                    require_once 'conector.php';
                                    $conn = new Conector();
                            
                                    $result = $conn->mostrarListadoID($_GET['trabajoID']);
                                    $row = $result->fetch_assoc();
                                    echo '
                                    <div class="row justify-content-center">
                                        <div class="form-outline col-md-4 text-center mt-4 m-0">
                                            <input type="text" id="patente" name="patente" value="'.$row['patente'].'"
                                                class="form-control" />
                                            <label class="form-label" for="patente">Patente</label>
                                        </div>
                                    </div>
                                    <hr class="subwarning">
                                    <div class="row justify-content-center">
                                        <div class="form-outline col-md-4 text-center">
                                            <input type="text" id="marca" name="marca" value="'.$row['marca'].'"
                                                class="form-control" />
                                            <label class="form-label" for="marca">Marca</label>
                                        </div>
                                        <hr class="subwarning" style=" margin-left: 50%;">
                                        <div class="row d-flex mt-md-5">
                                            <div class="col-12 col-md-3">
                                                <div class="form-outline">
                                                    <input type="text" id="nombre" name="nombre"
                                                        value="'.$row['nombre'].'" class="form-control" />
                                                    <label class="form-label" for="nombre">Nombre</label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="text" id="telefono" name="telefono"
                                                        value="'.$row['telefono'].'" class="form-control" />
                                                    <label class="form-label" for="telefono">Telefono</label>
                                                </div>
                                                </h2>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-outline">
                                                    <input type="text" id="precio" name="precio"
                                                        value="'.$row['precio'].'" class="form-control" />
                                                    <label class="form-label" for="precio">Precio</label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="text" id="reparacion" name="reparacion"
                                                        value="'.$row['reparacion'].'" class="form-control" />
                                                    <label class="form-label" for="reparacion">Clase de trabajo</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="form-outline">
                                                    <input type="text" id="clase" name="clase" value="'.$row['clase'].'"
                                                        class="form-control" />
                                                    <label class="form-label" for="clase">Metodo</label>
                                                </div>

                                                <div class="form-outline">
                                                    <input type="text" id="estado" name="estado"
                                                        value="'.$row['estado'].'" class="form-control" />
                                                    <label class="form-label" for="estado">Indicar si es trabajo o
                                                        garantia</label>
                                                </div>

                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="col">
                                                    <div class="form-outline">
                                                        <input type="text" id="hoy" name="hoy"
                                                            value="'.$row['fecha_inicio'].'" class="form-control" />
                                                        <label class="form-label" for="hoy">Fecha de entrada</label>
                                                    </div>
                                                    <div class="form-outline">
                                                        <input type="text" id="hoyf" name="hoyf"
                                                            value="'.$row['fecha_entregado'].'" class="form-control" />
                                                        <label class="form-label" for="hoyf">Fecha de entrega</label>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="form-outline">
                                                <input type="text" id="id" name="id" value="'.$row['id'].'"
                                                    class="form-control " hidden />
                                            </div>
                                            <div class="form-outline mb-4">
                                                <textarea class="form-control" id="descripcion" name="descripcion"
                                                    rows="4">'.$row['descripcion'].'</textarea>
                                                <label class="form-label" for="descripcion">Descripcion</label>
                                            </div>


                                            <input type="submit" class="btn btn-dark" value="Actualizar"
                                                style="width: 100%;" tabindex="-1">
                                       ';
                                     ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <?php require_once 'footer.php'; ?>

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="componentes/slick/slick.min.js"></script>
</body>

</html>