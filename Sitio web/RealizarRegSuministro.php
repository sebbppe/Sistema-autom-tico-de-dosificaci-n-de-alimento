<?php 
include('ConBaseDeDatos.php');
$Rango=intval($_POST["rango"]);
date_default_timezone_set('America/New_York');
$Suministrado1="";
$Suministrado2="";
$Fechas="";

for ($i=$Rango-1; $i>=0;$i--){
    $fecha=date("Y-m-d", strtotime("-$i day", time()));
    $dato=ConsultarSuministroPorFechasTotal($fecha);
    if ($i==($Rango-1)){
        $Suministrado1=$Suministrado1.$dato["Suministro1"];
        $Suministrado2=$Suministrado2.$dato["Suministro2"];
        $Fechas=$Fechas. "'".$fecha."'";
    }
    else
    {
        $Suministrado1=$Suministrado1.",".$dato["Suministro1"];
        $Suministrado2=$Suministrado2.",".$dato["Suministro2"];
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
                label:"<?php echo "Cantidad de alimento 1 suministrado";?>",
                data: [<?php echo $Suministrado1;?>
                
                
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
                label:"<?php echo "Cantidad de alimento 2 suministrado";?>",
                data: [<?php echo $Suministrado2 ?>
                
                
                ],
                fill: false,
                borderColor: 'rgb(23, 128, 161)',
                tension: 0.1
            }]
            
        }
        
        
    })
</script>

