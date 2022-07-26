<?php 
    include('ConBaseDeDatos.php');
    session_start();
    $Usuario2=$_POST["Usuario"];
    $Contra2=$_POST["Contra"];
    $result= ConsultarUsuario($Usuario2);
    
    if($result['Passw']=='Nada'){
        echo "El usuario no existe";
    }
    else
    {
        if(password_verify($Contra2, $result['Passw'])){
            $_SESSION['user_id'] = $Usuario2;
            echo "iniciando sesión";
        }
        else{
            echo "Contraeña incorrecta";
        }
    }
?>