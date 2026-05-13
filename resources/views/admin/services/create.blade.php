<x-layoutAdmin>
    <div class="p-6 bg-base-200 min-h-screen">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.services.index') }}" class="btn btn-circle btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 m0 0l7-7 m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold">Nuovo Servizio</h1>
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

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div class="md:col-span-2 space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-bold">Nome del Servizio</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Es: SPA Benessere o Wi-Fi Fibra" class="input input-bordered" required>
                                </div>

                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text font-bold">Prezzo (€)</span></label>
                                    <input type="number" name="price" value="{{ old('price') }}" placeholder="0 per servizi gratuiti" class="input input-bordered" required>
                                </div>

                                <div class="form-control mt-4">
                                    <label class="label"><span class="label-text font-bold">Descrizione</span></label>
                                    <textarea name="description" class="textarea textarea-bordered h-32" placeholder="Descrivi cosa include il servizio...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="card bg-white shadow-xl">
                            <div class="card-body">
                                <label class="label"><span class="label-text font-bold">Immagine Copertina</span></label>

                                <div class="flex flex-col items-center gap-4">
                                    <div class="w-full aspect-video bg-base-200 rounded-xl overflow-hidden border-2 border-dashed border-base-300 flex items-center justify-center" id="preview-container">
                                        <span class="text-gray-400 text-sm p-4 text-center" id="preview-text">Nessuna immagine selezionata</span>
                                        <img id="image-preview" class="hidden w-full h-full object-cover">
                                    </div>

                                    <label class="btn btn-primary btn-sm w-full">
                                        Scegli File
                                        <input type="file" name="pathImage" class="hidden" accept="image/*" onchange="showPreview(event)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-block shadow-lg text-white">
                            Salva Servizio
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showPreview(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');
            const text = document.getElementById('preview-text');
            const container = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    text.classList.add('hidden');
                    container.classList.remove('border-dashed');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layoutAdmin>