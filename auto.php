<?php
    $clave=0;
	$pra = $_POST['pa_php'];
    $eng = $_POST['en_php'];
    $mes = $_POST['m_php'];
    $nom = $_POST['nom_php'];
    $pap = $_POST['pap_php'];
    $sap = $_POST['sap_php'];
    $tel = $_POST['tel_php'];
    $mod = $_POST['mod_php'];
    $pm = $_POST['pm_php'];
    require('conexion1.php');

    if( $cn->connect_errno ==0 ) {
        echo("Conexión exitosa");
    
    $insertar=$cn->query("Insert into clientes values(".$clave.",'".$nom."','".$pap."','".$sap."','".$tel."','".$mod."',".$pra.",".$eng.",".$mes.",".$pm.")");

    if($insertar==1){          
           echo("El registro se guardo  correctamente=".!$cn->connect_errno. "Insertar =". $insertar); 
        }

        else{
           echo("No se guardo el registro".$cn->error."insertar=".$insertar);
       }
       $cn->close();  
    }

    else
        echo("Fallo la Conexión". $cn->connect_errno);

    /*
$pago = ($pra-$eng)/$mes;
    echo($pago);
    */
?>

