<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Cita a Eliminar</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<div class="flex justify-center items-center m-6">
    <img src="img/iconPersona.jpeg" alt="modificar cita" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Eliminar Cita</h1>
</div>

<?php
// Verificar si se ha recibido un ID de cita en la URL
if (isset($_GET['id'])) {
    $citaId = $_GET['id'];
    $url = 'http://localhost:8080/citas/' . $citaId;
    $response = file_get_contents($url);
    if ($response !== false) {
        $data = json_decode($response);
        ?>
        <!-- Inicio del formulario -->
        <div class="max-w-lg mx-auto mb-6">
            <form id="myForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label for="identificacion" class="block text-lg font-semibold text-black">No. Identificación</label>
                    <input type="text" id="identificacion" name="identificacion" value="<?php echo $data->numeroIdentificacion; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                </div>
                <div>
                    <label for="nombrePaciente" class="block text-lg font-semibold text-black">Nombre</label>
                    <input type="text" id="nombrePaciente" name="nombrePaciente" value="<?php echo $data->nombrePaciente; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                </div>
                <div>
                    <label for="fecha" class="block text-lg font-semibold text-black">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo $data->fecha; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                </div>
                <div>
                    <label for="costo" class="block text-lg font-semibold text-black">Costo</label>
                    <input type="number" id="costo" name="costo" value="<?php echo $data->costo; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                </div>
                <div class="col-span-2">
                    <label for="generalista" class="block text-lg font-semibold text-black">Nombre Generalista</label>
                    <input type="text" id="generalista" name="generalista" value="<?php echo $data->nombreGeneralista; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                </div>
                <div class="col-span-2">
                    <label for="observaciones" class="block text-lg font-semibold text-black">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500"><?php echo $data->observacion; ?></textarea>
                </div>
                <input type="hidden" name="citaId" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                <div class="col-span-2">
                    <button type="submit" name="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
        <?php
    } else {
        echo 'Error al obtener los detalles de la cita';
    }
}
if (isset($_POST['submit'])) {
    $citaId = $_POST['citaId'];
    $url = 'http://localhost:8080/citas/' . $citaId;
    $options = array(
        'http' => array(
            'method'  => 'DELETE',
            'header'  => 'Content-Type: application/json',
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result !== false) {
        echo 'Cita eliminada exitosamente';
        // Redirigir a otra página después de la eliminación si es necesario
        header("Location: eliminarCita.php");
        exit();
    } else {
        echo 'Error al eliminar la cita';
    }
}
?>



<!-- Inicio Footer -->
<?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->

</body>
</html>