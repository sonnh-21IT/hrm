<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskFilterController;
use App\Http\Controllers\TaskSearchController;
use App\Http\Controllers\TaskExportController;
use App\Http\Controllers\Custom;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('country', CountryController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('user', CustomUserController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('company', CompanyController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('role', RoleController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('department', DepartmentController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('project', ProjectController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::resource('task', TaskController::class)->only([
    'index', 'store', 'destroy', 'update'
]);
Route::get('task/filter', [TaskFilterController::class, 'filter'])->name('task.filter');
Route::get('task/search', [TaskSearchController::class, 'searchByName'])->name('task.search');
Route::get('task/export', [TaskExportController::class, 'exportTasks'])->name('task.export');