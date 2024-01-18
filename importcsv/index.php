<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Importar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body style="background:#9CB4CC">

  <div class="container-fluid px-5 pb-2 pt-5">
    <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">

      <?php if (isset($_SESSION['status']) && $_SESSION['status'] == "success") : ?>
        <div class="alert alert-success rounded-0 mb-3">
          <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['status']);
        unset($_SESSION['message']) ?>
      <?php endif; ?>
      <?php if (isset($_SESSION['status']) && $_SESSION['status'] == "error") : ?>
        <div class="alert alert-danger rounded-0 mb-3">
          <?= $_SESSION['message'] ?>
        </div>
        <?php unset($_SESSION['status']);
        unset($_SESSION['message']) ?>
      <?php endif; ?>

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

                <li> Seleccione el documento <strong>"empleado.csv"</strong> obtenido de INGRESSIO</li>
                <li>Haga clic en importar</li>
                <li>Espere a que se muestre el mensaje del resultado</li>
                <li>Haga clic en siguiente</li>
              </ol>
              </p>
            </div>


            <form action="import_csv.php" id="import-form" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="fileData" class="form-label">Importar documento <strong>"empleado.csv"</strong></label>
                <input class="form-control" type="file" accept=".csv" name="fileData" id="fileData" required>
              </div>
            </form>
          </div>
        </div>
        <div class="card-footer py-1">
          <div class="text-center">
            <button class="btn btn-primary rounded-pill col-lg-5 col-md-6 col-sm-12 col-xs-12" form="import-form">IMPORTAR</button>
          </div>
        </div>
      </div>



      <div class="card my-2 rounded-0">
        <div class="card-body rounded-0">
          <div class="container-fluid">
            <div class="table-responsive">
              <table class="table table-hovered table-striped table-bordered">
                <thead>
                  <tr class="bg-gradient bg-primary text-white">
                    <th class="text-center">#ID</th>
                    <th class="text-center">Número de empleado</th>
                    <th class="text-center">Nombre completo</th>
                    <th class="text-center">Grupo</th>
                    <th class="text-center">Área</th>
                    <th class="text-center">Departamento</th>
                    <th class="text-center">Puesto</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include_once('db-connect.php');
                  $members_sql = "SELECT * FROM `members` order by id ASC";
                  $members_qry = $conn->query($members_sql);
                  if ($members_qry->num_rows > 0) :
                    while ($row = $members_qry->fetch_assoc()) :
                  ?>
                      <tr>
                        <th class="text-center"><?= $row['id'] ?></th>
                        <td><?= $row['numero_de_empleado'] ?></td>
                        <td><?= $row['nombre_completo'] ?></td>
                        <td><?= $row['grupo'] ?></td>
                        <td><?= $row['area'] ?></td>
                        <td><?= $row['departamento'] ?></td>
                        <td><?= $row['puesto'] ?></td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else : ?>
                    <tr>
                      <th class="text-center" colspan="8">No hay resgistros en la base de datos.</th>
                    </tr>
                  <?php endif; ?>
                  <?php $conn->close() ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary btn-ejecutivo btn-lg btn-block"><a href="/upxlsx/" class="text-white">SIGUIENTE</a></button>

    </div>

  </div>
</body>

</html>