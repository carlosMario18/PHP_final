<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Modificar Cita</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST['identificacion'];
    $url = 'http://localhost:8080/citas/' . $identificacion;
    $response = file_get_contents($url);

    if ($response === false) {
        echo 'Error al obtener los detalles de la cita';
    } else {
        $data = json_decode($response);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error al decodificar los detalles de la cita';
        } else {
            if ($data) {
                $id = $data->numeroIdentificacion;
                $redirectUrl = 'modificarCitaForm.php?id=' . $id;
                // Redirigir a la página de modificación de cita
                echo "<script>window.location.replace('$redirectUrl');</script>";
                exit;
            } else {
                echo 'La cita no fue encontrada';
            }
        }
    }
}
?>
<!-- Inicio contenido principal -->
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h1 class="text-2xl font-bold mb-4">Buscar Cita por Número de Identificación</h1>
    <form id="buscarCitaForm" method="POST" class="mb-4">
        <div class="mb-4">
            <label for="identificacion" class="block text-gray-700 font-bold mb-2">Número de Identificación:</label>
            <input type="text" id="identificacion" name="identificacion" class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-400 focus:border-indigo-400" required>
        </div>
        <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Buscar</button>
    </form>

    <div id="resultado"></div>
</div>
<!-- Fin contenido principal -->





<!-- Inicio Footer -->
<?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->
    
</body>
</html>