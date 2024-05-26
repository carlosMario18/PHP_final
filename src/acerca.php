<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Acerca de</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->


<!-- Inicio contenido principal -->
<div class="flex justify-center items-center mt-28">
    <img src="img/iconAcercaDe.jpg" alt="acerca" class="mr-4">
    <h1 class="text-black font-semibold text-2xl">Acerca de:</h1>
</div>
<div class="text-center mt-6 text-black text-lg font-medium">
    <p>Luis Alejandro Sanmiguel Galeano 2220221058</p>
    <p>Carlos Mario Bernal Cuellar 2220221050</p>
    <p>Mario Daniel Orozco Muñoz 2220201013</p>
</div>
<!-- Fin contenido principal -->


<!-- Inicio Footer -->
<?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->
    
</body>
</html>