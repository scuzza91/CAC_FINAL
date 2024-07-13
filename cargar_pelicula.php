<!DOCTYPE html>
<html>
<head>
    <title>Registro de Película</title>
    <style>
        .success-message {
            background-color: #dff0d8;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cac_movies";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $director = $_POST['director'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $anio = $_POST['anio'];
    $resena = $_POST['resena'];

    $sql = "INSERT INTO peliculas (nombre, director, descripcion, genero, anio, resena) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        $stmt->bind_param("ssssds", $nombre, $director, $descripcion, $genero, $anio, $resena);

        if ($stmt->execute()) {
            echo "<div class='success-message'>Registro de película exitoso</div>";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        die("Error al preparar la consulta: " . $conn->error);
    }
}

$conn->close();
?>

</body>
</html>