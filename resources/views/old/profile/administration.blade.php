<link rel="stylesheet" href="css/tailwind.css">
<x-app-layout>

    <!-- Header de la page actuelle -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration') }}
        </h2>
    </x-slot>

    <!-- Contenu de la page actuelle -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
           
                        Page d'administration
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
