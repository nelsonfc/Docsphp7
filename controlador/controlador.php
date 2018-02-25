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
$fechaAux;
$nuevafecha = "";
$errorfecha = false;
//Arreglos para devolver en json
$fechasoriginales = [];
$arreglofechas =[];
$arreglodias = [];
function calcular($fecha, $numero){

    $fechaSumada = strtotime($fecha);
    for($i=0; $i < $numero; $i++){
        //con esto obtenemos el valor del dia de la fecha referenciada del 0 al 6 donde 0 es domingo
        $dia= date('w',$fechaSumada);
        if($dia != 0){
            if($dia == 6){
                //si es sabado sumamos 2 dias
                $fechaSumada = strtotime('+2 day', $fechaSumada);
            }else{
                $fechaSumada = strtotime('+1 day', $fechaSumada);
            }
        }else{
            if($i==0){
                //cuando se selecciona un domingo agrega salta al siguente dia
                $fechaSumada = strtotime('+1 day', $fechaSumada);
            }else{
                $fechaSumada = strtotime('+1 day', $fechaSumada);
                $i--;

            }
        }

    }
    //retornamos la fecha calculada
    return $fechaSumada = date('d/m/Y', $fechaSumada);

}

for($i=0; $i < count($datos); $i +=2){

    $fecha = $datos[$i]['value'];
    $numero = $datos[$i+1]['value'];

    //comprovamos que los campos no vengan nulos
    if($fecha === '' || $numero === ''){
        $contadorErrores =1;
        break;
    }else{

        if($i == 0){
            $fechaAux = $fecha;
        }else{
            if($fechaAux < $fecha){
                $fechaAux = $fecha;
            }else{
                $errorfecha = true;
            }
        }
        //encolamos en el arreglo las fechas para retornar en formato dia/mes/año
        array_push($fechasoriginales, date('d/m/Y', strtotime($fecha)));
        //agregamos una funcion que calcule los dias
        $nuevafecha = calcular($fecha, $numero);
    }

}

if($contadorErrores == 0){

}else {

    echo json_encode("error");
}