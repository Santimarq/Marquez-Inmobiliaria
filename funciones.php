<?php 

require 'app.php';


function incluirTemplate ( string   $nombre , bool $inicio = false ) {
        include  TEMPLATES_URL .   "/${nombre}.php";
}

function estaAuntenticado () : bool {
        session_start();

$auntenticado = $_SESSION ['login'];
    if ($auntenticado) {
        return true;
    }   
    return false;

}
