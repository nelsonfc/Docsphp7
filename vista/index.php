<?php
/**
 * Created by PhpStorm.
 * User: Nelson-PC
 * Date: 25/02/2018
 * Time: 17:40
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Formulario - Tionvel</title>
    <meta charset="UTF-8">
    <!-- importamos bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- importamos la hoja de estilos -->
    <link REL=stylesheet HREF="../estilo/estilo.css" TYPE="text/css" MEDIA=screen>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function () {


            $("#enviar").click(function () {
                var mostrardatos = $("<p>Error una de las fechas es menor a la anterior</p>");

                $("#resp").empty();
                var datos = $("#frm1").serializeArray();

                $.ajax({

                    type: "POST",
                    url: "../controlador/controlador.php",
                    data: {"datos": datos},
                    dataType: "json",

                    success: function (data) {
        //valida que las fechas no sean vayan de menor a mayor
                       if(data === 'fechaerronea'){
                           $('#panel').show("slow");
                           var mostrardatos = $("<p>Error una de las fechas es menor a la anterior</p>")
                           mostrardatos.appendTo("#resp");
                       }else{
                           if(data === 'error'){
                               $('#panel').show("slow");
                               var mostrardatos = $("<p>Faltan campos del formulario por llenar</p>")
                               mostrardatos.appendTo("#resp");
                           }else{
                               //mostramos los datos dado que supera la validacion del backend
                               $('#panel').show("slow");
                                    for(i=0; i<data[0].length; i++){
                                        var mostrardatos = $("<p>fecha "+(i+1)+": "+data[0][i]+ "</p><br> <p>numero"+(i+1)+":"+data[1][i]+
                                        "</p><br><p>fecha calculada "+(i+1)+": "+data[2][i]+"</p><br>");
                                         mostrardatos.appendTo("#resp");
                                    }
                           }
                       }

                    },
                    error: function (data) {
                        console.log(data);

                    }

                }).done(function (datos) {

                    console.log("Datos de done :"+datos);

                })

            });
            var i = 5;
            $('#btnAdd').click(function () {

                var fechadinamica = $('<div id="elemento' + i + '"> <div class="col-md-6">\n' +
                    '                            Fecha ' + i + ':\n' +
                    '                            <input type="date" name="fecha' + i + '">\n' +
                    '                        </div>\n' +
                    '                        <div class="col-md-6">\n' +
                    '                            Numero ' + i + ': <input type="number" name="numero' + i + '"><br><br>\n' +
                    '                        </div></div>');
                fechadinamica.appendTo("#agregar");
                i +=1;

            });

            $('#btnDel').click(function () {

                if(i > 5){
                    $("#elemento" + (i-1)).remove();
                    i -= 1;
                }

            });

        });

    </script>
</head>

<body>
<div class="col-md-12">
    <header>
        <h1>Tionvel</h1>
    </header>
    <!-- este section se utilizara para mostrar el formulario -->
    <section>
        <div class="panel panel-primary">
            <div class="panel-heading"><b style="font-size: 18px">Formulario</b>
                <input type="button" id="btnAdd" value="Agregar Fecha"/>
                <input type="button" id="btnDel" value="Remover Fecha" style="background-color: red"/>
            </div>
            <div class="panel-body">

                <form id="frm1">
                    <fieldset>
                        <div class="col-md-6">
                            Fecha 1: <input type="date" name="fecha1">
                        </div>
                        <div class="col-md-6">
                            Numero 1: <input type="number" name="numero1">
                        </div>
                        <div class="col-md-6">
                            Fecha 2: <input type="date" name="fecha2">
                        </div>
                        <div class="col-md-6">
                            Numero 2: <input type="number" name="numero2">
                        </div>
                        <div class="col-md-6">
                            Fecha 3: <input type="date" name="fecha3">
                        </div>
                        <div class="col-md-6">
                            Numero 3: <input type="number" name="numero3">
                        </div>
                        <div class="col-md-6">
                            Fecha 4: <input type="date" name="fecha4">
                        </div>
                        <div class="col-md-6">
                            Numero 4: <input type="number" name="numero4">
                        </div>
                    </fieldset>

                    <fieldset id="agregar">

                    </fieldset>

                    <div class="col-md-6">
                        <input id="enviar" type="button" value="enviar">
                    </div>


                </form>

            </div>
        </div>

    </section>

    <!-- este section se utilizara para mostrar los resultados -->
    <section>
        <div id="panel" class="panel panel-success" style="display: none">
            <div class="panel-heading">Resultados</div>
            <div class="panel-body">
                <div id="resp"></div>
            </div>
        </div>
    </section>

    <footer>
        Autor: Nelson Figueroa Febrero 2018
    </footer>
</div>
</body>

</html>

