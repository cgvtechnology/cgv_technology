<?php
// Habilitar la depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la base de datos
$servername = "localhost"; // Usualmente 'localhost'
$username = "root"; // Usuario por defecto en XAMPP
$password = ""; // Contraseña por defecto en XAMPP
$dbname = "cgv_technology"; // Asegúrate de que el nombre de la base de datos sea correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar los datos del formulario
    $nombre = $conn->real_escape_string(trim($_POST['name']));
    $correo = $conn->real_escape_string(trim($_POST['email']));
    $problema = $conn->real_escape_string(trim($_POST['problem']));

    // Validar datos
    if (!empty($nombre) && !empty($correo) && !empty($problema)) {
        // Preparar la consulta SQL
        $sql = "INSERT INTO contactos (nombre, correo, problema) VALUES ('$nombre', '$correo', '$problema')";
        
        // Ejecutar la consulta SQL
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Gracias, $nombre. Tu mensaje ha sido guardado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error en la inserción de datos: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'>Por favor, completa todos los campos del formulario.</div>";
    }
}

// Cerrar conexión
$conn->close();
?>