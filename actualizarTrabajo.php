<?php
require_once 'conector.php';
$conn = new Conector();
$result = $conn->actualizarTrabajo($_POST['id'],$_POST['nombre'],$_POST['telefono'],$_POST['reparacion'],$_POST['precio'],$_POST['descripcion'],$_POST['clase'],$_POST['estado'],$_POST['patente'],$_POST['marca'],$_POST['hoy'],$_POST['hoyf']);
header('Location: /admin.php?tab=trabajos');