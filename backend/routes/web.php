<?php

use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\Broker\InquiryController as BrokerInquiryController;
use App\Http\Controllers\Broker\PropertyController as BrokerPropertyController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $user = auth()->user();

    if (! $user) {
        return redirect()->route('login');
    }

    if ($user->role === 'broker' && ! $user->isApproved()) {
        return view('dashboard')->with('status', 'Your broker account is pending approval.');
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'broker' => redirect()->route('broker.dashboard'),
        'client' => redirect()->route('client.dashboard'),
        default => view('dashboard'),
    };
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/approvals', [UserApprovalController::class, 'index'])->name('approvals.index');
    Route::post('/approvals/{user}/approve', [UserApprovalController::class, 'approve'])->name('approvals.approve');
    Route::post('/approvals/{user}/reject', [UserApprovalController::class, 'reject'])->name('approvals.reject');
});

Route::middleware(['auth', 'role:broker'])->prefix('broker')->name('broker.')->group(function () {
    Route::get('/dashboard', fn () => view('broker.dashboard'))->name('dashboard');
    Route::get('/', fn () => redirect()->route('broker.dashboard'));
    Route::resource('properties', BrokerPropertyController::class);
    Route::get('/inquiries', [BrokerInquiryController::class, 'index'])->name('inquiries.index');
    Route::patch('/inquiries/{id}', [BrokerInquiryController::class, 'update'])->name('inquiries.update');
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'storeMessage'])->name('conversations.messages.store');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client', fn () => view('client.dashboard'))->name('client.dashboard');
    Route::get('/client/dashboard', fn () => view('client.dashboard'))->name('client.dashboard.alt');

    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{property}/inquiries/create', [InquiryController::class, 'create'])->name('inquiries.create');
    Route::post('/properties/{property}/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'storeMessage'])->name('conversations.messages.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
