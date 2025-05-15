<?php 
$conexion = mysqli_connect("localhost", "root", "", "pleshmark");

if (!$conexion) {
  die("Conexión fallida: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesion l PLESHMARK</title>
  
  <link rel="stylesheet" href="css/style-pleshmark.css">
  <link rel="icon" href="img/logo1.png">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body id="body">
  <main>
  <div class="contenedor__todo">
  <div class="contenedor__login-register">
    <form action="" method="POST" class="formulario__login">
      <input type="hidden" name="accion" value="login">
      <h2>PLESHMARK</h2>
      <input type="text" placeholder="Correo Electronico" name="correo_electronico" required>
      <input type="password" placeholder="contraseña" name="contrasena" required>
      <button>Entrar</button>
      <button id="register_btn" type="button">Registrarme</button>
    </form>
    <form id="formRegistro" method="POST" class="formulario__register" style="display: none;">
      <input type="hidden" name="accion" value="registro">
      <h2>Registrarse</h2>
      <input type="text" placeholder="Nombre completo" name="nombre_completo" required>
      <select id="tipoDocumento" name="tipo_documento" required class="input-form">
        <option value="">Seleccione un tipo de documento</option>
        <option value="Cédula1">Cédula de ciudadania</option>
        <option value="Cédula2">Cédula de extranjeria</option>
        <option value="Pasaporte">Pasaporte</option>
      </select>
      <input type="text" placeholder="Numero Documento" name="numero_documento" required>
      <input type="text" placeholder="Correo Electronico" name="correo_electronico" required>
      <input type="text" placeholder="Telefono" name="telefono" required>
      <input type="password" placeholder="Contraseña" name="contrasena" required>
      <button>Crear Usuario</button>
      <button id="login_btn" type="button">Iniciar</button>
    </form>
  </div>
</div>
    <header>
      <div class="icon_menu">
        <img src="img/menu.png" alt="" id="btn_open">
      </div>
    </header>
    <div class="menu_side" id="menu_side">
      <div class="name_page">
        <img src="img/page.png" alt="">
        <h3>PLESHMARK</h3>
      </div>
      <div class="options_menu">
        <a href="inicio.php" class="selected">
          <div class="option">
            <img src="img/inicio.png" alt="">
            <h4>Inicio</h4>
          </div>
        </a>
        <a href="#">
          <div class="option">
            <img src="img/pqrs.png" alt="">
            <h4>PQRS</h4>
          </div>
        </a>
        <a href="#">
          <div class="option">
            <img src="img/contacto.png" alt="">
            <h4>Contactanos</h4>
          </div>
        </a>
        <a href="#">
          <div class="option">
            <img src="img/somos.png" alt="">
            <h4> Quines Somos</h4>
          </div>
        </a>
        <a href="#"></a>
        <div class="Pleshmark">
          <h4>@PLESHMARK</h4>
        </div>
      </a>
    </div>
  </div>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (isset($_POST['accion'])) { 
    if ($_POST['accion'] == 'login') { 
      $correo_electronico = $_POST['correo_electronico']; 
      $contrasena = $_POST['contrasena']; 
      $validar_login = mysqli_query($conexion, "SELECT * FROM aspirantes WHERE correo_electronico= '$correo_electronico' and contrasena= '$contrasena'"); 
      if(mysqli_num_rows($validar_login) >0){ 
        header("location: administracion.php"); 
        echo '<script>swal("Bienvenido", "", "error");</script>'; 
        exit; 
      }else if(isset($_POST['correo_electronico']) && isset($_POST['contrasena'])){ 
        echo '<script>swal("Error", "el usuario no existe", "error");</script>'; 
      } 
    } else
      
    if ($_POST['accion'] == 'registro') { 
      $nombre_completo = $_POST['nombre_completo']; 
      $tipo_documento = $_POST['tipo_documento']; 
      $numero_documento = $_POST['numero_documento']; 
      $correo_electronico = $_POST['correo_electronico']; 
      $telefono = $_POST['telefono']; 
      $contrasena = $_POST['contrasena'];  
      $query = "INSERT INTO aspirantes (nombre_completo, tipo_documento, numero_documento, correo_electronico, telefono, contrasena) VALUES (?, ?, ?, ?, ?, ?)"; 
      $stmt = mysqli_prepare($conexion, $query); 
      mysqli_stmt_bind_param($stmt, "ssssss", $nombre_completo, $tipo_documento, $numero_documento, $correo_electronico, $telefono, $contrasena); 
      $ejecutar = mysqli_stmt_execute($stmt); 
      if ($ejecutar) { 
        echo '<script>swal("¡Éxito!", "El usuario se registró correctamente", "success");</script>'; 
      } else { 
        echo '<script>swal("Error", "No se pudo registrar el usuario", "error");</script>'; 
      } 
    } 
  } 
} 
mysqli_close($conexion);
?>
  <script src="script.js"></script>
  </main>
  </body>
  </html>

