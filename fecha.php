<?php
require_once './conector.php';

$conn = new Conector();

$result = $conn->registrarEntrega($_GET['trabajoID']);
header('Location: /admin.php?tab=trabajos');