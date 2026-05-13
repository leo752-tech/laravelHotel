<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold mb-6">Impostazioni Profilo Admin</h1>

            {{-- Messaggi di successo o errore --}}
            @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            <div class="card bg-white shadow-xl">
                <div class="card-body">
                    <h2 class="card-title border-b pb-4 text-primary">Aggiorna Credenziali</h2>

                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4 mt-4">
                        @csrf
                        

                        {{-- Email --}}
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Indirizzo Email</span>
                            </label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="input input-bordered w-full @error('email') input-error @enderror" required />
                            @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="divider text-gray-400 text-sm">Cambio Password (opzionale)</div>

                        {{-- Nuova Password --}}
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Nuova Password</span>
                            </label>
                            <input type="password" name="password" placeholder="Minimo 8 caratteri"
                                class="input input-bordered w-full @error('password') input-error @enderror" />
                            @error('password') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Conferma Password --}}
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Conferma Nuova Password</span>
                            </label>
                            <input type="password" name="password_confirmation" placeholder="Ripeti la password"
                                class="input input-bordered w-full" />
                        </div>

                        <div class="divider"></div>

                        {{-- Password Attuale per Sicurezza --}}
                        <div class="form-control w-full p-4 bg-base-100 rounded-lg border border-warning/30">
                            <label class="label">
                                <span class="label-text font-bold text-warning-content">Password Attuale</span>
                            </label>
                            <input type="password" name="current_password" placeholder="Inserisci la password attuale per confermare"
                                class="input input-bordered w-full @error('current_password') input-error @enderror" required />
                            <p class="text-[10px] mt-2 opacity-70 italic text-center">Necessaria per autorizzare le modifiche</p>
                            @error('current_password') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="card-actions justify-end mt-6">
                            <button type="submit" class="btn btn-primary shadow-md">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layoutAdmin>