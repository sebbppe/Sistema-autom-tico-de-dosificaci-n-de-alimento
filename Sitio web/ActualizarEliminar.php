<?php 
include('ConBaseDeDatos.php');
$Proceso=$_POST["Proceso"];
$contra=$_POST["Contra"];
$RFID=$_POST["RFID"];
if($contra=="TG1234"){
if ($Proceso=="Actualizar"){
    $Alimento1=$_POST["Alimento1"];
    $Alimento2=$_POST["Alimento2"];
    $Porciones=$_POST["Porciones"];
    $Consulta=ActualizarDatos($RFID,$Alimento1,$Alimento2,$Porciones);
    echo $Consulta;
}elseif($Proceso=="Eliminar"){
    $Consulta=EliminarRegistros($RFID);
    echo $Consulta;
}
elseif($Proceso=="Ingresar") {
    $Alimento1=$_POST["Alimento1"];
    $Alimento2=$_POST["Alimento2"];
    $Porciones=$_POST["Porciones"];
    $Nombre=$_POST["Nombre"];
    $Consulta=IngresarIndividuos($Nombre,$RFID,$Alimento1,$Alimento2,$Porciones);
    echo $Consulta;

    
    
}
else{
    echo "no se cumplió ningún proceso";
    
}
    
}
else {
    echo "Contraseña incorrecta";
}

?>
