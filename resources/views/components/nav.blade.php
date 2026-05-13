<div class="navbar bg-base-200">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="-1" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li><a href='/servizi'>Servizi</a></li>
                <li><a href='/calendar'>Prenota Ora</a></li>
                <li><a href='/recensioni'>Recensioni</a></li>
                <li><a href='/specialOffer'>Offerte Speciali</a></li>
            </ul>
        </div>
        <a href='/' class="btn btn-ghost text-xl">SuiteDirect</a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href='/servizi'>Servizi</a></li>
            <li><a href='/calendar'>Prenota Ora</a></li>
            <li><a href='/recensioni'>Recensioni</a></li>
            <li><a href='/specialOffer'>Offerte Speciali</a></li>
        </ul>
    </div>

    <div class="navbar-end space-x-2">
        @auth
        {{-- AGGIUNTA: Accesso Dashboard Admin --}}
        @if(Auth::user()->isAdmin) 
        <a href="/admin/dashboard" class="btn btn-outline btn-info btn-sm hidden sm:flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Dashboard Admin
        </a>
        @endif

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar {{ Auth::user()->is_admin ? 'border-2 border-info' : '' }}">
                <div class="w-10 rounded-full">
                    <img alt="User menu" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background={{ Auth::user()->is_admin ? '0284c7' : 'random' }}&color=fff" />
                </div>
            </div>

            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li class="menu-title opacity-60"><span>{{ Auth::user()->name }}</span></li>
                <li>
                    <a href="/profile" class="justify-between">
                        Profilo
                    </a>
                </li>
                @if(Auth::user()->isAdmin)
                <li><a href="/admin/dashboard" class="text-info font-bold">Dashboard Admin</a></li>
                @endif
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

        @guest
        <a class="btn btn-primary btn-sm" href="/register">Register</a>
        <a class="btn btn-secondary btn-sm" href="/login">Log In</a>
        @endguest
    </div>
</div>