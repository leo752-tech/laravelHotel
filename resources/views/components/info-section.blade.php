@props(['image', 'title', 'text', 'reverse' => false, 'buttonLink' => null])

<section class="relative w-full overflow-hidden {{ $reverse ? 'bg-white' : 'bg-gray-50' }}">
    <div class="flex flex-col {{ $reverse ? 'md:flex-row-reverse' : 'md:flex-row' }} items-stretch min-h-[500px]">

        {{-- BLOCCO IMMAGINE: Aggiunte classi scroll-element e reveal --}}
        <div class="w-full md:w-1/2 relative scroll-element {{ $reverse ? 'reveal-right md:-mr-12' : 'reveal-left md:-ml-12' }}">
            <img src="{{ asset($image) }}" alt="{{ $title }}"
                class="w-full h-full object-cover"
                loading="lazy"
                style="clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);">
        </div>

        {{-- BLOCCO TESTO: Aggiunte classi scroll-element e reveal invertite --}}
        <div class="w-full md:w-1/2 flex items-center p-8 md:p-16 scroll-element {{ $reverse ? 'reveal-left' : 'reveal-right' }}">
            <div class="max-w-lg">
                <h2 class="text-4xl font-extrabold text-gray-900">{{ $title }}</h2>
                <div class="w-20 h-1 bg-amber-600 mt-4 mb-6"></div>
                <p class="text-lg text-gray-600">{{ $text }}</p>
                @if($buttonLink)
                <a href="{{$buttonLink}}" class="mt-8 inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded transition duration-300">
                    {{__('Scopri di più')}}</a>
                @endif
            </div>
        </div>

    </div>
</section>