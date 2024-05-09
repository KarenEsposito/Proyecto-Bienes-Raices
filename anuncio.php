<?php
        include './includes/templates/header.php';

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /');
        }

        //Importar la conexion
        require 'includes/config/database.php';
        $db = conectarDB();
    
    
        //consultar 
    
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
    
    
        //obtener resultado
        $resultado = mysqli_query($db, $query);

        if(!$resultado ->num_rows){
            header('Location: /');
        }


        $propiedad = mysqli_fetch_assoc($resultado);


?>


    
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen propiedad">
        <div class="resumen-propiedad">
            <?php echo $propiedad['descripcion']; ?>
            <p class="direccion"><?php echo "Dirección:  "  . $propiedad['direccion']; ?></p>
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
 
        </div>
        <a href="./contacto.php" class="boton-amarillo">Contactános</a>
    </main>

<?php
    
    include './includes/templates/footer.php'; 

    //cerrar la conexion bd

    mysqli_close($db);
?>

