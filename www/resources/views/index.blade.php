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
        <div class="loginForm">
        <?php
        if(!empty($errorLogin))
        {
            ?>
            <div class="uk-alert-danger" style="margin-bottom:-40px;" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><?=$errorLogin?></p>
            </div>
            <?php
        }
        ?>
        <h1 class="title">Log-in</h1>
        <div class="content">
           <form action="" method="POST">
                @csrf
               <center>
                <div class="uk-margin">
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input field" type="mail" name="mail" placeholder="Correo eléctronico" required>
                </div>
                </div>
                <div class="uk-margin">
                <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input field" name="password" type="password" placeholder="Clave" required>
                </div>
                </div>
                <button class="uk-button uk-button-default">Ingresar</button><br><br>
                <a href="#modal-center" uk-toggle>¿No tienes cuenta? lee esto</a>
                </center>
           </form> 
        </div>
        </div>
        <div id="modal-center" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <div class="uk-modal-header">
        <h2 class="uk-modal-title">¿Cómo puedes crear tu cuenta?</h2>
        </div>
        <button class="uk-modal-close-default" type="button" uk-close></button>

        <p>Para acceder a la aplicación debes contar con una cuenta, es por esto que te indicamos el proceso que debes seguir para obtener una.</p>
        <br>
        <p><b>1)</b>Debes dirigite al establecimiento más cercano.</p>
        <p><b>2)</b>Pide a administración que te afilien a la aplicación.</p>
        <p><b>3)</b>Ya puedes comenzar a disfrutar de las utilidades que tenemos para ti!</p>
        </div>
        </div>
    </body>
</html>

