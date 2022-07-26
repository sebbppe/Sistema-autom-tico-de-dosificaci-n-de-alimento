<?php 
include('ConBaseDeDatos.php');

$Proceso=$_POST["Proceso"];
if ($Proceso=="BuscarNombre"){
    $Nombre=$_POST["Nombre"];
    $Consulta=ListarTablaNombre($Nombre);
    
}elseif($Proceso=="BuscarCodigo"){
    $RFID=$_POST["CodigoRFID"];
    $Consulta=ListarTablaCodigo($RFID);
}
else {
    echo "<br>no se cumplió ningún proceso";
}
?>
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Código RFID</th>
      <th scope="col">Cantidad de alimento 1</th>
      <th scope="col">Cantidad de alimento 2</th>
      <th scope="col">Porciones diarias</th>
      <th scope="col">Opciones</th>
    </tr>
    </thead>
<tbody>

<?php
    for ($x=0;$x<count($Consulta); $x++){
        $Fila=$Consulta[$x];
        $datos=$Fila["Nombre"]."||".$Fila["CodigoRFID"]."||".$Fila["Alimentacion1"]."||".$Fila["Alimentacion2"]."||".$Fila["Porciones"];
?>
        <tr>
        <th scope="row"><?php echo "$x";?></th>
        <td><?php echo $Fila["Nombre"];?></td>
        <td><?php echo $Fila["CodigoRFID"];?></td>
        <td><?php echo $Fila["Alimentacion1"];?></td>
        <td><?php echo $Fila["Alimentacion2"];?></td>
        <td><?php echo $Fila["Porciones"];?></td>
        <td>
        <?php
        if ($Fila["CodigoRFID"]=="RFPREDETER"){
            ?>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modificacion" onclick="AgregarAlForm('<?php echo $datos;?>','Actualizar')" >Editar</button>
            <?php
        }else{
            ?>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Modificacion" onclick="AgregarAlForm('<?php echo $datos;?>','Actualizar')" >Editar</button>
            <button type="button" class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#Eliminar" onclick="AgregarAlForm('<?php echo $datos;?>','Eliminar')">Eliminar</button>

        <?php
        }
        ?>
        
        </td>
        </tr>

<?php 
}

?>

</tbody>