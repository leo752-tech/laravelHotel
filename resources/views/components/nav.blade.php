<div x-data="{ scrollPos: 0, maxScroll: 800, isMenuOpen: false }"
    @scroll.window="scrollPos = window.scrollY"
    @keydown.escape.window="isMenuOpen = false"
    class="fixed top-0 w-full z-50 text-white transition-[padding,box-shadow,backdrop-filter] duration-300 ease-in-out"
    :class="scrollPos > 10 ? 'py-2 shadow-lg backdrop-blur-md' : 'py-4'"
    :style="`background-color: rgba(15, 23, 42, ${Math.min(scrollPos / maxScroll, 0.95)});`">

    <div class="navbar max-w-7xl mx-auto px-4">

        {{-- SINISTRA: Burger Menu (Solo Pulsante) --}}
        <div class="navbar-start">
            <button @click="isMenuOpen = true" class="btn btn-ghost btn-circle hover:bg-white/20 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        {{-- CENTRO: Vuoto --}}
        <div class="navbar-center"></div>

        {{-- DESTRA: Pulsanti Azione (Invariati) --}}
        <div class="navbar-end gap-3">
            @guest
            <a href="/login" class="btn btn-ghost hover:bg-white/20 text-white border-none">Accedi</a>
            @endguest

            @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar hover:bg-white/20">
                    <div class="w-9 rounded-full ring ring-white/30 ring-offset-base-100 ring-offset-2">
                        <img alt="User avatar" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" />
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-4 z-[1] p-2 shadow-xl bg-base-100 text-base-content rounded-box w-52">
                    <li class="menu-title opacity-60"><span>{{ Auth::user()->name }}</span></li>
                    <li><a href="/profile">Profilo</a></li>
                    <hr class="my-1 border-base-200" />
                    <li>
                        <form method="POST" action="/logout" class="p-0 m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-error/10 text-error rounded-lg">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth

            <a href="/calendar" class="btn btn-primary bg-emerald-700 rounded-full px-6 border-none shadow-lg hover:scale-105 transition-transform">Prenota</a>
        </div>

    </div>

    {{-- IL MENU LATERALE A TUTTA ALTEZZA (Teleportato sul body) --}}
    <template x-teleport="body">
        <div>
            {{-- Sfondo Scuro Semitrasparente (Backdrop) --}}
            <div x-show="isMenuOpen"
                @click="isMenuOpen = false"
                style="display: none;"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100]"
                x-transition:enter="transition opacity ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
            </div>

            {{-- Pannello Laterale (Sidebar) --}}
            <div x-show="isMenuOpen"
                style="display: none;"
                class="fixed inset-y-0 left-0 w-80 max-w-[85vw] bg-slate-900 shadow-2xl z-[101] flex flex-col overflow-y-auto"
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition transform ease-in duration-300"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full">

                {{-- Header del menu con logo e tasto chiusura --}}
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <span class="text-xl font-bold text-white tracking-wider">SuiteDirect</span>
                    <button @click="isMenuOpen = false" class="text-white/70 hover:text-white transition-colors p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Voci del menu --}}
                <nav class="flex-1 px-8 py-10 flex flex-col gap-6">
                    <a href="/" class="text-2xl font-light text-white/80 hover:text-white hover:translate-x-2 transition-all">Home</a>
                    <a href="/servizi" class="text-2xl font-light text-white/80 hover:text-white hover:translate-x-2 transition-all">Servizi</a>
                    <a href="/recensioni" class="text-2xl font-light text-white/80 hover:text-white hover:translate-x-2 transition-all">Recensioni</a>
                    <a href="/specialOffer" class="text-2xl font-light text-yellow-500 hover:text-yellow-400 hover:translate-x-2 transition-all">Offerte Speciali</a>

                    @auth
                    @if(Auth::user()->isAdmin)
                    <div class="mt-8 pt-8 border-t border-white/10 flex flex-col gap-6">
                        <span class="text-xs font-bold text-white/40 uppercase tracking-widest">Amministrazione</span>
                        <a href="/admin/dashboard" class="text-lg font-light text-sky-400 hover:text-sky-300 hover:translate-x-2 transition-all">Dashboard</a>
                    </div>
                    @endif
                    @endauth
                </nav>

                {{-- Footer del menu (es. contatti rapidi) --}}
                <div class="p-8 text-sm text-white/50">
                    <p>+39 02 1234567</p>
                    <p>booking@suitedirect.com</p>
                </div>

            </div>
        </div>
    </template>
</div>