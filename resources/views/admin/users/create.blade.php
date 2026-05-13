<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold">Nuovo Ospite</h1>
                    <p class="text-gray-500">Inserisci i dati anagrafici e configura l'accesso al sistema.</p>
                </div>
            </div>

            {{-- Gestione Errori di Validazione --}}
            @if ($errors->any())
            <div class="alert alert-error mb-6 shadow-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="card bg-white shadow-xl mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-4 italic">Dati Anagrafici (Ospite)</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text">Nome</span></label>
                                <input type="text" name="firstName" value="{{ old('firstName') }}" placeholder="es. Mario" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text">Cognome</span></label>
                                <input type="text" name="lastName" value="{{ old('lastName') }}" placeholder="es. Rossi" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text">Luogo di Nascita</span></label>
                                <input type="text" name="birthPlace" value="{{ old('birthPlace') }}" placeholder="es. Roma" class="input input-bordered w-full" required />
                            </div>
                            <div class="form-control w-full">
                                <label class="label"><span class="label-text">Data di Nascita</span></label>
                                <input type="date" name="birthDate" value="{{ old('birthDate') }}" class="input input-bordered w-full" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-white shadow-xl border-t-4 border-primary">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="card-title text-gray-700">Account di Accesso</h2>
                            <div class="form-control">
                                <label class="label cursor-pointer gap-2">
                                    <span class="label-text font-semibold">Attiva Account?</span>
                                    <input type="checkbox" name="has_account" {{ old('has_account') ? 'checked' : '' }} class="checkbox checkbox-primary" id="toggleAccount" onchange="toggleAccountFields()" />
                                </label>
                            </div>
                        </div>

                        <div id="accountFields" class="{{ old('has_account') ? '' : 'hidden' }} animate-in fade-in duration-300">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text">Email</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="mario.rossi@esempio.it" class="input input-bordered w-full" />
                                </div>
                                <div class="form-control w-full">
                                    <label class="label"><span class="label-text">Password Temporanea</span></label>
                                    <input type="password" name="password" placeholder="••••••••" class="input input-bordered w-full" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8 gap-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Annulla</a>
                    <button type="submit" class="btn btn-primary px-8 shadow-lg">Salva Record</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleAccountFields() {
            const checkbox = document.getElementById('toggleAccount');
            const fields = document.getElementById('accountFields');
            checkbox.checked ? fields.classList.remove('hidden') : fields.classList.add('hidden');
        }
    </script>
</x-layoutAdmin>