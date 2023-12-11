
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
        <li id="association_action">Par: <a href="/association?id={{ $action->idassociation }}">{{ $action->association->nomassociation }}</a></li>
        <!-- description -->
        <li><p id="descripion_action">{{ $action->descriptionaction}}</p></li>
        @if (isset($action->codepostaladresse))
            <li><p>Lieu: {{ $action->codepostaladresse }} ({{ $action->nomdepartement }})</p></li>
        @else
            <li><p>Lieu: Pas de lieu spécifique</p></li>
        @endif
        
        <!-- Nombre de soutiens/participation -->
            @if ($action->demandebenevolat)

                <li>Type: Bénévolat ({{count($action->participationbenevolat)}} participation(s) )</li>
                
            @elseif ($action->demandedon)
                <li>Type: Don ({{count($action->participationdon)}} don(s) )</li>
               
            @else
                <li>Type: Information</li>
                
            @endif


        <!-- date publication -->
        <li><p>Nombre Like: {{count($action->likes)}}</p></li>
        <li id="date_action">{{ \Carbon\Carbon::parse($action->datepublicationaction)->isoFormat('D MMMM Y', 'Do MMMM Y') }}</li>
        <a id="voirplus" href="/action?id={{ $action->idaction }}">Voir plus</a>

    </ul>
</li>
