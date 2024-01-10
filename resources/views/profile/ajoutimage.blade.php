@section('title', "Ajout d'image - HelpHub")
<link rel="stylesheet" href="css/dashboard/ajoutimage.blade.css">

<x-app-layout>
    <div id="page">

        <h1>Ajout image</h1>
        <h3>Images actuelles: </h3>
        <div id="lesimages">
            @if(count($action->images) > 0)
            @foreach ($action->images as $img)
            <img src="/storage/{{$img->media->image}}" alt="">
            @endforeach
            @else
            <h3>Aucune image</h3>
            @endif
        </div>
        <h3>Ajouter une image</h3>
        <form id="ajoutimage" method="POST" action="{{route('profile.ajouterimage')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idaction" value="{{$action->idaction}}">
            <input id="media" type="file" name="media" required />
            <input type="submit" value="Ajouter">
        </form>
        
    </div>
</x-app-layout>
