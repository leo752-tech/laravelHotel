<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $allReviews = Review::all();

        return view('admin.reviews.index', ['reviews' => $allReviews]);
    }

    public function indexHome()
    {
        $allReviews = Review::all();

        return view('review', ['reviews' => $allReviews]);
    }

    public function index()
    {
        $reviews = Review::where('userId', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('auth.myReviews', compact('reviews'));
    }

   
    public function createReview($bookingId)
    {
        session(['bookingId' => $bookingId]);
        $booking = Booking::findOrFail($bookingId);
        $this->authorize(Auth::user(), $booking);
        return view('auth.createReview', compact('booking'));
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'description' => ['required', 'string', 'max:300']
        ]);

        $user = Auth::user();
        $review = Review::create([
            'title' => $request->title,
            'rating' => $request->rating,
            'description' => $request->description,
            'userId' => $user->id,
            'bookingId' => $request->bookingId
        ]);

        return redirect()->route('myBookings')->with('success', 'Recensione effettuata');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $this->authorize('delete', $review);

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Recensione cancellata');
    }
}
