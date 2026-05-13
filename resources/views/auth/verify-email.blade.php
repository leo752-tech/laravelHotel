<x-layout>
    <div class="py-16 bg-base-200 min-h-[80px] flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white shadow-2xl rounded-3xl overflow-hidden border border-base-300">

            <div class="bg-primary p-8 text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full fill-current">
                        <path d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-46.5C87.4,-33.9,90,-16.9,88.5,-0.9C87,15.1,81.4,30.2,72.6,43.2C63.8,56.2,51.8,67.1,37.8,74.5C23.8,81.9,7.8,85.8,-8.5,84.3C-24.8,82.8,-41.4,75.9,-54.8,65.3C-68.2,54.7,-78.4,40.4,-83.4,24.7C-88.4,9,-88.2,-8.1,-83.1,-23.7C-78,-39.3,-68,-53.4,-54.6,-61.1C-41.2,-68.8,-24.4,-70.1,-8.5,-75.2C7.3,-80.3,22.7,-89.2,44.7,-76.4Z" transform="translate(100 100)" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-4 animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Verifica la tua Email</h1>
                </div>
            </div>

            <div class="p-8 space-y-6">
                @if (session('message'))
                <div class="alert alert-success shadow-sm rounded-xl py-3 text-sm font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
                @endif

                <div class="text-center space-y-4">
                    <p class="text-gray-600 leading-relaxed">
                        Grazie per esserti registrato! Prima di iniziare, potresti verificare il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato?
                    </p>
                    <p class="text-xs text-gray-400 italic">
                        Se non hai ricevuto l'email, saremo lieti di inviartene un'altra.
                    </p>
                </div>

                <div class="divider"></div>

                <div class="flex flex-col gap-3">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block rounded-xl shadow-lg shadow-primary/20">
                            Reinvia Email di Verifica
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-block text-gray-400 hover:text-error hover:bg-error/5 rounded-xl">
                            Esci dall'account
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-base-200/50 p-4 text-center">
                <p class="text-[10px] uppercase tracking-widest font-bold opacity-30">Security Verification System</p>
            </div>
        </div>
    </div>
</x-layout>