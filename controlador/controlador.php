<?php
/**
 * Created by PhpStorm.
 * User: Nelson-PC
 * Date: 25/02/2018
 * Time: 17:42
 */
//recepcionamos los datos
$datos = $_POST['datos'];
//variables para manejar errores
$contadorErrores =0;
//Arreglos para devolver en json
$fechasoriginales = [];
$arreglofechas =[];
$arreglodias = [];


for($i=0; $i < count($datos); $i +=2){

    $fecha = $datos[$i]['value'];
    $numero = $datos[$i+1]['value'];

    //comprovamos que los campos no vengan nulos
    if($fecha === '' || $numero === ''){
        $contadorErrores =1;
        break;
    }

}

if($contadorErrores == 0){

}else {

    echo json_encode("error");
}