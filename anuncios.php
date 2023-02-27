<?php  
     require 'includes/funciones.php';
     incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h2>Casas en Venta</h2>

    <?php
        // Maximo de  propiedades  para mostrar en el front-end
         $limite = 7 ;  
         include 'includes/templates/config/anuncio.php';
      ?>


    </main>

<?php
    incluirTemplate('footer');
?>