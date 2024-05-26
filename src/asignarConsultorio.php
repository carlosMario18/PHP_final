<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Asignar Consultorio</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php include('./includes/header.php') ?>
<!-- Fin Header -->

<!-- Titulo -->
<div class="flex justify-center items-center mt-6">
    <img src="img/iconPersona.jpeg" alt="acerca" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Asignar Consultorio</h1>
</div>
<!-- Titulo -->

<!-- Inicio Agregar Consultorio -->
<div class="container mx-auto mt-8">
    <form id="formulario" class="max-w-md mx-auto" method="POST">
        <div class="mb-4">
            <label for="consultorio" class="block text-gray-700 text-lg font-bold mb-2">Número del consultorio:</label>
            <input type="text" id="consultorio" name="consultorio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
<!-- Agregar un campo oculto para enviar el ID de la cita -->
<input type="hidden" id="idCita" name="idCita" value="<?php echo isset($_GET['idCita']) ? htmlspecialchars($_GET['idCita']) : ''; ?>">
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Asignar</button>
        </div>
    </form>
</div>
<!-- Fin Agregar Consultorio -->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Evita que el formulario se envíe automáticamente
    $consultorioId = $_POST['consultorio'];

    // Captura el ID de la cita del campo oculto
    $citaId = $_POST['idCita'];

    // Verifica que el consultorioId no esté vacío
    if (empty($consultorioId)) {
        echo 'El número del consultorio no puede estar vacío.';
        return;
    }

    // Verifica que el citaId no esté vacío
    if (empty($citaId)) {
        echo 'El ID de la cita no puede estar vacío.';
        return;
    }

    // Llama a la función para asignar el consultorio a la cita
    asignarConsultorioACita($citaId, $consultorioId);
}

function asignarConsultorioACita($citaId, $consultorioId) {
    $url = "http://localhost:8080/consultorios/{$consultorioId}/asignar-cita?idCita={$citaId}";
    $data = array('idCita' => $citaId);

    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        )
    );

    // Crea el contexto de la solicitud
    $context = stream_context_create($options);

    // Realiza la solicitud POST y obtiene la respuesta
    $result = file_get_contents($url, false, $context);

    // Verifica la respuesta
    if ($result !== false) {
        // Consultorio asignado correctamente a la cita
        echo 'Consultorio ' . $consultorioId . ' asignado a la cita ' . $citaId . ' correctamente.';
        // Redirige a la página de lista de citas después de asignar el consultorio
        header('Location: listaCitas.php');
        exit();
    } else {
        // Error al asignar el consultorio a la cita
        echo 'Error al asignar el consultorio a la cita.';
    }
}
?>


<!-- Inicio Footer -->
<?php include('./includes/footer.php') ?>
<!-- Fin Footer -->

</body>
</html>
