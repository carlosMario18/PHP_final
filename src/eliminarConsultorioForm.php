<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Consultorio a Eliminar</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->


<?php
// Verificar si se ha recibido un ID de consultorio en la URL
if (isset($_GET['id'])) {
    $consultorioID = $_GET['id'];
    $url = 'http://localhost:8080/consultorios/' . $consultorioID;
    $response = file_get_contents($url);
    if ($response !== false) {
        $data = json_decode($response);
?>
<!-- Inicio contenido principal -->
<div class="flex justify-center items-center m-6">
    <img src="img/iconPersona.jpeg" alt="modificar cita" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Eliminar Consultorio</h1>
</div>
<div class="max-w-lg mx-auto mb-6">
    <form id="myForm" class="grid grid-cols-2 gap-4" method="post">
      <!-- Campo No. Identificación -->
      <div class="col-span-2">
        <label for="numeroConsultorio" class="block text-lg font-semibold text-black">No. Identificación</label>
        <input type="text" id="numeroConsultorio" name="consultorioID" value="<?php echo $data->id; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
      </div>
      <!-- Campo Nombre -->
      <div>
        <label for="seccion" class="block text-lg font-semibold text-black">Sección</label>
        <input type="text" id="seccion" name="seccion" value="<?php echo $data->nombre; ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-400 rounded-md hover:border-indigo-500">
      </div>
      <!-- Botón Eliminar -->
      <div class="col-span-2">
        <button type="submit" name="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Eliminar
        </button>
      </div>
    </form>
  </div>
<!-- Fin contenido principal -->
<?php
    } else {
        echo 'Error al obtener los detalles del consultorio';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $consultorioID = $_POST['consultorioID'];
    $url = 'http://localhost:8080/consultorios/' . $consultorioID;
    $options = array(
        'http' => array(
            'method'  => 'DELETE',
            'header'  => 'Content-Type: application/json',
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result !== false) {
        echo 'Consultorio eliminado exitosamente';
        // Redirigir a otra página después de la eliminación si es necesario
        header("Location: eliminarConsultorio.php");
        exit();
    } else {
        echo 'Error al eliminar el consultorio';
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