<?php
require_once './conector.php';

$conn = new Conector();
$result = $conn->registrarTrabajo($_POST['nombre'],$_POST['telefono'],$_POST['reparacion'],$_POST['precio'],$_POST['descripcion'],$_POST['clase'],$_POST['estado'],$_POST['patente'],$_POST['marca']);


header('Location: /admin.php?tab=registro');