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

    <!-- Font e Icone per il Booking Engine -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=EB+Garamond:wght@400;500;600&display=swap" rel="stylesheet" />

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen">
    <x-navBooking />

    <div class="max-w-4xl mx-auto px-4 sm:px-0 mt-4">

        {{-- 1. MESSAGGIO DI SUCCESSO (Elegante e discreto) --}}
        @if(session('success'))
        <div class="bg-white border-l-4 border-[#354F42] shadow-sm rounded-r-xl p-4 mb-6 flex items-start gap-3.5 backend-alert">
            <div class="text-[#354F42] mt-0.5 shrink-0">
                <i class="fa-solid fa-circle-check text-lg"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-800 leading-relaxed">
                    {{ session('success') }}
                </p>
            </div>
        </div>
        @endif

        {{-- 2. ERRORE DI SESSIONE / GENERICO --}}
        @if(session('error'))
        <div class="bg-[#FFF8F8] border-l-4 border-amber-600 shadow-sm rounded-r-xl p-4 mb-6 flex items-start gap-3.5 backend-alert">
            <div class="text-amber-600 mt-0.5 shrink-0">
                <i class="fa-solid fa-circle-exclamation text-lg"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-slate-800 leading-relaxed">
                    {{ session('error') }}
                </p>
            </div>
        </div>
        @endif

        {{-- 3. ERRORI DI VALIDAZIONE (Formato Lista Pulita) --}}
        @if ($errors->any())
        <div class="bg-[#FFF8F8] border-l-4 border-red-500 shadow-sm rounded-r-xl p-4 mb-6 flex items-start gap-3.5 backend-alert">
            <div class="text-red-500 mt-0.5 shrink-0">
                <i class="fa-solid fa-circle-xmark text-lg"></i>
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-slate-900 mb-1.5">Si è verificato un inconveniente</h4>
                <ul class="space-y-1.5 text-sm text-slate-600 list-none pl-0">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-400 shrink-0"></span>
                        <span>
                            {{-- Piccolo trick temporaneo per tradurre al volo l'errore dello screenshot --}}
                            {{ $error == 'The date range field is required.' ? 'È necessario selezionare le date del soggiorno nel calendario.' : $error }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

    </div>
    <main class="flex-grow">
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