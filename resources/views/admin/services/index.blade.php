<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold">Servizi Extra</h1>
                    <p class="text-gray-500">Configura i servizi disponibili per gli ospiti dell'hotel</p>
                </div>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nuovo Servizio
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success shadow-lg mb-6">
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-shadow border border-base-300">
                    <figure class="px-4 pt-4">
                        <img src="{{ asset('storage/' . $service->pathImage) }}"
                            alt="{{ $service->name }}"
                            class="rounded-xl h-48 w-full object-cover shadow-inner bg-base-100" />
                    </figure>

                    <div class="card-body p-6">
                        <div class="flex justify-between items-start">
                            <h2 class="card-title text-xl font-bold">{{ $service->name }}</h2>
                            <div class="badge badge-outline badge-success font-bold px-3 py-3">
                                € {{ number_format($service->price, 2, ',', '.') }}
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                            {{ $service->description }}
                        </p>

                        <div class="card-actions justify-end mt-6 pt-4 border-t border-base-100 gap-2">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-ghost btn-sm border border-base-300">
                                Modifica
                            </a>

                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo servizio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-outline btn-sm">
                                    Elimina
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                @if($services->isEmpty())
                <div class="col-span-full bg-white p-12 rounded-xl text-center border-2 border-dashed border-base-300">
                    <p class="text-gray-400">Nessun servizio creato. Inizia aggiungendone uno!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-layoutAdmin>