<?php
    if(!empty($usuario))
    {
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
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: world"></span>Ajustes generales</a>
            <ul class="uk-nav-sub">
                <li><a href="#">Agregar almacen</a></li>
            </ul>
        </li>
        <li class="uk-nav-divider"></li>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: bolt"></span>Administración</a>
            <ul class="uk-nav-sub">
                <li><a href="empleado">Gestionar empleado</a></li>
                <li><a href="producto">Gestionar producto</a></li>
                <li><a href="#">Inventario</a></li>
                <li><a href="#">Estadísticas</a></li>
                <li><a href="#">Liquidar nominas</a></li>
            </ul>
        </li>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: star"></span>Supervisión</a>
            <ul class="uk-nav-sub">
                <li><a href="#">Devoluciones</a></li>
                <li><a href="cliente">Gestionar cliente</a></li>
            </ul>
        </li>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: cart"></span>Tienda</a>
            <ul class="uk-nav-sub">
                <li><a href="comprar">Comprar</a></li>
                <li><a href="#">Mis compras</a></li>
                <li><a href="#">Pedidos</a></li>
            </ul>
        </li>
        <li class="uk-nav-header">Area personal</li>
        <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Mis ajustes</a></li>
        <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Mi nomina</a></li>
        <li class="uk-nav-divider"></li>
        <li><a href="logout"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Cerrar sesión</a></li>
    </ul>
</div>
<br><br>
<?php
    }
?>