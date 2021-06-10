<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MollieController;

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

Route::get('/nieuwefactuur', [MollieController::class, 'NieuweFactuur']);
Route::get('/status_betaling/{id}', [MollieController::class, 'StatusBetaling']);
Route::get('/succes', [MollieController::class, 'succes']);

Route::name('webhooks.mollie')->post('/webhooks/mollie', 'MollieWebhookController@handle');

require __DIR__.'/auth.php';

