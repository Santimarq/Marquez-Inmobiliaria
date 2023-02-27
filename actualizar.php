<?php  

require '../../includes/funciones.php';
$auntenticado = estaAuntenticado();

if (!$auntenticado) {
    header('Location:/');
}

// Validando que el id sea valido 
    $id = $_GET ['id'];
    $id = filter_var($id , FILTER_VALIDATE_INT);
    if (!$id) {
     header ('Location: /admin');
   }
   
        
   //Conectando a la base de datos
    require '../../includes/templates/config/database.php';
     $db = conectarDB();

    //Obtener los datos de la propiedad 
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
   $resultado = mysqli_query($db , $consulta);
   $propiedad = mysqli_fetch_assoc($resultado);

   //echo "<pre>";
   //var_dump($propiedad);
   //echo "</pre>";
    
    
    
    //echo $consulta ;


    // Consultar a la base de datos los vendedores
    $consulta = " SELECT * FROM vendedores";
    $resultado = mysqli_query($db , $consulta);


     // array con errores para validar el formulario
        $errores = [];

        $titulo = $propiedad ['titulo'];
        $precio = $propiedad ['precio'];
        $descripcion = $propiedad ['descripcion'];
        $habitaciones = $propiedad ['habitaciones'];
        $wc = $propiedad ['wc'];
        $estacionamiento = $propiedad ['estacionamiento'];
        $vendedor =  $propiedad ['vendedor'];


     // ejecutrar el codigo despues q se envia el formulario
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        // Sanitizando los datos del formulario
        $titulo = mysqli_real_escape_string( $db,$_POST ['titulo']) ;
        $precio =  mysqli_real_escape_string( $db , $_POST ['precio']);
        $descripcion = mysqli_real_escape_string( $db , $_POST ['descripcion']);
        $habitaciones =  mysqli_real_escape_string( $db, $_POST ['habitaciones']);
        $wc = mysqli_real_escape_string( $db , $_POST ['wc']);
        $estacionamiento =  mysqli_real_escape_string( $db ,$_POST ['estacionamiento']);
        $vendedor = mysqli_real_escape_string( $db , $_POST ['vendedor']);
        $creado = date('Y/m/d');
        $imagen = $_FILES ['imagen'];
       // var_dump($imagen ['imagen']);

        //exit;


        // validando el formulario 

        if (!$titulo) {
            $errores [] = "Debes añadir un titulo";
        }
        if (!$precio) {
            $errores [] = "Debes añadir un precio";
        }
        if (!$descripcion) {
            $errores [] = "Debes añadir una descripcion";
        }
        if (!$habitaciones) {
            $errores [] = "Debes añadir un numero de habitaciones";
        }
        if (!$wc) {
            $errores [] = "Debes añadir un numero de baños";
        }
        if (!$estacionamiento) {
            $errores [] = "Debes añadir un numero de estacionamiento";
        }
        if (!$vendedor) {
            $errores [] = "Debes elegir un vendedor";
        }
       // if (!$imagen ['name'] || $imagen ['error']) {
         //   $errores [] = "Debes Añadir una imagen";
      //  }

        // Validar imagen por tamaño

        $medida = 1000 * 1000;


        // Revisar que el arreglo de errores este vacio
        if (empty($errores)) {

       // Insertar en la base de datos
       $query =  "UPDATE propiedades SET  titulo = '${titulo}' , precio = '${precio}' , 
        descripcion = '${descripcion}' ,  habitaciones = ${habitaciones} ,  wc = ${wc}
         ,estacionamiento = ${estacionamiento} , venededor = ${vendedor}  WHERE id = ${id} ";

      // echo $query;
        //exit;
      
        
      $resultado = mysqli_query($db , $query);
      
      if($resultado) {
      // echo "Insertado correctamente";

      // Redireccionar al usuario despues de actulizar la propiedad

        header('location:/bienesRaicesPHP_inicio/admin/index.php ');
  
         }
       }
 }


   
     incluirTemplate('header');
    ?>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedades </h1>

        <a href="\bienesRaicesPHP_inicio\admin\index.php " class="boton boton-verde"> Volver</a>

    <?php  foreach ($errores as $error ): ?>

        <div class="boton-amarillo">
        <?php echo $error; ?>
        </div>

       

     <?php endforeach ;?>   



        <form class="formulario" method="POST">
                <fieldset>
                    <legend>Informacion General</legend>

                    <label for="titulo"> titulo:</label>
                    <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" 
                    value="<?php echo $titulo; ?> "  >

                    <label for="precio"> precio:</label>
                    <input type="number" id="precio" placeholder="Precio" name="precio" 
                    value="<?php echo $precio ?>">

                    <label for="imagen"> imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/jpeg" >

                    <label for="descripcion">descripcion:</label>
                    <textarea name="descripcion"  id="descripcion"> <?php echo $descripcion?>   </textarea>
                </fieldset>

                <fieldset>
                    <legend>Informacion de la propiedad</legend>

                    <label for="habitaciones">Habitaciones</label>
                    <input type="number" id="habitaciones" placeholder="Ej:3" min="1" max="9" name="habitaciones" 
                    value="<?php echo $habitaciones ?>">

                    <label for="wc"> Baños:</label>
                    <input type="number" id="wc" placeholder="Ej:4" min="1" max="9"  name="wc"  
                    value=" <?php echo $wc ?>">
                    

                    <label for="estacionamiento"> Estacionamineto:</label>
                    <input type="number" id="estacionamiento" placeholder="Ej:4" min="1" max="9" name="estacionamiento" 
                    value=" <?php echo $wc ?>"> 
                </fieldset>

                <fieldset>
                    <legend>Vendedor</legend>

                    <select name="vendedor">
                        <option value="" disabled> --Seleccionar--</option>
                        <?php while ($row = mysqli_fetch_assoc($resultado) ) : ?>

                            <option <?php echo $vendedor === $row ['id'] ? 'select': '';  ?> 
                            value=" <?php echo $row ['id']; ?>"> 
                             <?php echo $row ['nombre'] . "" . $row['apellido'] ?>  </option>
                           

                            <?php endwhile; ?>
                    </select>
                    </fieldset>
       <input type="submit" class="boton boton-verde"  value="Actualizar Propiedad">
                
        </form>
    </main>

    <?php
    incluirTemplate('footer');
?>