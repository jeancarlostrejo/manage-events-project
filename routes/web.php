<?php

use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryCityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryIndexController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\savedEventController;
use App\Http\Controllers\SaveSystemController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{event}', EventShowController::class)->name('eventShow');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/events', EventController::class);
    Route::resource('/galleries', GalleryController::class);
    Route::get('/countries/{country}', CountryCityController::class);
    Route::post('/events-like/{event}', LikeSystemController::class)->name('events.like');
    Route::post('/events-save/{event}', SaveSystemController::class)->name('events.save');
    Route::post('/events-attending/{event}', AttendingSystemController::class)->name('events.likattending');
    Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('events.comments.store');
    Route::delete('/events/{event}/comments/{comment}', [CommentController::class, 'destroy'])->name('events.comments.destroy');
    Route::get('/saved-events', savedEventController::class)->name('savedEvents');
    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/attending-events', AttendingEventController::class)->name('attendingEvents');
});

require __DIR__.'/auth.php';
