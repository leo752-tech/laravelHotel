<x-layout>
    <div class="flex items-center justify-center min-h-screen">
        <form method="POST" action="/register" class="w-full max-w-sm">
            @csrf

            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box border p-4 shadow-sm">
                <legend class="fieldset-legend">Crea il tuo Account</legend>

                <label class="label">Nome</label>
                <input type="text" name="firstName" class="input w-full" value="{{ old('firstName') }}" required />

                <label class="label">Cognome</label>
                <input type="text" name="lastName" class="input w-full" value="{{ old('lastName') }}" required />

                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label class="label">Data di Nascita</label>
                        <input type="date" name="birthDate" class="input w-full" value="{{ old('birthDate') }}" required />
                    </div>
                    <div class="w-1/2">
                        <label class="label">Luogo di Nascita</label>
                        <input type="text" name="birthPlace" class="input w-full" value="{{ old('birthPlace') }}" required />
                    </div>
                </div>

                <hr class="my-4 border-base-300" />

                <label class="label">Email</label>
                <input type="email" name="email" class="input w-full" value="{{ old('email') }}" required />

                <label class="label">Password</label>
                <input type="password" name="password" class="input w-full" required />

                <label class="label">Conferma Password</label>
                <input type="password" name="password_confirmation" class="input w-full" required />

                <button class="btn btn-neutral mt-6 w-full">Registrati</button>
            </fieldset>
        </form>
    </div>
</x-layout>