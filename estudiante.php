<?php
session_start();

// Verifica que el usuario inició sesión
if(!isset($_SESSION['usuario'])){
    header("Location: iniciarsesion.php");
    exit();
}

$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "universidad_bogota_nueva";

$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);

// Obtiene los datos del usuario
$usuario_actual = $_SESSION['usuario'];
$consulta_usuario = "SELECT id, nombre, cedula, email, carrera FROM registro WHERE usuario = '$usuario_actual'";
$resultado = mysqli_query($enlace, $consulta_usuario);
$datos_usuario = mysqli_fetch_assoc($resultado);

// Obtener las materias del estudiante
$estudiante_id = $datos_usuario['id'];
$consulta_materias = "SELECT m.id_materia, m.codigo_materia, m.nombre_materia, m.creditos_materia,
                             em.id_estudiante_materias, t.id_tareas, t.nombre_tarea, t.descripcion, 
                             t.fecha_entrega, t.archivo_pdf, t.estado
                      FROM estudiante_materias em
                      JOIN materias m ON em.materia_id = m.id_materia
                      LEFT JOIN tareas t ON em.id_estudiante_materias = t.estudiante_materia_id
                      WHERE em.estudiante_id = '$estudiante_id'
                      ORDER BY m.codigo_materia";

$resultado_materias = mysqli_query($enlace, $consulta_materias);

$materias_estudiante = [];
while ($materia = mysqli_fetch_assoc($resultado_materias)) {
    $materia_id = $materia['id_materia'];
    
    if (!isset($materias_estudiante[$materia_id])) {
        $materias_estudiante[$materia_id] = [
            'id_materia' => $materia['id_materia'],
            'codigo_materia' => $materia['codigo_materia'],
            'nombre_materia' => $materia['nombre_materia'],
            'creditos_materia' => $materia['creditos_materia'],
            'id_estudiante_materias' => $materia['id_estudiante_materias'],
            'tareas' => []
        ];
    }
    
    // Agregar tarea si existe
    if ($materia['id_tareas']) {
        $materias_estudiante[$materia_id]['tareas'][] = [
            'id_tareas' => $materia['id_tareas'],
            'nombre_tarea' => $materia['nombre_tarea'],
            'descripcion' => $materia['descripcion'],
            'fecha_entrega' => $materia['fecha_entrega'],
            'archivo_pdf' => $materia['archivo_pdf'],
            'estado' => $materia['estado']
        ];
    }
}

// Contar estadísticas
$total_materias = count($materias_estudiante);
$tareas_entregadas = 0;
$tareas_pendientes = 0;

