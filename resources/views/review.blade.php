<x-layout>
    <div class="py-16 bg-base-200 min-h-screen">
        <div class="max-w-5xl mx-auto px-4">

            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-gray-800 italic uppercase tracking-tighter">Esperienze degli Ospiti</h1>
                <p class="text-gray-500 mt-2">La trasparenza è il nostro valore principale. Ecco cosa dicono di noi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 bg-white p-10 rounded-3xl shadow-xl border border-white">
                <div class="flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-base-200 pb-8 md:pb-0">
                    <span class="text-sm font-bold uppercase text-gray-400 tracking-widest mb-2">Valutazione Media</span>
                    <h2 class="text-7xl font-black text-primary">{{ number_format($reviews->avg('rating'), 1) }}</h2>
                    <div class="rating rating-md mt-4">
                        @for ($i = 1; $i
                        <= 5; $i++)
                            <input type="radio" class="mask mask-star-2 bg-orange-400" {{ round($reviews->avg('rating')) == $i ? 'checked' : '' }} disabled />
                        @endfor
                    </div>
                    <p class="text-gray-400 mt-4 text-sm font-medium">Basato su {{ $reviews->count() }} soggiorni</p>
                </div>

                <div class="md:col-span-2 space-y-4 flex flex-col justify-center">
                    @foreach(range(5, 1) as $stars)
                    @php
                    $count = $reviews->where('rating', $stars)->count();
                    $percent = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-6">
                        <span class="text-sm font-bold w-16 text-gray-600">{{ $stars }} stelle</span>
                        <progress class="progress progress-primary w-full h-3" value="{{ $percent }}" max="100"></progress>
                        <span class="text-sm font-mono text-gray-400 w-10 text-right">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="space-y-8">
                <div class="flex items-center justify-between mb-8 border-b border-base-300 pb-4">
                    <h3 class="text-2xl font-bold italic text-neutral">Ultime testimonianze</h3>
                    <span class="badge badge-outline p-4 font-semibold uppercase tracking-widest text-xs">Verificate al 100%</span>
                </div>

                @forelse($reviews as $review)
                <div class="card bg-white shadow-lg border-none transition-transform hover:-translate-y-1 duration-300">
                    <div class="card-body p-8">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-6">
                            <div class="flex gap-5">
                                <div class="avatar placeholder">
                                    <div class="bg-primary text-primary-content rounded-2xl w-14 shadow-md">
                                        <span class="text-2xl font-bold">{{ substr($review->user->firstName, 0, 1) }}</span>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-bold text-xl text-gray-800">{{ $review->user->firstName }} {{ $review->user->lastName }}</h4>
                                    <div class="rating rating-xs mt-1">
                                        @for ($i = 1; $i
                                        <= 5; $i++)
                                            <input type="radio" class="mask mask-star-2 bg-orange-400" {{ $review->rating == $i ? 'checked' : '' }} disabled />
                                        @endfor
                                    </div>
                                    <div class="flex items-center gap-2 mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-[10px] font-bold uppercase text-success tracking-widest">Acquisto Verificato</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs font-bold text-gray-300 uppercase tracking-tighter">
                                {{ $review->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>

                        <div class="mt-8 relative">
                            <span class="absolute -top-4 -left-2 text-6xl text-primary opacity-10 font-serif">“</span>
                            <h5 class="font-black text-lg text-neutral mb-3">{{ $review->title }}</h5>
                            <p class="text-gray-600 leading-relaxed italic">
                                {{ $review->description }}
                            </p>

                            <div class="mt-6 pt-4 border-t border-base-100 flex items-center justify-between">
                                <p class="text-xs text-gray-400 font-medium">
                                    Soggiorno del {{ \Carbon\Carbon::parse($review->booking->checkInDate)->translatedFormat('F Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="card bg-white p-20 text-center shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-200 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-400 italic">Ancora nessuna storia da raccontare.</h3>
                    <p class="text-gray-400 mt-2">Sii il primo a condividere la tua esperienza!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>