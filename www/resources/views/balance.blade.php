<!DOCTYPE html>
<html>
    <head>
        <title>SoftCorp - StoreNet</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
            function money($val)
            {
                return number_format($val, 2);
            }
        ?>
        <div class="informe">
        <h1>Informe - <?=$balance['nombre']?></h1>
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
            <td><?=money($balance['ventas'])?></td>
            <td><?=money($balance['costosv'])?></td>
            <td><?=money($balance['utilidades'])?></td>
        </tr>
        <tr>
            <td>Pagos por nomina</td>
            <td>0</td>
            <td><?=money($balance['nominas'])?></td>
            <td><?=money($balance['nominas'])?></td>
        </tr>
        <?php
        $total = money($balance['utilidades']-$balance['nominas']);
        ?>
        <tr>
            <th colspan="3">Total</th>
            <th><?=$total?></th>
        </tr>
        </table>
        </center>
        <br>
        <br>
        <div class="balance_productos">
        <table id="balance_productos">
        <tr>
            <th>Productos vendidos</th>
        </tr>
        <tr>
            <td><?=$balance['nventas']?></td>
        </tr>
        </table>
        </div>
        <br><br>
        <hr>
        <b style="color:red;">*</b>Si el saldo total, tiene un valor negativo, es posible que <?=$balance['nombre']?> presente perdidas.<br>
        <b style="color:red;">*</b>Es importante tener en cuenta que los balances están hechos en el rango de fechas que usted solicito.
        </div>
        <div class="footer">Balance generador por StoreNet - a product by SoftCorp</div>
        <?php
            }else{
                echo '<script>window.location.href = "/";</script>';
            }
        ?>
    </body>
</html>