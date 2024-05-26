<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>Hospital de Ibague</title>
</head>
<body class="flex flex-col min-h-screen">

<!-- Inicio Header -->
<?php
@include('./includes/header.php')
?>
<!-- Fin Header -->

<h1 class="text-center text-black text-2xl font-semibold mt-8">
    Hospital de Ibagué
</h1>

<!-- Inicio imagenes -->
<div class="flex justify-center mt-8 space-x-4">
    <img src="img/logoIndex1.jpeg" alt="Imagen index 1" width="32%">
    <img src="img/logoIndex2.jpeg" alt="Imagen index 2" width="32%">
    <img src="img/logoIndex3.jpeg" alt="Imagen index 3" width="32%">
</div>
<!-- Fin imagenes -->


    <!-- Inicio Footer -->
<?php
@include('./includes/footer.php')  
?> 
 <!--Fin Footer  -->
</body>
</html>