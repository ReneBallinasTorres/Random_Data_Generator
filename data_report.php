<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/sty_data_repor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reportes</title>
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
        $consulta = "SELECT * FROM solicitud";
        // $resultado = $conexion->query($consulta);//Forma 1 ejecuta la consulta SQL en la base de datos MySQL.
        $resultado = mysqli_query($conexion, $consulta); //Forma 2 ejecuta la consulta SQL en la base de datos MySQL.
        echo "<div>
                <div class='text-center'>
                    <a href='Index.html' class='button'><b>Inicio</b></a>
                    <a href='Index_report.html' class='button'><b>Otro Reporte</b></a>
                </div>
                <h2 class='text-center'><b>Listado Solicitudes</b></h2>
                    <div>
                        <table class='container text-center'>
                            <tr>
                                <th>ID Solicitud</th>
                                <th>Fecha de Solicitud</th>
                                <th>Carrera</th>
                                <th>Promedio</th>
                                <th>ID Beneficiario</th>
                                <th>ID Instituto</th>
                            </tr>";
        // Recorrer los resultados y mostrar los datos
        // while ($row = $resultado->fetch_assoc()) { //Forma 1 obtener una fila de resultados de una consulta SQL en forma de un array asociativo.
        while ($row = mysqli_fetch_row($resultado)) { //Forma 2 obtener una fila de resultados de una consulta SQL ejecutada previamente, en formato de array numérico
            echo "<tr>
                    <td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[5] . "</td>
                </tr>";
        }
        echo "</table>
            </div>
        </div>";
    } elseif ($valor == 2) {
        $consulta = "SELECT * FROM equipo_computo";
        $resultado = mysqli_query($conexion, $consulta);
        echo "<div>
                <div class='text-center'>
                    <a href='Index.html' class='button'><b>Inicio</b></a>
                    <a href='Index_report.html' class='button'><b>Otro Reporte</b></a>
                </div>
                <h2 class='text-center'><b>Listado de Equipos de Computo</b></h2>
                    <div>
                        <table class='container text-center'>
                            <tr>
                                <th>ID Equipo</th>
                                <th>Tipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Estado</th>
                            </tr>";
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>
                    <td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                </tr>";
        }
        echo "</table> 
            </div>
        </div>";
    } elseif ($valor == 3) {
        $consulta = "SELECT * FROM prestamo_equipo";
        $resultado = mysqli_query($conexion, $consulta);
        echo "<div>
                <div class='text-center'>
                    <a href='Index.html' class='button'><b>Inicio</b></a>
                    <a href='Index_report.html' class='button'><b>Otro Reporte</b></a>
                </div>
                <h2 class='text-center'><b>Listado Prestamos</b></h2>
                    <div>
                        <table class='container text-center'>
                            <tr>
                                <th>ID Prestamo</th>
                                <th>Fecha de Prestamo</th>
                                <th>Fecha de Devolucion</th>
                                <th>Estado</th>
                                <th>ID Solicitud</th>
                                <th>ID Equipo</th>
                            </tr>";
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>
                    <td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                    <td>" . $row[5] . "</td>
                </tr>";
        }
        echo "</table>
            </div>
        </div>";
    } elseif ($valor == 4) {
        $consulta = "SELECT * FROM reporte";
        $resultado = mysqli_query($conexion, $consulta);
        echo "<div>
                <div class='text-center'>
                    <a href='Index.html' class='button'><b>Inicio</b></a>
                    <a href='Index_report.html' class='button'><b>Otro Reporte</b></a>
                </div>
                <h2 class='text-center'><b>Listado Reportes de Fallos</b></h2>
                    <div>
                        <table class='container text-center'>
                            <tr>
                                <th>ID Reporte</th>
                                <th>Fecha de Reporte</th>
                                <th>Observación</th>
                                <th>Estado</th>
                                <th>ID Prestamo</th>
                            </tr>";
        while ($row = mysqli_fetch_row($resultado)) {
            echo "<tr>
                    <td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td>" . $row[4] . "</td>
                </tr>";
        }
        echo "</table>
            </div>
        </div>";
    }
    ?>
</body>

</html>