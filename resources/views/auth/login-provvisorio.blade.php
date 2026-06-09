<x-layout>
    {{-- FORZATURA CSS: Rende la navbar solida e visibile SOLO in questa pagina --}}
    <style>
        .fixed.top-0.w-full {
            background-color: rgba(15, 23, 42, 0.95) !important;
            padding-top: 0.5rem !important;
            /* Corrisponde a py-2 */
            padding-bottom: 0.5rem !important;
            /* Corrisponde a py-2 */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            /* shadow-lg */
            backdrop-filter: blur(12px) !important;
            /* backdrop-blur-md */
        }
    </style>
    <div class="flex min-h-screen items-center justify-center p-4 mt-20">
        <div class="card bg-base-200 border border-base-300 w-full max-w-xl shadow-xl rounded-box p-6 md:p-10 text-center">

            <!-- Icona o Badge Incuriosente -->
            <div class="mx-auto mb-4 bg-amber-500/10 text-amber-500 rounded-full p-4 w-fit animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <!-- Titolo Principale -->
            <h1 class="text-3xl font-bold tracking-tight mb-2">Area Admin in Anteprima</h1>
            <p class="text-base-content/70 max-w-md mx-auto mb-6">
                Stiamo rifinendo gli ultimi dettagli della dashboard amministrativa per garantirti un'esperienza di gestione senza compromessi.
            </p>

            <hr class="border-base-300 my-4" />

            <!-- Teaser delle funzionalità (Crea curiosità) -->
            <div class="text-left mb-8">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-base-content/50 mb-3">Cosa troverai qui dentro:</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <span class="text-success">✓</span> **Analytics Avanzati:** Monitoraggio KPI e grafici interattivi in tempo reale.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-success">✓</span> **Gestione Utenti:** Controllo totale su permessi, ruoli e log delle attività.
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-success">✓</span> **Automazioni:** Pannello di controllo per task pianificati e notifiche push.
                    </li>
                </ul>
            </div>

            <!-- Call to Action -->
            <div class="bg-base-300 rounded-box p-4 border border-base-400/20">
                <h4 class="font-medium text-lg mb-1">Vuoi testare l'area Admin in anteprima privata?</h4>
                <p class="text-xs text-base-content/70 mb-4">Siamo felici di mostrartela in una call dedicata o attivarti un accesso beta.</p>

                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                    <!-- Sostituisci il link con la tua mail o un form di contatto/Calendly -->
                    <a href="mailto:tua@email.com?subject=Richiesta Accesso Beta Demo Admin" class="btn btn-neutral grow sm:grow-0">
                        Richiedi Accesso Beta
                    </a>

                </div>
            </div>

        </div>
    </div>
</x-layout>