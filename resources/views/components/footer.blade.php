<footer class="bg-black text-gray-400 py-2">
    <div class="max-w-7xl mx-auto px-6 flex flex-col items-center text-center gap-6">

        {{-- Brand --}}
        <h3 class="text-white text-xl font-bold tracking-widest uppercase">Luxury Hotel</h3>

        {{-- Link Rapidi Orizzontali --}}
        <nav class="flex flex-wrap justify-center gap-6 text-xs uppercase tracking-wider mt-2">
            <a href="/" class="hover:text-white transition-colors">Home</a>
            <a href="{{ route('calendar') }}" class="hover:text-white transition-colors">Prenota</a>
            <a href="/camere" class="hover:text-white transition-colors">Camere</a>
            <a href="/servizi" class="hover:text-white transition-colors">Servizi & SPA</a>
            <a href="/specialOffer" class="hover:text-white transition-colors">Offerte</a>
        </nav>

        {{-- Contatti Compatti --}}
        <div class="flex flex-wrap justify-center items-center gap-3 text-sm">
            <span>Via Roma 123, Roma</span>
            <span class="hidden sm:inline text-gray-600">•</span>
            <span>+39 06 1234567</span>
            <span class="hidden sm:inline text-gray-600">•</span>
            <a href="mailto:info@luxuryhotel.com" class="hover:text-white transition-colors">info@luxuryhotel.com</a>
        </div>

        {{-- Icone Social --}}
        <div class="flex gap-6 mt-2">
            <a href="#" class="hover:text-white transition-colors"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
            <a href="#" class="hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
        </div>

        {{-- Legali e Copyright --}}
        <div class="w-full border-t border-gray-800 pt-6 mt-4 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-gray-500">
            <p>&copy; 2026 Luxury Hotel S.p.A. Tutti i diritti riservati. P.IVA 01234567890</p>
            <div class="flex gap-6 uppercase tracking-wider">
                <a href="#" class="hover:text-gray-300 transition-colors">Privacy</a>
                <a href="#" class="hover:text-gray-300 transition-colors">Termini</a>
                <a href="#" class="hover:text-gray-300 transition-colors">Cookie</a>
            </div>
        </div>

    </div>
</footer>