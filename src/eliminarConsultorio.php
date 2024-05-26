<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Eliminar Consultorio</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroConsultorio = $_POST['numeroConsultorio'];
    $url = 'http://localhost:8080/consultorios/' . $numeroConsultorio;
    $response = file_get_contents($url);

    if ($response === false) {
        echo 'Error al obtener los detalles del consultorio';
    } else {
        $data = json_decode($response);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo 'Error al decodificar los detalles del consultorio';
        } else {
            if ($data) {
                $id = $data->id;
                $redirectUrl = 'eliminarConsultorioForm.php?id=' . $id;
                // Redirigir a la página de modificación de cita
                echo "<script>window.location.replace('$redirectUrl');</script>";
                exit;
            } else {
                echo 'El consultorio no fue encontrado';
            }
        }
    }
}
?>


<div class="flex justify-center items-center m-6">
    <img src="img/iconPersona.jpeg" alt="eliminar consultorio" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Eliminar Consultorio</h1>
</div>

<!-- Inicio contenido principal -->
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-4 w-1/2">
    <form id="eliminarConsultorioForm" class="mb-4" method="post">
        <div class="mb-4">
            <label for="numeroConsultorio" class="block text-gray-700 font-bold mb-2">Número de Consultorio:</label>
            <input type="text" id="numeroConsultorio" name="numeroConsultorio" class="w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-400 focus:border-indigo-400" required>
        </div>
        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Eliminar</button>
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