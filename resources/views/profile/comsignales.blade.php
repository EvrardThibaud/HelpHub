@section('title', 'Commentaires signalés - HelpHub')

<x-app-layout>
<link rel="stylesheet" href="css/dashboard/comsignales.blade.css">

    <div id="page">
        @foreach ($commentaires as $com)
            
        @endforeach
    </div>
    
</x-app-layout>