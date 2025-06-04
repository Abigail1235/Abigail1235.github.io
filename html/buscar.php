<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Generalmente "localhost"
$username = " root@localhost"; // Tu nombre de usuario de MySQL
$password = "utf8mb4"; // Tu contraseña de MySQL
$database = "style"; // El nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda del formulario
if (isset($_GET['termino_busqueda'])) {
    $termino = $_GET['termino_busqueda'];

    // Escapar el término de búsqueda para prevenir inyección SQL (¡muy importante!)
    $termino_seguro = $conn->real_escape_string($termino);

    // Construir la consulta SQL (ejemplo básico)
    $sql = "SELECT * FROM productos WHERE nombe LIKE '%$termino_seguro%' OR otra_columna LIKE '%$termino_seguro%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Resultados de la búsqueda:</h2>";
        echo "<ul>";
        // Mostrar los resultados
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nombre"] . " - " . $row["precio"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No se encontraron resultados para: " . htmlspecialchars($termino) . "</p>";
    }
}

$conn->close();
?>