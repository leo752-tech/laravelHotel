<x-layoutAdmin>
    @if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-ghost btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold">Aggiungi Nuova Camera</h1>
            </div>

            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title border-b pb-2 text-primary">Dettagli Camera</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold">Nome Camera</span></label>
                                        <input type="text" name="name" placeholder="Es: Suite Vista Mare" class="input input-bordered w-full" required>
                                    </div>

                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold">Tipologia</span></label>
                                        <select name="type" class="select select-bordered w-full">
                                            <option disabled selected>Seleziona tipo...</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Luxury">Luxury</option>
                                            <option value="Suite">Suite</option>
                                            <option value="Deluxe">Deluxe</option>
                                        </select>
                                    </div>

                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold">Posti Letto</span></label>
                                        <input type="number" name="beds" min="1" class="input input-bordered w-full" required>
                                    </div>

                                    <div class="form-control w-full">
                                        <label class="label"><span class="label-text font-semibold">Prezzo per Notte (€)</span></label>
                                        <input type="number" name="price" step="0.01" min="0" class="input input-bordered w-full" required>
                                    </div>
                                </div>

                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text font-semibold">Descrizione</span></label>
                                    <textarea name="description" class="textarea textarea-bordered h-32" placeholder="Descrivi i comfort della camera..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <h2 class="card-title border-b pb-2 text-primary">Media</h2>

                                <div class="form-control w-full mt-4">
                                    <label class="label">
                                        <span class="label-text font-semibold">Carica Immagini (Max 4-5)</span>
                                    </label>

                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2l2 2" />
                                                </svg>
                                                <p class="text-xs text-gray-500 uppercase font-bold">Clicca per caricare</p>
                                            </div>
                                            <input type="file" name="images[]" id="image-input" multiple class="hidden" accept="image/*" onchange="previewImages(event)" />
                                        </label>
                                    </div>
                                </div>

                                <div id="preview-grid" class="grid grid-cols-2 gap-2 mt-4">
                                </div>

                                <div class="card-actions mt-8">
                                    <button type="submit" class="btn btn-primary w-full shadow-lg">Crea Camera</button>
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
            const grid = document.getElementById('preview-grid');
            grid.innerHTML = ''; // Pulisce le anteprime se l'utente cambia selezione

            const files = event.target.files;

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "relative group h-24 w-full border rounded-lg overflow-hidden";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white text-[10px] font-bold">PRONTA</span>
                        </div>
                    `;
                    grid.appendChild(div);
                }

                reader.readAsDataURL(file);
            });
        }
    </script>
</x-layoutAdmin>