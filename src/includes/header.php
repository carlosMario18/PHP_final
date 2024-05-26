<header class="bg-custom-color dark:bg-gray-800 shadow-md relative" style="background-color: #F9F8EF;">
    <div class="container mx-auto flex items-center justify-between px-4 py-2 text-white">
        <a href="../src/index.php">
            <img src="img/iconHospital.jpeg" alt="Logo" class="w-30">
        </a>
        
        <div class="flex space-x-4 text-black text-2xl gap-6 relative w-3/4">
            <div class="relative">
                <a href="#" id="agregar" class="hover:underline">Agregar</a>
                <div id="opciones-cita" class="absolute bg-custom-color rounded-md shadow-md py-2 w-48 text-center right-0 z-10 transition-all duration-300 opacity-0 invisible" style="background-color: #F9F8EF;">
                    <a href="../src/addCitaGeneral.php" class="hover:underline block">- Cita General</a>
                    <a href="../src/addConsultorio.php" class="hover:underline block">- Consultorio</a>
                </div>
            </div>
            <div class="relative">
                <a href="#" id="modificar" class="hover:underline">Modificar</a>
                <div id="opciones-modificar" class="absolute bg-custom-color rounded-md shadow-md py-2 w-48 text-center right-0 z-10 transition-all duration-300 opacity-0 invisible mt-10" style="background-color: #F9F8EF;">
                    <a href="../src/modificarCita.php" class="hover:underline block">- Cita</a>
                    <a href="../src/modificarConsultorio.php" class="hover:underline block">- Consultorio</a>
                </div>
            </div>

            <div class="relative">
                <a href="#" id="listar" class="hover:underline">Listar</a>
                <div id="opciones-listar"
                    class="absolute bg-custom-color rounded-md shadow-md py-2 w-48 text-center right-0 z-10 transition-all duration-300 opacity-0 invisible mt-10"
                    style="background-color: #F9F8EF;">
                    <a href="../src/listaCitas.php" class="hover:underline block">- Cita</a>
                    <a href="../src/listaConsultorios.php" class="hover:underline block">- Consultorio</a>
                </div> 
            </div>

            <div class="relative">
                <a href="#" id="eliminar" class="hover:underline">Eliminar</a>
                <div id="opciones-eliminar" class="absolute bg-custom-color rounded-md shadow-md py-2 w-48 text-center right-0 z-10 transition-all duration-300 opacity-0 invisible mt-10" style="background-color: #F9F8EF;">
                    <a href="../src/eliminarCita.php" class="hover:underline block">- Cita</a>
                    <a href="../src/eliminarConsultorio.php" class="hover:underline block">- Consultorio</a>
                </div>
            </div>
            <div class="relative">
                <a href="#" id="consultar" class="hover:underline">Consultar</a>
                <div id="opciones-consultar"
                    class="absolute bg-custom-color rounded-md shadow-md py-2 w-48 text-center right-0 z-10 transition-all duration-300 opacity-0 invisible mt-10"
                    style="background-color: #F9F8EF;">
                    <a href="../src/consultarCita.php" class="hover:underline block">- Cita</a>
                    <a href="../src/consultarConsultorio.php" class="hover:underline block">- Consultorio</a>
                </div>
            </div>
            <!--<a href="/src/costoTotal.html" class="hover:underline">Costo Total</a>-->
            <a href="../src/acerca.php" class="hover:underline">Acerca de</a>
            <!-- <a href="/src/consultorio.html" class="hover:underline">Con.Especializado</a> -->

        </div>
    </div>
</header>


<!-- Eventos de click -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const agregar = document.getElementById('agregar');
    const opcionesCita = document.getElementById('opciones-cita');
    const modificar = document.getElementById('modificar');
    const opcionesModificar = document.getElementById('opciones-modificar');
    const eliminar = document.getElementById('eliminar');
    const opcionesEliminar = document.getElementById('opciones-eliminar');
    const consultar = document.getElementById('consultar');
    const opcionesConsultar = document.getElementById('opciones-consultar');
    const listar = document.getElementById('listar');
    const opcionesListar = document.getElementById('opciones-listar');

    agregar.addEventListener("click", function() {
        opcionesCita.classList.toggle('opacity-100');
        opcionesCita.classList.toggle('invisible');
        opcionesModificar.classList.remove('opacity-100');
        opcionesModificar.classList.add('invisible');
        opcionesEliminar.classList.remove('opacity-100');
        opcionesEliminar.classList.add('invisible');
        opcionesConsultar.classList.remove('opacity-100');
        opcionesConsultar.classList.add('invisible');
    });

    modificar.addEventListener("click", function() {
        opcionesModificar.classList.toggle('opacity-100');
        opcionesModificar.classList.toggle('invisible');
        opcionesCita.classList.remove('opacity-100');
        opcionesCita.classList.add('invisible');
        opcionesEliminar.classList.remove('opacity-100');
        opcionesEliminar.classList.add('invisible');
        opcionesConsultar.classList.remove('opacity-100');
        opcionesConsultar.classList.add('invisible');
    });

    eliminar.addEventListener("click", function() {
        opcionesEliminar.classList.toggle('opacity-100');
        opcionesEliminar.classList.toggle('invisible');
        opcionesCita.classList.remove('opacity-100');
        opcionesCita.classList.add('invisible');
        opcionesModificar.classList.remove('opacity-100');
        opcionesModificar.classList.add('invisible');
        opcionesConsultar.classList.remove('opacity-100');
        opcionesConsultar.classList.add('invisible');
    });

    consultar.addEventListener("click", function() {
        opcionesConsultar.classList.toggle('opacity-100');
        opcionesConsultar.classList.toggle('invisible');
        opcionesCita.classList.remove('opacity-100');
        opcionesCita.classList.add('invisible');
        opcionesModificar.classList.remove('opacity-100');
        opcionesModificar.classList.add('invisible');
        opcionesEliminar.classList.remove('opacity-100');
        opcionesEliminar.classList.add('invisible');
    });

    listar.addEventListener("click", function() {
        opcionesListar.classList.toggle('opacity-100');
        opcionesListar.classList.toggle('invisible');
        opcionesCita.classList.remove('opacity-100');
        opcionesCita.classList.add('invisible');
        opcionesModificar.classList.remove('opacity-100');
        opcionesModificar.classList.add('invisible');
        opcionesEliminar.classList.remove('opacity-100');
        opcionesEliminar.classList.add('invisible');
    });
});
</script>