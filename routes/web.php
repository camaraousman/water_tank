<?php

use App\Http\Controllers\TankController;
use App\Http\Controllers\UserController;
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
    return view('pages.login');
})->middleware(['guest'])->name('sign-in');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('users')->as('users.')->group(
    function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/fetchall', [UserController::class, 'fetchAll'])->name('fetchAll');
        Route::delete('/delete', [UserController::class, 'delete'])->name('delete');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
    }
);

Route::get('dashboard/water_level',[TankController::class, 'tank1_water_level'])->name('water_level');

require __DIR__.'/auth.php';
