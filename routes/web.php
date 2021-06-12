<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\FacturenController;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomePageController;

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

Route::get('/', [HomePageController::class, 'index'])->name('homepage');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/mail', function () {
    return view('mails.notification');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/nieuwefactuur', [MollieController::class, 'NieuweFactuur']);
    Route::get('/status_betaling/{id}', [MollieController::class, 'StatusBetaling']);
    Route::get('/succes', [MollieController::class, 'succes']);

    Route::get('/financieel/mijn_facturen', [FacturenController::class, 'index'])->name('financieel.mijn_facturen');
    Route::get('/financieel/mandaat_afgeven', [FacturenController::class, 'mandaat_afgeven'])->name('financieel.mandaat_afgeven');
    Route::get('/financieel/mandaat_intrekken', [FacturenController::class, 'mandaat_intrekken'])->name('financieel.mandaat_intrekken');
    Route::get('/financieel/factuur_betalen/{id}', [FacturenController::class, 'factuurbetalen'])->name('financieel.factuur_betalen');
    Route::get('/financieel/factuur_weergeven/{id}', [FacturenController::class, 'factuur_weergeven'])->name('financieel.factuur_weergeven');

});

Route::get('/send-mail', function () {

    Mail::to('jeffrey92.hrb@gmail.com')->send(new Notification());

    return 'A message has been sent to Mailtrap!';

});

require __DIR__.'/auth.php';

