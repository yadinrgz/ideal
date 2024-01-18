<?php
// Configuración de conexión a la base de datos MySQL
$db_host = 'tu_host';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'tu_base_de_datos';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consultar datos desde la base de datos
$sql = "SELECT * FROM datos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Datos</title>
</head>
<body>
    <h2>Datos en la Base de Datos</h2>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['edad'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>
