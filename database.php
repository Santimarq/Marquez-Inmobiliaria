<?php
// Conectando a la base de datos

function conectarDB () : mysqli {
    $db= mysqli_connect('localhost' , 'root' , 'root123' , 'marquezinmo_crud');

   if(!$db) {
    echo "no se pudo conectar";
    exit;
   }
   return $db;
   
   
}
   
    // if ($db) {
     //   echo "Se puedo conectar la base de datos";
  //  } else {
     //   "No se puudo conectar a la base de datos";
  //  }
 