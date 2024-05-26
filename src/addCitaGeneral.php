<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Agregar Cita General</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php include('./includes/header.php') ?>
<!-- Fin Header -->

<div class="flex justify-center items-center m-6">
    <img src="img/iconPersona.jpeg" alt="agregar cita general" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Agregar Cita</h1>
</div>

<!-- Inicio contenido principal -->
<div class="max-w-lg mx-auto mb-6">
    <form id="myForm" class="grid grid-cols-2 gap-4" method="POST">
        <!-- Campo No. Identificación -->
        <div class="col-span-2">
            <label for="idCita" class="block text-lg font-semibold text-black">No. Identificación</label>
            <input type="text" id="idCita" name="idCita" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
        </div>
        <!-- Campo Nombre -->
        <div>
            <label for="nombre" class="block text-lg font-semibold text-black">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
        </div>
        <!-- Campo Fecha -->
        <div>
            <label for="fecha" class="block text-lg font-semibold text-black">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500" required>
        </div>
        <!-- Campo Costo -->
        <div>
            <label for="costo" class="block text-lg font-semibold text-black">Costo</label>
            <input type="number" id="costo" name="costo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500" required>
        </div>
        <!-- Campo Nombre Generalista -->
        <div class="col-span-2">
            <label for="generalista" class="block text-lg font-semibold text-black">Nombre Generalista</label>
            <input type="text" id="generalista" name="generalista" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
        </div>
        <!-- Campo Observaciones -->
        <div class="col-span-2">
            <label for="observaciones" class="block text-lg font-semibold text-black">Observaciones</label>
            <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500"></textarea>
        </div>
        <!-- Botón Guardar -->
        <div class="col-span-2">
            <button type="submit" name="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar
            </button>
        </div>
    </form>
</div>
<!-- Fin contenido principal -->

<!-- Footer -->
<?php include('./includes/footer.php') ?>
<!-- Footer -->
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Captura los valores de los campos del formulario
    $identificacion = $_POST['idCita'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $costo = $_POST['costo'];
    $generalista = $_POST['generalista'];
    $observaciones = $_POST['observaciones'];

    // Crea un array con los datos capturados
    $data = array(
        'numeroIdentificacion' => $identificacion,
        'nombrePaciente' => $nombre,
        'fecha' => $fecha,
        'costo' => $costo,
        'tipoCita' => 'General',
        'nombreGeneralista' => $generalista,
        'observacion' => $observaciones
    );

    // Convierte el array a una cadena JSON
    $jsonData = json_encode($data);

    // Envía los datos al backend utilizando file_get_contents()
    $url = 'http://localhost:8080/citas';
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $jsonData
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result !== FALSE) {
        // La solicitud fue exitosa
        $responseData = json_decode($result, true);
        // Redirige a la página de asignar consultorio con el ID de la cita en la URL usando JavaScript
        echo "<script>window.location.href = 'asignarConsultorio.php?idCita={$responseData['numeroIdentificacion']}';</script>";
        exit();
    } else {
        // Error al enviar los datos al servidor
        echo 'Error al enviar los datos al servidor';
    }
}
?>

