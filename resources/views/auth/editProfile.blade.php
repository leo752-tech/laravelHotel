<x-layout>
    <div class="max-w-2xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">Modifica Profilo</h1>
            <p class="text-base-content/60">Aggiorna i tuoi dati personali</p>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body">
                <form action="/updateProfile" method="POST">
                    @csrf


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Nome</span>
                            </label>
                            <input type="text" name="firstName" value="{{ old('firstName', Auth::user()->firstName) }}"
                                class="input input-bordered w-full focus:input-primary" required />
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Cognome</span>
                            </label>
                            <input type="text" name="lastName" value="{{ old('lastName', Auth::user()->lastName) }}"
                                class="input input-bordered w-full focus:input-primary" required />
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Data di Nascita</span>
                            </label>
                            <input type="date" name="birthDate" value="{{ old('birthDate', Auth::user()->birthDate?->format('Y-m-d')) }}"
                                class="input input-bordered w-full focus:input-primary" required />
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-semibold">Luogo di Nascita</span>
                            </label>
                            <input type="text" name="birthPlace" value="{{ old('birthPlace', Auth::user()->birthPlace) }}"
                                class="input input-bordered w-full focus:input-primary" required />
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-8 border-t pt-6">
                        <a href="/profile" class="btn btn-ghost">Annulla</a>
                        <button type="submit" class="btn btn-primary px-8">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>