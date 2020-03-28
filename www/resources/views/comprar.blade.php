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
        @include('elements.navbar')
        <div class="container">
            <div id="v-app">
                <comprar></comprar>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>