<?php 
session_start();
include_once('db-connect.php');

/**
 * REVISA QUE EL CSV HA SIDO ENVIADO SINO ENVIA ERROR
 */
if(isset($_FILES['fileData']) && !empty($_FILES['fileData']['tmp_name'])){

    // Leer archivo CSV 
    $csv_file = fopen($_FILES['fileData']['tmp_name'], "r"); 

    // Row Iteration
    $rowCount = 0;

    //Data  a insertar en batch 
    $data = [];

    // LEYENDO  CSV POR FILA
    while(($row = fgetcsv($csv_file, 1000, ",")) !== FALSE){
        if($rowCount > 2){
            //SANITIZANDO DATOS
            $numempleado = addslashes($conn->real_escape_string($row[0]));
            $name = addslashes($conn->real_escape_string($row[1]));
            $grupo = addslashes($conn->real_escape_string($row[6]));
            $area = addslashes($conn->real_escape_string($row[7]));
            $departamento = addslashes($conn->real_escape_string($row[9]));
            $puesto = addslashes($conn->real_escape_string($row[11]));

            // ADD DATA DE FILA PARA INSERTAR VALOR
            $data[] =  "('{$numempleado}','{$name}', '{$grupo}', '{$area}', '{$departamento}', '{$puesto}')";
        }
        $rowCount++;
    }

    // Cerrar archivo CSV 
    fclose($csv_file);

    /**
     *Compruebe si hay datos para insertar; de lo contrario, devolverá el error.
     */
    if(count($data) > 0) {
        // Convierta valores de datos de una matriz a una cadena con separador de coma
        $insert_values = implode(", ", $data);

        ///////////////////////
        ///////////////////////
        //MySQL INSERT Statement
        $insert_sql = "INSERT INTO `members` (`numero_de_empleado`,`nombre_completo`, `grupo`, `area`, `departamento`, `puesto`) VALUES {$insert_values}";

        // Execute Insertion
        $insert = $conn->query($insert_sql);

        if($insert){
            // Data Insertion is successful
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Datos importados correctamente.';
        }else{
            // Data Insertion has failed
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = '¡Falla en la importación! Error: '. $conn->error;
        }
    }else{
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'El documento CSV se encuentra vacío.';
    }

}else{
    $_SESSION['status'] = 'error';
    $_SESSION['message'] = 'El archivo CSV no se encuentra.';
}
$conn->close();

header('location: ./');
exit;
?>