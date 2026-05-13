<footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

            <div>
                <h3 class="text-white text-xl font-bold mb-6 tracking-widest uppercase">Luxury Hotel</h3>
                <p class="text-sm leading-relaxed mb-6">
                    Offriamo un'esperienza di ospitalità senza pari dal 1995. Raffinatezza, comfort e un servizio personalizzato nel cuore pulsante della città.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-primary transition-colors"><i class="fab fa-facebook-f text-lg"></i></a>
                    <a href="#" class="hover:text-primary transition-colors"><i class="fab fa-instagram text-lg"></i></a>
                    <a href="#" class="hover:text-primary transition-colors"><i class="fab fa-twitter text-lg"></i></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-sm tracking-wider">Link Rapidi</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('calendar') }}" class="hover:text-white transition-colors">Prenota Camera</a></li>
                    <li><a href="/camere" class="hover:text-white transition-colors">Le Nostre camere</a></li>
                    <li><a href="/servizi" class="hover:text-white transition-colors">Servizi & SPA</a></li>
                    <li><a href="/specialOffer" class="hover:text-white transition-colors">Offerte Speciali</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 uppercase text-sm tracking-wider">Contatti</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span>Via Roma 123, 00100 Roma (RM)</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+39 06 1234567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>info@luxuryhotel.com</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
            <p>&copy; 2026 Luxury Hotel S.p.A. Tutti i diritti riservati. P.IVA 01234567890</p>
            <div class="flex gap-6">
                <a class="hover:text-white transition-colors">Privacy Policy</a>
                <a class="hover:text-white transition-colors">Termini e Condizioni</a>
                <a class="hover:text-white transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>