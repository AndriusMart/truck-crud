<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;

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

Route::get('/', function () {
    return view('welcome');
});

// Assign subunit routes
Route::get('/trucks/{id}/assign-subunit', [TruckController::class, 'showAssignSubunitForm'])
    ->name('trucks.showAssignSubunitForm');
Route::post('/trucks/{id}/assign-subunit', [TruckController::class, 'assignSubunit'])
    ->name('trucks.assignSubunit');

// Truck resource routes
Route::resource('trucks', TruckController::class);

// Truck subunit resource routes
Route::resource('trucks.subunits', TruckSubunitController::class)
    ->parameters([
        'trucks' => 'truck',
        'subunits' => 'subunit'
    ])
    ->except(['index', 'create', 'show']);

// Assign truck routes
// Route::get('/subunits/{id}/assign-truck', [SubunitController::class, 'showAssignTruckForm'])
//     ->name('subunits.showAssignTruckForm');
// Route::post('/subunits/{id}/assign-truck', [SubunitController::class, 'assignTruck'])
//     ->name('subunits.assignTruck');