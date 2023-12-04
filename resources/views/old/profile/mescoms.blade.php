<link rel="stylesheet" href="css/tailwind.css">
<x-app-layout>

    <!-- Header de la page actuelle -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Commentaires') }}
        </h2>
    </x-slot>

    <!-- Contenu de la page actuelle -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
           
                    @if(count($commentaires) > 0)
                        <ul >
                            @foreach ($commentaires as $com)

                            <li>
                                <ul class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <li>id: {{ $com->idcommentaire}}</li>
                                    <li>action: {{ $com->titreaction}}</li>
                                    <li>texte: {{ $com->textecommentaire}}</li>
                                    <li>nb like: {{ $com->nblikecommentaire}}</li>
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucun commentaires.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
