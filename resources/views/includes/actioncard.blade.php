
<head>
    <link rel="stylesheet" href="css/actioncard.blade.css">
</head>
<li id="action">
    
    <!-- titre -->
    <h4>{{ $action->titreaction }}</h4>
    <ul >
        <div id="image_action_div">
            @if ($action->image)
            <img src="{{$action->image}}" alt="" >
            @else
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Pas_d%27image_disponible.svg/2048px-Pas_d%27image_disponible.svg.png" alt="" >
            @endif
        </div>
        <!-- association -->
        <li id="association_action">Par: <a href="/association?id={{ $action->idassociation }}">{{ $action->nomassociation }}</a></li>
        <!-- description -->
        <li><p id="descripion_action">{{ $action->descriptionaction}}</p></li>
        @if (isset($action->codepostaladresse))
            <li><p>Lieu: {{ $action->codepostaladresse }} ({{ $action->nomdepartement }})</p></li>
        @else
            <li><p>Lieu: Pas de lieu spécifique</p></li>
        @endif
        
        <!-- Nombre de soutiens/participation -->
            @php 
                $actionId = $action->idaction; 
                $countDemandedon = 0;
                $countDemandeBenevolat = 0;
                $countLikeInformation = 0;
                $estDemandeDon = False;
                $estDemandeBenevolat = False;
                $nbLike = 0
            @endphp

            @foreach($actionlike as $like)
                @if($like['idaction'] == $actionId)
                    @php $nbLike++; @endphp
                @endif
            @endforeach                   

            
            @foreach($demandedon as $item)
                @if($item['idaction'] == $actionId)
                    @php $estDemandeDon = True; @endphp
                @endif
            @endforeach

            @foreach($demandebenevolat as $item)
                @if($item['idaction'] == $actionId)
                    @php $estDemandeBenevolat = True; @endphp
                @endif
            @endforeach

            @if ($estDemandeBenevolat)
                @foreach($participationbenevolat as $item)
                    @if($item['idaction'] == $actionId)
                        @php $countDemandeBenevolat++; @endphp
                    @endif
                @endforeach
                <li>Type: Bénévolat ({{ $countDemandeBenevolat }} participation(s) )</li>
                
            @elseif ($estDemandeDon)
                @foreach($participationdon as $item)
                    @if($item['idaction'] == $actionId)
                        @php $countDemandedon++; @endphp
                    @endif
                @endforeach
                <li>Type: Don ({{ $countDemandedon}} don(s) )</li>
               
            @else
                <li>Type: Information (0 j'aime(s) )</li>
                
            @endif


        <!-- date publication -->
        <li><p>Nombre Like: {{$nbLike}}</p></li>
        <li id="date_action">{{ \Carbon\Carbon::parse($action->datepublicationaction)->isoFormat('D MMMM Y', 'Do MMMM Y') }}</li>
        <a id="voirplus" href="/action?id={{ $action->idaction }}">Voir plus</a>

    </ul>
</li>
