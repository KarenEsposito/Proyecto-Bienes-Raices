<?php
    include './includes/templates/header.php';
?>
    
    <main class="contenedor seccion">
        
            <h2>Casas y Apartamentos en Venta</h2>
        <?php 
            $limite = 100;
            include 'includes/templates/anuncios.php';
        ?>

    </main>


    <?php
    
    include './includes/templates/footer.php';
    ?>

