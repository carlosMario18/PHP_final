<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Agregar Consultorio</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<!-- Titulo -->
<div class="flex justify-center items-center mt-6">
    <img src="img/iconPersona.jpeg" alt="acerca" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Agregar Consultorio</h1>
</div>
<!-- Titulo -->






<!-- Inicio Agregar Consultorio -->
<div class="container mx-auto mt-8 w-2/3">
    <form id="formulario" class="max-w-md mx-auto" method="post">
        <div class="mb-4">
            <label for="consultorio" class="block text-gray-700 text-lg font-bold mb-2">Número del consultorio:</label>
            <input type="text" id="consultorio" name="consultorio" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-6">
            <label for="seccion" class="block text-gray-700 text-lg font-bold mb-2">Sección:</label>
            <input type="text" id="seccion" name="seccion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" id="guardar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Guardar</button>
        </div>
    </form>
</div>
<!-- Fin Agregar Consultorio -->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consultorio = $_POST['consultorio'];
    $seccion = $_POST['seccion'];

    // Validar que los campos no estén vacíos
    if (empty($consultorio) || empty($seccion)) {
        echo json_encode(array("message" => "Por favor, complete todos los campos."));
        http_response_code(400);
        exit();
    }

    // Crear un array con los datos del formulario
    $nuevoConsultorio = array(
        "id" => $consultorio,
        "nombre" => $seccion
    );

    // Realizar la solicitud al servidor (aquí suponemos que ya tienes configurada la API en localhost:8080)
    $url = 'http://localhost:8080/consultorios';
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($nuevoConsultorio)
        )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === false) {
        echo json_encode(array("message" => "Error al guardar el consultorio."));
        http_response_code(500);
        exit();
    } else {
        echo json_encode(array("message" => "Consultorio guardado exitosamente."));
        http_response_code(200);
        exit();
    }
} else {
    http_response_code(405);
    exit();
}
?>

<!-- Inicio Footer -->
    <?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->

</body>
</html>