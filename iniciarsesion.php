<?php

    session_start();

    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $basededatos = "universidad_bogota_nueva";

    $enlace = mysqli_connect ($servidor, $usuario, $clave, $basededatos);

    if(!$enlace){
        die("Error de conexion: " . mysqli_connect_error());
    }

    //Iniciar sesión

    if(isset($_POST['iniciar_sesion'])){
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

    // Consulta SQL para verificar usuario y contraseña

    $consulta = "SELECT * FROM registro WHERE usuario = '$usuario' AND contrasena = '$contrasena'";

    $ejecutarConsulta = mysqli_query($enlace, $consulta);
    
    if(mysqli_num_rows($ejecutarConsulta) > 0){
        
        //Usuario y contraseña correctos

        $fila = mysqli_fetch_assoc($ejecutarConsulta);

        //Guardar los datos de sesión

        $_SESSION['usuario'] = $fila['usuario'];
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['email'] = $fila['email'];

        echo "<script>alert('Inicio de sesión exitoso');</script>";
        echo"<script>window.location.href = 'estudiante.php';</script>";
    }

    else{
        //Usuario y contraseña incorrectos

        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }    
}

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

    <div class="contenido">
        <div class="titulo-principal">
            <h1 style="color: black;"> Iniciar Sesión</h1>
        </div>

        <main>
            <section class="contenido-iniciarsesion">
                <div class="contenedor-iniciarsesion">


                    <form action="#" method="post">

                        <label for="nombre">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required><br><br>

                        <label for="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" required><br><br>
                        
                        
                        
                        <input type = "submit" name = "iniciar_sesion" value = "Iniciar Sesión">
                        
                    </form>

            </section>


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

                <!-- Bootstrap JavaScript -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>