@section('title', 'Préférences - HelpHub')
<link rel="stylesheet" href="css/dashboard/preferences.blade.css">
<x-app-layout>

    <div id="page">
        @if(session('message'))
            <script>
                var message = '{{ session('message') }}';
                createToast('valid', message)
            </script>
        @endif
        <form method="post" action="{{route('profile.changenotif')}}" id="form_preferences">
            @csrf
            <input type="hidden" name="idutilisateur" value="{{Auth::user()->idutilisateur}}">
            <input id="notification_cb" name="notification" type="checkbox" @if(Auth::user()->notification) checked @endif>
            <label for="notification_cb">Recevoir les notifications ?</label>
            <input type="submit" value="Enregistrer">
        </form>
        <p>Suite à la séléction d'une préférence, vous serez alerté lors de la publication d'un action en lien avec la/les préférence(s) séléctionnée(s).</p>
        
        <h4>Séléctionner les thématiques et les associations qui vous intéresse.</h4>
        <div class="pref_actions">
            <div>
                <h3>Préférences de type d'action</h3>
                <p>Bénévolat</p>
                <p>Information</p>
                <p>Don</p>
            </div>
            <div>
                <h3>Préférences de thématique</h3>
                <form action="">
                    @foreach ($thematiques as $them)
                        <input type="checkbox" name="thematique_{{$them->idthematique}}">
                        <label for="thematique_{{$them->idthematique}}">{{$them->libellethematique}}</label>
                    @endforeach
                </form>
            </div>
            <div>
                <h3>Préférences d'association</h3>
                @foreach ($associations as $asso)
                    <p>{{$asso->nomassociation}}</p>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
