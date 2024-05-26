<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Búsqueda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
</head>

<body>
    <div class="container p-4">
        <div class="filtro-header flex items-center">
            <span class="filtro-txt text-lg">Filtro de Búsqueda</span>
            <button class="filtro-btn bg-blue-500 text-white rounded-lg px-4 py-2 cursor-pointer transition-colors duration-300 hover:bg-blue-700">&#xe429;</button>
        </div>
        <form id="filtroForm" method="POST">
            <div class="opciones hidden mt-4 right-0 bg-white border border-gray-300 rounded-lg p-4 z-10">
                <div class="seccion mb-4">
                    <label for="filtroID" class="w-24 inline-block align-top">ID:</label>
                    <input type="text" id="filtroID" name="filtroID" class="inline-block">
                </div>
                <div class="seccion mb-4">
                    <label for="filtroNombre" class="w-24 inline-block align-top">Nombre:</label>
                    <input type="text" id="filtroNombre" name="filtroNombre" class="inline-block">
                </div>
                <div class="seccion mb-4">
                    <label for="filtroCostoMin" class="w-24 inline-block align-top">Costo Mínimo:</label>
                    <input type="number" id="filtroCostoMin" name="filtroCostoMin" min="0" class="inline-block">
                </div>
                <div class="seccion mb-4">
                    <label for="filtroCostoMax" class="w-24 inline-block align-top">Costo Máximo:</label>
                    <input type="number" id="filtroCostoMax" name="filtroCostoMax" min="0" class="inline-block">
                </div>
                <div class="seccion mb-4">
                    <label for="tipoCita" class="w-24 inline-block align-top">Tipo de Cita:</label>
                    <select id="tipoCita" name="tipoCita" class="inline-block">
                        <option value="General">General</option>
                        <option value="Especialista">Especialista</option>
                    </select>
                </div>
                <div class="seccion">
                    <button id="btnAceptar" type="submit" class="btnAceptar bg-blue-500 text-white rounded-lg px-4 py-2 cursor-pointer transition-colors duration-300 hover:bg-blue-700">Aceptar</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['filtroID'] ?? '';
        $nombre = $_POST['filtroNombre'] ?? '';
        $costoMinimo = $_POST['filtroCostoMin'] ?? 0;
        $costoMaximo = $_POST['filtroCostoMax'] ?? '';
        $tipoCita = $_POST['tipoCita'] ?? '';

        $queryParams = [];
        if ($id) $queryParams['id'] = $id;
        if ($nombre) $queryParams['nombre'] = $nombre;
        if ($costoMinimo) $queryParams['costoMinimo'] = $costoMinimo;
        if ($costoMaximo) $queryParams['costoMaximo'] = $costoMaximo;
        if ($tipoCita) $queryParams['tipo'] = $tipoCita;

        $url = 'http://localhost:8080/citas';
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
            echo "IF\n";
        } else {
            $url .= '/todas-las-citas';
            echo "else\n";
        }

        $response = file_get_contents($url);
        $citas = json_decode($response, true);

        echo 'Datos recibidos: ' . print_r($citas, true);

        $tablaHTML = '';
        foreach ($citas as $cita) {
            $tablaHTML .= '
                <tr>
                    <td class="border px-4 py-2">' . $cita['numeroIdentificacion'] . '</td>
                    <td class="border px-4 py-2">' . $cita['nombrePaciente'] . '</td>
                    <td class="border px-4 py-2">' . $cita['fecha'] . '</td>
                    <td class="border px-4 py-2">' . $cita['tipoCita'] . '</td>
                    <td class="border px-4 py-2">' . $cita['costo'] . '</td>
                    <td class="border px-4 py-2">' . $cita['idConsultorio'] . '</td> <!-- Aquí se muestra solo el consultorio -->
                </tr>
            ';
        }

        echo 'HTML de la tabla: ' . $tablaHTML;

        // Enviar tablaHTML a través de un mensaje a la ventana principal
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filtroBtn = document.querySelector(".filtro-btn");
            const filtroContainer = document.querySelector(".opciones");

            filtroContainer.style.display = "none";

            filtroBtn.addEventListener("click", function () {
                if (filtroContainer.style.display === "none") {
                    filtroContainer.style.display = "block";
                } else {
                    filtroContainer.style.display = "none";
                }
            });

            const btnAceptar = document.getElementById("btnAceptar");
            btnAceptar.addEventListener("click", function (event) {
                event.preventDefault();

                const id = document.getElementById("filtroID").value;
                const nombre = document.getElementById("filtroNombre").value;
                const costoMinimo = document.getElementById("filtroCostoMin").value || 0;
                const costoMaximo = document.getElementById("filtroCostoMax").value;
                const tipoCita = document.getElementById("tipoCita").value;

                const queryParams = new URLSearchParams();
                if (id) queryParams.append('id', id);
                if (nombre) queryParams.append('nombre', nombre);
                if (costoMinimo) queryParams.append('costoMinimo', costoMinimo);
                if (costoMaximo) queryParams.append('costoMaximo', costoMaximo);
                if (tipoCita) queryParams.append('tipo', tipoCita);

                let url = 'http://localhost:8080/citas';
                if (queryParams.toString()) {
                    url += '?' + queryParams.toString();
                    console.log("IF");
                } else {
                    url += '/todas-las-citas';
                    console.log("else");
                }

                fetch(url)
                    .then(response => response.json())
                    .then(citas => {
                        console.log('Datos recibidos:', citas);

                        let tablaHTML = '';
                        citas.forEach(cita => {
                            tablaHTML += `
                            <tr>
                                <td class="border px-4 py-2">${cita.numeroIdentificacion}</td>
                                <td class="border px-4 py-2">${cita.nombrePaciente}</td>
                                <td class="border px-4 py-2">${cita.fecha}</td>
                                <td class="border px-4 py-2">${cita.tipoCita}</td>
                                <td class="border px-4 py-2">${cita.costo}</td>
                                <td class="border px-4 py-2">${cita.idConsultorio}</td> <!-- Aquí se muestra solo el consultorio -->
                            </tr>
                        `;
                        });
                        console.log('HTML de la tabla:', tablaHTML);
                        // Aquí puedes manipular la tabla HTML, por ejemplo:
                        document.getElementById('tablaPacientesBody').innerHTML = tablaHTML;
                    })
                    .catch(error => console.error('Error al obtener citas:', error));
            });
        });
    </script>

</body>

</html>
