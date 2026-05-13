<x-layout>
    <div class="max-w-6xl mx-auto p-6">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold">Le mie Recensioni</h1>
                <p class="text-base-content/60">Ecco cosa hai pensato dei tuoi soggiorni passati.</p>
            </div>
        </div>

        @if($reviews->isEmpty())
        <div class="card bg-base-100 shadow-xl border border-base-200 p-12 text-center">
            <div class="flex justify-center mb-4">
                <div class="p-4 bg-base-200 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
            </div>
            <h2 class="text-xl font-bold">Nessuna recensione ancora</h2>
            <p class="mt-2 text-base-content/60">Dopo il tuo soggiorno, potrai lasciare un feedback qui.</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($reviews as $review)
            <div class="card bg-base-100 shadow-md border border-base-200 hover:shadow-lg transition-all">
                <div class="card-body">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="card-title text-primary">{{ $review->title }}</h2>
                        <div class="rating rating-sm">
                            @for ($i = 1; $i
                            <= 5; $i++)
                                <input type="radio" class="mask mask-star-2 {{ $i <= $review->rating ? 'bg-orange-400' : 'bg-base-300' }}" disabled />
                            @endfor
                        </div>
                    </div>

                    <div class="flex items-center gap-2 mb-4">
                        <div class="badge badge-outline text-xs">Prenotazione #{{ $review->bookingId }}</div>
                        <span class="text-xs text-base-content/50">{{ $review->created_at->format('d M Y') }}</span>
                    </div>

                    <p class="text-base-content/80 italic">"{{ $review->description }}"</p>

                    <div class="card-actions justify-end mt-4 pt-4 border-t border-base-200">
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Vuoi eliminare definitivamente questa recensione?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ghost btn-xs text-error">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        <div class="mt-8 text-center">
            <a href="/profile" class="btn btn-ghost btn-sm"> Torna al Profilo</a>
        </div>
    </div>
</x-layout>