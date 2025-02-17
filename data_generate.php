<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/sty_data_generate.css">
    <title>Datos Generados</title>
</head>

<body>
    <?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "My_Int_Neg";

    $cantidad = $_POST['cantidad'];

    $conexion = new mysqli($server, $user, $password, $db);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Arrays de datos elitarios
    $entidades = ['Ciudad de México', 'Estado de México', 'Jalisco', 'Nuevo León', 'Puebla', 'Querétaro', 'Tamaulipas'];
    $instituciones = ['UNAM', 'IPN', 'ITESM', 'UANL', 'BUAP', 'UQROO', 'UTT'];
    $niveles = ['Bachillerato', 'Superior'];
    // $nombres = ['Carlos', 'Ana', 'Luis', 'María', 'Jorge', 'Fernanda', 'Juan', 'Sofía', 'Eduardo', 'Lucía'];
    $nombres_h = ['Daniel', 'Mariano', 'Ismael', 'Luis', 'Miguel', 'Leo', 'Fernando', 'Juan', 'Andres', 'Pedro'];
    $nombres_m = ['Daniela', 'Maria', 'Isabel', 'Luz', 'Miguelina', 'Linda', 'Fernanda', 'Juana', 'Ana', 'Guille'];
    $apellidos = ['Hernández', 'González', 'López', 'Martínez', 'Pérez', 'Cruz', 'Rodríguez', 'García', 'Díaz', 'Sánchez'];
    $tipo_vivienda = ['Propia', 'Renta', 'Familiar'];
    $estado_civil = ['Soltero', 'Casado', 'Otro'];
    $marcas = ['HP', 'Dell', 'Lenovo', 'Asus', 'Apple'];
    $modelos = ['EliteBook', 'Inspiron', 'ThinkPad', 'ROG', 'MacBook'];
    $carreras = ['Industrial', 'Medicina', 'Informática', 'Economía', 'Administración', 'Derecho', 'Psicología', 'Biología', 'Química', 'Física'];
    $promedios = ['9.0', '9.5', '8.0', '7.0', '10', '6.0', '8.5', '7.5'];
    $tiposEquipo = ['Laptop', 'Desktop', 'Tablet', 'Computadora de Escritorio'];
    $estadoEquipo = ['Disponible', 'En Reparación', 'En Uso'];
    $estadoPrestamo = ['Activo', 'Inactivo', 'Pendiente'];
    $tipoReporte = ['No aprende', 'Fallo de hardware', 'Fallo de software', 'No se sabe'];
    $estadoReporte = ['En reparación', 'En espera', 'Finalizado'];

    // Desordenar el array de entidades y Insertar entidades en orden aleatorio--Nota
    // shuffle($entidades);-Codigó

    // Insertar entidades
    $entidad_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $nombre = $entidades[array_rand($entidades)]; // Selección aleatoria
        $conexion->query("INSERT INTO entidad (nombre) VALUES ('$nombre')"); //Inserción de datos
        if ($conexion->error) {
            die("Error en inserción de entidad: " . $conexion->error);
        }
        $entidad_ids[] = $conexion->insert_id;
    }

    // Insertar instituciones
    $institucion_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $entidad_id = $entidad_ids[array_rand($entidad_ids)]; // Selección aleatoria
        $nombre = $instituciones[array_rand($instituciones)]; // Selección aleatoria
        $nivel = $niveles[array_rand($niveles)];
        $conexion->query("INSERT INTO institucion (nombre, nivel, id_entidad) VALUES ('$nombre', '$nivel', $entidad_id)"); //Inserción de datos
        if ($conexion->error) {
            die("Error en inserción de institución: " . $conexion->error);
        }
        $institucion_ids[] = $conexion->insert_id;
    }

    // Insertar beneficiarios
    $beneficiario_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $genero = (rand(0, 1) == 0) ? 'H' : 'F';
        $curp = "CURP" . str_pad($i, 5, "0", STR_PAD_LEFT);
        $nombre = ($genero == 'H') ? $nombres_h[array_rand($nombres_h)] : $nombres_m[array_rand($nombres_m)]; //Operador ternario (? :) para asignar un nombre aleatorio dependiendo del género del beneficiario.
        // $nombre = $nombres_h[array_rand($nombres_h)];
        $apellido_p = $apellidos[array_rand($apellidos)];
        $apellido_m = $apellidos[array_rand($apellidos)];
        $edad = rand(18, 30);
        $tipo_v = $tipo_vivienda[array_rand($tipo_vivienda)];
        $estado_c = $estado_civil[array_rand($estado_civil)];
        $tarjeta = (rand(0, 1) == 0) ? 'SI' : 'NO';
        $entidad_id = $entidad_ids[array_rand($entidad_ids)]; // Se agrega relación con entidad
        $institucion_id = $institucion_ids[array_rand($institucion_ids)]; // Se agrega relación con institución

        $conexion->query("INSERT INTO beneficiario (curp, nombre, apellido_p, apellido_m, genero, edad, tipo_vivienda, estado_civil, tarjeta_bancaria, id_entidad) 
                    VALUES ('$curp', '$nombre', '$apellido_p', '$apellido_m', '$genero', $edad, '$tipo_v', '$estado_c', '$tarjeta', $entidad_id)");
        if ($conexion->error) {
            die("Error en inserción de beneficiario: " . $conexion->error);
        }
        $beneficiario_ids[] = $conexion->insert_id;
    }

    // Insertar solicitudes
    $solicitud_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $institucion_id = $institucion_ids[array_rand($institucion_ids)];
        $fecha = date('Y-m-d', rand(strtotime('-2 years'), strtotime('now'))); // Generar una fecha aleatoria entre hace 2 años y hoy
        // $fecha = date('Y-m-d');
        $carrera = $carreras[array_rand($carreras)]; // Se agrega relación con carrera
        $promedio = $promedios[array_rand($promedios)]; // Se agrega relación con promedio
        $beneficiario_id = $beneficiario_ids[array_rand($beneficiario_ids)]; // Se agrega relación con institución
        $institucion_id = $institucion_ids[array_rand($institucion_ids)]; // Se agrega relación con institución

        $conexion->query("INSERT INTO solicitud (fecha_solicitud, carrera, promedio, id_beneficiario, id_institucio) 
                    VALUES ('$fecha', '$carrera', '$promedio', $beneficiario_id, $institucion_id)");
        $solicitud_ids[] = $conexion->insert_id;
    }

    // Insertar equipos de cómputo
    $equipo_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $tipo = $tiposEquipo[array_rand($tiposEquipo)];
        $marca = $marcas[array_rand($marcas)];
        $modelo = $modelos[array_rand($modelos)];
        $estado = $estadoEquipo[array_rand($estadoEquipo)];

        $conexion->query("INSERT INTO equipo_computo (tipo, marca, modelo, estado) VALUES ('$tipo', '$marca', '$modelo', '$estado')");
        $equipo_ids[] = $conexion->insert_id;
    }

    // Insertar préstamos de equipos
    $prestamo_ids = [];
    for ($i = 0; $i < $cantidad; $i++) {
        $equipo_id = $equipo_ids[array_rand($equipo_ids)];
        $fecha = $fecha_prestamo = date('Y-m-d', rand(strtotime('-2 years'), strtotime('now'))); // Generar una fecha aleatoria entre hace 2 años y hoy
        $fecha_devolucion = date('Y-m-d', strtotime($fecha_prestamo . ' +' . rand(1, 30) . ' days')); // Generar fecha de devolución entre 1 y 30 días después de la fecha de préstamo
        $estado = $estadoPrestamo[array_rand($estadoPrestamo)];
        $solicitud_id = $solicitud_ids[array_rand($solicitud_ids)]; // Se agrega relación con solicitudes
        $equipo_id = $equipo_ids[array_rand($equipo_ids)]; // Se agrega relación con equipos

        $conexion->query("INSERT INTO prestamo_equipo (fecha_prestamo, fecha_devolucion, estado, id_solicitud, id_equipoComputo) 
                    VALUES ('$fecha_prestamo', '$fecha_devolucion', '$estado', $solicitud_id, $equipo_id)");
        $prestamo_ids[] = $conexion->insert_id;
    }

    // Insertar reportes de fallos
    for ($i = 0; $i < $cantidad; $i++){
        $observacion = $tipoReporte[array_rand($tiposEquipo)];
        $fecha_reporte = date('Y-m-d', rand(strtotime('-2 years'), strtotime('now'))); // Generar una fecha aleatoria entre hace 2 años y hoy
        $estado = $estadoReporte[array_rand($estadoReporte)]; // Se agrega relación con tipo de reporte
        $prestamo_id = $prestamo_ids[array_rand($prestamo_ids)]; // Se agrega relación con equipos

        $conexion->query("INSERT INTO reporte (fecha_reporte, observacion, estado, id_prestamoEquipo) 
                    VALUES ('$fecha_reporte', '$observacion', '$estado', $prestamo_id)");
    }

    $conexion->close();
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo '<div class="message">Datos generados con éxito.</div> <br>';
    }
    ?>
    <form action="index.html" method="post">
        <input type="submit" value="Continuar" />
    </form>
</body>

</html>