<x-layout>
    <div class="min-h-[70vh] flex items-center justify-center bg-base-100 px-4">
        <div class="max-w-md w-full text-center">
            <div class="mb-8 flex justify-center">
                <div class="p-6 bg-red-50 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11 3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <h1 class="text-6xl font-black text-gray-900 mb-4">403</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Accesso Riservato</h2>
            <p class="text-gray-500 mb-10 leading-relaxed">
                Spiacenti, non hai i permessi necessari per visualizzare questa pagina o eseguire l'azione richiesta. Assicurati di essere loggato con l'account corretto.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/" class="btn btn-primary px-8">
                    Vai alla Home
                </a>
            </div>
        </div>
    </div>
</x-layout>