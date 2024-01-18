<?php
if (isset($_POST['submit'])) {
    // Configuración de conexión a la base de datos MySQL
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = 'root';
    $db_name = 'csvimport';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Procesar el archivo Excel
    require 'vendor/autoload.php'; // Asegúrate de instalar la biblioteca PhpSpreadsheet

    $inputFileName = $_FILES['file']['tmp_name'];
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    // Crear la tabla en la base de datos (si no existe)
    $sqlCreateTable = file_get_contents('create_table.sql');
    $conn->multi_query($sqlCreateTable);

    // Insertar datos en la base de datos
    foreach ($sheetData as $row) {
        $nombre = $conn->real_escape_string($row['A']);
        $edad = (int)$row['B'];
        $telefono = $conn->real_escape_string($row['C']);
        $correo = $conn->real_escape_string($row['D']);

        $sqlInsert = "INSERT INTO datos (nombre, edad, telefono, correo) 
                      VALUES ('$nombre', $edad, '$telefono', '$correo')";
        $conn->query($sqlInsert);
    }

    // Mostrar datos en una tabla HTML
    $sqlSelect = "SELECT * FROM datos";
    $result = $conn->query($sqlSelect);
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
}
?>
