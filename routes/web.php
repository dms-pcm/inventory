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

// Route::get('/', function () {
//     return view('inventory');
// });
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryController;
// use App\Models\Item_history;
// use App\Models\Item;
Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/store', function () {
    return redirect('/');
});;
Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/edit/{id}', [ItemController::class, 'update'])->name('items.update');
Route::post('/store', [ItemController::class, 'store'])->name('items.store');
Route::delete('/{id}', [ItemController::class, 'destroy'])->name('items.destroy');
Route::get('/history/{id}', [HistoryController::class, 'edit'])->name('history.edit');
Route::post('/history/{id}', [HistoryController::class, 'update'])->name('history.update');
