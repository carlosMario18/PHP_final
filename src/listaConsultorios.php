<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Lista de Consultorios</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<?php
// Función para hacer la solicitud al backend y mostrar la lista de consultorios
function mostrarListaConsultorio() {
    $url = 'http://localhost:8080/consultorios';
    $response = file_get_contents($url);
    $data = json_decode($response);

    if ($data === false) {
        echo "Error al obtener datos de consultorios.";
        return;
    }

    $tablaBody = '';
    foreach ($data as $consultorio) {
        $tablaBody .= "
            <tr>
                <td class='border px-4 py-2'>$consultorio->id</td>
                <td class='border px-4 py-2'>$consultorio->nombre</td>
            </tr>
        ";
    }

    echo $tablaBody;
}

// Llamar a la función para mostrar la lista de consultorios

?>


<!-- Inicio contenido principal -->
<div class="flex justify-center items-center mt-6 relative">
    <img src="img/iconListaPacientes.jpeg" alt="Icono Lista Pacientes" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Lista de Consultorios</h1>
    <!-- Contenedor del filtro
    <div class="filtro-container absolute top-0 right-0 mt-8 pr-6">
        <iframe class="filtro-iframe" src="filtrarBusqueda.html" frameborder="0"></iframe>
    </div> -->
</div>



<!-- Inicio tabla -->
<div class="relative mt-6 ml-20 mr-20">
    <!-- Contenedor del filtro -->
    
    <div class="w-full">
        <!-- Tabla de pacientes -->
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Seccion</th>
                </tr>
            </thead>
            <tbody id="tablaConsultoriosBody">
                <!-- Recupera del Backend -->
                <?php mostrarListaConsultorio(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Fin tabla -->

<!-- Fin contenido principal -->


<!-- Inicio Footer -->
<?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->

</body>
</html>