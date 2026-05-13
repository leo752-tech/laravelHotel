<x-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="text-sm breadcrumbs mb-4">
            <ul>
                <li><a href="/bookings">Le mie Prenotazioni</a></li>
                <li>Scrivi Recensione</li>
            </ul>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-2xl font-bold mb-2">Com'è stato il tuo soggiorno?</h2>
                <p class="text-base-content/60 mb-6">La tua opinione aiuta altri viaggiatori e migliora il nostro servizio.</p>

                <div class="bg-base-200/50 p-4 rounded-lg mb-8 flex justify-between items-center">
                    <div>
                        <span class="block text-xs uppercase font-bold opacity-50">Stai recensendo la</span>
                        <span class="font-medium text-lg">Camera #{{ $booking->roomId }}</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-xs uppercase font-bold opacity-50">Soggiorno del</span>
                        <span>{{ \Carbon\Carbon::parse($booking->checkInDate)->format('d M Y') }}</span>
                    </div>
                </div>

                <form action="{{ route('storeReview') }}" method="POST">
                    @csrf
                    <input type="hidden" name="bookingId" value="{{ $booking->id }}">

                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text font-bold">Valutazione complessiva</span>
                        </label>
                        <div class="rating rating-lg gap-1">
                            <input type="radio" name="rating" value="1" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating" value="2" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating" value="3" class="mask mask-star-2 bg-orange-400" checked />
                            <input type="radio" name="rating" value="4" class="mask mask-star-2 bg-orange-400" />
                            <input type="radio" name="rating" value="5" class="mask mask-star-2 bg-orange-400" />
                        </div>
                    </div>

                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text font-bold">Titolo della recensione</span>
                        </label>
                        <input type="text" name="title" placeholder="Es: Soggiorno fantastico!" class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control mb-8">
                        <label class="label">
                            <span class="label-text font-bold">Raccontaci i dettagli</span>
                        </label>
                        <textarea name="description" class="textarea textarea-bordered h-32" placeholder="Cosa ti è piaciuto di più? Com'era il servizio?" required></textarea>
                    </div>

                    <div class="card-actions justify-end gap-4">
                        <a href="{{ route('myBookings') }}" class="btn btn-ghost">Annulla</a>
                        <button type="submit" class="btn btn-primary px-8">Invia Recensione</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>