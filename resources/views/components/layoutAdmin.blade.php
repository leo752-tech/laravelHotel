@props([
'title' => 'Hotel'
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navAdmin />

    <main>
        {{ $slot }}
    </main>

    <script>
        const checkInInput = document.getElementById('checkInDate');
        const checkOutInput = document.getElementById('checkOutDate');

        checkInInput.addEventListener('change', function() {
            // Imposta il minimo del checkout a un giorno dopo il checkin
            let date = new Date(this.value);
            date.setDate(date.getDate() + 1);
            checkOutInput.min = date.toISOString().split("T")[0];

            if (checkOutInput.value <= this.value) {
                checkOutInput.value = checkOutInput.min;
            }
        });
    </script>
</body>

</html>