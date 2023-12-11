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
        @elseif (Auth::user()->servicediffusion)
            <a href="{{ route('profile.demandeactions') }}" class="{{ Request::is('demandeactions*') ? 'active' : '' }}">
                Demandes Action 
            </a>
            <a href="{{ route('profile.comsignales') }}" class="{{ Request::is('comsignales*') ? 'active' : '' }}">
                Commentaires Signalés 
            </a>    
        @else
            <a href="{{ route('profile.edit') }}" class="{{ Request::is('profile*') ? 'active' : '' }}">
                Profil
            </a>
            <a href="{{ route('profile.actionlikes') }}" class="{{ Request::is('actionlikes*') ? 'active' : '' }}">
                Mes Actions likés 
            </a>   
            <a href="{{ route('profile.mescoms') }}" class="{{ Request::is('mescoms*') ? 'active' : '' }}">
                Mes Commentaires 
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
