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
        <center>
        <table id="balance">
        <tr>
            <th>Concepto</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Totales</th>
        </tr>
        <tr>
            <td>Ventas realizadas</td>
            <td><?=$balance->ventas?></td>
            <td>0</td>
            <td></td>
        </tr>
        <tr>
            <td>Pagos por nomina</td>
            <td>0</td>
            <td><?=$balance->nominas?></td>
            <td></td>
        </tr>
        <?php
        $total = $balance->ventas-$balance->nominas;
        ?>
        <tr>
            <th colspan="3">Total</th>
            <th><?=$total?></th>
        </tr>
        </table>
        </center>
        <br><br>
        <hr>
        <b style="color:red;">*</b>Si el saldo total, tiene un valor negativo, es posible que presentes perdidas.
        </div>
        <div class="footer">Balance generador por StoreNet - a product by SoftCorp</div>
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
    </body>
</html>