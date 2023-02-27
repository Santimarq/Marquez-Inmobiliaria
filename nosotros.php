<?php  
      require 'includes/funciones.php';
      incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>

                <p>   Somos una empresa dedicada a brindar servicios inmobiliarios de alto nivel. Para ello contamos con profesionales orientados a satisfacer y superar los requerimientos de un mercado cada vez más competitivo y exigente . Ofrecemos un servicio personalizado a cada cliente. Nuestra trayectoria, experiencia y confiabilidad hacen que 
                    nuestros valores agregados sean la confianza y profesionalismo que nos destacan  </p>
            </div>
        </div>
    </main>

    

 <?php
    incluirTemplate('footer');
?>