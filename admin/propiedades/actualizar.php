<?php

    require '../../includes/funciones.php';
    $auth = estaAutenticado();
    if(!$auth){
        header('Location: /');  
    }

    //VALIDAR QUE SEA UN ID VALIDO NO UN HOLA O ALGO ASI
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);


    if(!$id){
        header('Location: /admin');
    }




    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();



    //CONSULTA PARA OBTENER LO DATOS DE LA PROPIEDAD
    $consulta ="SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);



    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);




    //arreglo con mensajes de error

    $errores = [];

    $titulo = $propiedad['titulo'];
    $direccion = $propiedad['direccion'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $parqueaderos = $propiedad['parqueaderos'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];



    //ejercutar el codigo despuest de que el usuario envia el formulario
       if($_SERVER['REQUEST_METHOD'] === 'POST'){


        // echo "<pre>" ;
        // var_dump($_POST);
        // echo "</pre>";


        //SANITIZAR
            // $numero = "1Hola";
            // $numero2 = 1;
            
            // $resultado = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);
            // $resultado = filter_var($numero, FILTER_SANITIZE_EMAIL);
            // $resultado = filter_var($numero, FILTER_VALIDATE_EMAIL);
            //var_dump($resultado);


        $titulo = mysqli_real_escape_string( $db,  $_POST['titulo'] ); //mysqli_real_escape_string sirve para escapar datos, validar string, numeros enteros
        $direccion = mysqli_real_escape_string( $db,  $_POST['direccion'] ); //mysqli_real_escape_string sirve para escapar datos, validar string, numeros enteros
        $precio = mysqli_real_escape_string( $db,  $_POST['precio'] );
        $descripcion = mysqli_real_escape_string( $db,  $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string( $db,  $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string( $db,  $_POST['wc'] );
        $parqueaderos = mysqli_real_escape_string( $db,  $_POST['parqueaderos'] );
        $vendedorId = mysqli_real_escape_string( $db,  $_POST['vendedorId'] );
        $creado = date('Y-m-d');


        //Asignar files hacia una variables
        $imagen =$_FILES['imagen'];


        if(!$titulo) {
            $errores[] = "Debes añadir un Titulo";
        }

        if(!$direccion) {
            $errores[] = "Debes añadir un Direccion";
        }

        if(!$precio) {
            $errores[] = 'El Precio es Obligatorio';
        }

        if( strlen( $descripcion ) < 50 ) {
            $errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$habitaciones) {
            $errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$wc) {
            $errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$parqueaderos) {
            $errores[] = 'El Número de Parqueaderos es obligatorio';
        }
        
        if(!$vendedorId) {
            $errores[] = 'Elige un vendedor';
        }


        //validar por tamaño (1000 Kb máximo)
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida){
            $errores[] = 'La Imagen es muy pesada';
        }

        // echo "<pre>" ;
        // var_dump($errores);
        // echo "</pre>";

        // exit; // prevenir que se ejecute la insercion a la base de datos





        //Revisar que el arreglo de erores este como esta, vacio


        if(empty($errores)){


            /**SUbir de archivos*/


            //crear carpeta
            $carpetaImagenes = '../../imagenes/';
            
            if(!is_dir($carpetaImagenes)){ //sino existe la carperta imagenes en mi directorio, en este caso en la carpera madre, entonces me crea a traves de la fundion MKDIR  la carpeta de IMAGENES
                mkdir($carpetaImagenes);                
            }

            $nombreImagen = '';


            if($imagen['name']){
                //ELIMINAR LA IMAGEN PREVIA
                unlink($carpetaImagenes . $propiedad['imagen']);// funcion PHP diseñada especificamente para eliminar archivos

                
                //Generar nombre unico para imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg" ;

                //Subir imagenes
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

            }else{
                $nombreImagen = $propiedad['imagen'];
            }




            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', direccion = '${direccion}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, parqueaderos = ${parqueaderos}, vendedorId = ${vendedorId} WHERE id = ${id} ";
        
            // echo $query;

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccionar al usuario para que los usuarios no metan datos duplicados.
                header('Location: /admin?resultado=2');
            }
        }

    }

    incluirTemplate('header');
?>
    

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Regresar</a>
        
        <?php foreach($errores as $error): ?>

        <div class="alerta error">
            <?php echo $error; ?>     
        </div>
        
       
        <?php  endforeach; ?>

        <form class="formulario" method="POST"  enctype="multipart/form-data"> <!-- /**enctype="multipart/form-data" sirve para cargar los archivos en backend, que no es solo un nombre sino que se esta cargando un archivo */  -->
            <fieldset>
                <legend>Información General</legend>
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

                <label for="direccion">Direccion:</label>
                <input type="text" id="direccion" name="direccion" placeholder="Direccion de la Propiedad" value="<?php echo $direccion; ?>">
                

                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej :3" min="1" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej :3" min="1" value="<?php echo $wc; ?>">

                <label for="parqueaderos">Parqueaderos:</label>
                <input type="number" id="parqueaderos" name="parqueaderos" placeholder="Ej :3" min="1" value="<?php echo $parqueaderos; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId">
                    <option value="">-- Selecione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ) :?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : '';  ?>   value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre']. " " . $vendedor['apellido']; ?></option>

                    <?php endwhile;?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>

    </main>


<?php
    incluirTemplate('footer');
?>

