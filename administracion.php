<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin Aragon l PLESHMARK</title>
    <link rel="icon" href="img/logo1.png">
    <link rel="stylesheet" href="css/administracion.css">
</head>
<body>
    <?php
    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "pleshmark");

    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        // Si no se conectó, mostrar un mensaje de error
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Realizar una consulta SQL para obtener todos los usuarios
    $consulta = "SELECT * FROM aspirantes";

    // Ejecutar la consulta y almacenar el resultado en la variable $resultado
    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si se envió el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_usuario"])) {
        // Obtener los datos del formulario
        $idUsuario = $_POST["id_usuario"];
        $nombreCompleto = $_POST["nombre_completo"];
        $tipoDocumento = $_POST["tipo_documento"];
        $numeroDocumento = $_POST["numero_documento"];
        $correoElectronico = $_POST["correo_electronico"];
        $telefono = $_POST["telefono"];
        $contrasena = $_POST["contrasena"];
        $estado = $_POST["estado"];

        // Actualizar el usuario en la base de datos
        $consulta = "UPDATE aspirantes SET nombre_completo = '$nombreCompleto', tipo_documento = '$tipoDocumento', numero_documento = '$numeroDocumento', correo_electronico = '$correoElectronico', telefono = '$telefono', contrasena = '$contrasena', estado = '$estado' WHERE id = '$idUsuario'";
        mysqli_query($conexion, $consulta);
    }

    // Verificar si se envió el formulario de eliminación
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_usuario"])) {
        // Obtener el ID del usuario a eliminar
        $idUsuario = $_POST["id_usuario"];

        // Eliminar el usuario de la base de datos
        $consulta = "DELETE FROM aspirantes WHERE id = '$idUsuario'";
        mysqli_query($conexion, $consulta);
    }
    ?>
    <!-- Crear una tabla para mostrar los usuarios -->
    <table id="tabla-usuarios">
        <thead>
            <tr>
                <!-- Definir las columnas de la tabla -->
                <th>Id</th>
                <th>Nombre completo</th>
                <th>Tipo documento</th>
                <th>N° documento</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
                <th>Contraseña</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tbody-usuarios">
            <?php
            // Recorrer el resultado de la consulta y mostrar cada usuario en la tabla
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                // Mostrar cada columna del usuario
                echo "<td>" . $fila['Id'] . "</td>";
                echo "<td>" . $fila['nombre_completo'] . "</td>";
                echo "<td>" . $fila['tipo_documento'] . "</td>";
                echo "<td>" . $fila['numero_documento'] . "</td>";
                echo "<td>" . $fila['correo_electronico'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['contrasena'] . "</td>";
                echo "<td>" . $fila['estado'] . "</td>";
                // Mostrar los botones para editar y eliminar el usuario
                echo "<td><button onclick='mostrarModalEditar(" . $fila['Id'] . ")'>Editar</button> | <button onclick='mostrarModalEliminar(" . $fila['Id'] . ")'>Eliminar</button></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- Ventana modal para editar usuario -->
    <div id="modal-editar" class="modal">
        <!-- Contenido de la ventana modal -->
        <div class="modal-content">
            <!-- Botón para cerrar la ventana modal -->
            <span class="close">&times
<!-- Botón para cerrar la ventana modal -->
<span class="close">&times;</span>
        <!-- Título de la ventana modal -->
        <h2>Editar usuario</h2>
        <!-- Formulario para editar el usuario -->
        <form action="" method="post">
            <!-- Campo para el ID del usuario -->
            <input type="hidden" id="id-usuario-editar" name="id_usuario">
            <!-- Campo para el nombre completo del usuario -->
            <label>Nombre completo:</label>
            <input type="text" id="nombre-completo-editar" name="nombre_completo"><br><br>
            <!-- Campo para el tipo de documento del usuario -->
            <label>Tipo documento:</label>
            <input type="text" id="tipo-documento-editar" name="tipo_documento"><br><br>
            <!-- Campo para el número de documento del usuario -->
            <label>N° documento:</label>
            <input type="text" id="numero-documento-editar" name="numero_documento"><br><br>
            <!-- Campo para el correo electrónico del usuario -->
            <label>Correo electrónico:</label>
            <input type="email" id="correo-electronico-editar" name="correo_electronico"><br><br>
            <!-- Campo para el teléfono del usuario -->
            <label>Teléfono:</label>
            <input type="text" id="telefono-editar" name="telefono"><br><br>
            <!-- Campo para la contraseña del usuario -->
            <label>Contraseña:</label>
            <input type="password" id="contrasena-editar" name="contrasena"><br><br>
            <!-- Campo para el estado del usuario -->
            <label>Estado:</label>
            <select id="estado-editar" name="estado">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select><br><br>
            <!-- Botón para actualizar el usuario -->
            <input type="submit" value="Actualizar" name="editar_usuario">
        </form>
    </div>
</div>
<!-- Ventana modal para eliminar usuario -->
<div id="modal-eliminar" class="modal">
    <!-- Contenido de la ventana modal -->
    <div class="modal-content">
        <!-- Botón para cerrar la ventana modal -->
        <span class="close">&times;</span>
        <!-- Título de la ventana modal -->
        <h2>Eliminar usuario</h2>
        <!-- Mensaje de confirmación para eliminar el usuario -->
        <p>¿Estás seguro de que deseas eliminar al usuario?</p>
        <!-- Botón para eliminar el usuario -->
        <form action="" method="post">
            <input type="hidden" id="id-usuario-eliminar" name="id_usuario">
            <input type="submit" value="Eliminar" name="eliminar_usuario">
        </form>
    </div>
</div>
<script>
    // Obtener los elementos de la página
    var tablaUsuarios = document.getElementById("tabla-usuarios");
    var modalEditar = document.getElementById("modal-editar");
    var modalEliminar = document.getElementById("modal-eliminar");

    // Función para mostrar la modal de editar
    function mostrarModalEditar(idUsuario) {
        // Obtener los datos del usuario
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                // Rellenar los campos de la modal con los datos del usuario
                document.getElementById("id-usuario-editar").value = (respuesta.id);
                document.getElementById("nombre-completo-editar").value = respuesta.nombre_completo;
                document.getElementById("tipo-documento-editar").value = respuesta.tipo_documento;
                document.getElementById("numero-documento-editar").value = respuesta.numero_documento;
                document.getElementById("correo-electronico-editar").value = respuesta.correo_electronico;
                document.getElementById("telefono-editar").value = respuesta.telefono;
                document.getElementById("contrasena-editar").value = respuesta.contrasena;
                document.getElementById("estado-editar").value = respuesta.estado;
                // Mostrar la modal
                modalEditar.style.display = "block";
            }
        };
        xhr.send("id_usuario=" + idUsuario);
    }

    // Función para mostrar la modal de eliminar
    function mostrarModalEliminar(idUsuario) {
    // Mostrar la modal
    modalEliminar.style.display = "block";
    // Rellenar el campo de ID del usuario
    document.getElementById("id-usuario-eliminar").value = idUsuario;
}

</script>
</body>
</html>