<div class="navbar bg-neutral text-neutral-content shadow-lg">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 text-base-content">
                <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/bookings">Prenotazioni</a></li>
                <li><a href="/admin/rooms">Gestione Camere</a></li>
                <li><a href="/admin/users">Utenti</a></li>
            </ul>
        </div>
        <a href='/admin/dashboard' class="btn btn-ghost text-xl">Hotel <span class="badge badge-error">Admin</span></a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 font-medium">
            <li><a href='/admin/statistics'>Statistiche</a></li>
            <li><a href='/admin/bookings'>Prenotazioni</a></li>
            <li><a href='/admin/users'>Utenti</a></li>
            <li><a href='/admin/rooms'>Camere</a></li>
            <li><a href='/admin/services'>Servizi</a></li>
            <li><a href='/admin/allReviews'>Recensioni</a></li>
        </ul>
    </div>

    <div class="navbar-end space-x-2">
        <a href="/" class="btn btn-outline btn-sm btn-info hidden sm:flex">Sito Pubblico</a>

        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border-2 border-primary">
                <div class="w-10 rounded-full">
                    <img alt="Admin menu" src="https://ui-avatars.com/api/?name=Admin&background=ef4444&color=fff" />
                </div>
            </div>

            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52 text-base-content">
                <li class="menu-title text-xs">Amministratore</li>
                <li><a href="/admin/settings">Impostazioni Sistema</a></li>
                <li><a href="/admin/logs">Log Attività</a></li>
                <hr class="my-1 border-base-200" />
                <li>
                    <form method="POST" action="/logout" class="p-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-error/10 text-error font-bold">
                            Esci dalla Dashboard
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>