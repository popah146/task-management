<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Auth::routes();

/*
Project Routes
*/
Route::get('/home', [App\Http\Controllers\ProjectController::class, 'create'])->name('home.create');
Route::post('/home', [App\Http\Controllers\ProjectController::class, 'store'])->name('home.store');
Route::get('/home', [App\Http\Controllers\ProjectController::class, 'index'])->name('home');


Route::get('/project/{project}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit');
Route::patch('/project/{project}', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{project}', [App\Http\Controllers\ProjectController::class, 'delete'])->name('project.delete');
Route::get('project/{project}', [App\Http\Controllers\ProjectController::class, 'indexa'])->name('project.show');


/*
Task Routes
*/
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'indexa'])->name('tasks.show');
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class,'edit'])->name('tasks.edit');
Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::post('/tasks/priority', [App\Http\Controllers\TaskController::class, 'updatePriority']);
Route::patch('/tasks', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks', [App\Http\Controllers\TaskController::class, 'delete'])->name('tasks.delete');




/*

*/
