<?php 
include('ConBaseDeDatos.php');
$RFID=$_POST["CodigoRF"];
$Rango=intval($_POST["rango"]);
date_default_timezone_set('America/New_York');
$Desperdicio="";
$SuministroTotal="";
$Consumo="";
$Fechas="";

for ($i=$Rango-1; $i>=0;$i--){
    $fecha=date("Y-m-d", strtotime("-$i day", time()));
    $dato=ConsultarSuministroPorFechas($fecha,$RFID);
    $dato1=ConsultarDesperdicioPorFechasYCodigo($fecha,$RFID);
    if ($i==($Rango-1)){
        $Suministro1=$dato["Suministro1"];
        $Suministro2=$dato["Suministro2"];
        $SuministroTotal=$SuministroTotal.($Suministro1+$Suministro2);
        $Desperdicio=$Desperdicio.$dato1["Desperdicio"];
        $Consumo=$Consumo.($Suministro1+$Suministro2-$dato1["Desperdicio"]);
        $Fechas=$Fechas. "'".$fecha."'";
    }
    else
    {
        $Suministro1=$dato["Suministro1"];
        $Suministro2=$dato["Suministro2"]; 
        $SuministroTotal=$SuministroTotal.",".($Suministro1+$Suministro2);
        $Desperdicio=$Desperdicio.",".$dato1["Desperdicio"];
        $Consumo=$Consumo.",".($Suministro1+$Suministro2-$dato1["Desperdicio"]);
        $Fechas=$Fechas. ",'".$fecha."'";
    }
    
}
?>
<div class="col">
        <canvas id="Grafica" width="100%" height="100%"></canvas>
</div>
<div class="col">
        <canvas id="Grafica2" width="100%" height="100%"></canvas>
</div>

<script>
    var ctx=document.getElementById("Grafica").getContext("2d");
    var ctx2=document.getElementById("Grafica2").getContext("2d");
    var MyChart= new Chart(ctx,{
        type:"line",
        data:
        {
            labels:[<?php echo $Fechas; ?>
            ],
            datasets: [
                {
                  label: 'Suministro total de alimento[Kg]',
                  data: [<?php echo $SuministroTotal; ?>],
                  fill: false,
                  borderColor: 'rgb(137, 43, 100)',
                  tension: 0.1
                },
                {
                  label: 'Desperdicio total de alimento[Kg]',
                  data: [<?php echo $Desperdicio; ?>],
                  fill: false,
                  borderColor: 'rgb(23, 128, 161)',
                  tension: 0.1
                }
                ]
            
        }
        
        
    })
    var MyChart2= new Chart(ctx2,{
        type:"line",
        data:
        {
            labels:[<?php echo $Fechas ?>],
            datasets: [{
                label:"<?php echo "Consumo total de alimentos: "; ?>",
                data: [<?php echo $Consumo ?>],
                fill: false,
                borderColor: 'rgb(23, 128, 161)',
                tension: 0.1
            }]
            
        }
        
        
    })
</script>

