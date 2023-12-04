@section('title', 'HelpHub - Choix Inscription')
<x-guest-layout>



    <div id="content">

        <a href="{{ route('register_association') }}"><div>Association</div></a>
        <a href="{{ route('register') }}"><div>Utilisateur</div></a>

    </div>

    @include('includes.footer')

</x-guest-layout>
