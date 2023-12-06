<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        
        <link rel="stylesheet" href="css/adressecompletion.css">
        <link rel="stylesheet" href="css/dashboard/app.blade.css">
        <link rel="stylesheet" href="css/dashboard/mescoms.blade.css">
    </head>
    <body>
        @include('includes.header')
        <div>
            @include('layouts.navigation')

            {{ $slot }}
            
        </div>
        @include('includes.footer')
    </body>
</html>
