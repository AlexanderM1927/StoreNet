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
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <?php
            if(!empty($usuario))
            {
        ?>
        <div class="container" style="width:50%; height:30%;">
            <center>
            <h2 class="titulo-seccion">Almacen:</h2>
            <form action="administrador" method="POST">
            @csrf
            <table>
            <tr>
            <td>
            <div class="uk-margin">
            <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input field" type="text" name="id" placeholder="Codigo de la empresa" required>
            </div>
            </div>
            </td>
            </tr>
            <tr>
            <td><center>
            <button class="uk-button uk-button-primary">Ingresar</button>
            </center>
            </td>
            </tr>
            </table>
            </form>
            </center>
            <br>
        </div>
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
    </body>
</html>