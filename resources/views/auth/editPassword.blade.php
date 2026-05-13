<x-layout>
    <div class="max-w-2xl mx-auto p-6">

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-primary">Cambia Password</h2>
                <p class="text-sm text-base-content/70">Assicurati che il tuo account utilizzi una password lunga e casuale per rimanere al sicuro.</p>

                <form action="{{ url('/updatePassword') }}" method="POST" class="mt-4">
                    @csrf

                    <div class="space-y-4">
                        {{-- Password Attuale --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Password Attuale</span>
                            </label>
                            <input type="password" name="current_password"
                                class="input input-bordered focus:input-primary @error('current_password') input-error @enderror"
                                placeholder="Inserisci la password attuale" required />
                            @error('current_password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="divider"></div>

                        {{-- Nuova Password --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Nuova Password</span>
                            </label>
                            <input type="password" name="password"
                                class="input input-bordered focus:input-primary @error('password') input-error @enderror"
                                placeholder="Minimo 8 caratteri" required />
                            @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Conferma Nuova Password --}}
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">Conferma Nuova Password</span>
                            </label>
                            <input type="password" name="password_confirmation"
                                class="input input-bordered focus:input-primary"
                                placeholder="Ripeti la nuova password" required />
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-8">
                        <a href="/profile" class="btn btn-ghost">Annulla</a>
                        <button type="submit" class="btn btn-primary">Aggiorna Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>