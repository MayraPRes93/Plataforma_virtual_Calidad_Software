<?php

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $basededatos = "universidad_bogota";

    $enlace = mysqli_connect ($servidor, $usuario, $clave, $basededatos);

    
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas Académicos - Universidad de Bogotá</title>
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
            <button onclick="location.href='programasacademicos.php'">Programas Académicos</button>
            <button onclick="location.href='index.php'">Pagina Principal</button>

            <div class="buscador-sesion">
                <div>
                    <input type="text" placeholder="Buscar...">
                    <button type="button">X</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="contenido-programas">
        <div class="titulo-principal">
            <h1>Programas Académicos de Ingeniería</h1>
            <p class="subtitulo">Formamos los profesionales que transformarán el futuro</p>
        </div>

        <!-- Grid de Carreras -->
        <div class="carreras-grid">
            <!-- Ingeniería de Sistemas -->
            <div class="carrera-card">
                <div class="carrera-header">
                    <div class="carrera-icon">
                        <span>💻</span>
                    </div>
                    <div class="carrera-info">
                        <h3>Ingeniería de Sistemas</h3>
                        <span class="carrera-duracion">Duración: 10 semestres</span>
                    </div>
                </div>
                <div class="carrera-body">
                    <p class="carrera-descripcion">
                        Formamos ingenieros capaces de diseñar, desarrollar e implementar soluciones 
                        tecnológicas innovadoras para optimizar procesos y transformar digitalmente 
                        las organizaciones.
                    </p>
                    <div class="carrera-details">
                        <div class="detail-item">
                            <strong>Modalidad:</strong> Presencial
                        </div>
                        <div class="detail-item">
                            <strong>Créditos:</strong> 160
                        </div>
                        <div class="detail-item">
                            <strong>SNIES:</strong> 12345
                        </div>
                    </div>
                    <div class="carrera-enfasis">
                        <h4>Énfasis:</h4>
                        <ul>
                            <li>Desarrollo de Software</li>
                            <li>Inteligencia Artificial</li>
                            <li>Ciberseguridad</li>
                            <li>Base de Datos</li>
                        </ul>
                    </div>
                </div>
                <div class="carrera-footer">
                    <button class="btn-info" onclick="mostrarInfo('sistemas')">Más Información</button>
                    <button class="btn-inscribir" onclick="location.href='registro.html'">Inscribirse</button>
                </div>
            </div>

            <!-- Ingeniería Civil -->
            <div class="carrera-card">
                <div class="carrera-header">
                    <div class="carrera-icon">
                        <span>🏗️</span>
                    </div>
                    <div class="carrera-info">
                        <h3>Ingeniería Civil</h3>
                        <span class="carrera-duracion">Duración: 10 semestres</span>
                    </div>
                </div>
                <div class="carrera-body">
                    <p class="carrera-descripcion">
                        Desarrollamos profesionales capaces de planificar, diseñar y construir 
                        infraestructuras sostenibles que mejoren la calidad de vida de las comunidades.
                    </p>
                    <div class="carrera-details">
                        <div class="detail-item">
                            <strong>Modalidad:</strong> Presencial
                        </div>
                        <div class="detail-item">
                            <strong>Créditos:</strong> 165
                        </div>
                        <div class="detail-item">
                            <strong>SNIES:</strong> 12346
                        </div>
                    </div>
                    <div class="carrera-enfasis">
                        <h4>Énfasis:</h4>
                        <ul>
                            <li>Estructuras y Construcción</li>
                            <li>Vías y Transporte</li>
                            <li>Hidráulica y Ambiental</li>
                            <li>Geotecnia</li>
                        </ul>
                    </div>
                </div>
                <div class="carrera-footer">
                    <button class="btn-info" onclick="mostrarInfo('civil')">Más Información</button>
                    <button class="btn-inscribir" onclick="location.href='registro.html'">Inscribirse</button>
                </div>
            </div>

            <!-- Ingeniería Industrial -->
            <div class="carrera-card">
                <div class="carrera-header">
                    <div class="carrera-icon">
                        <span>🏭</span>
                    </div>
                    <div class="carrera-info">
                        <h3>Ingeniería Industrial</h3>
                        <span class="carrera-duracion">Duración: 10 semestres</span>
                    </div>
                </div>
                <div class="carrera-body">
                    <p class="carrera-descripcion">
                        Formamos ingenieros expertos en optimizar procesos productivos y de servicios 
                        mediante la integración de recursos humanos, tecnológicos y financieros.
                    </p>
                    <div class="carrera-details">
                        <div class="detail-item">
                            <strong>Modalidad:</strong> Presencial
                        </div>
                        <div class="detail-item">
                            <strong>Créditos:</strong> 158
                        </div>
                        <div class="detail-item">
                            <strong>SNIES:</strong> 12347
                        </div>
                    </div>
                    <div class="carrera-enfasis">
                        <h4>Énfasis:</h4>
                        <ul>
                            <li>Gestión de Operaciones</li>
                            <li>Logística y Cadena de Suministro</li>
                            <li>Calidad y Productividad</li>
                            <li>Ergonomía y Seguridad Industrial</li>
                        </ul>
                    </div>
                </div>
                <div class="carrera-footer">
                    <button class="btn-info" onclick="mostrarInfo('industrial')">Más Información</button>
                    <button class="btn-inscribir" onclick="location.href='registro.html'">Inscribirse</button>
                </div>
            </div>

            <!-- Ingeniería Electrónica -->
            <div class="carrera-card">
                <div class="carrera-header">
                    <div class="carrera-icon">
                        <span>🔌</span>
                    </div>
                    <div class="carrera-info">
                        <h3>Ingeniería Electrónica</h3>
                        <span class="carrera-duracion">Duración: 10 semestres</span>
                    </div>
                </div>
                <div class="carrera-body">
                    <p class="carrera-descripcion">
                        Preparamos profesionales para diseñar, implementar y mantener sistemas 
                        electrónicos y de telecomunicaciones que impulsen la innovación tecnológica.
                    </p>
                    <div class="carrera-details">
                        <div class="detail-item">
                            <strong>Modalidad:</strong> Presencial
                        </div>
                        <div class="detail-item">
                            <strong>Créditos:</strong> 162
                        </div>
                        <div class="detail-item">
                            <strong>SNIES:</strong> 12348
                        </div>
                    </div>
                    <div class="carrera-enfasis">
                        <h4>Énfasis:</h4>
                        <ul>
                            <li>Telecomunicaciones</li>
                            <li>Control y Automatización</li>
                            <li>Electrónica de Potencia</li>
                            <li>Internet de las Cosas (IoT)</li>
                        </ul>
                    </div>
                </div>
                <div class="carrera-footer">
                    <button class="btn-info" onclick="mostrarInfo('electronica')">Más Información</button>
                    <button class="btn-inscribir" onclick="location.href='registro.html'">Inscribirse</button>
                </div>
            </div>
        </div>

        <!-- Sección de Información Adicional -->
        <div class="info-adicional">
            <div class="info-card">
                <h3>¿Por qué estudiar en nuestra Universidad?</h3>
                <div class="beneficios-grid">
                    <div class="beneficio">
                        <span class="beneficio-icon">🎓</span>
                        <h4>Profesores Calificados</h4>
                        <p>Contamos con docentes con amplia experiencia académica y profesional</p>
                    </div>
                    <div class="beneficio">
                        <span class="beneficio-icon">🔬</span>
                        <h4>Laboratorios Modernos</h4>
                        <p>Infraestructura tecnológica de última generación para prácticas</p>
                    </div>
                    <div class="beneficio">
                        <span class="beneficio-icon">🌍</span>
                        <h4>Convenios Internacionales</h4>
                        <p>Oportunidades de intercambio y doble titulación</p>
                    </div>
                    <div class="beneficio">
                        <span class="beneficio-icon">💼</span>
                        <h4>Bolsa de Empleo</h4>
                        <p>Convenios con más de 200 empresas para prácticas profesionales</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barra Inferior -->
    <div class="barra-inferior">
        <div class="iconos-redes">
            <div class="red-social">
                <a href="URL_FACEBOOK" target="_blank"><img src="Imagenes_Universidad/facebook.png"
                        alt="Facebook" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

            <div class="red-social">
                <a href="URL_INSTAGRAM" target="_blank"><img src="Imagenes_Universidad/instragram.jpg"
                        alt="Instagram" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

            <div class="red-social">
                <a href="URL_TWITTER" target="_blank"><img src="Imagenes_Universidad/x.png" alt="Twitter"
                        class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function mostrarInfo(carrera) {
            const mensajes = {
                sistemas: "Ingeniería de Sistemas: Programa acreditado de alta calidad. Contamos con laboratorios de inteligencia artificial, ciberseguridad y desarrollo de software.",
                civil: "Ingeniería Civil: Programa con acreditación internacional. Laboratorios de suelos, materiales y estructuras completamente equipados.",
                industrial: "Ingeniería Industrial: Enfoque en industria 4.0 y transformación digital. Prácticas en empresas líderes del sector.",
                electronica: "Ingeniería Electrónica: Especialización en telecomunicaciones 5G y IoT. Convenios con empresas de tecnología."
            };
            
            alert(mensajes[carrera]);
        }

        // Efecto hover para las tarjetas
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.carrera-card');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>