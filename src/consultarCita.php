<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Consultar Cita</title>
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
    
<!-- Inicio Header -->
<?php include('./includes/header.php'); ?>
<!-- Fin Header -->


<!-- Contenido principal -->
<div class="flex justify-center items-center mt-6 relative">
    <img src="img/iconListaPacientes.jpeg" alt="Icono Lista Pacientes" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Consultar citas</h1>
</div>

<!-- Filtro de búsqueda -->
<div class="flex justify-center items-center mt-6 gap-6">
    <label for="filtroID">ID:</label>
    <input class="border" type="text" id="filtroID" placeholder="ID">
    <label for="filtroNombre">Nombre:</label>
    <input class="border " type="text" id="filtroNombre" placeholder="Nombre">
    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" onclick="filtrarCitas()">Buscar</button>
</div>

<!-- Tabla de citas -->
<div class="relative mt-6 ml-20 mr-20">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Número de Identificación</th>
                <th class="px-4 py-2 border">Nombre del Paciente</th>
                <th class="px-4 py-2 border">Fecha</th>
                <th class="px-4 py-2 border">Tipo de Cita</th>
                <th class="px-4 py-2 border">Costo</th>
                <th class="px-4 py-2 border">ID Consultorio</th>
            </tr>
        </thead>
        <tbody id="tablaPacientesBody">
            <!-- Aquí se cargarán los datos de las citas -->
            <?php
            function mostrarListaCita()
            {
                $url = 'http://localhost:8080/citas/todas-las-citas';
                $response = file_get_contents($url);
                $data = json_decode($response);

                if ($data !== null) {
                    foreach ($data as $cita) {
                        echo "
                        <tr>
                            <td class='border px-4 py-2'>$cita->numeroIdentificacion</td>
                            <td class='border px-4 py-2'>$cita->nombrePaciente</td>
                            <td class='border px-4 py-2'>$cita->fecha</td>
                            <td class='border px-4 py-2'>$cita->tipoCita</td>
                            <td class='border px-4 py-2'>$cita->costo</td>
                            <td class='border px-4 py-2'>$cita->idConsultorio</td>
                        </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='6' class='border px-4 py-2'>Error al obtener datos de citas</td></tr>";
                }
            }

            // Llamada a la función para mostrar la lista de citas al cargar la página
            mostrarListaCita();
            ?>
        </tbody>
    </table>
</div>

<!-- Inicio Footer -->
<?php include('./includes/footer.php'); ?>
<!-- Fin Footer -->

<script>
    function filtrarCitas() {
        const filtroID = document.getElementById("filtroID").value.toLowerCase();
        const filtroNombre = document.getElementById("filtroNombre").value.toLowerCase();
        const filas = document.querySelectorAll("#tablaPacientesBody tr");

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

</body>
</html>
