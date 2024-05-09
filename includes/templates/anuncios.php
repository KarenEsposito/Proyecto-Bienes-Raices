<?php

    //Importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();


    //consultar 

    $query = "SELECT * FROM propiedades LIMIT ${limite}";


    //obtener resultado

    $resultado = mysqli_query($db, $query);


?>


    <div class="contenedor-anuncios">
            <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>        
            <div class="anuncios">
                <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen propiedad">

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad['titulo']; ?></h3>
                    <p class="direccion"><?php echo "Dirección:  "  . $propiedad['direccion']; ?></p>
                    <p><?php echo $propiedad['descripcion']; ?></p>
                    <p class="precio"><?php echo "$ ". $propiedad['precio']; ?></p>
                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono parqueadero">
                            <p><?php echo $propiedad['parqueaderos']; ?></p>
                        </li>

                    </ul>

                    <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class=" boton-amarillo-block">Ver Propiedad</a>
                </div> <!--.contenido-anuncio -->

            </div> <!--.anuncio -->
            <?php endwhile; ?>

    </div><!--.contenedor-anuncio -->




<?php

    //cerrar la conexion bd

    mysqli_close($db);
?>

