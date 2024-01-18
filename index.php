<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Ejecutivo</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .btn-ejecutivo {
            font-size: 18px;
            padding: 15px 30px;
            margin: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-4">Panel Ejecutivo IDEAL</h1>
            <button class="btn btn-primary btn-ejecutivo"><a href="/importcsv/" class="text-white">ALTAS Y BAJAS</a></button>
            <button class="btn btn-success btn-ejecutivo">% DE ENROLAMIENTO</button>
            <button class="btn btn-info btn-ejecutivo">% CON ASIGNACIÓN Y % SIN ASIGNACIÓN DE HORARIOS</button>
            <button class="btn btn-warning btn-ejecutivo">% DE LECTORES ACTIVOS</button>
            <button class="btn btn-danger btn-ejecutivo">REPORTE DE INCIDENCIAS</button>
        </div>
    </div>
</div>

<!-- Incluir Bootstrap JS y Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
