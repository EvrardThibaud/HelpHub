<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/404.blade.css">
    <title>Erreur - HelpHub</title>
</head>
<body>
    @include('includes.header')

    <div id="content">
        
            <p id="error_nb">Error 404</p>
            <p id="error_info">Cette page n'existe pas </p>
            <a href="/">cliquer ici pour revenir à l'acceuil</a>

    </div>

    @include('includes.footer')
</body>
</html>