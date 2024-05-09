<?php

    require '../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /');  
    }


    //1. IMPORTAR LA CONEXION
    require '../includes/config/database.php';
    $db = conectarDB();



    //2. ESCRIBIR EL QUERY
    $query = "SELECT * FROM propiedades";


    //3. CONSULTAR LA BASE DE DATOS
    $resultadoConsulta = mysqli_query($db, $query);




    //muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    //ELIMINAR PROPIEDAD
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            //elimina la propiedad pero no el archivo
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            if($resultado) {

                header('Location: /admin?resultado=3');
            }
        }

    }
    
    //incluye un template

    incluirTemplate('header');
?>
    

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php  if(intval($resultado) === 1): ?>
                <p class="alerta exito">Propiedad Creada Correctamente</p>
            <?php elseif(intval($resultado) === 2): ?>
                <p class="alerta exito">Propiedad Actualizada Correctamente</p>
            <?php elseif(intval($resultado) === 3): ?>
                <p class="alerta exito">Propiedad Eliminada Correctamente</p>
        <?php endif; ?>
        

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Dirección</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>


            <tbody> <!-- 4. mOSTRAR LOS RESULTADOS -->
            <?php while($propiedad = mysqli_fetch_assoc( $resultadoConsulta)): ?>
                <tr>
                    <td><?php  echo $propiedad['id']; ?></td>
                    <td><?php  echo $propiedad['titulo']; ?></td>
                    <td> <img class="imagen-tabla" src="/imagenes/<?php  echo $propiedad['imagen']; ?>"> </td>
                    <td>$ <?php  echo $propiedad['direccion']; ?></td>
                    <td>$ <?php  echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">                        
                        </form>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>


                    </td>                    
                </tr>
                <?php  endwhile; ?>

            </tbody>
        </table>
    </main>


<?php


    //5.OPCIONAL: CERRAR LA CONEXION
    mysqli_close(($db));



    incluirTemplate('footer');
?>

