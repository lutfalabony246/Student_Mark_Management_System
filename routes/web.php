<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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
// for class crud
Route::resource('class', ClassController::class);
// for student all route
Route::prefix('student')->group(function () {
    Route::get('/add', [StudentController::class, 'Add'])->name('student.add');
    Route::post('/store', [StudentController::class, 'Store'])->name('student.store');
    Route::get('/edit/{id}', [StudentController::class, 'Edit'])->name('student.edit');
    Route::post('/update', [StudentController::class, 'Update'])->name('student.update');
    Route::get('/delete/{id}', [StudentController::class, 'Delete'])->name('student.delete');
    Route::get('/view', [StudentController::class, 'View'])->name('student.view');
});

Route::get('subject/add', [SubjectController::class, 'Add'])->name('subject.add');
Route::post('subject/store', [SubjectController::class, 'Store'])->name('subject.store');




Route::prefix('mark')->group(function () {
Route::get('/add', [MarkController::class, 'Add'])->name('mark.add');
Route::post('/store', [MarkController::class, 'Store'])->name('mark.store');
Route::get('/get/subject/ajax/{class_id}',[MarkController::class, 'SubjectAjax']);
Route::get('/result/view',[MarkController::class, 'MarkShowAdd'])->name('mark.filter.view');
Route::get('/get/{id}',[MarkController::class, 'MarkShow'])->name('mark.result.show');
});
