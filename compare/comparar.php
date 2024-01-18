<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "csvimport";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener registros diferentes
$sql = "SELECT empleados.empleado
        FROM empleados
        LEFT JOIN members ON empleados.empleado = members.numero_de_empleado
        WHERE members.numero_de_empleado IS NULL";

$result = $conn->query($sql);

// Mostrar resultados en una tabla
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['empleado'] . '</td><td>Detalles aquí</td></tr>';
    }
} else {
    echo '<tr><td colspan="2">No hay registros diferentes</td></tr>';
}

// Cerrar conexión
$conn->close();
?>
