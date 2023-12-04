<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">



    <!-- Sous header principal des pages 'mon compte' -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Mon Compte') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Profil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.mescoms')" :active="request()->routeIs('profile.mescoms')">
                        {{ __('Mes Commentaires') }}
                    </x-nav-link>
                    @if(Auth::user()->admin)
                        <x-nav-link :href="route('profile.administration')" :active="request()->routeIs('profile.administration')">
                            {{ __('Administration') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>



            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Deconnexion') }}
                                    </x-dropdown-link>
                                </form>
                            </div>

                 
                        </button>
                    </x-slot>

                    <x-slot name="content">


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Deconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            



        </div>
    </div>







</nav>
