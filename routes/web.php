<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistroVehicularController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroRolController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    // RUTAS DE VEHÍCULO
    Route::get('registrovehicular/table', [RegistroVehicularController::class, 'getTableData'])->name('registrovehicular.table');
    Route::get('registrovehicular', [RegistroCombustibleController::class, 'index'])->name('registrovehicular.index');
    Route::get('/vehiculo_create', [RegistroVehicularController::class, 'create'])->name('registrovehicular.create');
    Route::post('/vehiculo_store', [RegistroVehicularController::class, 'store'])->name('registrovehicular.store');
    Route::get('/registrovehicular/{id}/edit', [RegistroVehicularController::class, 'edit'])->name('registrovehicular.RVEdit');
    Route::put('/registrovehicular/{id}', [RegistroVehicularController::class, 'update'])->name('registrovehicular.update');
    Route::delete('/registrovehicular/{id}', [RegistroVehicularController::class, 'destroy'])->name('registrovehicular.destroy');
    // Mostrar detalles de un vehículo
    Route::get('registrovehicular/{id}', [RegistroVehicularController::class, 'show'])->name('registrovehicular.show');

   
    // RUTAS DE ROL
    Route::get('rol_table', [RegistroRolController::class, 'getData'])->name('registrorol.table');
    Route::get('/roles/{id}/editar', [RegistroRolController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}/editar', [RegistroRolController::class, 'update'])->name('roles.update');
    Route::put('/roles/{id}/editar', [RegistroRolController::class, 'update'])->name('roles.update');
    Route::get('/roles/data', [RegistroRolController::class, 'getData'])->name('registrorol.table');
    Route::post('/roles/toggleEstado', [RegistroRolController::class, 'toggleEstado'])->name('roles.toggleEstado');

    //Rutas de user
    Route::get('/user_table', [UserController::class, 'getTableData'])->name('user.table');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create'); // Nueva ruta para formulario de creación
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

   

    // MENÚ
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');
    
   
});

//INICIO DE SESION Y REGISTRO
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas de registro (solo para administradores)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirección para cualquier ruta no definida
Route::fallback(function () {
    if (auth()->check()) {
        return redirect()->route('menu');  // Redirecciona a menú si está autenticado
    }
    return redirect()->route('login');  // Redirecciona a login si no está autenticado
});
