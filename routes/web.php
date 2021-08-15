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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->group( function () {
    Route::get('/users',\App\Http\Livewire\User\Lista::class)->name("users");
    Route::get('/mesas',\App\Http\Livewire\Mesa\LiveMesa::class)->name("mesas");
    Route::get('/pedidos',\App\Http\Livewire\Pedido\LivePedido::class)->name("pedidos");
    Route::get('/platos',\App\Http\Livewire\Plato\LivePlato::class)->name("platos");
    Route::get('/reservas',\App\Http\Livewire\Reserva\LiveReserva::class)->name("reservas");
});







