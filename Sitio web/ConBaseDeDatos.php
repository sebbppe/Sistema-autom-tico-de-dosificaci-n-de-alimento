<?php
  $NombreServidor = "127.0.0.1:3306";
  $NombreBaseDatos="u834242973_Bovinos";
  $Usuario = "u834242973_TGComedor";
  $Contra = "Tg12345678";
  function CrearSelector(){
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="SELECT * FROM Bovinos";
    $datos=$conn->query($sentencia);
    while ($filas = $datos->fetch_assoc()) {
        $codigo=$filas['CodigoRFID'];
        $nombre=$filas['Nombre'];
        echo '<option value="'.$codigo.'">'.$nombre.'</option>';
    }
  }
    function ActualizarDatos($CodigoRFID,$Aliment1,$Aliment2,$Porciones) {
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="UPDATE Bovinos SET Alimentacion1='$Aliment1',Alimentacion2='$Aliment2',NumPorciones='$Porciones' WHERE CodigoRFID='$CodigoRFID'";
    if ($conn->query($sentencia) === TRUE) {
            $Mensaje="Se ha actualizado el registro";
    }
    else {
            $Mensaje="Error al conectar con la base de datos";
    }
    return $Mensaje;
    $conn->close();
    
    }
  function ListarTablaNombre($Nomb){
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="SELECT * FROM Bovinos WHERE Nombre LIKE '".$Nomb."%'";
    $datos=$conn->query($sentencia);
    $total=array();
    while ($filas = $datos->fetch_assoc()) {
        $codigo=$filas['CodigoRFID'];
        $nombre=$filas['Nombre'];
        $Alimento1=$filas['Alimentacion1'];
        $Alimento2=$filas['Alimentacion2'];
        $Fecha=$filas['FechaDeRegistro'];
        $Porciones=$filas['NumPorciones'];
        $info=array("Nombre"=>$nombre,"CodigoRFID"=>$codigo,"Alimentacion1"=>$Alimento1,"Alimentacion2"=>$Alimento2,"Fecha"=>$Fecha,"Porciones"=>$Porciones);
        array_push($total,$info);
    }
    return $total;
  }
  function ListarTablaCodigo($RFID){
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="SELECT * FROM Bovinos WHERE CodigoRFID LIKE '".$RFID."%'";
    $datos=$conn->query($sentencia);
    $total=array();
    while ($filas = $datos->fetch_assoc()) {
        $codigo=$filas['CodigoRFID'];
        $nombre=$filas['Nombre'];
        $Alimento1=$filas['Alimentacion1'];
        $Alimento2=$filas['Alimentacion2'];
        $Fecha=$filas['FechaDeRegistro'];
        $Porciones=$filas['NumPorciones'];
        $info=array("Nombre"=>$nombre,"CodigoRFID"=>$codigo,"Alimentacion1"=>$Alimento1,"Alimentacion2"=>$Alimento2,"Fecha"=>$Fecha,"Porciones"=>$Porciones);
        array_push($total,$info);
    }
    return $total;
      
  }
  function IngresarIndividuos($Nombre,$CodigoRFID,$Alimentacion1,$Alimentacion2,$Porciones) {
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
   // conectandose en la base de datos
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="SELECT * FROM Bovinos WHERE (CodigoRFID='$CodigoRFID' || Nombre='$Nombre')";
    $datos=$conn->query($sentencia);
    $filas=$datos->fetch_assoc();
    if ($filas['Nombre']!=$Nombre){
    if ($filas['CodigoRFID']!=$CodigoRFID){
        date_default_timezone_set('America/New_York');
        $hoy = getdate();
        $Fecha="$hoy[year]-$hoy[mon]-$hoy[mday] $hoy[hours]:$hoy[minutes]:$hoy[seconds]";
        $sentencia = "INSERT INTO Bovinos (Nombre, CodigoRFID, Alimentacion1, Alimentacion2,NumPorciones, FechaDeRegistro)
        VALUES ('$Nombre','$CodigoRFID','$Alimentacion1','$Alimentacion2','$Porciones','$Fecha')";
        if ($conn->query($sentencia) === TRUE) {
            $Mensaje= "Registrado el individuo";
         }
        else {
            $Mensaje= "Error: " . $sql . "<br>" . $conn->error;
         }
    }
    else{
        $Mensaje= "El código RFID registrado, ya está en la base de datos... Por favor, introduzca otro código";
    }}
    else
    {
        $Mensaje= "El nombre registrado, ya está en la base de datos... Por favor, introduzca otro nombre";
    }
    return $Mensaje;
    $conn->close();
  }
  function EliminarRegistros($CodigoRFID) {
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    // conectandose en la base de datos
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="DELETE FROM Bovinos WHERE CodigoRFID='$CodigoRFID'";
    if ($conn->query($sentencia) === TRUE) {
            $Mensaje="Se ha eliminado el registro del individuo";
    }
    else {
            $Mensaje= "Ha ocurrido un error al eliminar el registro";
    }
    $sentencia="DELETE FROM RegistroAlimentacion WHERE CodigoRFID='$CodigoRFID'";
    if ($conn->query($sentencia) === TRUE) {
            $Mensaje=$Mensaje." y los registros de alimentación del mismo.";
    }
    else {
            $Mensaje=$Mensaje. " Ha ocurrido un error al eliminar los registros de alimentación";
    }
    return $Mensaje;
    $conn->close();
  }
  function IngresarDatos($CodigoRFID,$Suministro1,$Suministro2,$Desperdicio) {
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
    // conectandose en la base de datos
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    date_default_timezone_set('America/New_York');
    $hoy=date("Y-m-d");
    $sentencia = "INSERT INTO RegistroAlimentacion(CodigoRFID,SuministroA1,SuministroA2,Desperdicio,Fecha) VALUES ('$CodigoRFID','$Suministro1','$Suministro2','$Desperdicio','$hoy');";

    if ($conn->query($sentencia) === TRUE) {
            echo "1";
    }
    else {
            echo "Error: " . $sentencia . "<br>" . $conn->error;
    }
    $conn->close();
  }
  function ObtenerRegistros(){
    global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        // conectandose en la base de datos
    $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
    // verificar conexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sentencia="SELECT * FROM Bovinos";
    if ($result = $conn->query($sentencia)) {
        $i=1;
        $total=array();
        while ($fila = $result->fetch_assoc()) {
            //printf("Nombre: %s,CodigoRFID: %s, Alimentacion1: %s, Alimentacion2: %s \n", $fila['Nombre'], $fila['CodigoRFID'],$fila['Alimentacion1'],$fila['Alimentacion2']);
            $Nombre=$fila['Nombre'];
            $RFID=$fila['CodigoRFID'];
            $Aliment1=floatval($fila['Alimentacion1']);
            $Aliment2=floatval($fila['Alimentacion2']);
            $info=array("bovino". strval($i)=>array("CodigoRFID"=>$RFID,"Alimentacion1"=>$Aliment1,"Alimentacion2"=>$Aliment2));
            array_push($total,$info);
            $i=$i+1;
        }
        echo json_encode($total);
    }
    else {
    }
    $conn->close();
  }
  function ConsultarSuministroDelDia($CodigoRFID){
        global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        date_default_timezone_set('America/New_York');
        $hoy = getdate();
        //$Fecha="$hoy[year]-$hoy[mon]-$hoy[mday]";
        $Fecha=date("Y-m-d");
        $sentencia = "SELECT SUM(SuministroA1), SUM(SuministroA2) FROM RegistroAlimentacion WHERE (Fecha='$Fecha' && CodigoRFID='$CodigoRFID')";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Suministro1=floatval($filas[0]);
            $Suministro2=floatval($filas[1]);
            $resp=array("Suministro1"=>$Suministro1,"Suministro2"=>$Suministro2);
        }
        else{
            $Suministro1=0.0;
            $Suministro2=0.0;
            $resp=array("Suministro1"=>$Suministro1,"Suministro2"=>$Suministro2);
        }
        return $resp;
  }
  function ConsultarDieta($CodigoRFID){
        global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT Alimentacion1, Alimentacion2, NumPorciones FROM Bovinos WHERE CodigoRFID='$CodigoRFID'";
        $datos=$conn->query($sentencia);
        if ($filas=$datos->fetch_row()){
            $Alimento1=floatval($filas[0]);
            $Alimento2=floatval($filas[1]);
            $Porciones=floatval($filas[2]);
            $resp=array("Alimento1"=>$Alimento1,"Alimento2"=>$Alimento2,"Porciones"=>$Porciones);
            return $resp;
        }else{
        $sentencia = "SELECT Alimentacion1, Alimentacion2, NumPorciones FROM Bovinos WHERE CodigoRFID='RFPREDETER'";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Alimento1=floatval($filas[0]);
            $Alimento2=floatval($filas[1]);
            $Porciones=floatval($filas[2]);
            $resp=array("Alimento1"=>$Alimento1,"Alimento2"=>$Alimento2,"Porciones"=>$Porciones);
            return $resp;
        }
        }
  }
  
  function ConsultarSuministroPorFechas($Fecha,$CodigoRFID){
      global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT SUM(SuministroA1), SUM(SuministroA2) FROM RegistroAlimentacion WHERE (Fecha='$Fecha' && CodigoRFID='$CodigoRFID')";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Suministro1=floatval($filas[0]);
            $Suministro2=floatval($filas[1]);
            $resp=array("Suministro1"=>$Suministro1,"Suministro2"=>$Suministro2);
        }
        else
        {
            $resp=array("Suministro1"=>0,"Suministro2"=>0);
        }
        return $resp;
  }
  function ConsultarSuministroPorFechasTotal($Fecha){
      global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT SUM(SuministroA1), SUM(SuministroA2) FROM RegistroAlimentacion WHERE (Fecha='$Fecha')";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Suministro1=floatval($filas[0]);
            $Suministro2=floatval($filas[1]);
            $resp=array("Suministro1"=>$Suministro1,"Suministro2"=>$Suministro2);
        }
        else
        {
            $resp=array("Suministro1"=>0,"Suministro2"=>0);
        }
        return $resp;
  }
  function ConsultarDesperdicioPorFechas($Fecha){
      global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT SUM(Desperdicio) FROM RegistroAlimentacion WHERE (Fecha='$Fecha')";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Desperdicio=floatval($filas[0]);
            $resp=array("Desperdicio"=>$Desperdicio);
        }
        else
        {
            $resp=array("Desperdicio"=>0);
        }
        return $resp;
  }
  function ConsultarDesperdicioPorFechasYCodigo($Fecha,$CodigoRFID){
      global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT SUM(Desperdicio) FROM RegistroAlimentacion WHERE (Fecha='$Fecha' && CodigoRFID='$CodigoRFID')";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Desperdicio=floatval($filas[0]);
            $resp=array("Desperdicio"=>$Desperdicio);
        }
        else
        {
            $resp=array("Desperdicio"=>0);
        }
        return $resp;
  }
  
  function ConsultarUsuario($Usuario2){
      global $NombreServidor, $Usuario, $Contra, $NombreBaseDatos;
        $conn=mysqli_connect($NombreServidor, $Usuario, $Contra , $NombreBaseDatos);
        // verificar conexion
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sentencia = "SELECT `password` FROM `Usuarios` WHERE nombreUsuario='$Usuario2'";
        $datos=$conn->query($sentencia);
        if ($datos){
            $filas=$datos->fetch_row();
            $Passw=$filas[0];
            $resp=array("Passw"=>$Passw);
        }
        else
        {
            $resp=array("Passw"=>"Nada");
        }
        return $resp;
  }
  ?>
  