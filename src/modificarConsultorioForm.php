<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Consultorio a Modificar</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<div class="flex justify-center items-center m-6">
    <img src="img/iconPersona.jpeg" alt="modificar cita" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Modificar Consultorio</h1>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $consultorioId = $_GET['id'];
    $url = 'http://localhost:8080/consultorios/' . $consultorioId;
    $response = file_get_contents($url);

    if ($response === false) {
        echo 'Error al obtener los detalles del consultorio';
        exit();
    } else {
        $data = json_decode($response);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error al decodificar los detalles del consultorio';
            exit();
        } else {
            ?>
            <!-- Inicio del formulario -->
            <div class="max-w-lg mx-auto mb-6">
                <form id="myForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label for="numeroConsultorio" class="block text-lg font-semibold text-black">Número de Consultorio</label>
                        <input type="text" id="numeroConsultorio" name="numeroConsultorio" value="<?php echo $data->id; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                    </div>
                    <div class="col-span-2">
                        <label for="seccion" class="block text-lg font-semibold text-black">Sección</label>
                        <input type="text" id="seccion" name="seccion" value="<?php echo $data->nombre; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
                    </div>
                    <input type="hidden" name="consultorioId" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                    <div class="col-span-2">
                        <button type="submit" name="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
            <?php
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $consultorioId = $_POST['consultorioId'];
    $numeroConsultorio = $_POST['numeroConsultorio'];
    $seccion = $_POST['seccion'];

    $consultorioActualizado = array(
        'id' => $numeroConsultorio,
        'nombre' => $seccion
    );

    $url = 'http://localhost:8080/consultorios/' . $consultorioId;
    $data_string = json_encode($consultorioActualizado);

    $options = array(
        'http' => array(
            'method'  => 'PUT',
            'header'  => 'Content-Type: application/json',
            'content' => $data_string
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result !== false) {
        echo 'Consultorio actualizado exitosamente';
        // Redirigir a otra página después de la actualización si es necesario
        header("Location: modificarConsultorio.php");
        exit();
    } else {
        echo 'Error al actualizar el consultorio';
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