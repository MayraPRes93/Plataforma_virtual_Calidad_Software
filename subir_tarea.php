<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "universidad_bogota:nueva";

$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);

if (!$enlace) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo']) && isset($_POST['tarea_id'])) {
    $tarea_id = mysqli_real_escape_string($enlace, $_POST['tarea_id']);
    $usuario_actual = $_SESSION['usuario'];
    
    // Verificar que la tarea pertenece al usuario
    $consulta_verificar = "SELECT t.id_tareas 
                          FROM tareas t
                          JOIN estudiante_materias em ON t.estudiante_materia_id = em.id_estudiante_materias
                          JOIN registro r ON em.estudiante_id = r.id
                          WHERE t.id_tareas = '$tarea_id' AND r.usuario = '$usuario_actual'";
    
    $resultado_verificar = mysqli_query($enlace, $consulta_verificar);
    
    if (mysqli_num_rows($resultado_verificar) === 0) {
        echo json_encode(['success' => false, 'error' => 'Tarea no encontrada o no autorizada']);
        exit;
    }

    $archivo = $_FILES['archivo'];
    
    // Validaciones
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'error' => 'Error al subir el archivo']);
        exit;
    }
    
    // Validar tipo de archivo
    $tipo_permitido = 'application/pdf';
    if ($archivo['type'] !== $tipo_permitido) {
        echo json_encode(['success' => false, 'error' => 'Solo se permiten archivos PDF']);
        exit;
    }
    
    // Validar tamaño (máximo 10MB)
    $tamano_maximo = 10 * 1024 * 1024; // 10MB
    if ($archivo['size'] > $tamano_maximo) {
        echo json_encode(['success' => false, 'error' => 'El archivo no puede ser mayor a 10MB']);
        exit;
    }
    
    // Generar nombre único para el archivo
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombre_archivo = 'tarea_' . $tarea_id . '_' . time() . '.' . $extension;
    $ruta_archivo = 'uploads/' . $nombre_archivo;
    
    // Mover archivo a la carpeta uploads
    if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
        // Actualizar base de datos
        $consulta_actualizar = "UPDATE tareas 
                               SET archivo_pdf = '$nombre_archivo', 
                                   estado = 'entregado',
                                   fecha_entrega = NOW()
                               WHERE id_tareas = '$tarea_id'";
        
        if (mysqli_query($enlace, $consulta_actualizar)) {
            echo json_encode([
                'success' => true, 
                'mensaje' => 'Archivo subido correctamente',
                'archivo' => $nombre_archivo
            ]);
        } else {
            // Si falla la BD, eliminar el archivo
            unlink($ruta_archivo);
            echo json_encode(['success' => false, 'error' => 'Error al actualizar la base de datos']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al guardar el archivo']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
}

mysqli_close($enlace);
?>