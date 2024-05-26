<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Consultar Consultorio</title>
    <style>
        /* Estilos del contenedor del filtro */
        .filtro-container {
            position: absolute;
            top: 0px;
            right: 20px;
            z-index: 1000;
            /* Un valor alto para asegurarse de que esté por encima de otros elementos */
        }

        .filtro-iframe {
            width: 500px;
            /* Ancho del iframe */
            height: 500px;
            /* Alto del iframe */
            border: none;
            /* Elimina el borde del iframe si es necesario */
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    
<?php
@include('./includes/header.php')
?>

    <!-- Contenido principal -->
    <div class="flex justify-center items-center mt-6 relative">
        <img src="img/iconListaPacientes.jpeg" alt="Icono Lista Pacientes" class="mr-4">
        <h1 class="text-black font-semibold text-2xl">Consultar consultorios</h1>
    </div>

    <!-- Filtro de búsqueda -->
    <div class="flex justify-center items-center mt-6 gap-6">
        <label for="filtroID">ID:</label>
        <input class="border" type="text" id="filtroID" placeholder="ID">
        <label for="filtroNombre">Seccion:</label>
        <input class="border" type="text" id="filtroNombre" placeholder="Seccion">
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" onclick="filtrarConsultorios()">Buscar</button>
    </div>

    <!-- Tabla de consultorios -->
    <div class="relative mt-6 ml-20 mr-20">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Seccion</th>
                </tr>
            </thead>
            <tbody id="tablaConsultoriosBody">
                <!-- Aquí se cargarán los datos de los consultorios -->
                <?php
                function mostrarListaConsultorios()
                {
                    $url = 'http://localhost:8080/consultorios';
                    $response = file_get_contents($url);
                    $data = json_decode($response);

                    if ($data !== null) {
                        foreach ($data as $consultorio) {
                            echo "
                            <tr>
                                <td class='border px-4 py-2'>$consultorio->id</td>
                                <td class='border px-4 py-2'>$consultorio->nombre</td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='border px-4 py-2'>Error al obtener datos de consultorios</td></tr>";
                    }
                }

                // Llamada a la función para mostrar la lista de consultorios al cargar la página
                mostrarListaConsultorios();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function filtrarConsultorios() {
            const filtroID = document.getElementById("filtroID").value.toLowerCase();
            const filtroNombre = document.getElementById("filtroNombre").value.toLowerCase();
            const filas = document.querySelectorAll("#tablaConsultoriosBody tr");

            filas.forEach(fila => {
                const id = fila.querySelector("td:nth-child(1)").textContent.toLowerCase();
                const nombre = fila.querySelector("td:nth-child(2)").textContent.toLowerCase();

                if ((filtroID && !id.includes(filtroID)) || (filtroNombre && !nombre.includes(filtroNombre))) {
                    fila.style.display = "none";
                } else {
                    fila.style.display = "";
                }
            });
        }
    </script>

    <!-- Inicio Footer -->
    <?php
@include('./includes/footer.php')
?>
    <!-- Fin Footer -->
</body>

</html>
