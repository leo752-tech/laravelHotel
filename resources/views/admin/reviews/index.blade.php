<x-layoutAdmin>
    <div class="max-w-5xl mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 bg-white p-8 rounded-2xl shadow-sm border border-base-200">
            <div class="flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-base-200 pb-6 md:pb-0">
                <h2 class="text-6xl font-black text-primary">{{ number_format($reviews->avg('rating'), 1) }}</h2>
                <div class="rating rating-sm mt-2">
                    @for ($i = 1; $i
                    <= 5; $i++)
                        <input type="radio" class="mask mask-star-2 bg-orange-400" {{ round($reviews->avg('rating')) == $i ? 'checked' : '' }} disabled />
                    @endfor
                </div>
                <p class="text-gray-500 mt-2 text-sm">{{ $reviews->count() }} Recensioni</p>
            </div>

            <div class="md:col-span-2 space-y-3 flex flex-col justify-center">
                @foreach(range(5, 1) as $stars)
                @php
                $count = $reviews->where('rating', $stars)->count();
                $percent = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                @endphp
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold w-12">{{ $stars }} stelle</span>
                    <progress class="progress progress-primary w-full" value="{{ $percent }}" max="100"></progress>
                    <span class="text-sm text-gray-400 w-8">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-2xl font-bold mb-6">Cosa dicono i nostri ospiti</h3>

            @forelse($reviews as $review)
            <div class="card bg-white shadow-sm border border-base-100 overflow-hidden">
                <div class="card-body p-6">
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <div class="flex gap-4">
                            <div class="avatar placeholder">
                                <div class="bg-neutral text-neutral-content rounded-full w-12">
                                    <span class="text-xl">{{ substr($review->user->firstName, 0, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg leading-tight">{{ $review->user->firstName }} {{ $review->user->lastName }}</h4>
                                <div class="rating rating-xs">
                                    @for ($i = 1; $i
                                    <= 5; $i++)
                                        <input type="radio" class="mask mask-star-2 bg-orange-400" {{ $review->rating == $i ? 'checked' : '' }} disabled />
                                    @endfor
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Soggiornato il {{ \Carbon\Carbon::parse($review->booking->checkInDate)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-400 italic">
                            {{ $review->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="font-bold text-neutral">{{ $review->title }}</h5>
                        <p class="text-gray-600 mt-2 leading-relaxed">
                            "{{ $review->description }}"
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <p class="text-gray-400">Non ci sono ancora recensioni per questa camera.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-layoutAdmin>