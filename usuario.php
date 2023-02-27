<?php 
 // Auntenticacion del administrador de la web

// Trayendo  la conexion de base de datos
require 'includes/templates/config/database.php';
 $db = conectarDB();

// Crear un email y password
$email = "santiago@correo.com";
$password = "121232";

// Hashear password
$passwordHash = password_hash ($password , PASSWORD_DEFAULT);



// Agregar el usuario 
$query = "INSERT INTO usuarios (email,password ) VALUES  ( '${email}' , '${passwordHash}') ;";

//echo $query;



// Insertar a la base de datos
mysqli_query($db , $query);
