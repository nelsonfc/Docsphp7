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

                var datos = $("#frm1").serializeArray();

                $.ajax({

                    type:"POST",
                    url:"..controlador/controlador.php",
                    data: {"datos":datos},
                    dataType: "json",

                    success: function (data) {

                        console.log(data);

                    },
                    error: function (data) {
                        console.log(data);

                    }

                })

            })

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
            <div class="panel-heading"><b style="font-size: 18px">Formulario</b></div>
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

                        <div class="col-md-6">
                            <input id="enviar" type="button" value="enviar">
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>

    </section>

    <!-- este section se utilizara para mostrar los resultados -->
    <section>
        <div id="panel" class="panel panel-success">
            <div class="panel-heading">Resultados</div>
            <div class="panel-body">

            </div>
        </div>
    </section>

    <footer>
        Autor: Nelson Figueroa Febrero 2018
    </footer>
</div>
</body>

</html>

