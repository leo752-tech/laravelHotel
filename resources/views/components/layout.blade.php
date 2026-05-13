@props([
'title' => 'SuiteDirect'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-nav />

    <div class="max-w-4xl mx-auto"> {{-- Container opzionale per centraggio --}}
        @if(session('success'))
        <div class="alert alert-success shadow-lg mb-6 mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error shadow-lg mb-6 bg-red-100 text-red-800 border-red-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        {{-- Errori di validazione (quelli automatici di Laravel) --}}
        @if ($errors->any())
        <div class="alert alert-error shadow-lg mb-6 bg-red-100 text-red-800 border-red-200">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <main>
        {{ $slot }}
    </main>

    <x-footer />

    <script>
        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');

        checkInInput.addEventListener('change', function() {
            // Imposta il minimo del checkout a un giorno dopo il checkin
            let date = new Date(this.value);
            date.setDate(date.getDate() + 1);
            checkOutInput.min = date.toISOString().split(" T")[0];

            if (checkOutInput.value <= this.value) {
                checkOutInput.value = checkOutInput.min;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/it.js"></script>
</body>

</html>