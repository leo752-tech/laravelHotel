<x-layout>
    <div class="max-w-4xl mx-auto p-6">
        <div class="card bg-base-100 shadow-xl border border-base-200 mb-8">
            <div class="card-body flex-row items-center gap-6">
                <div class="avatar">
                    <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=128" />
                    </div>
                </div>
                <div>
                    <h2 class="card-title text-2xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-base-content/70">{{ Auth::user()->email }}</p>
                    <div class="badge badge-primary mt-2">Membro dal {{ Auth::user()->created_at->format('M Y') }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="/editProfile" class="card bg-base-100 shadow-md hover:shadow-lg transition-all border border-base-200 group">
                <div class="card-body flex-row items-center gap-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold">Dati Personali</h3>
                        <p class="text-sm text-base-content/60">Nome, email e contatti</p>
                    </div>
                </div>
            </a>

            <a href="/editCredentials" class="card bg-base-100 shadow-md hover:shadow-lg transition-all border border-base-200 group">
                <div class="card-body flex-row items-center gap-4">
                    <div class="p-3 bg-orange-100 text-orange-600 rounded-lg group-hover:bg-orange-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold">Sicurezza</h3>
                        <p class="text-sm text-base-content/60">Cambia password e credenziali</p>
                    </div>
                </div>
            </a>

            <a href="/myBookings" class="card bg-base-100 shadow-md hover:shadow-lg transition-all border border-base-200 group">
                <div class="card-body flex-row items-center gap-4">
                    <div class="p-3 bg-green-100 text-green-600 rounded-lg group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold">Prenotazioni</h3>
                        <p class="text-sm text-base-content/60">Gestisci i tuoi soggiorni</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reviews.index') }}" class="card bg-base-100 shadow-md hover:shadow-lg transition-all border border-base-200 group">
                <div class="card-body flex-row items-center gap-4">
                    <div class="p-3 bg-purple-100 text-purple-600 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold">Recensioni</h3>
                        <p class="text-sm text-base-content/60">I tuoi feedback sulle strutture</p>
                    </div>
                </div>
            </a>

        </div>
    </div>
    
</x-layout>