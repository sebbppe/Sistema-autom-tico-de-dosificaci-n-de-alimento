<?php 
include('ConBaseDeDatos.php');
$Rango=intval($_POST["rango"]);
date_default_timezone_set('America/New_York');
$Desperdicio="";
$Fechas="";

for ($i=$Rango-1; $i>=0;$i--){
    $fecha=date("Y-m-d", strtotime("-$i day", time()));
    $dato=ConsultarDesperdicioPorFechas($fecha);
    if ($i==($Rango-1)){
        $Desperdicio=$Desperdicio.$dato["Desperdicio"];
        $Fechas=$Fechas. "'".$fecha."'";
    }
    else
    {
        $Desperdicio=$Desperdicio.",".$dato["Desperdicio"];
        $Fechas=$Fechas. ",'".$fecha."'";
    }
    
}
?>
<div class="col"> 
<canvas id="Grafica" width="100%" height="100%"></canvas>
</div>
<script>
    var ctx=document.getElementById("Grafica").getContext("2d");
    var MyChart= new Chart(ctx,{
        type:"line",
        data:
        {
            labels:[<?php echo $Fechas; ?>
            ],
            datasets: [{
                label:"<?php echo "Desperdicios de alimento:";?>",
                data: [<?php echo $Desperdicio;?>
                
                
                ],
                fill: false,
                borderColor: 'rgb(137, 43, 100)',
                tension: 0.1
            }]
            
        }
        
        
    })
</script>

