<?php
session_start();
$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "universidad_bogota_nueva";

$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);

if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}

// PROCESAR REGISTRO
if(isset($_POST['Registrarse'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $cedula = mysqli_real_escape_string($enlace, $_POST['cedula']);
    $usuario = mysqli_real_escape_string($enlace, $_POST['usuario']);
    $sexo = mysqli_real_escape_string($enlace, $_POST['sexo']);
    $fecha_nacimiento = mysqli_real_escape_string($enlace, $_POST['fecha_nacimiento']);
    $direccion = mysqli_real_escape_string($enlace, $_POST['direccion']);
    $telefono = mysqli_real_escape_string($enlace, $_POST['telefono']);
    $email = mysqli_real_escape_string($enlace, $_POST['email']);
    $contrasena = mysqli_real_escape_string($enlace, $_POST['contrasena']);
    $carrera = mysqli_real_escape_string($enlace, $_POST['carrera']);
    $materias_seleccionadas = $_POST['materias_seleccionadas'];

    // Validar que seleccionó exactamente 3 materias
    $materias_array = explode(',', $materias_seleccionadas);
    $materias_array = array_filter($materias_array); // Eliminar elementos vacíos
    
    if (count($materias_array) !== 3) {
        echo "<script>alert('Debes seleccionar exactamente 3 materias');</script>";
    } else {
        // 1. Insertar estudiante
        $insertarEstudiante = "INSERT INTO registro (nombre, cedula, usuario, sexo, fecha_nacimiento, direccion, telefono, email, contrasena, carrera) 
                              VALUES ('$nombre', '$cedula', '$usuario', '$sexo', '$fecha_nacimiento', '$direccion', '$telefono', '$email', '$contrasena', '$carrera')";
        
        $ejecutarInsertar = mysqli_query($enlace, $insertarEstudiante);
        
        if($ejecutarInsertar) {
            $estudiante_id = mysqli_insert_id($enlace);
            
            // 2. Insertar materias seleccionadas
            foreach($materias_array as $materia_id) {
                if (!empty($materia_id)) {
                    $insertarMateria = "INSERT INTO estudiante_materias (estudiante_id, materia_id) 
                                       VALUES ('$estudiante_id', '$materia_id')";
                    mysqli_query($enlace, $insertarMateria);
                    
                    // 3. Crear tarea por defecto para cada materia
                    $id_estudiante_materias = mysqli_insert_id($enlace);
                    $insertarTarea = "INSERT INTO tareas (estudiante_materia_id, nombre_tarea, descripcion, fecha_entrega) 
                                     VALUES ('$id_estudiante_materias', 'Tarea 1', 'Primera tarea del curso', DATE_ADD(NOW(), INTERVAL 7 DAY))";
                    mysqli_query($enlace, $insertarTarea);
                }
            }
            
            echo "<script>alert('Registro exitoso. Materias inscritas correctamente.');</script>";
            echo "<script>window.location.href = 'iniciarsesion.php';</script>";
        } else {
            echo "<script>alert('Error al registrar datos: " . mysqli_error($enlace) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Universidad de Bogotá</title>
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
            <button onclick="location.href='iniciarsesion.php'">Iniciar Sesión</button>
            <button onclick="location.href='registro.php'">Registrarse</button>
            <button onclick="location.href='programasacademicos.php'">Programas Academicos</button>
            <button onclick="location.href='index.php'">Pagina Principal</button>

            <div class="buscador-sesion">
                <div>
                    <input type="text" placeholder="Buscar...">
                    <button type="button">X</button>
                </div>
            </div>
        </div>
    </div>

    <div class="contenido">
        <div class="titulo-principal">
            <h1>Registro de Usuario Nuevo</h1>
        </div>

        <main>
            <section class="contenido-registro">
                <div class="contenedor-registro">
                    <form action="#" name="universidad_bogota" method="post" class="row g-3">

                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre completo" required>
                        </div>

                        <div class="col-md-6">
                            <label for="cedula" class="form-label">Cédula:</label>
                            <input type="text" class="form-control" name="cedula" placeholder="Número de cédula" required>
                        </div>

                        <div class="col-md-6">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario" required>
                        </div>

                        <div class="col-md-6">
                            <label for="sexo" class="form-label">Sexo:</label>
                            <select class="form-select" name="sexo" required>
                                <option value="">Seleccionar sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" name="fecha_nacimiento" required>
                        </div>

                        <div class="col-md-6">
                            <label for="carrera" class="form-label">Carrera:</label>
                            <select class="form-select" name="carrera" required>
                                <option value="">Seleccionar carrera</option>
                                <option value="sistemas">Ingeniería de Sistemas</option>
                                <option value="civil">Ingeniería Civil</option>
                                <option value="medicina">Medicina</option>                                
                                <option value="derecho">Derecho</option>
                                <option value="administracion">Administración de Empresas</option>
                                <option value="psicologia">Psicologia</option>                                
                                <option value="arquitectura">Arquitectura</option>
                                
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Selecciona 3 Materias:</label>
                            <div class="materias-container" id="materiasContainer">
                                <div class="alert alert-info">
                                    Primero selecciona tu carrera para ver las materias disponibles
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <span id="contadorMaterias">0</span>/3 materias seleccionadas
                                </small>
                            </div>
                            <input type="hidden" name="materias_seleccionadas" id="materiasSeleccionadas">
                        </div>

                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección de residencia:</label>
                            <input type="text" class="form-control" name="direccion" placeholder="Dirección completa" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Número de Teléfono:</label>
                            <input type="text" class="form-control" name="telefono" placeholder="Número de teléfono" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="correo@ejemplo.com" required>
                        </div>

                        <div class="col-md-6">
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
                        </div>

                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <input type="reset" class="btn btn-secondary me-md-2" value="Restablecer">
                                <input type="submit" class="btn btn-primary" name="Registrarse" value="Registrarse">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>

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
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const materiasContainer = document.getElementById('materiasContainer');
            const materiasSeleccionadasInput = document.getElementById('materiasSeleccionadas');
            const contadorMaterias = document.getElementById('contadorMaterias');
            let materiasSeleccionadas = [];

            // Función para cargar materias desde la base de datos
            function cargarMaterias(carrera) {
                if (!carrera) {
                    materiasContainer.innerHTML = '<div class="alert alert-info">Primero selecciona tu carrera</div>';
                    return;
                }

                // Mostrar carga
                materiasContainer.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div><p class="mt-2">Cargando materias...</p></div>';

                
                fetch('obtener_materias.php?carrera=' + encodeURIComponent(carrera))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error HTTP: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(materias => {
                        console.log('Materias recibidas:', materias); // Para ver en consola
                        if (materias.error) {
                            throw new Error(materias.error);
                        }
                        mostrarMaterias(materias);
                    })
                    .catch(error => {
                        console.error('Error completo:', error);
                        materiasContainer.innerHTML = '<div class="alert alert-danger">Error: ' + error.message + '</div>';
                    });
            }

            // Función para mostrar las materias en el grid
            function mostrarMaterias(materias) {
                materiasSeleccionadas = [];
                actualizarInputMaterias();
                
                if (materias.length === 0) {
                    materiasContainer.innerHTML = '<div class="alert alert-warning">No hay materias disponibles para esta carrera</div>';
                    return;
                }

                const grid = document.createElement('div');
                grid.className = 'materias-grid';

                materias.forEach(materia => {
                    const card = document.createElement('div');
                    card.className = 'materia-card';
                    card.dataset.materiaId = materia.id_materia;
                    
                    card.innerHTML = `
                        <div class="materia-info">
                            <h5>${materia.nombre_materia}</h5>
                            <div class="codigo">${materia.codigo_materia}</div>
                            <div class="creditos">${materia.creditos_materia} créditos</div>
                        </div>
                    `;

                    card.addEventListener('click', function() {
                        toggleSeleccionMateria(materia.id_materia, card);
                    });

                    grid.appendChild(card);
                });

                materiasContainer.innerHTML = '';
                materiasContainer.appendChild(grid);
            }

            // Función para seleccionar/deseleccionar materia
            function toggleSeleccionMateria(materiaId, card) {
                if (card.classList.contains('disabled') && !card.classList.contains('selected')) {
                    return;
                }

                const index = materiasSeleccionadas.indexOf(materiaId);
                
                if (index > -1) {
                    // Deseleccionar
                    card.classList.remove('selected');
                    materiasSeleccionadas.splice(index, 1);
                } else {
                    // Seleccionar (máximo 3)
                    if (materiasSeleccionadas.length < 3) {
                        card.classList.add('selected');
                        materiasSeleccionadas.push(materiaId);
                    }
                }

                actualizarInputMaterias();
                actualizarEstadoMaterias();
            }

            function actualizarInputMaterias() {
                materiasSeleccionadasInput.value = materiasSeleccionadas.join(',');
                contadorMaterias.textContent = materiasSeleccionadas.length;
                
                // Cambiar color del contador
                if (materiasSeleccionadas.length === 3) {
                    contadorMaterias.className = 'text-success fw-bold';
                } else {
                    contadorMaterias.className = 'text-warning fw-bold';
                }
            }

            function actualizarEstadoMaterias() {
                const cards = document.querySelectorAll('.materia-card');
                const maxSeleccionadas = materiasSeleccionadas.length >= 3;
                
                cards.forEach(card => {
                    const isSelected = card.classList.contains('selected');
                    card.classList.toggle('disabled', maxSeleccionadas && !isSelected);
                });
            }

            // Escuchar cambios en el select de carrera
            const selectCarrera = document.querySelector('select[name="carrera"]');
            selectCarrera.addEventListener('change', function() {
                cargarMaterias(this.value);
            });

            // Cargar materias si ya hay una carrera seleccionada (en caso de error en el formulario)
            if (selectCarrera.value) {
                cargarMaterias(selectCarrera.value);
            }

            // Validar confirmación de contraseña
            const contrasenaInput = document.querySelector('input[name="contrasena"]');
            const confirmarContrasenaInput = document.querySelector('input[name="confirmar_contrasena"]');
            
            function validarContrasenas() {
                if (contrasenaInput.value !== confirmarContrasenaInput.value) {
                    confirmarContrasenaInput.setCustomValidity('Las contraseñas no coinciden');
                } else {
                    confirmarContrasenaInput.setCustomValidity('');
                }
            }

            contrasenaInput.addEventListener('input', validarContrasenas);
            confirmarContrasenaInput.addEventListener('input', validarContrasenas);
        });
    </script>
</body>
</html>


