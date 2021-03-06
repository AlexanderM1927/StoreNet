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
        <?php if($usuario->getRango()>3){ ?>
        <hr>
        <li class="uk-parent">
            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: world"></span>Ajustes generales</a>
            <ul class="uk-nav-sub">
                <li><a href="afiliados">Gestionar almacenes</a></li>
                <li><a href="reportes">Gestionar reportes</a></li>
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
                <li><a href="nominas">Liquidar nominas</a></li>
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
        <li><a href="nomina"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Mi nomina</a></li>
        <?php } ?>
        <?php if($usuario->getRango()==0){ ?>
        <li><a href="sorteo"><span class="uk-margin-small-right" uk-icon="icon: play-circle"></span> Revisar sorteo<b class="new uk-animation-shake">NEW</b></a></li>
        <?php } ?>
        <li class="uk-nav-divider"></li>
        <li><a href="logout"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Cerrar sesión</a></li>
    </ul>
</div>
<br><br>
<div class="reportes">
<div onclick="report()" style="width:100%; padding:3px;"><span class="uk-margin-small-right" uk-icon="icon: list"></span>Enviar reportes</div>
<div id="list-reportes" class="barra">
<center>
<form action="" onsubmit="enviar(); return false">
<div class="uk-margin">
<div class="uk-inline">
<span class="uk-form-icon" uk-icon="icon: mail"></span>
<input class="uk-input field" type="mail" id="mail" placeholder="Correo eléctronico" required>
</div>
</div>
<div class="uk-margin">
<div class="uk-inline">
<span class="uk-form-icon" uk-icon="icon: tag"></span>
<input class="uk-input field" type="text" id="title" placeholder="Título" required>
</div>
</div>
<div class="uk-margin">
<textarea class="uk-textarea" id="content" rows="4" maxlength="590" placeholder="Contenido" required></textarea>
</div>
<button class="uk-button uk-button-primary">Enviar</button>
</form>
</center>
</div>
</div>
<script>
let activo=0
function report()
{
    if(activo===0)
    {
        document.getElementById('list-reportes').style.display="block"
        activo=1
    }else{
        document.getElementById('list-reportes').style.display="none"
        activo=0
    }
}
function limpiar()
{
    document.getElementById("mail").value = ""
    document.getElementById("title").value = ""
    document.getElementById("content").value = ""
}
function enviar()
{
    var mail = document.getElementById("mail").value;
    var title = document.getElementById("title").value;
    var content = document.getElementById("content").value;
    var xhttp = new XMLHttpRequest();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    xhttp.withCredentials = true;
    let envio = false
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Reporte enviado correctamente',pos: 'top-right',status:'success'})
        report()
        limpiar()
        envio = true
    }
    };
    xhttp.open("POST", "procesarReportes/1", true);
    xhttp.setRequestHeader('x-csrf-token', csrfToken);
    xhttp.send(JSON.stringify({correo: mail,titulo: title, contenido: content}));
    if(envio === false) UIkit.notification({message: '<span uk-icon=\'icon: error\'></span> Se ha presentado un fallo al enviar',pos: 'top-right',status:'error'})
}
</script>
<?php
    }
?>