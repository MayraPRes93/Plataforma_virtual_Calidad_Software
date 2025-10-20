<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "universidad_bogota";

$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);

if (!$enlace) {
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

if (isset($_GET['carrera'])) {
    $carrera = mysqli_real_escape_string($enlace, $_GET['carrera']);
    
    // CONSULTA CON NOMBRES CORRECTOS
    $consulta = "SELECT id_materia, codigo_materia, nombre_materia, creditos_materia 
                 FROM materias 
                 WHERE carrera = '$carrera' 
                 ORDER BY codigo_materia";
    
    $resultado = mysqli_query($enlace, $consulta);
    
    if (!$resultado) {
        echo json_encode(['error' => 'Error en la consulta: ' . mysqli_error($enlace)]);
        exit;
    }
    
    $materias = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $materias[] = $fila;
    }
    
    echo json_encode($materias);
} else {
    echo json_encode(['error' => 'No se especificó la carrera']);
}

mysqli_close($enlace);
?>