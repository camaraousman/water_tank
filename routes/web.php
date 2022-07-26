<?php

use App\Http\Controllers\ALarmLogController;
use App\Http\Controllers\MeterController;
use App\Http\Controllers\MeterControlLogController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\Services;
use App\Http\Controllers\TankController;
use App\Http\Controllers\TankLevelLogController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
|
|
*/
require __DIR__.'/auth.php';
Route::get('/login', function () {
    return view('pages.login');
})->middleware(['guest'])->name('login');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/tank1_water_level',[TankController::class, 'tank1_water_level'])->name('tank1_water_level')->middleware('auth');
Route::get('/tank2_water_level',[TankController::class, 'tank2_water_level'])->name('tank2_water_level')->middleware('auth');

Route::post('/open_close_meter/{id}', [MeterController::class, 'open_close_meter'])->name('open_close_meter')->middleware('auth');

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
        Route::get('/fetchall', [UserController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware(['auth']);
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
                Route::post('/store', [TankLevelLogController::class, 'store'])->name('store');
                Route::post('/fetchall', [TankLevelLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
                Route::get('/getGraph', [TankLevelLogController::class, 'getGraph'])->name('getGraph')->middleware(['auth']);
            }
        );
        Route::prefix('alarmlogs')->as('alarmlogs.')->group(
            function() {
                Route::get('/', [ALarmLogController::class, 'index'])->name('index')->middleware(['auth']);
                Route::post('/fetchall', [ALarmLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
                //begin api routes
                Route::post('/store', [ALarmLogController::class, 'store'])->name('store');
            }
        );
        Route::prefix('metercontrollogs')->as('metercontrollogs.')->group(
            function() {
                Route::get('/', [MeterControlLogController::class, 'index'])->name('index')->middleware(['auth']);
                Route::post('/fetchall', [MeterControlLogController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);

                //begin api routes
                Route::post('/store', [MeterControlLogController::class, 'store'])->name('store');
            }
        );
    }
);


/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
|
|
*/

Route::prefix('services')->as('services.')->group(function (){
    Route::post('/switch', [Services::class, 'switch'])->name('switch');
});




Route::get('/test',[TestController::class, 'test'])->name('test')->middleware('auth');
Route::post('/test/fetch_data',[TestController::class, 'fetch_data'])->name('fetch_data')->middleware('auth');

