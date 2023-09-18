<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Text\TextController;
use Illuminate\Support\Facades\Auth;

Route::redirect('/', '/home');



Auth::routes();

Route::controller(FileController::class)->group(Function() {

    Route::get('files','index')->
    name('file.index');

    Route::post('files/create','create')->
    name('file.create');

    Route::get('files/download/{id}','download')->
    name('file.download');

    Route::delete('files/{id}','delete')->
    name('file.delete');

});


Route::controller(TextController::class)->group(function () {

    Route::get('/texts',[TextController::class,'index'])
    ->name('text.index');

    // Route::get('texts/create',[TextController::class,'create'])->name('text.create');

    Route::post('texts/store',[TextController::class,'store'])->
    name('text.store');

    Route::get('texts/{text}',[TextController::class,'show'])->
    name('text.show');

    Route::get('texts/{texts}/edit',[TextController::class,'edit'])->
    name('text.edit');

    Route::put('texts/{texts}',[TextController::class,'update'])->
    name('text.update');

    Route::delete('texts/{text}',[TextController::class,'delete'])->
    name('text.delete');
});

Route::post('/upload', 'UploadController@upload')->name('upload');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->
name('home');


