<?php
  include_once('ConBaseDeDatos.php');
  //API key
  $api_key_value = "tPmAT5Ab3j7F9";
  $api_key= $CodigoRFID= "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $funcion=$_POST["Fun"];
        if ($funcion=="ConsultarSuministro"){
            $CodigoRFID = test_input($_POST["CodigoRFID"]);
            $Dietas=ConsultarDieta($CodigoRFID);
            $Alimento1=$Dietas["Alimento1"];
            $Alimento2=$Dietas["Alimento2"];
            $Porciones=$Dietas["Porciones"];
            $Suministrado=ConsultarSuministroDelDia($CodigoRFID);
            $SuministroA1=$Suministrado["Suministro1"];
            $SuministroA2=$Suministrado["Suministro2"];
            
            $DiffA1=$Alimento1-$SuministroA1;
            $DiffA2=$Alimento2-$SuministroA2;
            if ($DiffA1>=$Alimento1/$Porciones && $DiffA2>=$Alimento2/$Porciones){
                $Suministrar1=$Alimento1/$Porciones;
                $Suministrar2=$Alimento2/$Porciones;
            }
            else if($DiffA1>=0 && $DiffA2>=0){
                $Suministrar1=$DiffA1;
                $Suministrar2=$DiffA2;
            }
            else{
                $Suministrar1=0;
                $Suministrar2=0;
            }
            $resp=array("Suministrar1"=>$Suministrar1,"Suministrar2"=>$Suministrar2);
            echo json_encode($resp);
        }
        elseif($funcion=="IngresarConsumo"){
            $CodigoRFID = test_input($_POST["CodigoRFID"]);
            $Suministro1 = test_input($_POST["Suministro1"]);
            $Suministro2 = test_input($_POST["Suministro2"]);
            $Desperdicio = test_input($_POST["Desperdicio"]);
            IngresarDatos($CodigoRFID,$Suministro1,$Suministro2,$Desperdicio);
        }
        elseif ($funcion=="ConsultarDieta"){
            $CodigoRFID = test_input($_POST["CodigoRFID"]);
            ConsultarDieta($CodigoRFID);
        }
    }
    else {
      echo "API key errónea.";
    }
  }
  else {
    echo "No hay datos posteados.";
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

  
  
  
  
  