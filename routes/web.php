<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeController;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Route;



Route::controller(ThemeController::class)-> name('theme.')->group(function()
{
    Route::get('/','index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');
    // Route::get('/single_blog','singleblog')->name('singleblog');
    // Route::get('/login','login')->name('login');
    // Route::get('/register','register')->name('register');


});


Route::post('/subcriber/store',[SubscriberController::class,'store'])-> name('subcriber.store');
Route::post('/contact/store',[ContactsController::class,'store'])-> name('contact.store');

Route::get('/my_blogs',[BlogController::class,'myblogs']) ->name('blogs.my_blogs');
Route::resource('blogs',BlogController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
