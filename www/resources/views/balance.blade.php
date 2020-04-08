<!DOCTYPE html>
<html>
    <head>
        <title>SoftCorp - StoreNet</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <link type="text/css" href="css/app.css" rel="stylesheet" />
    </head>
    <body>
    <?php
            if(!empty($usuario))
            {
        ?>
        <div class="informe">
        <h1>Informe</h1>
        <hr>
        Desde: <?=$desde?><br>
        Hasta: <?=$hasta?>
        <hr>
        <?=$balance?>
        </div>
        <div class="footer">Balance generador por StoreNet - a product by SoftCorp</div>
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
    </body>
</html>