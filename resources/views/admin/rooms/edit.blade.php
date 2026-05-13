<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-2xl font-bold mb-6">Modifica Camera: {{ $room->name }}</h1>

            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title border-b pb-2">Informazioni Generali</h2>
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="form-control">
                                        <label class="label"><span class="label-text">Nome Camera</span></label>
                                        <input type="text" name="name" value="{{ $room->name }}" class="input input-bordered" required>
                                    </div>
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold">Tipologia</span></label>
                                        <select name="type" class="select select-bordered w-full">
                                            <option value="Standard" {{ $room->type == 'Standard' ? 'selected' : '' }}>Standard</option>
                                            <option value="Luxury" {{ $room->type == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                                            <option value="Suite" {{ $room->type == 'Suite' ? 'selected' : '' }}>Suite</option>
                                            <option value="Deluxe" {{ $room->type == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                                        </select>
                                    </div>
                                    <div class="form-control">
                                        <label class="label"><span class="label-text">Posti Letto</span></label>
                                        <input type="number" name="beds" value="{{ $room->beds }}" class="input input-bordered">
                                    </div>
                                    <div class="form-control">
                                        <label class="label"><span class="label-text">Prezzo per notte (€)</span></label>
                                        <input type="number" name="price" value="{{ $room->price }}" class="input input-bordered">
                                    </div>
                                </div>
                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text">Descrizione</span></label>
                                    <textarea name="description" class="textarea textarea-bordered h-24">{{ $room->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title border-b pb-2">Gallery Attuale</h2>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                                    @foreach($room->images as $image)
                                    {{-- AGGIUNTO: id="image-container-{{ $image->id }}" --}}
                                    <div id="image-container-{{ $image->id }}" class="relative group h-32">
                                        <img src="{{ asset('storage/' . $image->pathImage) }}" class="w-full h-full object-cover rounded-lg shadow-sm">

                                        <button type="button"
                                            onclick="deleteImage('{{ $image->id }}')"
                                            class="absolute top-1 right-1 btn btn-circle btn-error btn-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                            ✕
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title border-b pb-2">Aggiungi Foto</h2>
                                <div class="form-control w-full mt-4">
                                    <label class="btn btn-outline btn-primary btn-sm w-full">
                                        Seleziona File
                                        <input type="file" name="new_images[]" multiple class="hidden" onchange="previewImages(event)">
                                    </label>
                                </div>

                                {{-- Anteprima Interattiva --}}
                                <div id="image-preview-container" class="grid grid-cols-2 gap-2 mt-4">
                                </div>

                                <div class="card-actions mt-6">
                                    <button type="submit" class="btn btn-success w-full text-white">Salva Modifiche</button>
                                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-ghost btn-sm w-full">Annulla</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImages(event) {
            const container = document.getElementById('image-preview-container');
            container.innerHTML = ''; // Pulisce anteprime precedenti

            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative h-20 w-full';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded border-2 border-primary">`;
                    container.appendChild(div);
                }
                reader.readAsDataURL(files[i]);
            }
        }

        function deleteImage(imageId) {

            if (!confirm('Vuoi eliminare definitivamente questa immagine?')) return;

            // Recuperiamo il token CSRF che Laravel richiede per sicurezza
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                '{{ csrf_token() }}';

            // Invio della richiesta al server
            fetch(`/admin/room-images/${imageId}`, {
                    method: 'POST', // Usiamo POST + _method DELETE per compatibilità
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE' // Diciamo a Laravel che è una cancellazione
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Se il server dice OK, rimuoviamo l'elemento HTML con un effetto dissolvenza
                        const element = document.getElementById(`image-container-${imageId}`);
                        element.style.transition = 'all 0.3s';
                        element.style.opacity = '0';
                        element.style.transform = 'scale(0.8)';
                        setTimeout(() => element.remove(), 300);
                    } else {
                        alert('Errore durante la cancellazione');
                    }
                })
                .catch(error => {
                    console.error('Errore:', error);
                    alert('Si è verificato un errore di rete');
                });
        }
    </script>
</x-layoutAdmin>