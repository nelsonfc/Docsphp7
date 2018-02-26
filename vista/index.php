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
    <script src="../bootbox.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {

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
                i += 1;

            });
            $("#enviar").click(function () {
                    var envio = 0;
                    var u = (i);
                    $("#resp").empty();

                    for (j = 1; j < u; j++) {

                        var elementofecha = document.getElementsByName("numero" + j)[0].value;
                            //valida que los numeros no vengan nulos
                        if (elementofecha === '') {
                            $('#panel').hide("slow");
                            envio = 2;
                            var mostrardatos = $("<p>El campo numero " + j + " no puede nulo</p>")
                            mostrardatos.appendTo("#resp");

                            break;

                        } else {
                            //validamos que los numeros no sean menor a 0
                            if (elementofecha <= 0) {
                                $('#panel').hide("slow");
                                envio = 2;
                                var mostrardatos = $("<p>El campo numero " + j + " no puede ser menor a 1</p>")
                                mostrardatos.appendTo("#resp");

                                break;
                            }
                        }
                    }


                    var datos = $("#frm1").serializeArray();
                    if (envio == 0) {
                        $.ajax({

                            type: "POST",
                            url: "../controlador/controlador.php",
                            data: {"datos": datos},
                            dataType: "json",

                            success: function (data) {
                                //valida que las fechas no sean vayan de menor a mayor
                                if (data === 'fechaerronea') {
                                    $('#panel').show("slow");
                                    var mostrardatos = $("<p>Error una de las fechas es menor a la anterior</p>")
                                    mostrardatos.appendTo("#resp");
                                } else {
                                    if (data === 'error') {
                                        $('#panel').show("slow");
                                        var mostrardatos = $("<p>Debe ingresar todos los campos de fecha</p>")
                                        mostrardatos.appendTo("#resp");
                                    } else {
                                        //mostramos los datos dado que supera la validacion del backend
                                        $('#panel').show("slow");
                                        for (i = 0; i < data[0].length; i++) {
                                            var mostrardatos = $("<p>Fecha " + (i + 1) + ": " + data[0][i] + "</p> <p>Numero " + (i + 1) + ": " + data[1][i] +
                                                "</p><p>Fecha calculada " + (i + 1) + ": " + data[2][i] + "</p><br>");
                                            mostrardatos.appendTo("#resp");

                                        }
                                        i +=1;
                                    }
                                }

                            },
                            error: function (data) {
                                console.log(data);

                            }

                        }).done(function (datos) {

                            console.log("Datos de done :" + datos);

                        });
                    }
                }
            );




            $('#btnDel').click(function () {

                if (i > 5) {
                    $("#elemento" + (i - 1)).remove();
                    i -= 1;
                }

            });

        })
        ;

    </script>
</head>

<body>

<div class="col-md-12">
    <br>
    <header>
        <img src="../tionvel.png">

    </header>
    <br>

    <!-- este section se utilizara para mostrar el formulario -->
    <section>
        <div class="panel panel-primary">
            <div class="panel-heading"><b style="font-size: 18px">Formulario</b>
                <input class="btn2" type="button" id="btnAdd" value="Agregar Fecha"/>
                <input class="btn2" type="button" id="btnDel" value="Remover Fecha" style="background-color: red"/>
            </div>
            <div class="panel-body">

                <form id="frm1">
                    <fieldset>
                        <div class="col-md-6">
                            Fecha 1: <input type="date" name="fecha1">
                        </div>
                        <div class="col-md-6">
                            Numero 1: <input type="number" name="numero1" id="numero1"><br><br>
                        </div>
                        <div class="col-md-6">
                            Fecha 2: <input type="date" name="fecha2">
                        </div>
                        <div class="col-md-6">
                            Numero 2: <input type="number" name="numero2"><br><br>
                        </div>
                        <div class="col-md-6">
                            Fecha 3: <input type="date" name="fecha3">
                        </div>
                        <div class="col-md-6">
                            Numero 3: <input type="number" name="numero3"><br><br>
                        </div>
                        <div class="col-md-6">
                            Fecha 4: <input type="date" name="fecha4">
                        </div>
                        <div class="col-md-6">
                            Numero 4: <input type="number" name="numero4"><br><br>
                        </div>
                    </fieldset>
                    <fieldset id="agregar">

                    </fieldset>

                    <div class="col-md-6">
                        <input class="btn1" id="enviar" type="button" value="enviar" data-toggle="modal" data-target="#myModal">
                    </div>


                </form>

            </div>
        </div>

    </section>

    <!-- este section se utilizara para mostrar los resultados -->
    <section>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Resultados</h4>
                    </div>
                    <div class="modal-body">
                        <div id="resp"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <footer>
        Autor: Nelson Figueroa Febrero 2018
    </footer>
</div>
</body>

</html>

