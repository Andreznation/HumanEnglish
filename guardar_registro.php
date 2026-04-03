<?php
// Conexión a la base de datos MySQL (ajusta usuario/contraseña si necesitas)
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$baseDatos = 'humanenglish';

// Crear conexión
$mysqli = new mysqli($host, $usuario, $contrasena, $baseDatos);

// Verificar conexión
if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Capturar datos del formulario
$nombre = $mysqli->real_escape_string($_POST['nombre'] ?? '');
$celular = $mysqli->real_escape_string($_POST['celular'] ?? '');

if (empty($nombre) || empty($celular)) {
    echo '<p>Por favor completa todos los campos requeridos.</p>';
    exit;
}

// Insertar registro en tabla
$sql = "INSERT INTO registros (nombre, celular, fecha_registro) VALUES ('{$nombre}', '{$celular}', NOW())";

if ($mysqli->query($sql) === TRUE) {
    echo '<h2>Registro exitoso</h2>';
    echo '<p>Gracias por registrarte. Pronto nos pondremos en contacto.</p>';
    echo '<p><a href="registrate_y_agendatuclase.html">Volver al formulario</a></p>';
} else {
    echo '<p>Error al guardar: ' . $mysqli->error . '</p>';
}

$mysqli->close();
?>

<form action="/guardar_registro.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="celular">Celular:</label>
    <input type="text" name="celular" id="celular" required>
    <button type="submit">Guardar</button>
</form>