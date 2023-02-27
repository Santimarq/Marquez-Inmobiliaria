<?php  
    
require '../includes/funciones.php';
$auntenticado = estaAuntenticado();

if (!$auntenticado) {
    header('Location:/');
}

    // Conectando la base de datos
    require '../includes/templates/config/database.php';
    $db = conectarDB();

    // Query 
    $query = "SELECT * FROM propiedades ";

    // Consultar  a la base de datos
    $resultadoConsulta = mysqli_query($db ,$query);


    //Si coincide el id eliminamos la propiedad
    if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $id = $_POST ['id'];
    $id = filter_var($id , FILTER_VALIDATE_INT);

    if ('id') {
        // Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE  id = ${id}";
        $resultado = mysqli_query($db , $query);

        // Redireccionando despues de eliminar propiedad
        if ($resultado) {
            header('location:\bienesRaicesPHP_inicio\admin\index.php?resultado=3');
        }
    }


    //echo $query;
        
    }




    //  Mensaje despues de agregar propiedad en la base de datos
    $mensaje = $_GET ['resultado'] ?? null;
    //Incluyendo template de header 
   
     incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador de inmobiliaria</h1>

        <?php if ( intval(  $resultado )  === 1 ) : ?>
            <p class="boton-amarillo"> Anuncio Creado Correctamente</p>
            <?php elseif (intval ($resultado) === 2 ): ?>
            <p class="boton-amarillo">Anuncio Actualizado Correctamente</p> 
            <?php elseif (intval ($resultado) === 3 ): ?>
            <p class="boton-amarillo">Anuncio Eliminado Correctamente</p>  
      <?php endif ; ?>      

        <a href="\bienesRaicesPHP_inicio\admin\propiedades\crear.php" 
         class="boton boton-verde">Nueva Propiedad</a>
   
            <table class="propiedades  boton-verde">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                    </tr>
            </thead>

<tbody>  <!---  Mostras los resultados de las propiedades insertadas en la base de datos --->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>    
       
                    <tr>

                    <td> <?php echo $propiedad ['id'];  ?> </td>
                    <td> <?php echo $propiedad ['titulo'] ?> </td>
                    <td><img src="\bienesRaicesPHP_inicio\src\img\anuncio5.jpg" 
                    class="imagen-tabla iconos-caracteristicas"></td>
                    <td>  <?php echo $propiedad ['precio'] ?> </td>
                    <td> 

        <form  method="POST" class=""> 
            <input type="hidden" name="id"  value="<?php  echo $propiedad ['id'];?>">       
      <input type="submit" class="boton-amarillo" value="Eliminar">
        </form>     


        <a  class="boton-amarillo-block 
        "href="\bienesRaicesPHP_inicio\admin\propiedades\actualizar.php?id=<?php
          echo $propiedad ['id']; ?>">  Actualizar</a>
                </td>
                </tr>
          <?php endwhile; ?>
            </tbody>
           </table>
        </main>

    <?php
            // Cerrar conexion base de datos
            mysqli_close($db);
    incluirTemplate('footer');
?>