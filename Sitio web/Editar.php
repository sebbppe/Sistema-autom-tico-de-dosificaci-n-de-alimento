<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    } else {
        // Show users the page!
    }
    include_once('ConBaseDeDatos.php');
?>
<!doctype html>

<html>

<head>
    <title>Comedor automático</title>
    <link rel="icon" type="image/png" href="Imagenes/logoCabecera.png"/>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <Base href="">
    <!--Archivos bases del Bootstrap CSS -->
    <link href="Css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="Css/sidebars.css" rel="stylesheet">
    <link href="Css/bootstrap-grid.min.css" rel="stylesheet" media="screen">
    <link href="Css/bootstrap-reboot.min.css" rel="stylesheet" media="screen">
    <!--  -->
    <script src="JavaScripts/jquery-3.6.0.min.js"></script>
    
    
    <script type="text/javascript">
        $(document).ready(function()
        {  
         $("#Nombre_").change(function()
         {    
          var Nombre=$(this).val();
          var Proceso="BuscarNombre";
          var dataString = "Nombre="+ Nombre+"&Proceso="+Proceso;
            
          $.ajax
          ({
           url: 'GenerarTabla.php',
           method: 'POST',
           data: dataString,
           cache: false,
           success: function(r)
           {
            $("#Tabla").html(r);
           } 
          });
         
        });
        
        
        $("#RFID_").change(function()
         {    
          var RFID=$(this).val();
          var Proceso="BuscarCodigo";
          var dataString = "CodigoRFID="+RFID+"&Proceso="+Proceso;
            
          $.ajax
          ({
           url: 'GenerarTabla.php',
           method: 'POST',
           data: dataString,
           cache: false,
           success: function(r)
           {
            $("#Tabla").html(r);
           } 
          });
         
        });
        
        
        
        
        $("#cerrarVentana").click(function(){
            var Nombre="";
            var Proceso="BuscarNombre";
            var dataString = "Nombre="+ Nombre+"&Proceso="+Proceso;
            
          $.ajax
          ({
           url: 'GenerarTabla.php',
           method: 'POST',
           data: dataString,
           cache: false,
           success: function(r)
           {
            $("#Tabla").html(r);
           } 
          });
            
        });
        $("#cerrarVentana2").click(function(){
            var Nombre="";
            var Proceso="BuscarNombre";
            var dataString = "Nombre="+ Nombre+"&Proceso="+Proceso;
            
          $.ajax
          ({
           url: 'GenerarTabla.php',
           method: 'POST',
           data: dataString,
           cache: false,
           success: function(r)
           {
            $("#Tabla").html(r);
           } 
          });
            
        });
        
        
        $("#EliminarRegistros").click(function(){
            var Nombre=$('#Nombre_individuo2').val();
            var Codigo=$('#Codigo_individuo2').val();
            var Contra=$('#ContraAc2').val();
            var Proceso="Eliminar";
            var dataString = "Nombre="+ Nombre+"&Proceso="+Proceso+"&RFID="+Codigo+"&Contra="+Contra;
            $.ajax
          ({
           url: 'ActualizarEliminar.php',
           method: 'POST',
           data: dataString,
           dataType: 'text',
           cache: false,
           success: function(mensaje)
           {
            alert(mensaje);
           } 
          });
          
            
        });
        
        
        
        
        $("#actualizarDatos").click(function(){
         var Nombre=$('#Nombre_individuo').val();
         var Codigo=$('#Codigo_individuo').val();
         var Alimento1=parseFloat($('#Alimento1_individuo').val());
         var Alimento2=parseFloat($('#Alimento2_individuo').val());
         var Porciones=parseFloat($('#Porciones').val());
         var Contra=$('#ContraAc').val();
         var Proceso="Actualizar";
         var dataString = "RFID="+Codigo+"&Porciones="+Porciones+"&Proceso="+Proceso+"&Alimento1="+Alimento1+"&Alimento2="+Alimento2+"&Contra="+Contra;
          if (Number.isNaN(Alimento1) 
            || Number.isNaN(Alimento2) 
            || Number.isNaN(Porciones)
            || Alimento1<0
            || Alimento2<0
            || Porciones<0
            ){
          alert("Por favor, introduzca números positivos en los campos");
         }else{
            $.ajax
          ({
           url: 'ActualizarEliminar.php',
           method: 'POST',
           data: dataString,
           dataType: 'text',
           cache: false,
           success: function(mensaje)
           {
            alert(mensaje);
           } 
          });
         }
         
        });
        
        $("#Check").click(function(){
            
            if (chec=$("#Check").is(":checked")){
                $("#EliminarRegistros").removeAttr('disabled');
            }
            else
            {
                $("#EliminarRegistros").attr('disabled', 'disabled')
                
            }
            
        });
        
            
            
        });
        
        
        
        
    </script>
    <script type="text/javascript">
        function AgregarAlForm(datos,opcion){
            d=datos.split('||');
            if(opcion=="Actualizar"){
                $('#Nombre_individuo').val(d[0]);
                $('#Codigo_individuo').val(d[1]);
                $('#Alimento1_individuo').val(d[2]);
                $('#Alimento2_individuo').val(d[3]);
                $('#Porciones').val(d[4]);
            }
            else if(opcion=="Eliminar"){
                $('#Nombre_individuo2').val(d[0]);
                $('#Codigo_individuo2').val(d[1]);
                $('#Check').prop("checked", false);
            }
            
        }
        
    </script> 
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

    <symbol id="Monitoreo" viewBox="0 0 8 10">
        <path  d="M0.8 6.18l6.38 0c0.11,0.46 0.21,0.94 0.33,1.41 0.14,0.58 0.13,1.01 -0.26,1.33 -0.36,0.29 -1.01,0.21 -1.54,0.21l-3.52 0c-0.59,0 -1.15,0.09 -1.53,-0.24 -0.54,-0.48 -0.27,-1.17 -0.07,-2.02 0.04,-0.14 0.12,-0.64 0.21,-0.69zm-0.27 -1.11c0.17,-0.06 0.86,-0.03 1.09,-0.03 0.29,-0.01 0.27,-0.03 0.48,0.09 0.66,0.38 1.49,0.55 2.31,0.47 1.08,-0.1 1.43,-0.54 1.67,-0.56 0.25,-0.03 0.86,-0.02 1.13,0 0.32,0.01 0.6,0.22 0.49,0.58 -0.1,0.34 -0.42,0.33 -0.81,0.33l-5.58 0c-0.36,0 -0.77,0.07 -0.97,-0.16 -0.19,-0.21 -0.17,-0.59 0.19,-0.72zm6.03 -1.67c0.62,0.01 0.27,0.47 0.1,0.7 -1.14,1.55 -3.4,1.66 -4.72,0.66 -0.26,-0.2 -0.46,-0.38 -0.66,-0.67 -0.21,-0.27 -0.53,-0.69 0.14,-0.69l5.14 0zm-2.01 -0.21c0.02,0 0.39,-0.13 0.52,-0.14 0.18,-0.02 0.36,0.08 0.5,0.16l-1.02 -0.02zm-1.73 -0.04l0.18 -0.07 0.04 0.11c-0.01,0 -0.02,0.01 -0.07,0.02 -0.01,0.01 -0.06,0.01 -0.08,0.01 -0.05,0 -0.09,-0.01 -0.14,-0.01 0.04,-0.07 0.02,-0.04 0.07,-0.06zm-0.75 0.05c0.04,-0.11 0.05,-0.1 0.17,-0.16l0.63 -0.31 0.05 0.18c-0.36,0.11 -0.36,0.29 -0.85,0.29zm1.76 -0.1c0.22,-0.3 1.76,-0.69 2.31,-0.43 -0.41,0.06 -0.79,0.11 -1.18,0.21 -0.26,0.06 -0.93,0.32 -1.08,0.31l-0.05 -0.09zm-0.18 0.06l0.03 0.05c-0.03,0 -0.05,0.01 -0.08,0 -0.06,-0.01 -0.05,-0.01 -0.07,-0.03l-0.26 -0.78 0.38 0.76zm-0.33 -0.02l0.02 0.07c-0.16,0.01 -0.06,0 -0.1,-0.03l-0.24 -0.62c-0.09,-0.23 -0.05,-0.14 -0.01,-0.18 0.08,0.01 0.07,0.02 0.11,0.14l0.22 0.62zm0.57 -1.23c0.09,-0.13 0.21,-0.3 0.31,-0.46 0.07,-0.12 0.22,-0.39 0.31,-0.47 -0.02,0.2 -0.09,0.51 -0.19,0.62 -0.05,0.05 -0.35,0.28 -0.43,0.31zm-0.23 0.83c0.68,-0.42 0.59,-0.21 1.26,-0.91l1.3 -0.84c-0.07,0.17 -0.51,0.56 -0.66,0.69 -0.13,0.11 -0.24,0.18 -0.39,0.28 -0.14,0.09 -0.3,0.13 -0.42,0.24l0.05 0.15c0.15,-0.05 0.29,-0.14 0.43,-0.2 0.14,-0.07 0.29,-0.12 0.43,-0.17 0.33,-0.1 0.7,-0.18 1.07,-0.14 -0.03,0.02 -1.39,0.57 -1.45,0.58 -0.33,0.06 -0.52,0.05 -0.85,0.17 -0.24,0.08 -0.5,0.25 -0.7,0.31l-0.07 -0.16zm1.56 -1.78c0.05,-0.07 -0.06,-0.03 0.04,-0.05 0.08,0.1 0.01,0.03 0,0.05 -0.1,0.27 -0.54,0.84 -0.69,0.97 -0.21,0.19 -0.67,0.52 -1.01,0.64l-0.07 -0.17c0.65,-0.39 1.24,-0.86 1.73,-1.44zm-0.52 0.28l-0.07 0.03 0.04 -0.05c0.04,-0.4 0.13,-0.8 0.14,-1.21l-0.1 0.15c-0.36,0.63 -0.45,0.88 -0.92,1.56 -0.16,0.22 -0.28,0.33 -0.38,0.48 -0.21,-0.09 -0.21,-0.09 -0.47,-0.01 -0.24,0.07 -0.19,0.16 -0.15,0.37l-0.79 0.41c-0.14,0.1 -0.08,0.2 -0.18,0.23 -0.22,0 -0.64,-0.05 -0.81,0.05 -0.2,0.12 -0.27,0.38 -0.15,0.61 0.07,0.16 0.25,0.4 0.35,0.52 0.1,0.11 0.25,0.32 0.43,0.43 -0.58,0.05 -1.17,-0.15 -1.49,0.26 -0.14,0.17 -0.2,0.45 -0.09,0.69 0.14,0.31 0.35,0.34 0.46,0.41 -0.02,0.24 -0.12,0.55 -0.17,0.79 -0.17,0.73 -0.5,1.61 0.17,2.12 0.48,0.36 0.89,0.28 1.58,0.27l3.72 0c0.63,0 1.16,0.09 1.58,-0.27 0.88,-0.76 0.14,-1.83 0.01,-2.91 0.25,-0.14 0.36,-0.15 0.48,-0.42 0.1,-0.23 0.03,-0.51 -0.1,-0.67 -0.32,-0.42 -0.93,-0.2 -1.48,-0.27 0.09,-0.07 0.19,-0.19 0.27,-0.27 0.19,-0.18 0.63,-0.71 0.55,-1.02 -0.09,-0.34 -0.41,-0.3 -0.77,-0.31 -0.49,0 -0.3,0.02 -0.66,-0.16l-0.15 -0.08c-0.01,-0.01 -0.01,-0.01 -0.02,-0.02 0.27,-0.04 0.55,-0.08 0.83,-0.1 0.17,-0.02 0.75,-0.03 0.84,-0.06 -0.31,-0.23 -1.08,-0.3 -1.4,-0.39l1.66 -0.63c-0.59,-0.15 -1.05,-0.18 -1.66,-0.03 0.09,-0.11 0.19,-0.19 0.29,-0.29 0.25,-0.24 0.57,-0.7 0.67,-1.06 -0.2,0.08 -1.15,0.83 -1.48,0.96 0.06,-0.22 0.43,-0.72 0.52,-1.35l-1.1 1.24z"/>
        <path  d="M2.11 6.84c0.2,-0.05 2.67,-0.02 3.09,-0.02 0.53,0 0.98,-0.01 1.07,0.49 0.08,0.5 -0.01,1 -0.44,1.1 -0.24,0.05 -2.65,0.02 -3.11,0.02 -0.35,0 -0.95,0.08 -1.05,-0.5 -0.08,-0.52 0,-0.96 0.44,-1.09zm0.01 -0.23c-0.26,0.04 -0.43,0.19 -0.54,0.34 -0.16,0.22 -0.15,0.46 -0.14,0.77 0.01,0.58 0.29,0.92 0.86,0.93 0.59,0.01 1.18,0 1.77,0 0.46,0 1.36,0.05 1.76,-0.01 0.63,-0.11 0.68,-0.66 0.67,-1.11 -0.01,-0.57 -0.28,-0.92 -0.85,-0.93 -0.43,-0.01 -3.31,-0.03 -3.53,0.01z"/>
        <path  d="M4.5 7.83c-0.1,-0.05 -0.08,-0.08 -0.08,-0.22 0,-0.13 -0.02,-0.15 0.08,-0.19 0.06,0.07 0.08,0.32 0,0.41zm-0.11 -0.62c-0.2,0.08 -0.21,0.27 -0.19,0.54 0.02,0.22 0.17,0.37 0.39,0.29 0.3,-0.11 0.26,-1.01 -0.2,-0.83z"/>
        <path  d="M3.42 7.83c-0.03,-0.08 -0.03,-0.14 -0.03,-0.25 0.01,-0.15 -0.01,-0.14 0.1,-0.16 0.03,0.07 0.03,0.15 0.02,0.25 0,0.14 0.02,0.14 -0.09,0.16zm-0.04 -0.63c-0.31,0.08 -0.33,0.95 0.14,0.85 0.22,-0.05 0.22,-0.25 0.22,-0.5 -0.01,-0.23 -0.11,-0.41 -0.36,-0.35z"/>
        <path  d="M5.1 7.83c-0.04,-0.12 -0.06,-0.32 0.02,-0.41 0.05,0.02 0.07,-0.08 0.07,0.22 0,0.12 0.02,0.17 -0.09,0.19zm-0.05 -0.63c-0.2,0.08 -0.21,0.28 -0.2,0.53 0.01,0.22 0.15,0.39 0.38,0.31 0.32,-0.12 0.26,-0.99 -0.18,-0.84z"/>
        <path  d="M2.78 7.83c-0.05,-0.09 -0.05,-0.31 -0.01,-0.41 0.13,0.02 0.09,0.05 0.09,0.22 0,0.14 0.03,0.16 -0.08,0.19zm-0.06 -0.62c-0.22,0.07 -0.21,0.27 -0.2,0.52 0.02,0.42 0.61,0.56 0.57,-0.2 -0.01,-0.23 -0.13,-0.4 -0.37,-0.32z"/>
        <path  d="M3.24 3.18c0.13,0.01 0.05,0.02 0.08,-0.04l-0.22 -0.62c-0.04,-0.12 -0.03,-0.13 -0.11,-0.14 -0.04,0.04 -0.08,-0.05 0.01,0.18l0.24 0.62z"/>
        <path  d="M3.53 3.18c0.08,0.01 0.08,0.03 0.12,-0.02l-0.38 -0.76 0.26 0.78z"/>    
    
    </symbol>
      <symbol id="Editar" viewBox="0 0 10 10">
        <path d="M6.78 8.36l0.23 0.02 0 1.14 -0.23 0.02 0 -1.18zm-0.47 -0.05l0.23 0.03 0 1.18 -0.18 -0.05c-0.08,-0.3 -0.05,-0.81 -0.05,-1.16zm0.95 1.22l-0.02 -1.12c0.19,0.01 0.23,-0.02 0.25,0.15 0.01,0.1 -0.01,0.29 -0.01,0.39 0,0.29 0.06,0.51 -0.22,0.58zm-1.27 -1.55c0.05,-0.1 -0.04,-0.09 0.41,-0.04 0.17,0.03 0.34,0.05 0.51,0.08l0.74 0.08c0.17,0.03 0.13,0.02 0.15,0.14 -0.49,-0.11 -1.68,-0.11 -1.81,-0.26zm1.74 -0.25c0.06,0.11 0.04,0.03 0.03,0.17l-0.12 -0.04 -1.48 -0.17 1.49 -0.03c0.1,0.03 0.04,-0.01 0.08,0.07zm-1.77 -1.18c0.08,0.1 0.07,0.09 0.02,0.19l-0.05 -0.12c-0.05,-0.17 -0.22,-0.42 -0.32,-0.58 -0.07,-0.12 -0.3,-0.47 -0.33,-0.58 0.45,0.26 0.68,0.53 0.68,1.09zm2.48 -1.06c0.09,-0.1 -0.11,-0.07 0.08,-0.07 0.11,0.15 0.01,0.04 -0.02,0.07l-0.68 1.18c-0.01,-0.19 0.07,-0.61 0.15,-0.75 0.1,-0.17 0.32,-0.29 0.47,-0.43zm-0.96 1.93l-0.23 0.01c-0.06,-1.17 0.3,-2.11 0.85,-2.82 -0.03,0.37 -0.49,1.14 -0.62,2.81zm-1.73 -2.76c0.52,0.94 0.86,1.39 0.79,2.77l-0.22 0c-0.01,-0.05 -0.11,-1.01 -0.22,-1.45l-0.41 -1.31c0,-0.01 -0.01,-0.02 -0.01,-0.02l0.07 0.01zm1.26 2.76l-0.23 0.01c-0.04,-0.8 0,-1.07 -0.26,-1.79 -0.14,-0.4 -0.22,-1.44 -0.15,-1.9 0.33,0.58 0.38,1.44 0.41,2.17l0.23 -0.01c0.01,-0.81 0.07,-1.9 0.52,-2.41 -0.01,0.24 -0.16,1.87 -0.21,2.01 -0.28,0.81 -0.28,0.98 -0.31,1.92zm-1.08 -4.64l0.08 1.29c0.06,0.15 0.04,0.43 0.05,0.62 -0.09,-0.03 -0.06,-0.01 -0.11,-0.09 -0.13,-0.32 -0.5,-0.63 -0.72,-0.86l-0.07 -0.08 0.23 -0.01c0.15,-0.07 0.13,-0.12 0.08,-0.29 -0.2,-0.06 -2.23,-0.1 -2.48,-0.03 -0.21,0.05 -0.18,0.29 0.02,0.33l1.97 0.01c0.13,0.17 0.65,1.43 0.68,1.69 0.02,0.04 0.04,-0.07 0.03,0.11 -0.1,-0.06 -0.03,-0.02 -0.07,-0.07 -0.08,-0.05 -0.52,-0.35 -0.59,-0.42 -0.19,-0.21 -0.05,-0.07 -0.31,-0.2 -0.13,-0.06 -0.18,-0.13 -0.34,-0.19 0.03,0.08 0.08,0.15 0.13,0.21 -0.44,0.08 -1.36,-0.1 -1.65,0.09l-0.01 0.2c0.25,0.18 1.67,0.03 1.87,0.08 0.18,0.09 0.59,0.82 0.72,1.04 0.24,0.43 0.39,0.7 0.58,1.18l-0.07 0.06c-0.2,0.17 -0.22,0.55 -0.17,0.73l0.15 0.07 0.14 0.02c0.05,0.18 0.02,0.41 0.02,0.61 -0.06,0.05 0.01,0.01 -0.12,0.02 -0.25,0.15 -4.35,0.12 -4.94,0.08l0 -6.96c0.51,-0.03 -0.13,0.33 1.04,0.32 0.42,0 3.18,0.03 3.39,-0.02 0.37,-0.09 0.17,-0.3 0.52,-0.31l0.04 0.2c0,0.36 0.05,0.51 -0.09,0.45l0 0.12zm-4.37 -1.7c0.13,-0.11 0.52,-0.06 0.75,-0.06 0.36,0 0.46,0.06 0.57,-0.22 0.14,-0.39 0.62,-0.63 1.01,-0.33 0.55,0.42 -0.18,0.55 1.07,0.55 0.27,0 0.52,-0.1 0.53,0.21 0.05,1 0.16,0.76 -2.01,0.76 -0.33,0 -1.75,0.09 -1.91,-0.06 -0.11,-0.14 -0.1,-0.71 -0.01,-0.85zm4.41 0.58c-0.01,0 -0.02,-0.01 -0.03,-0.01l-0.07 -0.02c0,-0.01 -0.02,0 -0.03,-0.01l0 -0.27c0.97,0 0.82,-0.24 0.82,1.21 0,0.4 0.01,0.83 -0.01,1.23 0,-0.11 -0.17,-0.4 -0.23,-0.51 -0.22,-0.42 0.14,-1.42 -0.28,-1.59 -0.09,-0.03 -0.09,-0.02 -0.17,-0.03zm0.03 7.61l0.08 -0.04 0.01 0.16c0.03,0.15 0.05,0.15 0.11,0.26 -1.07,0.06 -3.76,0 -5.14,0 -0.32,0 -0.55,0.06 -0.66,-0.08 -0.12,-0.15 -0.06,-5.27 -0.06,-6.15 0,-0.47 -0.05,-1.69 0.04,-2.05l0.78 -0.02 0 0.3c-0.61,0.09 -0.49,0.16 -0.49,1.18l0 5.89c0,0.82 0.26,0.6 1.99,0.6 1.12,0 2.24,0.03 3.34,-0.05zm1.7 -4.48c-0.05,0.06 0.06,0.03 -0.09,0.07l0.04 -0.13c-0.01,-0.31 0.06,-0.74 0.1,-1.05 0.02,-0.18 0.04,-0.35 0.06,-0.52l0.06 -0.41c-0.02,-0.22 0.04,0.18 -0.01,-0.06l-0.03 -0.06c-0.15,0.25 -0.75,0.93 -0.82,1.39l0 -2.08c0,-1.03 -0.21,-0.96 -1.2,-0.94 -0.18,-0.46 -0.75,-0.33 -1.32,-0.33 -0.09,-0.04 -0.26,-0.66 -0.98,-0.67 -0.74,-0.01 -0.86,0.63 -1.01,0.67 -0.26,0 -0.56,-0.02 -0.82,0 -0.35,0.02 -0.33,0.16 -0.5,0.32 -0.3,0.01 -0.74,-0.06 -0.96,0.11 -0.27,0.2 -0.21,0.47 -0.21,0.87l0 6.52c0,1.77 -0.35,1.49 2.84,1.49 0.73,0 1.46,0 2.19,0 0.35,0 1.62,0.11 1.9,-0.13 0.05,-0.04 -0.02,-0.01 0.08,-0.08 0.34,0 0.57,-0.03 0.67,-0.31 0.07,-0.2 0,-0.71 0.04,-0.97 0.32,-0.11 0.35,-0.07 0.29,-0.49 -0.03,-0.18 -0.03,-0.38 -0.13,-0.5l-0.12 -0.11c0.3,-0.99 1.21,-2.05 1.64,-2.8 -0.32,0.11 -1.09,0.76 -1.31,0.85 0.12,-0.65 0.62,-1.5 0.76,-1.96 -0.34,0.24 -1.03,0.94 -1.16,1.31z"/>
        <path  d="M1.69 6.21c0.06,-0.08 -0.01,-0.04 0.11,-0.06l0.37 0.01 0.02 0.41c-0.02,0.1 0.02,0.04 -0.05,0.08l-0.45 0 0 -0.44zm-0.03 -0.38c-0.38,0.08 -0.38,0.44 -0.32,0.86 0.06,0.42 1.1,0.5 1.16,0 0.02,-0.09 0.02,-0.49 0,-0.58 -0.05,-0.34 -0.51,-0.35 -0.84,-0.28z"/>
        <path  d="M2.16 7.66c0.01,0.01 0.01,0.02 0.02,0.03 0,0 0.01,0.02 0.01,0.02 0.03,0.11 0,-0.04 0.01,0.07l-0.03 0.37c-0.09,0.02 -0.16,0.02 -0.25,0.02 -0.15,0 -0.19,0.03 -0.23,-0.06l0 -0.44 0.47 -0.01zm-0.59 -0.31c-0.17,0.06 -0.22,0.13 -0.23,0.36 -0.02,0.41 -0.07,0.76 0.38,0.78 0.12,0 0.47,0.01 0.57,-0.02 0.26,-0.08 0.29,-0.64 0.2,-0.94 -0.08,-0.24 -0.62,-0.3 -0.92,-0.18z"/>
        <path  d="M1.69 3.21c0.05,-0.06 0,-0.07 0.23,-0.07 0.09,0 0.16,0.01 0.25,0.02 0.03,0.1 0.03,0.15 0.03,0.26 0,0.18 0,0.19 -0.05,0.23l-0.46 -0.01 0 -0.43zm0.82 0.44c0,-0.83 0.05,-0.82 -0.79,-0.82 -0.62,0 -0.36,0.98 -0.3,1.05 0.14,0.16 0.39,0.12 0.65,0.12 0.26,0 0.44,-0.08 0.44,-0.35z"/>
        <path d="M2.16 4.66c0,0.01 0.01,0.02 0.01,0.02l0 0.47c-0.09,0.01 -0.16,0.02 -0.25,0.02 -0.15,0 -0.19,0.03 -0.23,-0.06l0 -0.44 0.47 -0.01zm-0.36 0.84c0.7,0 0.71,-0.02 0.71,-0.8 0,-0.29 -0.12,-0.37 -0.4,-0.37 -0.72,-0.01 -0.82,0 -0.77,0.8 0.01,0.27 0.18,0.37 0.46,0.37z"/>
        <path  d="M4.84 1.68c0.32,0 0.4,-0.09 0.27,-0.33 -0.21,-0.04 -2.17,-0.04 -2.38,0l-0.07 0.17c0.09,0.14 0.11,0.16 0.31,0.16l1.87 0z"/>
        <path  d="M4.67 6.43c-0.18,-0.18 -0.5,-0.11 -0.96,-0.11 -0.23,0 -0.93,-0.11 -0.86,0.21 0.05,0.25 0.77,0.14 0.98,0.14 0.17,0 0.37,0.01 0.55,0 0.22,-0.01 0.28,-0.03 0.29,-0.24z"/>
        <path  d="M3.13 8.15l1.28 0 0.16 0c0.12,-0.21 0.13,-0.33 -0.16,-0.33l-1.32 0c-0.35,0 -0.39,0.33 0.04,0.33z"/>
        <path  d="M1.88 1.63c0.34,0.14 0.6,-0.08 0.41,-0.26 -0.08,-0.07 -0.56,-0.13 -0.41,0.26z"/>
      </symbol>
      
      <symbol id="Ingresar" viewBox="0 0 24.4238 22.3554">
            <path  d="M20.4748 18.1485c-0.1557,0.6641 -0.6123,1.0818 -1.0611,1.3833 -2.6908,1.8072 -7.2602,1.9015 -10.1479,0.6725 -0.9703,-0.4129 -2.5047,-1.336 -2.233,-2.7342 0.1164,-0.5991 0.6534,-1.1622 1.0213,-1.4092 0.2803,-0.1882 0.4942,-0.2619 0.7996,-0.4438 1.1587,-0.6902 3.8873,-0.9786 5.2643,-0.9412 1.4351,0.039 2.9806,0.2725 4.186,0.7779 0.9481,0.3975 2.4929,1.3206 2.1709,2.6947zm-10.4502 -15.2869c-0.0555,-0.086 -0.065,-0.0836 -0.0025,-0.1849 0.1897,0.0819 -0.0269,-0.0252 0.0859,0.1291 0.2363,0.3871 0.6853,0.8146 1.2165,0.9891 0.566,0.186 1.5313,0.0624 2.1715,0.0694 1.3558,0.0149 3.0333,0.3105 3.7893,-0.5525l0.1016 -0.1188c0.0811,0.2932 0.024,0.0288 -0.0413,0.1315 -0.1966,0.5882 -0.8801,0.761 0.3109,1.5928 0.3891,0.2717 0.6921,0.1953 0.9037,-0.1555 0.4886,-0.81 0.8637,-1.6086 1.8807,-2.1539 0.7137,-0.3827 1.4512,-0.4235 2.3629,-0.3392 -0.0102,0.6038 -1.173,1.8906 -1.4498,2.1829 -0.5442,0.5747 -1.1638,0.6573 -1.9059,0.824 -0.1628,0.0366 -0.6222,0.1367 -0.6982,0.2536 -0.1789,0.6612 0.2976,1.4461 0.4302,2.151 0.1582,0.8407 0.1048,1.7181 0.1085,2.5789 0.0063,1.4495 0.1722,3.6963 -0.5747,4.7875 -0.2299,-0.0289 -1.407,-0.469 -2.2332,-0.6263 -1.7902,-0.3409 -3.5695,-0.3499 -5.3616,-0.0167 -0.7854,0.146 -2.0347,0.5973 -2.2738,0.628 -0.6307,-1.4024 -0.4959,-2.3277 -0.4969,-3.9649 -0.0009,-1.4192 -0.1063,-2.8491 0.3194,-4.1452 0.1793,-0.546 0.6043,-1.2693 -0.1505,-1.4973 -0.6059,-0.183 -1.1964,-0.2085 -1.7338,-0.5045 -0.7673,-0.4227 -1.8521,-1.9046 -2.0013,-2.5793 1.8773,-0.2997 3.0249,0.5189 3.7147,1.6129 0.4595,0.7287 0.4257,1.4186 1.4131,0.7325 1.1381,-0.7908 0.2135,-0.8677 0.1145,-1.8243zm10.2357 3.6098c0.5048,-0.1278 1.0704,-0.3671 1.4598,-0.5979 1.0172,-0.6029 2.1001,-2.3574 2.6023,-3.4877 0.7272,-1.6368 -2.63,-2.0361 -4.7054,-0.8519 -0.2175,0.1241 -0.3766,0.2797 -0.5624,0.3718 -0.0232,-0.759 0.0336,-1.5788 -0.5951,-1.8286 -0.7922,-0.3147 -1.1402,0.4005 -1.364,0.9216 -0.8418,1.9605 -0.9708,1.5468 -3.2269,1.5173 -2.3602,-0.0308 -2.3191,0.3367 -3.3235,-1.5429 -0.2204,-0.4125 -0.719,-1.2384 -1.4486,-0.8265 -0.5979,0.3376 -0.4736,1.0691 -0.5802,1.8265 -0.7736,-0.6096 -1.5559,-1.0731 -2.9718,-1.0599 -0.9808,0.0092 -2.8467,0.1567 -2.2339,1.578 0.3727,0.8645 1.0104,1.8959 1.5552,2.4826 0.6258,0.674 1.2234,1.2854 2.4931,1.5538 -0.122,0.711 -0.2858,1.18 -0.3194,1.9896l0.0044 4.5386c0.0362,0.6615 0.2645,1.3884 0.2841,1.9041 -2.201,1.666 -2.2773,3.7733 -0.2586,5.452 3.0992,2.5774 10.428,2.6036 13.3527,0.0044 0.616,-0.5474 1.5254,-1.4197 1.4511,-2.8243 -0.0325,-0.6146 -0.2985,-1.1734 -0.5954,-1.5735 -0.1438,-0.1938 -0.3534,-0.3987 -0.5109,-0.5448 -0.1708,-0.1584 -0.3923,-0.3298 -0.5399,-0.4933 0.1808,-0.6758 0.3577,-1.1324 0.3779,-1.9256l-0.0203 -4.6001c-0.0422,-0.771 -0.2101,-1.2937 -0.3242,-1.9833z"/>
            <polygon  points="3.5774,15.275 3.6152,13.4462 5.4393,13.4141 5.4179,11.6223 3.6436,11.6064 3.6437,9.8173 1.8156,9.8189 1.8166,11.6329 0.0006,11.634 -0,13.4528 1.8102,13.4525 1.8261,15.2806 "/>
            <path  d="M15.8254 16.4047c-2.0356,0.6378 -1.121,3.6018 0.9373,3.0238 1.9364,-0.5438 1.2227,-3.7005 -0.9373,-3.0238z"/>
            <path  d="M10.9227 16.3721c-2.0099,0.4093 -1.4886,3.5013 0.6986,3.0701 2.0208,-0.3984 1.4441,-3.5065 -0.6986,-3.0701z"/>
            <path  d="M10.0876 8.8745c-1.8575,0.4586 -1.1412,3.1319 0.6801,2.6925 1.745,-0.421 1.1404,-3.142 -0.6801,-2.6925z"/>
            <path  d="M16.6551 8.8647c-1.7853,0.4253 -1.2654,3.0718 0.5951,2.7181 0.6902,-0.1312 1.2647,-0.7922 1.0741,-1.6801 -0.143,-0.6658 -0.8116,-1.2423 -1.6691,-1.038z"/>
            <path  d="M3.5774 15.275c0.1046,-0.0821 0.0651,-0.0077 0.0951,-0.1687l0.002 -1.6245 1.7804 -0.0197c0.1213,-0.3621 0.048,-1.2236 0.0473,-1.6498 -0.0094,-0.3748 0.014,-0.0896 -0.0844,-0.1901l0.0214 1.7918 -1.8241 0.0321 -0.0378 1.8288z"/>
            <path d="M10.0246 2.8616c0.0183,-0.1061 -0.0129,-0.0933 0.0833,-0.0558 -0.1128,-0.1543 0.1039,-0.0472 -0.0859,-0.1291 -0.0625,0.1013 -0.053,0.0989 0.0025,0.1849z"/>
            <path  d="M17.2852 3.3119l0.0603 0.0127c0.0653,-0.1027 0.1223,0.1617 0.0413,-0.1315l-0.1016 0.1188z"/>
        </symbol>
      <symbol id="Ayuda" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
      </symbol>
    </svg>
    
    <main>
        <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 4.5rem;">
            <a href="index.php" class="d-block p-3 link-dark text-decoration-none" title="Comedor automático para bovinos" data-bs-toggle="tooltip" data-bs-placement="right">
                <img src="Imagenes/logo.png" width="100%" heigth="100%"/>
                <span class="visually-hidden">Comedor automático para bovinos</span>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="index.php" class="nav-link py-3 border-bottom" aria-current="page" title="Monitoreo" data-bs-toggle="tooltip" data-bs-placement="right">
                        <svg class="bi" width="40" height="40" role="img"><use xlink:href="#Monitoreo"/></svg>
                    </a>
                </li>
                <li>
                    <a href="IngresarBovino.php" class="nav-link py-3 border-bottom" title="Ingresar bovino" data-bs-toggle="tooltip" data-bs-placement="right">
                        <svg class="bi" width="32" height="32" role="img"><use xlink:href="#Ingresar"/></svg>
                    </a>
                </li>
                <li>
                    <a href="Editar.php" class="nav-link active py-3 border-bottom" title="Editar dietas" data-bs-toggle="tooltip" data-bs-placement="right">
                        <svg class="bi" width="32" height="32" role="img"><use xlink:href="#Editar"/></svg>
                    </a>
                </li>
                <li>
                    <a href="Ayuda.php" class="nav-link py-3 border-bottom" title="Guia de usuario" data-bs-toggle="tooltip" data-bs-placement="right">
                        <svg class="bi" width="24" height="24" role="img"><use xlink:href="#Ayuda"/></svg>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="b-example-divider"></div>
        <div class="container"> 
        <div class="mb-3"></div>
            <div class="row">
                <input class="form-control mb-2" id="Nombre_" type="text" placeholder="Buscar por nombre">
                <input class="form-control mb-2" id="RFID_" type="text" placeholder="Buscar por RFID" >
            </div>
            <div class="row mb-3">
                <table class="table" id="Tabla">

                </table>
            </div>
        </div>
    
    <!-- Modal -->
    <div class="modal fade" id="Modificacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Modificar</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
          </div>
            
          <div class="modal-body">
            <p>Por favor, tenga en cuenta que los datos modificados serán actualizados automáticamente en el servidor.</p>
            <form>
          <div class="mb-1">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="Nombre_individuo" disabled>
          </div>
          <div class="mb-1">
            <label for="recipient-name" class="col-form-label">Código RFID:</label>
            <input type="text" class="form-control" id="Codigo_individuo" disabled>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Cantidad de alimento1:</label>
            <input type="text" class="form-control" id="Alimento1_individuo">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Cantidad de alimento2:</label>
            <input type="text" class="form-control" id="Alimento2_individuo">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Porciones diarias:</label>
            <input type="text" class="form-control" id="Porciones">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Contraseña de acceso:</label>
            <input type="password" class="form-control" id="ContraAc">
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarVentana">Cerrar</button>
            <button type="button" class="btn btn-primary" id="actualizarDatos">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="Eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Eliminar</h5>
            
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
          </div>
            
          <div class="modal-body">
            <p>Al eliminar el registro del siguiente individuo el comedor autónomo no podrá identificarlo, por esta razón, no realice esta acción a menos que esté seguro.</p>
            <form>
          <div class="mb-1">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="Nombre_individuo2" disabled>
          </div>
          <div class="mb-1">
            <label for="recipient-name" class="col-form-label">Código RFID:</label>
            <input type="text" class="form-control" id="Codigo_individuo2" disabled>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Contraseña de acceso:</label>
            <input type="password" class="form-control" id="ContraAc2">
          </div>
          <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="Check">
              <label class="form-check-label" for="flexSwitchCheckChecked">Oprima el botón de verificación si está seguro/a de eliminar los registros del individuo.</label>
          </div>
          
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarVentana2">Cerrar</button>
            <button type="button" class="btn btn-primary" id="EliminarRegistros" disabled>Eliminar registros</button>
          </div>
        </div>
      </div>
    </div>
    
    
    
    
    
    </main>
    
    <script src="JavaScripts/bootstrap.min.js"></script>
    <script src="JavaScripts/bootstrap.bundle.min.js"></script>
    <script src="JavaScripts/sidebars.js"></script>
    

</body>

</html>