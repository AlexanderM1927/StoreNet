<!DOCTYPE html>
<html>
    <head>
        <title>SoftCorp - StoreNet</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    </head>
    <body>
        <?php
            if(!empty($usuario))
            {
        ?>
        @include('elements.navbar', ['usuario' => $usuario])
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
        <div class="container">
        <h1 class="titulo-seccion">Welcome to StoreNet</h1>
            <hr>
            Esta plataforma te permitirá gestionar hasta el más mínimo detalle de tu empresa, contamos con gestionador de inventario, nominas, ventas, reportes, tickets, entre otras muchas utilidades que podrás encontrar.
            <br>
            Release: 0.1
            <br>
        </div>
    </body>
</html>