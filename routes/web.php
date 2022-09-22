<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Individual examples

//Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
//
//Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
//
//Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
//
//Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
//
//Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
//
//Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
//
//Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

//Route::resource('/companies.contacts', ContactController::class);

Route::resources([
    '/contacts'     => ContactController::class,
    '/companies'    => CompanyController::class
]);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
