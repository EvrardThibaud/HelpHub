<nav id="navigation">
    <div id="leftpart">

        <a href="{{ route('dashboard') }}" class="{{ Request::is('dashboard*') ? 'active' : '' }}">
            Mon Compte
        </a>

        @if(Auth::user()->association)
            <a href="{{ route('profile.mesactions') }}" class="{{ Request::is('mesactions*') ? 'active' : '' }}">
                Mes Actions 
            </a>              
            <a href="{{ route('profile.creeraction') }}" class="{{ Request::is('creeraction*') ? 'active' : '' }}">
                Créer Action 
            </a>  
            @if(Auth::user()->directeurasso)
                <a href="{{ route('profile.powerbi') }}" class="{{ Request::is('powerbi*') ? 'active' : '' }}">
                    PowerBI 
                </a>  
            @endif
        @elseif (Auth::user()->servicediffusion)
            <a href="{{ route('profile.demandeactions') }}" class="{{ Request::is('demandeactions*') ? 'active' : '' }}">
                Demandes Action 
            </a>
            <a href="{{ route('profile.comsignales') }}" class="{{ Request::is('comsignales*') ? 'active' : '' }}">
                Commentaires Signalés 
            </a>
            <a href="{{ route('profile.ajoutthematique') }}" class="{{ Request::is('ajoutthematique*') ? 'active' : '' }}">
                Ajout Thématique 
            </a>
            <a href="{{ route('profile.actioninvisible') }}" class="{{ Request::is('actioninvisible*') ? 'active' : '' }}">
                Actions invisibles
            </a>    
        @else
            <a href="{{ route('profile.edit') }}" class="{{ Request::is('profile*') ? 'active' : '' }}">
                Profil
            </a>
            <a href="{{ route('profile.candidatures') }}" class="{{ Request::is('candidatures*') ? 'active' : '' }}">
                Mes Candidatures
            </a> 
            <a href="{{ route('profile.actionlikes') }}" class="{{ Request::is('actionlikes*') ? 'active' : '' }}">
                Mes Actions likés 
            </a>   
            <a href="{{ route('profile.mescoms') }}" class="{{ Request::is('mescoms*') ? 'active' : '' }}">
                Mes Commentaires 
            </a>        
            <a href="{{ route('profile.mesinfosbancaire') }}" class="{{ Request::is('mesinfosbancaire*') ? 'active' : '' }}">
                Mes Informations bancaires 
            </a>      
            @if(Auth::user() && Auth::user()->admin)
                <a href="{{ route('profile.administration') }}" class="{{ Request::is('administration*') ? 'active' : '' }}">
                    Administration
                </a>  
            @endif
        @endif
    </div>
    <div id="rightpart">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a id="deco" href="{{ route('logout') }}" class="{{ Request::is('logout*') ? 'active' : '' }}" 
            onclick="event.preventDefault(); this.closest('form').submit();">
            Deconnexion
            </a>  
        </form>
    </div>
</nav>
