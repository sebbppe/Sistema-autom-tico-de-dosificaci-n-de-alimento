<?php 
include('ConBaseDeDatos.php');
$RFID=$_POST["CodigoRF"];
$Rango=intval($_POST["rango"]);
date_default_timezone_set('America/New_York');
$Suministro1="";
$Suministro2="";
$Fechas="";

for ($i=$Rango-1; $i>=0;$i--){
    $fecha=date("Y-m-d", strtotime("-$i day", time()));
    $dato=ConsultarSuministroPorFechas($fecha,$RFID);
    if ($i==($Rango-1)){
        $Suministro1=$Suministro1.$dato["Suministro1"];
        $Suministro2=$Suministro2.$dato["Suministro2"];
        $Fechas=$Fechas. "'".$fecha."'";
    }
    else
    {
        $Suministro1=$Suministro1.",".$dato["Suministro1"];
        $Suministro2=$Suministro2.",".$dato["Suministro2"];
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
            datasets: [{
                label:"<?php echo " Cantidad de alimento 1 suministrado al individuo";?>",
                data: [<?php echo $Suministro1;?>
                
                
                ],
                fill: false,
                borderColor: 'rgb(137, 43, 100)',
                tension: 0.1
            }]
            
        }
        
        
    })
    var MyChart2= new Chart(ctx2,{
        type:"line",
        data:
        {
            labels:[<?php echo $Fechas ?>
            ],
            datasets: [{
                label:"<?php echo "Cantidad de alimento 2 suministrado al individuo";?>",
                data: [<?php echo $Suministro2 ?>
                
                
                ],
                fill: false,
                borderColor: 'rgb(23, 128, 161)',
                tension: 0.1
            }]
            
        }
        
        
    })
</script>

