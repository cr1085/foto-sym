{{-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Dashboard
                    </a>

                    <!-- User dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 focus:outline-none">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Iniciar sesión
                    </a>
                @endguest

            </div>

            <!-- Mobile button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden px-4 pb-4 space-y-2">

        @auth
            <a href="{{ route('admin.dashboard') }}" class="block text-gray-700">
                Dashboard
            </a>

            <a href="{{ route('profile.edit') }}" class="block text-gray-700">
                Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600">
                    Cerrar sesión
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="block text-gray-700">
                Iniciar sesión
            </a>
        @endguest

    </div>
</nav> --}}


<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Desktop -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                @auth
                    <span class="text-sm text-gray-700">
                        {{ Auth::user()->name }}
                    </span>

                    <a href="{{ route('admin.dashboard') }}"
                       class="text-sm font-medium text-gray-700 hover:text-gray-900">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">
                            Cerrar sesión
                        </button>
                    </form>
                @endauth

            </div>
        </div>
    </div>
</nav>
