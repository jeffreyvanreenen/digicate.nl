<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MollieController;
use App\Http\Controllers\FacturenController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/nieuwefactuur', [MollieController::class, 'NieuweFactuur']);
    Route::get('/status_betaling/{id}', [MollieController::class, 'StatusBetaling']);
    Route::get('/succes', [MollieController::class, 'succes']);

    Route::get('/financieel/mijn_facturen', [FacturenController::class, 'index'])->name('financieel.mijn_facturen');
    Route::get('/financieel/mandaat_afgeven', [FacturenController::class, 'mandaat_afgeven'])->name('financieel.mandaat_afgeven');
    Route::get('/financieel/mandaat_intrekken', [FacturenController::class, 'mandaat_intrekken'])->name('financieel.mandaat_intrekken');
    Route::get('/financieel/factuur_betalen/{id}', [FacturenController::class, 'factuurbetalen'])->name('financieel.factuur_betalen');
});

//Route::name('webhooks.mollie')->post('/webhooks/mollie', 'MollieWebhookController@handle');

require __DIR__.'/auth.php';

