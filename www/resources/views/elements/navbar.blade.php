<?php
    if(!empty($usuario))
    {
        if($usuario->getRango()==4 && $usuario->getIdAfiliado()==0)
        {
            ?>
            <script>window.location.href = "homeadm"</script>
            <?php
        }
?>
<div class="uk-card uk-card-default uk-card-body uk-width-1-2@s navbar">
    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
        <li class="uk-nav-header"><img src="img/logo.png"></li>
        <br>
        <center>
        <b><?=$usuario->getNombres()?></b><br>
        <b><?=$usuario->getNombreRango()?></b>
        </center>
        <hr>
        <?php if($usuario->getRango()>3){ ?>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: world"></span>Ajustes generales</a>
            <ul class="uk-nav-sub">
                <li><a href="afiliados">Agregar almacen</a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if($usuario->getRango()>=3){ ?>
        <li class="uk-nav-divider"></li>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: bolt"></span>Administración</a>
            <ul class="uk-nav-sub">
                <li><a href="empleado">Gestionar empleado</a></li>
                <li><a href="producto">Gestionar producto</a></li>
                <li><a href="inventario">Inventario</a></li>
                <li><a href="estadisticas">Estadísticas</a></li>
                <li><a href="#">Liquidar nominas</a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if($usuario->getRango()>=2){ ?>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: star"></span>Supervisión</a>
            <ul class="uk-nav-sub">
                <li><a href="cliente">Gestionar cliente</a></li>
                <li><a href="tarjetas">Gestionar tarjetas</a></li>
                <li><a href="gpedidos">Gestionar pedidos</a></li>
                <li><a href="devoluciones">Devoluciones</a></li>
            </ul>
        </li>
        <?php } ?>
        <?php if($usuario->getRango()==0){ ?>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: cart"></span>Tienda</a>
            <ul class="uk-nav-sub">
                <li><a href="comprar">Comprar</a></li>
                <li><a href="compras">Mis compras</a></li>
                <li><a href="pedidos">Pedidos</a></li>
            </ul>
        </li>
        <?php } ?>
        <li class="uk-nav-header">Area personal</li>
        <?php if($usuario->getRango()==0){ ?>
        <li><a href="tarjeta"><span class="uk-margin-small-right" uk-icon="icon: credit-card"></span> Mi tarjeta</a></li>
        <?php } ?>
        <li><a href="ajustes"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Mis ajustes</a></li>
        <?php if($usuario->getRango()!=0){ ?>
        <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Mi nomina</a></li>
        <?php } ?>
        <li class="uk-nav-divider"></li>
        <li><a href="logout"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Cerrar sesión</a></li>
    </ul>
</div>
<br><br>
<?php
    }
?>