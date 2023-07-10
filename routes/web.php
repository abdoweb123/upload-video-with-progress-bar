<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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




Route::get('file-upload', [VideoController::class, 'create'])->name('files.create');
Route::post('file-upload/upload-large-files', [VideoController::class, 'uploadLargeFiles'])->name('files.upload.large');
Route::post('store', [VideoController::class,'store'])->name('video_store');

