<?php

use Illuminate\Support\Facades\Route;

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
    return redirect(\route('login'));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect(\route('users'));
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('/users',\App\Http\Livewire\User\LiveUser::class)->name("users");
    Route::get('/mesas',\App\Http\Livewire\Mesa\LiveMesa::class)->name("mesas");
    Route::get('/pedidos',\App\Http\Livewire\Pedido\LivePedido::class)->name("pedidos");
    Route::get('/platos',\App\Http\Livewire\Plato\LivePlato::class)->name("platos");
    Route::get('/reservas',\App\Http\Livewire\Reserva\LiveReserva::class)->name("reservas");
    Route::get('/recibos',\App\Http\Livewire\Recibo\LiveRecibo::class)->name("recibos");
    Route::get('/bitacoras',\App\Http\Livewire\Bitacora\LiveBitacora::class)->name("bitacoras");
});







