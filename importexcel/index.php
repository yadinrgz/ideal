<?php
// Load the database configuration file 
include_once 'dbConfig.php';

// Get status message 
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Los datos de los miembros se han importado correctamente...';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Algo salió mal. Por favor, vuelva a intentarlo.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Cargue un archivo Excel válido.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Importar </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Show/hide Excel file upload form -->

</head>




<body style="background:#9CB4CC">

    <div class="container-fluid px-5 pb-2 pt-5">
        <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">



            <!-- Display status message -->
            <!-- <?php if (!empty($statusMsg)) { ?>
<div class="col-xs-12 p-3">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>
 -->

            <!-- Import link -->



            <div class="card rounded-0 mb-3">

                <div class="card-body rounded-0">
                    <div class="container-fluid">
                        <div class="col">
                            <h3>ALTAS Y BAJAS</h3>
                            <p>Este proceso compara las Altas y Bajas entre el documento de Eslabon "B.xlsx" vs "Emlpleado.csv" de INGRESSIO </p>
                            <h4>Instrucciones</h4>

                            <p>
                            <ol>
                                <li>Haga clic en el botón "Seleccionar archivo"</li>

                                <li> Seleccione el documento <strong>"B.xlsx"</strong> obtenido de Eslabon</li>
                                <li>Haga clic en importar</li>
                                <li>Espere a que se muestren los resultados en la tabla</li>
                                <li>Haga clic en siguiente</li>
                            </ol>
                            </p>
                        </div>


                        <form action="importData.php" id="import-form" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">


                                <label for="fileData" class="form-label">Importar documento <strong>"B.xlsx"</strong></label>
                                <input class="form-control" type="file" accept=".xlsx" name="file" id="fileInput" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer py-1">
                    <div class="text-center">
                        <button class="btn btn-primary rounded-pill col-lg-5 col-md-6 col-sm-12 col-xs-12" name="importSubmit" type="submit" form="import-form">Importar</button>
                    </div>
                </div>
            </div>



            <!-- <div class="col-md-12 head">
        <div class="float-end">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Importar Excel</a>
        </div>
    </div> -->
            <!-- Excel file upload form -->
            <!--     <div class="col-md-12" id="importFrm" style="display: none;">
        <form class="row g-3" action="importData.php" method="post" enctype="multipart/form-data">
            <div class="col-auto">
                <label for="fileInput" class="visually-hidden">Archivo</label>
                <input type="file" class="form-control" name="file" id="fileInput" />
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Importar">
            </div>
        </form>
    </div>
 -->
            <!-- Data list table -->

            <div class="card my-2 rounded-0">
                <div class="card-body rounded-0">
                    <div class="container-fluid">
                        <div class="table-responsive">




                        <table class="table table-hovered table-striped table-bordered">
                        <thead>
                  <tr class="bg-gradient bg-primary text-white">
                          <th>#</th>
                                        <th>Empleado</th>
                                        <th>Nombre</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get member rows 
                                    $result = $db->query("SELECT * FROM empleados ORDER BY id DESC");
                                    if ($result->num_rows > 0) {
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['empleado']; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>

                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="7">No se encontrarón colaboradores...</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block btn-ejecutivo"><a href="/compare/" class="text-white">SIGUIENTE</a></button>

                    </div>
                  



</body>

</html>