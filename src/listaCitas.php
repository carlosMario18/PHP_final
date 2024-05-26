<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Lista de Citas</title>

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
    <?php include('./includes/header.php') ?>
    <!-- Fin Header -->

    <div class="flex justify-center items-center mt-6">
        <img src="img/iconListaPacientes.jpeg" alt="Icono Lista Pacientes" class="mr-4">
        <h1 class="text-black font-semibold text-2xl">Lista de Citas</h1>
        <div class="filtro-container absolute top-0 right-0 mt-8 pr-6">
            <?php include('./includes/filtrarBusqueda.php') ?>
        </div>
    </div>


    <!-- Inicio contenido principal -->

    <!-- Tabla de pacientes -->
    <div class="flex justify-center mt-6 ml-20 mr-20">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Tipo de cita</th>
                    <th class="px-4 py-2 border">Costo</th>
                    <th class="px-4 py-2 border">Consultorio asignado</th>
                </tr>
            </thead>
            <tbody id="tablaPacientesBody">
                <!-- Aquí se mostrarán los datos -->
                <?php
                function mostrarListaCita() {
                    // Realiza una solicitud GET al backend para obtener todas las citas
                    $url = 'http://localhost:8080/citas/todas-las-citas';
                    $response = file_get_contents($url);

                    // Verifica si la solicitud fue exitosa
                    if ($response !== false) {
                        // Convierte la respuesta JSON en un array asociativo
                        $data = json_decode($response, true);

                        // Obtén el cuerpo de la tabla donde se mostrarán las citas
                        $tablaBody = '';

                        // Itera sobre cada cita y agrega una fila a la tabla
                        foreach ($data as $cita) {
                            $tablaBody .= '<tr>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['numeroIdentificacion'] . '</td>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['nombrePaciente'] . '</td>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['fecha'] . '</td>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['tipoCita'] . '</td>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['costo'] . '</td>';
                            $tablaBody .= '<td class="border px-4 py-2">' . $cita['idConsultorio'] . '</td>';
                            $tablaBody .= '</tr>';
                        }

                        // Imprime el cuerpo de la tabla en el lugar adecuado en tu HTML
                        echo $tablaBody;
                    } else {
                        // Error al obtener los datos de las citas
                        echo '<tr><td colspan="6">Error al obtener datos de citas</td></tr>';
                    }
                }

                // Llamada a la función para mostrar la lista de citas al cargar la página
                mostrarListaCita();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Fin contenido principal -->

    <!-- Inicio Footer -->
    <?php include('./includes/footer.php') ?>
    <!--Fin Footer  -->

</body>

</html>
