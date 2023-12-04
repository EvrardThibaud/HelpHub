<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if($association)
        <title>Association - {{ $association->nomassociation}}</title>
    @else
        <title>Association - Aucune</title>
    @endif
    <link rel="stylesheet" href="css/association.blade.css">
</head>
<body>
    @include('includes.header')
    @if($association)
        <div id="content">
            
            <div id="container_left">
                <img src="{{$association->media->image}}">
            </div>
            
            <div id="container_right">

                <h1 id="nomasso" >{{ $association->nomassociation}}</h1>
                <div id="contact">
                    <h4>Contact: {{ $association->mailassociation}}</h4>
                    <a href="{{$association->sitewebassociation}}">Site internet</a>
                </div>
                <p id="descriptionasso">{{$association->descriptionassociation}}</p>
                <h3 id="troisdernact">Les actions de l'association (ordre de publication)</h3>
                <div id="lesactions">
                @foreach ($actions as $action)
                    @include('includes.actioncard')
                @endforeach
                </div>
            </div>
        </div>

    
    @else
        <h1>L'association spécifiée n'existe pas.</h1>
    @endif
    @include('includes.footer')
</body>
</html>