<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

 
Route::get('/',[HomeController:: class,'home'])->name('home');
Route::get('/book-detail/{id}',[HomeController:: class,'bookDetail'])->name('book.detail');
Route::post('/save-review',[HomeController:: class,'saveReview'])->name('book.saveReview');

Route::group(['prefix' => 'account'], function () {

    // 🔹 Guest Routes
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', [AccountController::class, 'register'])->name('account.register');
        Route::post('/register', [AccountController::class, 'processRegister'])->name('account.processRegister');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/login', [AccountController::class, 'authentication'])->name('account.authentication');
    });

    // 🔹 Authenticated Routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
        Route::get('/books/list', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books/create', [BookController::class, 'store'])->name('book.store');
        Route::get('/books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::post('/books/edit/{id}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/books', [BookController::class, 'destroy'])->name('book.delete');
        Route::get('/reviews', [ReviewController::class, 'reviews'])->name('book.reviews');
        Route::get('/reviews/edit/{id}', [ReviewController::class, 'editReview'])->name('reviews.editReview');
        Route::Post('/reviews/edit/{id}', [ReviewController::class, 'updateReview'])->name('reviews.updateReview');
        Route::Post('delete-review', [ReviewController::class, 'deleteReview'])->name('reviews.deleteReview');

        Route::get('my-review', [AccountController::class, 'myReview'])->name('account.myreview');
        Route::get('my-review/edit/{id}', [AccountController::class, 'editReview'])->name('account.myreview.edit');
        Route::post('my-review/edit/{id}', [AccountController::class, 'updateMyReview'])->name('account.myreview.updateMyReview');
        Route::Post('delete-myreview', [ReviewController::class, 'deleteReviewdeleteMyReview'])->name('reviews.deleteMyReview');
    });

});

