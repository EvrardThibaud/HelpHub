<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accueil - HelpHub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/welcome.blade.css">
        
    </head>
    <body class="antialiased">
        

            
            @include('includes.header')
            
            <main>
                @include('includes.recherche')
                <div id="div_three_last_action">
                    <h2>Les 3 dernières actions</h2>
                    <ul id="list_three_last_action">
                    @foreach ($actions as $action)
                        @include('includes.actioncard')
                    @endforeach
                    </ul>
                </div>

            </main>
            
            @include('includes.footer')
    </body>
</html>
