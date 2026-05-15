<div class="navbar bg-base-100 shadow-md border-b border-base-200 px-2 sm:px-4 lg:px-8">

    {{-- SINISTRA: Ritorno al sito vetrina (Escape Hatch) --}}
    <div class="navbar-start">
        <a href="/" class="btn btn-ghost btn-sm sm:btn-md gap-2 normal-case px-2 sm:px-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-base-content/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="hidden sm:inline">Torna al sito</span>
        </a>
    </div>

    {{-- CENTRO: Branding e Trust Badge (Rassicurazione) --}}
    <div class="navbar-center flex-col items-center">
        <span class="text-lg sm:text-xl font-bold text-primary">SuiteDirect</span>
        <span class="text-[10px] sm:text-xs text-base-content/60 flex items-center gap-1 mt-0.5 sm:mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-success" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            <span class="hidden sm:inline">Prenotazione Sicura</span>
            <span class="inline sm:hidden">Sicura</span>
        </span>
    </div>

    {{-- DESTRA: Contatti, Valuta, Lingua e Utente --}}
    <div class="navbar-end space-x-1 sm:space-x-2">

        {{-- Contatti Assistenza (Visibili solo su schermi larghi per non affollare la navbar) --}}
        <div class="hidden lg:flex flex-col items-end justify-center pr-2 border-r border-base-200">
            <a href="tel:+39021234567" class="text-xs text-base-content/80 font-medium hover:text-primary flex items-center gap-1.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                +39 02 1234567
            </a>
            <a href="mailto:booking@suitedirect.com" class="text-xs text-base-content/80 font-medium hover:text-primary flex items-center gap-1.5 mt-0.5 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                booking@suitedirect.com
            </a>
        </div>

        {{-- Selettore Valuta --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm px-1.5 sm:px-2 font-semibold">
                EUR
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu menu-sm mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-24">
                <li><a class="active">EUR (€)</a></li>
                <li><a>USD ($)</a></li>
            </ul>
        </div>

        {{-- Selettore Lingua --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-sm px-1.5 sm:px-2 font-semibold">
                IT
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <ul tabindex="0" class="dropdown-content menu menu-sm mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-20">
                <li><a class="active">IT</a></li>
                <li><a>EN</a></li>
            </ul>
        </div>

        {{-- Menu Utente Loggato --}}
        @auth
        <div class="dropdown dropdown-end ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar btn-sm sm:btn-md {{ Auth::user()->is_admin ? 'border-2 border-info' : '' }}">
                <div class="w-8 sm:w-10 rounded-full">
                    <img alt="User menu" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background={{ Auth::user()->is_admin ? '0284c7' : 'random' }}&color=fff" />
                </div>
            </div>

            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li class="menu-title opacity-60"><span>{{ Auth::user()->name }}</span></li>
                <li><a href="/profile">Profilo</a></li>
                <hr class="my-1 border-base-200" />
                <li>
                    <form method="POST" action="/logout" class="p-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-error/10 text-error">
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth

    </div>
</div>