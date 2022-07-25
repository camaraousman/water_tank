<?php

use App\Http\Controllers\ALarmLogController;
use App\Http\Controllers\MeterControlLogController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\TankController;
use App\Http\Controllers\TankLevelLogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Login and Dashboard
|--------------------------------------------------------------------------
|
|
*/
require __DIR__.'/auth.php';
Route::get('/login', function () {
    return view('pages.login');
})->middleware(['guest'])->name('login');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
|
|
*/

Route::prefix('users')->as('users.')->group(
    function() {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware(['auth']);
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware(['auth']);
        Route::get('/fetchall', [UserController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
        Route::delete('/delete', [UserController::class, 'delete'])->name('delete')->middleware(['auth']);
        Route::get('/edit', [UserController::class, 'edit'])->name('edit')->middleware(['auth']);
        Route::post('/update', [UserController::class, 'update'])->name('update')->middleware(['auth']);
    }
);

/*
|--------------------------------------------------------------------------
| Phones
|--------------------------------------------------------------------------
|
|
*/

Route::prefix('phones')->as('phones.')->group(
    function() {
        Route::get('/', [PhoneController::class, 'index'])->name('index')->middleware(['auth']);
        Route::post('/store', [PhoneController::class, 'store'])->name('store')->middleware(['auth']);
        Route::get('/fetchall', [PhoneController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
        Route::delete('/delete', [PhoneController::class, 'delete'])->name('delete')->middleware(['auth']);
    }
);

/*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
|
|
*/

Route::prefix('logs')->group(
    function() {
        Route::prefix('tanklevellogs')->as('tanklevellogs.')->group(
            function() {
                Route::get('/', [TankLevelLogController::class, 'index'])->name('index')->middleware(['auth']);
                Route::post('/store', [TankLevelLogController::class, 'store'])->name('store')->middleware(['auth']);
                Route::get('/fetchall', [TankLevelLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
            }
        );
        Route::prefix('alarmlogs')->as('alarmlogs.')->group(
            function() {
                Route::get('/', [ALarmLogController::class, 'index'])->name('index')->middleware(['auth']);
                Route::post('/store', [ALarmLogController::class, 'store'])->name('store')->middleware(['auth']);
                Route::get('/fetchall', [ALarmLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
            }
        );
        Route::prefix('metercontrollogs')->as('metercontrollogs.')->group(
            function() {
                Route::get('/', [MeterControlLogController::class, 'index'])->name('index')->middleware(['auth']);
                Route::post('/store', [MeterControlLogController::class, 'store'])->name('store')->middleware(['auth']);
                Route::get('/fetchall', [MeterControlLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
            }
        );
    }
);




Route::get('dashboard/water_level',[TankController::class, 'tank1_water_level'])->name('water_level');


