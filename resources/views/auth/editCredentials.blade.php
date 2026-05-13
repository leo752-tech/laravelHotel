<x-layout>
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Sicurezza Account</h1>
            <p class="text-base-content/60">Gestisci le tue credenziali di accesso e la protezione del tuo profilo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <a href="/editEmail" class="card bg-base-100 shadow-md hover:shadow-xl transition-all border border-base-200 group">
                <div class="card-body items-center text-center py-10">
                    <div class="p-4 bg-primary/10 text-primary rounded-full group-hover:bg-primary group-hover:text-white transition-colors mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="card-title text-xl">Cambia Email</h2>
                    <p class="text-sm text-base-content/60">Aggiorna l'indirizzo email associato al tuo account.</p>
                    <div class="card-actions mt-4">
                        <div class="badge badge-outline group-hover:badge-primary">Modifica indirizzo</div>
                    </div>
                </div>
            </a>

            <a href="/editPassword" class="card bg-base-100 shadow-md hover:shadow-xl transition-all border border-base-200 group">
                <div class="card-body items-center text-center py-10">
                    <div class="p-4 bg-error/10 text-error rounded-full group-hover:bg-error group-hover:text-white transition-colors mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="card-title text-xl">Cambia Password</h2>
                    <p class="text-sm text-base-content/60">Proteggi il tuo account impostando una nuova chiave di accesso.</p>
                    <div class="card-actions mt-4">
                        <div class="badge badge-outline group-hover:badge-error">Aggiorna sicurezza</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="mt-8 text-center">
            <a href="/profile" class="btn btn-ghost btn-sm"> Torna al Profilo</a>
        </div>
    </div>
</x-layout>