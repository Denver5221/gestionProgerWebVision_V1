<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EntreeSortieController;
use App\Http\Controllers\CustomRegisterController;

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

require_once 'theme-routes.php';

// Route::resource('user/role', RoleController::class);

// Route::prefix('user')->group(function () {

//     Route::group(['prefix' => 'role'], function () {
//         Route::get('/', [RoleController::class, 'index'])->name('roles.index');
//         Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
//         Route::post('/', [RoleController::class, 'store'])->name('roles.store');
//         Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update');
//         Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
//     })->name('role');


//     Route::group(['prefix' => 'post'], function () {
//         Route::get('/', [PosteController::class, 'index'])->name('postes.index');
//         Route::get('/create', [PosteController::class, 'create'])->name('postes.create');
//         Route::post('/', [PosteController::class, 'store'])->name('postes.store');
//         Route::put('/{poste}', [PosteController::class, 'update'])->name('postes.update');
//         Route::delete('/postes/{poste}', [PosteController::class, 'destroy'])->name('postes.destroy');
//     })->name('role');
// });

// Route::get('user/role', [RoleController::class, 'index'])->name('roles.index');
// Route::get('user/roles/create', [RoleController::class, 'create'])->name('roles.create');
// Route::post('user/role', [RoleController::class, 'store'])->name('roles.store');


// Route::resource('user/post', PosteController::class);

// Route::get('user/post', [PosteController::class, 'index'])->name('postes.index');
// Route::get('user/post/create', [PosteController::class, 'create'])->name('postes.create');
// Route::post('user/post', [PosteController::class, 'store'])->name('postes.store');


Route::get('/roles', [PermissionController::class,'Permission']);

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/private', function () {
        return 'Bonjour admin';
    });
});

Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');

Route::prefix('expenses')->group(function () {
    Route::get('/', [EntreeSortieController::class, 'index'])->name('expenses.index');
    Route::get('/create', [EntreeSortieController::class, 'create'])->name('expenses.create');
    Route::post('/', [EntreeSortieController::class, 'store'])->name('expenses.store');
    Route::get('/{id}', [EntreeSortieController::class, 'show'])->name('expenses.show');
    Route::get('/{id}/edit', [EntreeSortieController::class, 'edit'])->name('expenses.edit');
    Route::put('/{id}', [EntreeSortieController::class, 'update'])->name('expenses.update');
    Route::delete('/{id}', [EntreeSortieController::class, 'destroy'])->name('expenses.destroy');
});


Route::get('/barebone', function () {
    return view('barebone', ['title' => 'This is Title']);
});

