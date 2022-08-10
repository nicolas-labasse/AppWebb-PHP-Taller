<!doctype html>
<html lang="es">

<?php require_once 'head.php';?>

<?php
    if (!$_SESSION['isLogged'])
       header("Location: index.php");
?>
<body class="fondot">
    <?php require_once 'headeradmin.php';
    error_reporting(0);
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
                                    <?php if($_GET['tab'] == 'trabajos' || !isset($_GET['tab']))  
                                   echo' <li>
                                   <form action="admin.php?tab=trabajos" method="POST" class="me-5">
                                      <div class="input-group">
                                       <div class="form-outline ms-5">
                                           <input type="text" id="buscar" name="buscar" class="form-control" />
                                       </div>
                                       <button  class="btn btn-primary" type="submit">
                                           <i class="fas fa-search"></i>
                                       </button>
                                      </div>
                                    </form>
                                    </li> ';
                                    ?>
                                </nav>
                            </div>
                            <div class="col-12">
                                <form action="registro.php" method="POST"
                                    class="<?php echo ($_GET['tab'] == 'registro' || !isset($_GET['tab'])) ? : 'd-none'?> me-5">
                                    <div class="row justify-content-center">
                                        <div class="form-outline col-md-4 text-center mt-4 m-0">
                                            <input type="text" id="patente" name="patente" class="form-control" />
                                            <label class="form-label" for="patente">Patente</label>
                                        </div>
                                    </div>
                                    <hr class="subwarning">
                                    <div class="row justify-content-center">
                                        <div class="form-outline col-md-4 text-center">
                                            <input type="text" id="marca" name="marca" class="form-control" />
                                            <label class="form-label" for="marca">Marca</label>
                                        </div>
                                        <hr class="subwarning" style=" margin-left: 50%;">
                                        <div class="row d-flex mt-md-5">
                                            <div class="col-12 col-md-4">
                                                <div class="form-outline">
                                                    <input type="text" id="nombre" name="nombre" class="form-control" />
                                                    <label class="form-label" for="nombre">Nombre</label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="text" id="telefono" name="telefono"
                                                        class="form-control" />
                                                    <label class="form-label" for="telefono">Telefono</label>
                                                </div>
                                                </h2>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-outline">
                                                    <input type="text" id="precio" name="precio" class="form-control" />
                                                    <label class="form-label" for="precio">Precio</label>
                                                </div>
                                                <div class="form-outline">
                                                    <input type="text" id="reparacion" name="reparacion"
                                                        class="form-control" />
                                                    <label class="form-label" for="reparacion">Clase de trabajo</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-outline">
                                                    <input type="text" id="clase" name="clase" class="form-control" />
                                                    <label class="form-label" for="clase">Indicar si fue en mano o con
                                                        auto</label>
                                                </div>

                                                <div class="form-outline">
                                                    <input type="text" id="estado" name="estado" class="form-control" />
                                                    <label class="form-label" for="estado">Indicar si es trabajo o
                                                        garantia</label>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="form-outline mb-4">
                                            <textarea class="form-control" id="descripcion" name="descripcion"
                                                rows="4"></textarea>
                                            <label class="form-label" for="descripcion">Descripcion</label>
                                        </div>


                                        <input type="submit" class="btn btn-dark" value="Registrar" style="width: 100%;"
                                            tabindex="-1">
                                </form>
                            </div><!-- Final div form -->
                            
                            
                            <div
                                class="col-12 table-responsive <?php echo ($_GET['tab'] == 'trabajos' ) ?  'd-block' : 'd-none'?>">
                                <table class="table table-striped table-hover  me-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Reparacion</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Clase</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Patente</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Fecha Entrada</th>
                                            <th scope="col">Fecha Salida</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                     require_once 'conector.php';
                                     require_once 'paginador.php';
                                     $conn = new Conector();
                                     $pagina = $_GET['pag'] ?? 1;
                                     
                                    
                                    if($_POST['buscar'] != null){
                                        $result = $conn->mostrarListadoFechaPaginado($_POST['buscar'],CalcularLimites($pagina,10),10);
                                        $row_cnt = mysqli_num_rows($result); 
                                        if($row_cnt > 0){
                                            $paginacion = Paginador($pagina, $conn->contarTrabajosFecha($_POST['buscar']),10);
                                                   
                                            foreach ($result as $row) {
                                                echo '<tr>';
                                                    echo "<td> {$row['nombre']}";
                                                    echo "<td> {$row['telefono']}";
                                                    echo "<td> {$row['reparacion']}";
                                                    echo "<td> {$row['precio']}";
                                                    echo "<td> {$row['clase']}";
                                                    echo "<td> {$row['estado']}";
                                                    echo "<td> {$row['patente']}";
                                                    echo "<td> {$row['marca']}";
                                                    echo "<td> {$row['fecha_inicio']}";
                                                    if($row['fecha_entregado'] != null){
                                                        echo "<td> {$row['fecha_entregado']}";
                                                    }else{
                                                        echo '<td> <a href="fecha.php?trabajoID='.$row['id'].'" class="fa-solid fa-calendar-plus" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar entrega"></a>';
                                                    }
                                                    echo '<td>
                                                    <a href="detalle.php?trabajoID='.$row['id'].'" class="fa-solid fa-eye" style="text-decoration: none; color: blue;" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalle"></a>
                                                    <a href="editar.php?trabajoID='.$row['id'].'" class="fa-solid fa-pen" style="text-decoration: none; color: green;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Trabajo"></a>
                                                    <a href="borrar.php?trabajoID='.$row['id'].'" class="fa-solid fa-trash-can" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Trabajo"></a>';
                                                    echo "</td>"; 
                                                echo "</tr>";
                                                
                                                }
                                                    echo' 
                                                    </tbody>
                                                    </table>
                                                    <nav aria-label="...">
                                                    <ul class="pagination justify-content-center">

                                                        <li class="page-item '; if(!$paginacion['anterior']) echo 'disabled';  echo'">
                                                            <a class="page-link"
                                                                href="admin.php?tab=trabajos&pag='.($paginacion['anterior']).'"
                                                                aria-label="Anterior">
                                                                <span aria-hidden="true">&laquo;</span>
                                                                
                                                            </a>
                                                        </li>';
                                                                for ($i = 1; $i <= $paginacion['cantidadPaginas']; $i++) {
                                                                    if ($pagina == $i)
                                                                        echo '<li class="page-item active"><span class="page-link">'.($i).'</span></li>';
                                                            
                                                                        else
                                                                        echo '<li class="page-item"><a class="page-link" href="admin.php?tab=trabajos&pag='.($i).'">'.($i).'</a></li>';
                                                                }
                                                        echo '<li class="page-item'; if(!$paginacion['siguiente']) echo 'disabled'; echo'">
                                                            <a class="page-link"
                                                                href="admin.php?tab=trabajos&pag='.($paginacion['siguiente']).'"
                                                                aria-label="Siguiente">
                                                                <span aria-hidden="true">&raquo;</span>
                                                                
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>';

                                        }else{
                                            require_once 'conector.php';
                                            require_once 'paginador.php';
                                            $conn = new Conector();
                                            $result = $conn->mostrarListadoPatenteTelefonoPaginado($_POST['buscar'],CalcularLimites($pagina,10),10);
                                            $paginacion = Paginador($pagina, $conn->contarTrabajosPatenteTelefono($_POST['buscar']),10);
                                                   
                                            foreach ($result as $row) {
                                                echo '<tr>';
                                                    echo "<td> {$row['nombre']}";
                                                    echo "<td> {$row['telefono']}";
                                                    echo "<td> {$row['reparacion']}";
                                                    echo "<td> {$row['precio']}";
                                                    echo "<td> {$row['clase']}";
                                                    echo "<td> {$row['estado']}";
                                                    echo "<td> {$row['patente']}";
                                                    echo "<td> {$row['marca']}";
                                                    echo "<td> {$row['fecha_inicio']}";
                                                    if($row['fecha_entregado'] != null){
                                                        echo "<td> {$row['fecha_entregado']}";
                                                    }else{
                                                        echo '<td> <a href="fecha.php?trabajoID='.$row['id'].'" class="fa-solid fa-calendar-plus" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar entrega"></a>';
                                                    }
                                                    echo '<td>
                                                    <a href="detalle.php?trabajoID='.$row['id'].'" class="fa-solid fa-eye" style="text-decoration: none; color: blue;" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalle"></a>
                                                    <a href="editar.php?trabajoID='.$row['id'].'" class="fa-solid fa-pen" style="text-decoration: none; color: green;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Trabajo"></a>
                                                    <a href="borrar.php?trabajoID='.$row['id'].'" class="fa-solid fa-trash-can" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Trabajo"></a>';
                                                    echo "</td>"; 
                                                echo "</tr>";
                                                
                                                }
                                                    echo' 
                                                    </tbody>
                                                    </table>
                                                    <nav aria-label="...">
                                                    <ul class="pagination justify-content-center">

                                                        <li class="page-item '; if(!$paginacion['anterior']) echo 'disabled';  echo'">
                                                            <a class="page-link"
                                                                href="admin.php?tab=trabajos&pag='.($paginacion['anterior']).'"
                                                                aria-label="Anterior">
                                                                <span aria-hidden="true">&laquo;</span>
                                                                
                                                            </a>
                                                        </li>';
                                                                for ($i = 1; $i <= $paginacion['cantidadPaginas']; $i++) {
                                                                    if ($pagina == $i)
                                                                        echo '<li class="page-item active"><span class="page-link">'.($i).'</span></li>';
                                                            
                                                                        else
                                                                        echo '<li class="page-item"><a class="page-link" href="admin.php?tab=trabajos&pag='.($i).'">'.($i).'</a></li>';
                                                                }
                                                        echo '<li class="page-item'; if(!$paginacion['siguiente']) echo 'disabled'; echo'">
                                                            <a class="page-link"
                                                                href="admin.php?tab=trabajos&pag='.($paginacion['siguiente']).'"
                                                                aria-label="Siguiente">
                                                                <span aria-hidden="true">&raquo;</span>
                                                                
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>';
                                        }
                                       
                                        
                                    }else{
                                                $paginacion1 = Paginador($pagina, $conn->contarTrabajos(),10);
                                                $result = $conn->cargarTrabajosPaginado(CalcularLimites($pagina,10),10);
                                                 foreach ($result as $row) {
                                                     echo '<tr>';
                                                    echo "<td> {$row['nombre']}";
                                                    echo "<td> {$row['telefono']}";
                                                    echo "<td> {$row['reparacion']}";
                                                    echo "<td> {$row['precio']}";
                                                    echo "<td> {$row['clase']}";
                                                    echo "<td> {$row['estado']}";
                                                    echo "<td> {$row['patente']}";
                                                    echo "<td> {$row['marca']}";
                                                    echo "<td> {$row['fecha_inicio']}";
                                                    if($row['fecha_entregado'] != null){
                                                        echo "<td> {$row['fecha_entregado']}";
                                                    }else{
                                                        echo '<td> <a href="fecha.php?trabajoID='.$row['id'].'" class="fa-solid fa-calendar-plus" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar entrega"></a>';
                                                    }
                                                    echo '<td>
                                                    <a href="detalle.php?trabajoID='.$row['id'].'" class="fa-solid fa-eye" style="text-decoration: none; color: blue;" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalle"></a>
                                                    <a href="editar.php?trabajoID='.$row['id'].'" class="fa-solid fa-pen" style="text-decoration: none; color: green;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Trabajo"></a>
                                                    <a href="borrar.php?trabajoID='.$row['id'].'" class="fa-solid fa-trash-can" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Trabajo"></a>';
                                                    echo "</td>"; 
                                                echo "</tr>";
                                                
                                                }
                                                        echo' 
                                                        </tbody>
                                                        </table>
                                                        <nav>
                                                        <ul class="pagination justify-content-center">

                                                            <li class="page-item '; if(!$paginacion1['anterior']) echo 'disabled'; echo'">
                                                                <a class="page-link"
                                                                    href="admin.php?tab=trabajos&pag='.($paginacion1['anterior']).'"
                                                                    aria-label="Anterior">
                                                                    <span aria-hidden="true">&laquo;</span>             
                                                                </a>
                                                            </li>';
                                                                    for ($i = 1; $i <= $paginacion1['cantidadPaginas']; $i++) {
                                                                        if ($pagina == $i)
                                                                            echo '<li class="page-item active"><span class="page-link">'.($i).'</span></li>';
                                                                            else
                                                                            echo '<li class="page-item"><a class="page-link" href="admin.php?tab=trabajos&pag='.($i).'">'.($i).'</a></li>';
                                                                        
                                                                    }
                                                            echo '<li class="page-item'; if(!$paginacion1['siguiente']) echo 'disabled'; echo'">
                                                                <a class="page-link"
                                                                    href="admin.php?tab=trabajos&pag='.($paginacion1['siguiente']).'"
                                                                    aria-label="Siguiente">
                                                                    <span aria-hidden="true">&raquo;</span>
                                                                    
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                    </div>   
                                            ';
                                    }
                                    ?><!-- Final div buscar -->
                        
                        
                        <div
                                class="col-12 table-responsive <?php echo ($_GET['tab'] == 'semana' ) ?  'd-block' : 'd-none'?>">
                                <table class="table table-striped table-hover  me-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Telefono</th>
                                            <th scope="col">Reparacion</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Clase</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Patente</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Fecha Entrada</th>
                                            <th scope="col">Fecha Salida</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            require_once 'conector.php';
                                            require_once 'paginador.php';
                                            $conn = new Conector();
                                            $pagina = $_GET['pag'] ?? 1;
                                            $result = $conn->mostrarListadoSemanaPaginado(CalcularLimites($pagina,10),10);
                                                    foreach ($result as $row) {
                                                        echo '<tr>';
                                                            echo "<td> {$row['nombre']}";
                                                            echo "<td> {$row['telefono']}";
                                                            echo "<td> {$row['reparacion']}";
                                                            echo "<td> {$row['precio']}";
                                                            echo "<td> {$row['clase']}";
                                                            echo "<td> {$row['estado']}";
                                                            echo "<td> {$row['patente']}";
                                                            echo "<td> {$row['marca']}";
                                                            echo "<td> {$row['fecha_inicio']}";
                                                            if($row['fecha_entregado'] != null){
                                                                echo "<td> {$row['fecha_entregado']}";
                                                            }else{
                                                                echo '<td> <a href="fecha.php?trabajoID='.$row['id'].'" class="fa-solid fa-calendar-plus" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Asignar entrega"></a>';
                                                            }
                                                            echo '<td>
                                                            <a href="detalle.php?trabajoID='.$row['id'].'" class="fa-solid fa-eye" style="text-decoration: none; color: blue;" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Detalle"></a>
                                                            <a href="editar.php?trabajoID='.$row['id'].'" class="fa-solid fa-pen" style="text-decoration: none; color: green;" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Trabajo"></a>
                                                            <a href="borrar.php?trabajoID='.$row['id'].'" class="fa-solid fa-trash-can" style="text-decoration: none; color: red;" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Trabajo"></a>';
                                                            echo "</td>"; 
                                                        echo "</tr>";
                                                        
                                                     }

                                                                  
                                            ?>
                                    </tbody>

                                </table>
                                <nav>
                                    <?php
                                 $paginacion = Paginador($pagina, $conn->contarTrabajosSemana(),10);
                                 ?>
                                    <ul class="pagination justify-content-center">

                                        <li class="page-item <?php if(!$paginacion['anterior']) echo 'disabled'?>">
                                            <a class="page-link"
                                                href="admin.php?tab=semana&pag=<?php echo ($paginacion['anterior']) ?>"
                                                aria-label="Anterior">
                                                <span aria-hidden="true">&laquo;</span>
                                                
                                            </a>
                                        </li>

                                        <?php
                                                for ($i = 1; $i <= $paginacion['cantidadPaginas']; $i++) {
                                                    if ($pagina == $i)
                                                        echo '<li class="page-item active"><span class="page-link">'.($i).'</span></li>';
                                                    else
                                                        echo '<li class="page-item"><a class="page-link" href="admin.php?tab=semana&pag='.($i).'">'.($i).'</a></li>';
                                                    
                                                }?>
                                        <li class="page-item <?php if(!$paginacion['siguiente']) echo 'disabled'?>">
                                            <a class="page-link"
                                                href="admin.php?tab=semana&pag=<?php echo ($paginacion['siguiente'])?>"
                                                aria-label="Siguiente">
                                                <span aria-hidden="true">&raquo;</span>
                                                
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        


                        </div>  <!-- Final card body -->
                </div>
            </div>
        </div>
</section>



    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="componentes/slick/slick.min.js"></script>
</body>

</html>