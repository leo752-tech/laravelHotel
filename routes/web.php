<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\Review;
use App\Models\SpecialOffer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

//REGISTRATION  
Route::get('/email/verify', [RegisterController::class, 'verify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'click'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [RegisterController::class, 'reclick'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/test-mail', function () {
    try {
        Mail::raw('Test Mailtrap', function ($message) {
            $message->to('test@example.com')->subject('Prova');
        });
        return "Email inviata! Controlla Mailtrap.";
    } catch (\Exception $e) {
        return "Errore: " . $e->getMessage();
    }
});

Route::get('/',[UserController::class, 'home'])->name('home');

Route::get('/servizi', [ServiceController::class, 'indexUser']);
Route::get('/recensioni', [ReviewController::class, 'indexHome']);
Route::get('/specialOffer', [SpecialOfferController::class, 'index']);
Route::get('/camere', [RoomController::class, 'indexUser']);
Route::get('/detailRoomGuest/{id}', [RoomController::class, 'showDetailGuest'])->name('detailRoom');
Route::get('/territorio', [UserController::class, 'showTerritory'])->name('territory');
Route::get('/allRooms', [RoomController::class, 'showAllRooms'])->name('allRooms');



Route::middleware(['auth', 'verified','checkBanned'])->group(function(){
    Route::get('/personalPage', function () {return view('personalPage');});
    Route::delete('/logout', [SessionsController::class, 'destroy'])->name('logout');

    //make a booking
    Route::get('/checkOut', [BookingController::class, 'checkOut'])->name('checkOut');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');

    //Personal Page
    Route::get('/profile', [SessionsController::class, 'showProfile']);
    Route::get('/editProfile', [SessionsController::class, 'editProfile']);
    Route::post('/updateProfile', [SessionsController::class, 'updateProfile']);
    Route::get('/editCredentials', [SessionsController::class, 'editCredentials']);
    Route::get('/editEmail', [SessionsController::class, 'editEmail']);
    Route::get('/editPassword', [SessionsController::class, 'editPassword']);
    Route::post('/updateEmail', [SessionsController::class, 'updateEmail']);
    Route::post('/updatePassword', [SessionsController::class, 'updatePassword']);
    
    Route::resource('reviews', ReviewController::class); 
    Route::get('/createReview/{bookingId}', [ReviewController::class, 'createReview'])->name('createReview');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('storeReview');
    Route::delete('/deleteReview/{id}', [ReviewController::class, 'destroy'])->name('deleteReview');

    Route::get('/myBookings', [SessionsController::class, 'showMyBooking'])->name('myBookings');
    Route::delete('/deleteBooking/{booking}', [SessionsController::class, 'deleteBooking'])->name('deleteBooking');
    
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
 
    Route::resource('users', UserController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('specialOffers', SpecialOffer::class);

    //Route::delete('/admin/room-images/{image}', [RoomController::class, 'deleteImage'])->name('admin.room-images.destroy');
    Route::get('/allReviews', [ReviewController::class, 'indexAdmin'])->name('allReviews');
    Route::delete('/room-images/{imageId}', [RoomController::class, 'deleteImage'])->name('admin.room-images.destroy');
    Route::get('/statistics', [AdminController::class, 'showStatistics']);
    Route::get('/settings', [AdminController::class, 'edit']);
    Route::post('/updateAdmin', [AdminController::class, 'update'])->name('profile.update');
});

//make a booking, alcune da mettere nel MIDDLEWARE
Route::get('/calendar', [BookingController::class, 'showCalendar'])->name('calendar');
Route::post('/search', [BookingController::class, 'search'])->name('search');
Route::get('/summary/{id}', [BookingController::class, 'summary'])->name('summary');
Route::get('/payment', [/* da scrivere*/]);

Route::get('/calendar/{id}', [BookingController::class, 'showCalendarOffer'])->name('calendarOffer');
