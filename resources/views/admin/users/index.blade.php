<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-bold">Registro Anagrafico Ospiti</h1>
                <p class="text-gray-500">Tutti i soggetti censiti nel sistema (con o senza account di login)</p>

                <a href="/admin/users/create" class="btn btn-primary shadow-lg gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nuovo Ospite
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <span>{{ session('success') }}</span>
            </div>
            @endif
            <div class="card bg-white shadow-xl overflow-hidden">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-base-100">
                            <th>Ospite (Anagrafica)</th>
                            <th>Info Nascita</th>
                            <th>Stato Account</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guests as $guest)
                        <tr>
                            <td>
                                <div class="flex items-center space-x-3">
                                    <div class="avatar placeholder">
                                        <div class="bg-neutral text-neutral-content rounded-full w-8">
                                            <span class="text-xs">{{ substr($guest->firstName, 0, 1) }}{{ substr($guest->lastName, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold text-lg text-gray-800">
                                            {{ $guest->firstName }} {{ $guest->lastName }}
                                        </div>
                                        <div class="text-[10px] opacity-40 font-mono">REF: #{{ $guest->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="text-sm">
                                    <span class="block">📍 {{ $guest->birthPlace }}</span>
                                    <span class="text-xs opacity-60">{{ \Carbon\Carbon::parse($guest->birthDate)->format('d/m/Y') }}</span>
                                </div>
                            </td>

                            <td>
                                @if($guest->user)
                                <div class="flex flex-col">
                                    {{-- Controllo se l'utente è bannato --}}
                                    @if($guest->user->isBanned)
                                    <div class="badge badge-error badge-sm text-white">Account Sospeso</div>
                                    @else
                                    <div class="badge badge-success badge-sm text-white">Account Attivo</div>
                                    @endif

                                    <span class="text-[10px] mt-1">{{ $guest->user->email }}</span>
                                </div>
                                @else
                                <div class="badge badge-ghost badge-sm italic text-gray-400">Nessun Account</div>
                                @endif
                            </td>

                            <th>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $guest->id) }}" class="btn btn-ghost btn-xs">Modifica Anagrafica</a>
                                </div>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $guests->links() }}
            </div>
        </div>
    </div>
</x-layoutAdmin>