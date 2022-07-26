<?php
    include_once('ConBaseDeDatos.php');
    if ($_GET['AccessPassword']=="Tg1234"){
        ObtenerRegistros();
    }
    else
    {
        echo "Acceso restringido";
    }
    

?>