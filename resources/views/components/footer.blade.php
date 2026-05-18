<footer class="bg-gray-900 text-gray-400 py-4 text-xs border-t border-gray-800">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">

        <!-- Sinistra: Brand & Info Legali -->
        <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 text-center md:text-left">
            <span class="text-white font-semibold">Hotel Nome</span>
            <span class="hidden md:inline text-gray-600">|</span>
            <span>&copy; {{ date('Y') }}</span>
            <span class="hidden md:inline text-gray-600">|</span>
            <span>P.IVA 01234567890</span>
            <span class="hidden md:inline text-gray-600">|</span>
            <a href="#" class="hover:text-white underline transition">Privacy & Cookies</a>
        </div>

        <!-- Centro: Contatti Rapidi -->
        <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1">
            <a href="https://maps.google.com" target="_blank" class="hover:text-white transition flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Via Roma 12, Roma
            </a>
            <a href="tel:+39061234567" class="hover:text-white transition flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                +39 06 1234567
            </a>
        </div>

        <!-- Destra: Social -->
        <div class="flex items-center gap-3">
            <a href="#" class="hover:text-white transition" aria-label="Instagram">
                <i class="fab fa-instagram text-base"></i>
            </a>
            <a href="#" class="hover:text-white transition" aria-label="Facebook">
                <i class="fab fa-facebook text-base"></i>
            </a>
            <a href="#" class="hover:text-white transition" aria-label="TripAdvisor">
                <i class="fab fa-tripadvisor text-base"></i>
            </a>
        </div>

    </div>
</footer>