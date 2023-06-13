<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\SubunitController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/subunit/{id}/assign-subunit', [SubunitController::class, 'showAssignSubunitForm'])
    ->name('subunits.showAssignSubunitForm');
Route::post('/subunit/{id}/assign-subunit', [SubunitController::class, 'assignSubunit'])
    ->name('subunits.assign-subunit');


Route::resource('trucks', TruckController::class);
Route::resource('subunits', SubunitController::class);
