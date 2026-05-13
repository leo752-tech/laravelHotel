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
                    <h1 class="text-3xl font-bold">Modifica Ospite</h1>
                    <p class="text-gray-500 italic">ID Record: #{{ $guest->id }}</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $guest->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card bg-white shadow-xl mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-4">Dati Anagrafici</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Nome</span></label>
                                <input type="text" name="firstName" value="{{ old('firstName', $guest->firstName) }}" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Cognome</span></label>
                                <input type="text" name="lastName" value="{{ old('lastName', $guest->lastName) }}" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Luogo di Nascita</span></label>
                                <input type="text" name="birthPlace" value="{{ old('birthPlace', $guest->birthPlace) }}" class="input input-bordered" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Data di Nascita</span></label>
                                <input type="date" name="birthDate" value="{{ old('birthDate', $guest->birthDate) }}" class="input input-bordered" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-white shadow-xl border-t-4 {{ $guest->user ? 'border-success' : 'border-warning' }}">
                    <div class="card-body">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="card-title text-gray-700">Configurazione Accesso</h2>
                            @if($guest->user)
                            <div class="badge badge-success text-white">Account Collegato</div>
                            @else
                            <div class="badge badge-warning text-white font-bold">Nessun Account</div>
                            @endif
                        </div>

                        @if($guest->user)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text">Email di Login</span></label>
                                <input type="email" name="email" value="{{ $guest->user->email }}" class="input input-bordered bg-base-100" />
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text">Cambia Password</span></label>
                                <input type="password" name="password" placeholder="Lascia vuoto per non cambiare" class="input input-bordered" />
                            </div>
                            <div class="col-span-full mt-2">
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <input type="checkbox" name="isBanned" class="checkbox checkbox-error checkbox-sm" {{ $guest->user->isBanned ? 'checked' : '' }} />
                                    <span>Sospendi accesso (Bannato)</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-base-200 p-4 rounded-lg">
                            <p class="text-sm mb-4 text-gray-600">Questo ospite non può ancora accedere al portale. Vuoi attivare un account adesso?</p>
                            <div class="flex items-center gap-4">
                                <label class="cursor-pointer label gap-2">
                                    <input type="checkbox" name="activate_account" class="toggle toggle-primary" id="toggleEditAccount" onchange="toggleAccountFields()" />
                                    <span class="label-text font-bold">Attiva ora</span>
                                </label>
                            </div>

                            <div id="newAccountFields" class="hidden mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 animate-in slide-in-from-top-2">
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Email</span></label>
                                    <input type="email" name="email" class="input input-bordered bg-white" />
                                </div>
                                <div class="form-control">
                                    <label class="label"><span class="label-text">Password</span></label>
                                    <input type="password" name="password" class="input input-bordered bg-white" />
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between items-center mt-8">
                    @if($guest->user)
                    <button type="button" class="btn btn-outline btn-error btn-sm">Scollega Account</button>
                    @else
                    <div></div>
                    @endif

                    <div class="flex gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Annulla</a>
                        <button type="submit" class="btn btn-primary px-10">Aggiorna Ospite</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleAccountFields() {
            const checkbox = document.getElementById('toggleEditAccount');
            const fields = document.getElementById('newAccountFields');
            checkbox.checked ? fields.classList.remove('hidden') : fields.classList.add('hidden');
        }
    </script>
</x-layoutAdmin>