<?php  
    //Login de aminstrador de la web
    include 'includes/templates/config/database.php';
    $db = conectarDB();

    // Si hay errores los agregamos al array
    $errores = [];

    // Autenticar el usuario
    if ($_SERVER ['REQUEST_METHOD'] === 'POST' ) {
     $email =  mysqli_real_escape_string( $db,  filter_var($_POST ['email'] , FILTER_VALIDATE_EMAIL));
     $password = mysqli_real_escape_string($db ,$_POST ['password'] ) ;

     //validando los campos 
     if (!$email) {
        $errores[] = "Debes añadir un email y que sea valido";
     }
     if (!$password) {
        $errores[] = "Debes añadir una contraseña y que sea correcta";
     }
    if (empty($errores)) {
        //revisar si el usuario existe 
        $query = "SELECT * FROM usuarios WHERE email '${email}' ";
        $resultado = mysqli_query($db,$query);

     if($resultado -> num_rows) {
        // revisar si la contraseña es correcta 
        $usuario = mysqli_fetch_assoc($resultado);
        //verificar el password
        $auntenticado = password_verify($password , $usuario ['password']);    
        
        if($auntenticado) {
            //el usuario esta auntenticado
            session_start();
            $_SESSION ['usuario'] = $usuario ['email'];
            $_SESSION ['login'] =  true;

            header('Location:\bienesRaicesPHP_inicio\admin\propiedades\crear.php ');


        }else {
            $errores[] = "la contraseña es incorrecta";
        }


     }else {
        
        $errores[] = "El usuario no existe";
     }    
    
    
        }

    }
       
      



    // Incluye el header 
     require 'includes/funciones.php';
     incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Administrador de Marquez Inmobiliaria</h1>

    <?php foreach ($errores as $error):  ?>
        <div class="boton boton-verde">
        <?php echo $error ;?>
        </div>

        <?php endforeach ;?>

        <form method="POST" class="formulario"  >

        <fieldset>
                <legend>Email y Contraseña </legend>

                <label for="email">Email</label>
                <input type="email" placeholder="Tu email" id="email" name="email" required >

                <label for="password">Contraseña </label>
                <input type="password" placeholder="Tu password"  name="password" id="password" required>
            </fieldset>
 <input type="submit" class="boton-amarillo" value="Iniciar Sesion">


        </form>
    </main>

    <?php
    incluirTemplate('footer');
?>