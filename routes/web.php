<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
    
// });

Route::group(['middleware'=>'auth'], function(){
    Route::get('dashboard', [HomeController::class,'dashboard'])->name('dashboard');
});

Route::group(['middleware'=>'role:author'], function(){
    Route::get('role', function(){
        dd('hi');
    });
});
require __DIR__.'/auth.php';
