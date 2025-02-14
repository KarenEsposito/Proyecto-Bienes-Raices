<?php 
    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Más sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate modi nesciunt labore perferendis velit laudantium incidunt reiciendis est ducimus exercitationem amet beatae, alias at dolorem veniam dicta doloremque aut? Tempore?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio " loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate modi nesciunt labore perferendis velit laudantium incidunt reiciendis est ducimus exercitationem amet beatae, alias at dolorem veniam dicta doloremque aut? Tempore?</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate modi nesciunt labore perferendis velit laudantium incidunt reiciendis est ducimus exercitationem amet beatae, alias at dolorem veniam dicta doloremque aut? Tempore?</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Apartamentos en Venta</h2>

        <?php 
            $limite = 3;
            include 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todos</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la Casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>17/04/2024</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article>


            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>17/04/2024</span> por: <span>Admin</span></p>

                        <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article>


        </section>


        <section class="testimonios">
            <h3>Testimonios</h3>
            <div class="testimonio">
                <blockquote>
                    El personal se comportó de una excelente forma, muy b uena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p> - Karen Stefany Espósito</p>
            </div>
        </section>
    </div>

    <?php 
    incluirTemplate('footer');
    ?>


    