foreach ($materias_estudiante as $materia) {
    foreach ($materia['tareas'] as $tarea) {
        if ($tarea['estado'] === 'entregado' || $tarea['estado'] === 'calificado') {
            $tareas_entregadas++;
        } else {
            $tareas_pendientes++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Estudiantil - Universidad de Bogotá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <div class="barra-superior">
        <div class="titulo-logo">
            <h1>Universidad de Bogotá D.C.</h1>
            <img src="Imagenes_Universidad/Logo.jpg" alt="Logo Universidad" width="100">
        </div>

        <div class="menu-botones">
            <span style="color: black; margin-right: 15px;">
                Bienvenido, <?php echo $datos_usuario['nombre']; ?>
            </span>
            <button onclick="location.href='index.php'">Cerrar Sesión</button>
            <button onclick="location.href='programasacademicos.php'">Programas Academicos</button>

            <div class="buscador-sesion">
                <div>
                    <input type="text" placeholder="Buscar...">
                    <button type="button">X</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido de la pagina -->
    <div class="portal-container">
        <div class="bienvenida-estudiante">
            <div class="estudiante-info">
                <h2 id="bienvenidaTitulo">¡Bienvenido, <?php echo $datos_usuario['nombre']; ?>!</h2>
                <p id="infoEstudiante">Pertenece al programa de <?php echo $datos_usuario['carrera']; ?> | Cédula: <?php echo $datos_usuario['cedula']; ?></p>
            </div>
            <div class="estadisticas-rapidas">
                <div class="estadistica">
                    <span class="numero"><?php echo $total_materias; ?></span>
                    <span class="texto">Materias</span>
                </div>
                <div class="estadistica">
                    <span class="numero"><?php echo $tareas_entregadas; ?></span>
                    <span class="texto">Tareas Entregadas</span>
                </div>
                <div class="estadistica">
                    <span class="numero"><?php echo $tareas_pendientes; ?></span>
                    <span class="texto">Pendientes</span>
                </div>
            </div>
        </div>

        <!-- Sección de Materias en Grid -->
        <div class="materias-section">
            <div class="seccion-header">
                <h3 class="seccion-titulo">Mis Materias</h3>
                <div class="filtros">
                    <button class="filtro-btn active">Todas</button>
                </div>
            </div>

            <div class="materias-grid">
                <?php if (empty($materias_estudiante)): ?>
                    <div class="col-12">
                        <div class="alert alert-info">
                            No tienes materias inscritas. 
                            <a href="registro.php" class="alert-link">Inscríbete en materias</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($materias_estudiante as $materia): ?>
                        <div class="materia-card">
                            <div class="materia-header">
                                <div class="materia-icon">
                                    <span>
                                        <?php 
                                        // Icono según el tipo de materia
                                        $iconos = [
                                            'MAT' => '📊',
                                            'FIS' => '⚡',
                                            'QUI' => '🧪',
                                            'PRO' => '💻',
                                            'BD' => '🗄️',
                                            'RED' => '🌐',
                                            'IS' => '🔧',
                                            'MED' => '🏥',
                                            'DER' => '⚖️',
                                            'ADM' => '📈',
                                            'PSI' => '🧠',
                                            'ARQ' => '🏛️'
                                        ];
                                        
                                        $prefijo = substr($materia['codigo_materia'], 0, 3);
                                        echo $iconos[$prefijo] ?? '📚';
                                        ?>
                                    </span>
                                </div>
                                <div class="materia-info-principal">
                                    <h4 class="materia-title"><?php echo $materia['nombre_materia']; ?></h4>
                                    <span class="materia-codigo"><?php echo $materia['codigo_materia']; ?></span>
                                </div>
                                <div class="materia-badge"><?php echo $materia['creditos_materia']; ?> Créditos</div>
                            </div>

                            <div class="materia-details">
                                <div class="profesor-info">
                                    <strong>Profesor:</strong> Por asignar
                                </div>
                                <div class="horario-info">
                                    <strong>Horario:</strong> Por definir
                                </div>
                                <div class="progreso-tareas">
                                    <?php
                                    $total_tareas = count($materia['tareas']);
                                    $tareas_completadas = 0;
                                    foreach ($materia['tareas'] as $tarea) {
                                        if ($tarea['estado'] === 'entregado' || $tarea['estado'] === 'calificado') {
                                            $tareas_completadas++;
                                        }
                                    }
                                    $porcentaje = $total_tareas > 0 ? ($tareas_completadas / $total_tareas) * 100 : 0;
                                    ?>
                                    <div class="progreso-text">
                                        <span>Progreso: <?php echo $tareas_completadas; ?>/<?php echo $total_tareas; ?> tareas</span>
                                        <span><?php echo round($porcentaje); ?>%</span>
                                    </div>
                                    <div class="progreso-bar">
                                        <div class="progreso-fill" style="width: <?php echo $porcentaje; ?>%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tareas de la materia -->
                            <div class="tareas-lista">
                                <h5 class="tareas-titulo">Tareas del Periodo</h5>
                                
                                <?php if (empty($materia['tareas'])): ?>
                                    <div class="alert alert-light">
                                        No hay tareas asignadas para esta materia.
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($materia['tareas'] as $index => $tarea): ?>
                                        <div class="tarea-item">
                                            <div class="tarea-header">
                                                <div class="tarea-info">
                                                    <span class="tarea-numero">Tarea <?php echo $index + 1; ?></span>
                                                    <span class="tarea-title"><?php echo $tarea['nombre_tarea']; ?></span>
                                                </div>
                                                <span class="tarea-fecha">📅 <?php echo date('d M Y', strtotime($tarea['fecha_entrega'])); ?></span>
                                            </div>
                                            <p class="tarea-descripcion"><?php echo $tarea['descripcion']; ?></p>
                                            <div class="tarea-acciones">
                                                <span class="estado-tarea estado-<?php echo $tarea['estado']; ?>">
                                                    <?php 
                                                    $estados = [
                                                        'pendiente' => 'Pendiente',
                                                        'entregado' => 'Entregado',
                                                        'calificado' => 'Calificado'
                                                    ];
                                                    echo $estados[$tarea['estado']];
                                                    ?>
                                                </span>
                                                <div class="acciones-botones">
                                                    <input type="file" 
                                                           id="tarea<?php echo $tarea['id_tareas']; ?>" 
                                                           accept=".pdf" 
                                                           class="file-input"
                                                           data-tarea-id="<?php echo $tarea['id_tareas']; ?>">
                                                    <label for="tarea<?php echo $tarea['id_tareas']; ?>" class="btn-cargar">
                                                        <?php echo $tarea['archivo_pdf'] ? '🔄 Reemplazar PDF' : '📎 Cargar PDF'; ?>
                                                    </label>
                                                </div>
                                                <span class="archivo-info">
                                                    <?php echo $tarea['archivo_pdf'] ? $tarea['archivo_pdf'] : 'No hay archivo cargado'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Barra Abajo -->
    <div class="barra-inferior">
        <div class="iconos-redes">
            <div class="red-social">
                <a href="URL_FACEBOOK" target="_blank"><img src="Imagenes_Universidad/facebook.png" alt="Facebook" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

            <div class="red-social">
                <a href="URL_INSTAGRAM" target="_blank"><img src="Imagenes_Universidad/instragram.jpg" alt="Instagram" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

            <div class="red-social">
                <a href="URL_TWITTER" target="_blank"><img src="Imagenes_Universidad/x.png" alt="Twitter" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInputs = document.querySelectorAll('.file-input');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const tareaId = this.getAttribute('data-tarea-id');
            const archivo = this.files[0];
            
            if (!archivo) return;
            
            // Validaciones del lado del cliente
            if (archivo.type !== 'application/pdf') {
                alert('Solo se permiten archivos PDF');
                this.value = '';
                return;
            }
            
            if (archivo.size > 10 * 1024 * 1024) { // 10MB
                alert('El archivo no puede ser mayor a 10MB');
                this.value = '';
                return;
            }
            
            // Mostrar carga
            const label = this.nextElementSibling;
            const estadoOriginal = label.textContent;
            label.textContent = '⏳ Subiendo...';
            label.style.opacity = '0.7';
            
            // Preparar formulario para enviar
            const formData = new FormData();
            formData.append('archivo', archivo);
            formData.append('tarea_id', tareaId);
            
            // Enviar archivo al servidor
            fetch('subir_tarea.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar interfaz
                    const archivoInfo = this.closest('.tarea-acciones').querySelector('.archivo-info');
                    const estadoTarea = this.closest('.tarea-acciones').querySelector('.estado-tarea');
                    
                    archivoInfo.textContent = `${archivo.name} (${(archivo.size / 1024 / 1024).toFixed(2)} MB)`;
                    estadoTarea.textContent = 'Entregado';
                    estadoTarea.className = 'estado-tarea estado-entregado';
                    label.textContent = '🔄 Reemplazar PDF';
                    label.style.opacity = '1';
                    
                    // Mostrar mensaje de éxito
                    mostrarMensaje('✅ ' + data.mensaje, 'success');
                    
                    // Actualizar estadísticas (recargar página después de 2 segundos)
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    
                } else {
                    alert('Error: ' + data.error);
                    this.value = '';
                    label.textContent = estadoOriginal;
                    label.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión al subir el archivo');
                this.value = '';
                label.textContent = estadoOriginal;
                label.style.opacity = '1';
            });
        });
    });
    
    // Función para mostrar mensajes
    function mostrarMensaje(mensaje, tipo) {
        // Crear elemento de mensaje
        const mensajeDiv = document.createElement('div');
        mensajeDiv.className = `alert alert-${tipo} alert-dismissible fade show`;
        mensajeDiv.style.position = 'fixed';
        mensajeDiv.style.top = '20px';
        mensajeDiv.style.right = '20px';
        mensajeDiv.style.zIndex = '1000';
        mensajeDiv.style.minWidth = '300px';
        mensajeDiv.innerHTML = `
            ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(mensajeDiv);
        
        // Auto-eliminar después de 5 segundos
        setTimeout(() => {
            if (mensajeDiv.parentNode) {
                mensajeDiv.remove();
            }
        }, 5000);
    }
    
    // Funcionalidad para los filtros
    const filtroBtns = document.querySelectorAll('.filtro-btn');
    filtroBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filtroBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
</body>
</html>