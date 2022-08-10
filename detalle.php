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
                    <div class="card p-3">
                        <div class="card-body">
                        <a href="./admin.php?tab=trabajos"><i class="fa-solid fa-arrow-left"></i></a>
                        <?Php
                                require_once 'conector.php';
                                $conn = new Conector();
                                $result = $conn->mostrarListadoID($_GET['trabajoID']);
                                $row = $result->fetch_assoc();
                                echo '  
                                        <h1 class="card-title h3 text-center">Patente: '.$row['patente'].'</h1>
                                        <hr class="subwarning">
                                        <h2 class="card-subtitle mt-md-4 text-center h5">Marca: '.$row['marca'].'</h2>
                                        <hr class="subwarning" style=" margin-left: 50%;">
                                        <div class="row d-flex mt-md-5">
                                            <div class="col-12 col-md-3">
                                            <h1 class="h6 text-center card-subtitle mt-md-0 mt-2 mb-3">Nombre: '.$row['nombre'].'</h1>
                                            <h2 class="card-subtitle mb-2 text-center h6">Telefono: '.$row['telefono'].'</h2>
                                            </div>
                                            <div class="col-12 col-md-3">
                                            <h1 class="h6 text-center card-subtitle mt-md-0 mt-2 mb-3">Precio: $'.$row['precio'].'</h1>
                                            <h2 class="card-subtitle mb-2 text-center h6">Reparacion: '.$row['reparacion'].'</h2>
                                            </div>
                                            <div class="col-12 col-md-3">
                                            <h1 class="h6 text-center card-subtitle mt-md-0 mt-2 mb-3">Como fue el trabajo: '.$row['clase'].'</h1>
                                            <h2 class="card-subtitle mb-2 text-center h6">Tipo de trabajo: '.$row['estado'].'</h2>
                                            </div>
                                            <div class="col-12 col-md-3">
                                            <h1 class="h6 text-center card-subtitle mt-2 mt-md-0 mb-3">Fecha de entrada: '.$row['fecha_inicio'].'</h1>
                                            <h2 class="card-subtitle mb-2 text-center h6">Fecha de salida: '.$row['fecha_entregado'].'</h2>
                                            </div>
                                        </div>
                                        <p class="card-text mt-5">Descripcion: <br>'.$row['descripcion'].'.</p>
                                        <hr class="subwarning" style=" margin-left:25%;">
                                     ';
                        ?>
                            
                            
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