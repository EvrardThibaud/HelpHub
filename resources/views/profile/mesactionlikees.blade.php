@section('title', 'Actions Likées- HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/mesactionlikees.css">
    <div id="page">
        <h1>Mes action likées</h1>
        <div id="actions_likees_div">

            @if(count($likedActions) > 0)
            
            @foreach ($likedActions as $action)
            @include('includes.actioncard')
            @endforeach
            @else
            <p>Aucune action likées</p>
            @endif
        </div>
    </div>
</x-app-layout>