<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Public booking routes (accessible without login)
Route::get('/book', [BookingController::class, 'showBookingForm'])->name('book');
Route::post('/book', [BookingController::class, 'submitBooking']);

Route::get('/book-room', [BookingController::class, 'showRoomForm'])->name('book.room');
Route::post('/book-room', [BookingController::class, 'submitRoomBooking']);
Route::get('/book-room/review', [BookingController::class, 'reviewRoomBooking'])->name('book.room.review');
Route::post('/book-room/confirm', [BookingController::class, 'confirmRoomBooking'])->name('book.room.confirm');

Route::get('/book-activity', [BookingController::class, 'showActivityForm'])->name('book.activity');
Route::post('/book-activity', [BookingController::class, 'submitActivityBooking']);
Route::get('/book-activity/review', [BookingController::class, 'reviewActivityBooking'])->name('book.activity.review');
Route::post('/book-activity/confirm', [BookingController::class, 'confirmActivityBooking'])->name('book.activity.confirm');

Route::get('/thank-you', [BookingController::class, 'thankYou'])->name('thank.you');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/receipt/pdf', [BookingController::class, 'downloadReceipt'])->name('receipt.pdf');

Route::middleware(['auth'])->group(function () {
    // Removed /admin/dashboard route
});

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard/booking/{booking}/complete', [AdminController::class, 'markCompleted'])->middleware(['auth', 'verified'])->name('dashboard.booking.complete');
Route::patch('/dashboard/booking/{booking}/status', [AdminController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('dashboard.booking.update-status');
Route::patch('/dashboard/booking/{booking}/reschedule', [AdminController::class, 'reschedule'])->middleware(['auth', 'verified'])->name('dashboard.booking.reschedule');
Route::patch('/dashboard/booking/{booking}/times', [AdminController::class, 'updateTimes'])->middleware(['auth', 'verified'])->name('dashboard.booking.update-times');
Route::get('/dashboard/booking/{booking}/check-status', [AdminController::class, 'checkBookingStatus'])->middleware(['auth', 'verified'])->name('dashboard.booking.check-status');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Debug route to check logged-in user's role without CSRF issues
Route::get('/debug-user-role', function (Request $request) {
    if (!auth()->check()) {
        return response()->json(['error' => 'Not authenticated'], 401);
    }
    $user = auth()->user();
    return response()->json([
        'id' => $user->id,
        'email' => $user->email,
        'role' => $user->role,
        'session' => Session::all(),
    ]);
});

// Route to list all users with their roles for database inspection
Route::middleware(['auth:sanctum'])->get('/debug-users', function (Request $request) {
    $users = \Illuminate\Support\Facades\DB::table('users')->select('id', 'name', 'email', 'role')->get();
    return response()->json($users);
});

require __DIR__.'/auth.php';

# Removed the generate-token route since admin middleware is removed and createToken method error occurs

// Debug route to show current authenticated user and role for troubleshooting
Route::middleware('auth')->get('/debug-current-user', function () {
    $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'Not authenticated'], 401);
    }
    return response()->json([
        'id' => $user->id,
        'email' => $user->email,
        'role' => $user->role,
    ]);
});
