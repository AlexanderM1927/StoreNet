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
        @include('elements.navbar', ['usuario' => $usuario])
        
        <div class="container">
            <div id="v-app">
                <inventario idafiliado="<?=$usuario->getIdAfiliado()?>"></inventario>
            </div>
        </div>
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>