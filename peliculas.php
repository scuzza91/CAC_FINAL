<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Películas</title>
    <link rel="stylesheet" href="./style_tabla.css">
</head>
<body>
    <h1>Lista de Películas</h1>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cac_movies";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);

    }

    $sql = "SELECT nombre, director, descripcion, genero, anio, resena, descripcion FROM peliculas";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Director</th><th>Descripción</th><th>Género</th><th>Año</th><th>Reseña</th><th>Descripción</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["nombre"]."</td>";
                echo "<td>".$row["director"]."</td>";
                echo "<td>".$row["descripcion"]."</td>";
                echo "<td>".$row["genero"]."</td>";
                echo "<td>".$row["anio"]."</td>";
                echo "<td>".$row["resena"]."</td>";
                echo "<td>".$row["descripcion"]."</td>"; 
                echo '<td><form method="post"><button type="submit" name="borrar" value="'.$row["id"].'">Borrar</button></form></td>';
                echo "</tr>";
            }
        }
        } else {
            echo "0 resultados";
        }
        
        if(isset($_POST['borrar'])){
            $id = $_POST['id'];
            $sql = "DELETE FROM peliculas WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo "Registro borrado correctamente.";
            } else {
                echo "Error al borrar el registro: " . $conn->error;
            }
        }
        
        $conn->close();
    ?>
    </table>
</body>
</html>