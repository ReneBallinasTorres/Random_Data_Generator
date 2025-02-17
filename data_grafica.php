<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/sty_data_repor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/sty_Index.css">
    <title>Graficas</title>
</head>

<body>
    <?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "My_Int_Neg";

    $conexion = new mysqli($server, $user, $password, $db);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener el valor enviado por el formulario
    $valor = $_POST['opcion'];

    if ($valor == 1) {
        $consulta = "SELECT ec.marca, COUNT(ec.id_equipoComputo) AS porcentaje 
                    FROM equipo_computo ec GROUP BY ec.marca";
        $resultado = $conexion->query($consulta); // Utilizar la variable correcta

        $data = [];
        while ($fila = $resultado->fetch_assoc()) {
            $data[] = [$fila['marca'], (int)$fila['porcentaje']];
        }

        $conexion->close();
    ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Marca', 'Porcentaje de Equipo de Computo'], // Títulos de las columnas
                    <?php
                    foreach ($data as $d) {
                        echo "['" . $d[0] . "', " . $d[1] . "],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Porcentajes de Marcas de los Equipos Computo',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>

        <div id="piechart" style="width: 900px; height: 500px;"></div>

        <div class='text-center'>
            <a href='Index.html' class='button'><b>Inicio</b></a>
            <a href='Index_grafica.html' class='button'><b>Otra Grafica</b></a>
        </div>

    <?php
    } elseif ($valor == 2) {
        $consulta = "SELECT i.nombre, COUNT(s.id_solicitud) AS solicitud_instituto FROM solicitud s 
                    INNER JOIN institucion i ON s.id_institucio = i.id_institucio GROUP BY i.nombre";
        $resultado = $conexion->query($consulta); // Utilizar la variable correcta

        $data = [];
        while ($fila = $resultado->fetch_assoc()) {
            $data[] = [$fila['nombre'], (int)$fila['solicitud_instituto']];
        }

        $conexion->close();
    ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Marca', 'Porcentaje de Solicitudes por Institución'], // Títulos de las columnas
                    <?php
                    foreach ($data as $d) {
                        echo "['" . $d[0] . "', " . $d[1] . "],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Porcentaje de Solicitudes por Institución',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>

        <div id="piechart" style="width: 900px; height: 500px;"></div>

        <div class='text-center'>
            <a href='Index.html' class='button'><b>Inicio</b></a>
            <a href='Index_grafica.html' class='button'><b>Otra Grafica</b></a>
        </div>

    <?php
    } elseif ($valor == 3) {
        $consulta = "SELECT b.genero, COUNT(s.id_solicitud) AS solicitudes_genero
            FROM solicitud s INNER JOIN beneficiario b ON s.id_beneficiario = b.id_beneficiario
            GROUP BY b.genero";
        $resultado = $conexion->query($consulta); // Utilizar la variable correcta

        $data = [];
        while ($fila = $resultado->fetch_assoc()) {
            $data[] = [$fila['genero'], (int)$fila['solicitudes_genero']];
        }

        $conexion->close();
    ?>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Marca', 'Porcentaje de Genero de Solicitudes'], // Títulos de las columnas
                    <?php
                    foreach ($data as $d) {
                        echo "['" . $d[0] . "', " . $d[1] . "],";
                    }
                    ?>
                ]);

                var options = {
                    title: 'Porcentaje de Genero de Solicitudes',
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>

        <div id="piechart" style="width: 900px; height: 500px;"></div>

        <div class='text-center'>
            <a href='Index.html' class='button'><b>Inicio</b></a>
            <a href='Index_grafica.html' class='button'><b>Otra Grafica</b></a>
        </div>
    <?php
    }
    ?>

</body>

</html>