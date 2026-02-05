<?php

use App\Http\Controllers\AdminPeticionesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PetitionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- RUTA PRINCIPAL
Route::get('/', [PagesController::class, 'home'])->name('home');

Route::controller(PetitionController::class)->group(function () {
    Route::get('peticiones/index', 'index')->name('petitions.index');
    Route::get('peticiones/{id}', 'show')->name('petitions.show');
});

Route::controller(PetitionController::class)->middleware('auth')->group(function () {
    Route::get('mispeticiones', 'listMine')->name('petitions.mine');
    Route::get('peticion/add', 'create')->name('petitions.create');
    Route::post('peticion/store', 'store')->name('petitions.store');
    Route::get('peticion/edit/{id}', 'edit')->name('petitions.edit');
    Route::put('peticion/update/{id}', 'update')->name('petitions.update');
    Route::post('peticiones/firmar/{id}', 'firmar')->name('petitions.firmar');
    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('petitions.peticionesfirmadas');
    // CORREGIDO: Aquí tenías una ruta larguísima
    Route::delete('/petitions/{id}', [PetitionController::class, 'destroy'])->name('petitions.destroy');
});

// Rutas de Perfil
Route::middleware('auth')->group(function () {
    Route::get('/misfirmas', [PetitionController::class, 'peticionesFirmadas'])->name('petitions.firmadas');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUTA DASHBOARD
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Estas rutas parecen duplicadas con las de arriba, pero las dejo por si acaso las usas en otro lado
// Si te dan error de "nombre duplicado", bórralas.
// Route::get('/petitions/{id}/edit', [PetitionController::class, 'edit'])->name('petitions.edit')->middleware('auth');
// Route::put('/petitions/{id}', [PetitionController::class, 'update'])->name('petitions.update')->middleware('auth');

require __DIR__.'/auth.php';

// GRUPO DE RUTAS DE ADMINISTRADOR
Route::middleware(['auth', 'admin'])->controller(AdminPeticionesController::class)->group(function () {

    Route::get('admin/peticion/add', 'create')->name('adminpeticiones.create');

    Route::get('admin', 'index')->name('admin.home');
    Route::get('admin/peticiones/index', 'index')->name('adminpeticiones.index');
    Route::get('admin/peticiones/{id}', 'show')->name('adminpeticiones.show');
    Route::get('admin/peticiones/edit/{id}', 'edit')->name('adminpeticiones.edit');
    Route::post('admin/peticiones', 'store')->name('adminpeticiones.store');
    Route::delete('admin/peticiones/{id}', 'delete')->name('adminpeticiones.delete');
    Route::put('admin/peticiones/{id}', 'update')->name('adminpeticiones.update');
    Route::put('admin/peticiones/estado/{id}', 'cambiarEstado')->name('adminpeticiones.estado');

// RUTAS PARA CATEGORÍAS
    Route::controller(App\Http\Controllers\AdminCategoriasController::class)->group(function () {
        Route::get('admin/categorias', 'index')->name('admincategorias.index');
        Route::get('admin/categorias/add', 'create')->name('admincategorias.create');
        Route::post('admin/categorias', 'store')->name('admincategorias.store');
        Route::get('admin/categorias/edit/{id}', 'edit')->name('admincategorias.edit');
        Route::put('admin/categorias/{id}', 'update')->name('admincategorias.update');
        Route::delete('admin/categorias/{id}', 'delete')->name('admincategorias.delete');
    });
    // RUTAS DE USUARIOS
    Route::controller(App\Http\Controllers\AdminUsersController::class)->group(function () {
        Route::get('admin/users', 'index')->name('adminusers.index');
        Route::put('admin/users/role/{id}', 'updateRole')->name('adminusers.role');
        Route::delete('admin/users/{id}', 'delete')->name('adminusers.delete');
    });
});
