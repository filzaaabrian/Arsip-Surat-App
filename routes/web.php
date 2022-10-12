<?php
use App\Http\Controllers\SuratController;
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
    return view('home');
});

Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});

Route::get('/upload', function () {
    return view('layouts.upload');
});

Route::get('/update', function () {
    return view('layouts.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/dashboard',  SuratController::class);

Route::get('/search', [SuratController::class, 'index'])->name('search');
Route::post('/upload/proses',  [SuratController::class, 'create']);
Route::get('/delete/{id}', [SuratController::class, 'hapus']);

Route::get('/download/{filename}', function ($filename) {
    $header = array(
        'Content-Type: application/pdf',
    );
    return Storage::download('public/' . $filename, $filename, $header);
})->name('download');

Route::get('/about', function () {
    return view('layouts.about');
});
