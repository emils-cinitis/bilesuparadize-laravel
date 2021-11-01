<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Biļešuparadīze test</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/app.css">
    </head>
    <body class="antialiased">
        <div id="app">
            <image-display></image-display>
        </div>

        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
