    <x-layout>
        <div class="max-w-2xl mx-auto p-6">

            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    <h2 class="card-title">Cambia Indirizzo Email</h2>
                    <form action="/updateEmail" method="POST">
                        @csrf


                        <div class="space-y-4">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-semibold">Nuova Email</span></label>
                                <input type="email" name="email" class="input input-bordered focus:input-primary"
                                    value="{{ old('email', Auth::user()->email) }}" required />
                                @error('email') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Conferma con la tua Password</span>
                                </label>
                                <input type="password" name="current_password"
                                    class="input input-bordered focus:input-primary"
                                    placeholder="Inserisci la password attuale" required />
                                @error('current_password') <span class="text-error text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="card-actions justify-end mt-6">
                            <a href="/profile" class="btn btn-ghost">Annulla</a>
                            <button type="submit" class="btn btn-primary">Salva Nuova Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-layout>