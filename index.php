<?php

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $basededatos = "universidad_bogota";

    $enlace = mysqli_connect ($servidor, $usuario, $clave, $basededatos);

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidad de Bogotá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo.css">

</head>

<body>
    <div class="barra-superior">
        <div class="titulo-logo">
            <h1>Universidad de Bogotá D.C.</h1>

            <img src="Imagenes_Universidad/Logo.jpg" alt="Imagen en carpeta" width="100">

        </div>
        <div class="menu-botones">
            <button onclick="location.href='iniciarsesion.php'">Iniciar Sesión</button>
            <button onclick="location.href='registro.php'">Registrarse</button>
            <button onclick="location.href='programasacademicos.php'">Programas Academicos</button>
            <button onclick="location.href='index.php'">Pagina Principal</button>

            <div class="buscador-sesion">
                <a href="registro.html"></a>
                <div>
                    <input type="text" placeholder="Buscar...">
                    <button>X</button>
                </div>
            </div>
        </div>
    </div>

    <!--Carrusel-->

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Imagenes_Universidad/Premiacion.jpg" class="d-block w-100" alt="Premiación">
            </div>
            <div class="carousel-item">
                <img src="Imagenes_Universidad/Profesores.jpeg" class="d-block w-100" alt="Profesores">
            </div>
            <div class="carousel-item">
                <img src="Imagenes_Universidad/Protesis.jpg" class="d-block w-100" alt="Prótesis">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <div class="contenido">
        <div class="columnas">
            <div class="columna">
                <h2> Quiénes Somos</h2>
                <p>
                    En el corazón de Bogotá, donde la tradición se encuentra con la innovación
                    y la energía de una ciudad eternamente joven, nace la Universidad de Bogotá. 
                    Somos más que una institución educativa; somos un ecosistema vivo de ideas, 
                    un puente entre el talento excepcional y el futuro del país.
                </p>

                <p>
                    Nuestra misión es desafiar los límites del conocimiento convencional. 
                    Formamos profesionales con una sólida base académica, pero, sobre todo,
                    con la capacidad crítica, la creatividad y la sensibilidad ética para
                    liderar la transformación social. Creemos en una educación que no solo
                    instruya, sino que inspire; que no solo prepare para el mercado laboral,
                    sino que forje ciudadanos comprometidos con la justicia, la sostenibilidad
                    y el bien común.
                </p>



            </div>

            <div class="columna">
                <h2> Donde estamos Ubicados</h2>

                <p> Bogotá D.C. / Colombia</p>
                <p> Barrio La Candelaria</p>
                <p> Calle 2 # 10 - 97</p>
                <p> Horario de Atención: </p>
                <p> Lunes a Sabados: 7:00 am a 5:00 pm</p>
                

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1447.2878311300856!2d-74.0843151072425!3d4.591737231699953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99038d3e1383%3A0x73b9c4cb94e82432!2sCl.%202%20%231097%2C%20Bogot%C3%A1%2C%20Colombia!5e0!3m2!1ses!2smx!4v1741528234121!5m2!1ses!2smx"
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>

        </div>

    </div>

    <div class="barra-inferior">
        <div class="iconos-redes">
            <div class="red-social">
                <a href="URL_FACEBOOK" target="_blank"><img src="Imagenes_Universidad/facebook.png" alt="Facebook"
                        class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>

            </div>

            <div class="red-social">
                <a href="URL_INSTAGRAM" target="_blank"><img src="Imagenes_Universidad/instragram.jpg" alt="Instagram"
                        class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

            <div class="red-social">
                <a href="URL_TWITTER" target="_blank"><img src="Imagenes_Universidad/x.png" alt="Twitter" class="icono-red"></a>
                <span class="nombre-usuario">UniversidadBogotaEDU</span>
            </div>

        </div>

        <!-- Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>