<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
//如果下面路徑要簡短 可以現在上面引用

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('articles',controller:\App\Http\Controllers\ArticleController::class);
// 也可以這樣把完整路徑寫出
Route::resource('articles',controller:ArticleController::class);
// 記得上面需要引用絕對路徑

Route::get('/',[ArticleController::class,'index'])->name('root');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
