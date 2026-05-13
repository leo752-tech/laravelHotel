<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.services.index') }}" class="btn btn-circle btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 m0 0l7-7 m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold">Modifica Servizio: <span class="text-primary">{{ $service->name }}</span></h1>
            </div>

            @if ($errors->any())
            <div class="alert alert-error mb-6 shadow-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Fondamentale per la modifica --}}

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div class="md:col-span-2 space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-bold">Nome del Servizio</span></label>
                                    <input type="text" name="name" value="{{ old('name', $service->name) }}" class="input input-bordered" required>
                                </div>

                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text font-bold">Prezzo (€)</span></label>
                                    <input type="number" name="price" value="{{ old('price', $service->price) }}" class="input input-bordered" required>
                                </div>

                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text font-bold">Descrizione</span></label>
                                    <textarea name="description" class="textarea textarea-bordered h-32">{{ old('description', $service->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <label class="label"><span class="label-text font-bold">Immagine Attuale</span></label>

                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-full aspect-video bg-base-200 rounded-xl overflow-hidden border border-base-300 flex items-center justify-center">
                                        <img id="image-preview"
                                            src="{{ asset('storage/' . $service->pathImage) }}"
                                            class="w-full h-full object-cover">
                                    </div>

                                    <div class="text-xs text-gray-500 text-center italic">
                                        Carica un nuovo file solo se vuoi sostituire l'immagine attuale.
                                    </div>

                                    <label class="btn btn-outline btn-sm w-full">
                                        Sostituisci Immagine
                                        <input type="file" name="pathImage" class="hidden" accept="image/*" onchange="showPreview(event)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <button type="submit" class="btn btn-primary btn-block shadow-lg">
                                Aggiorna Servizio
                            </button>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-ghost btn-block">Annulla</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPreview(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layoutAdmin>