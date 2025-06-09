<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistroDiagnosticoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroRolController;
use App\Http\Controllers\UserController;
use App\Models\RegistroDiagnostico;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\BitacoraController;



Route::middleware(['auth'])->group(function () {
    // RUTAS DE Diagnostico
   /* Obtener datos para tabla (si lo necesitas para DataTables u otra tabla AJAX)
   Esa línea Route::resource automatiza 7 rutas esenciales del CRUD (crear, listar, editar, actualizar, borrar, etc.).
   */

Route::get('registrodiagnostico/table', [RegistroDiagnosticoController::class, 'getTableData'])->name('registrodiagnostico.table');
    
Route::resource('registrodiagnostico', RegistroDiagnosticoController::class);
//RUTA DE EMPRESA
Route::resource('empresa', EmpresaController::class);
//RUTA PARA BITACORA
Route::resource('bitacoras', BitacoraController::class);
Route::get('bitacora', [BitacoraController::class, 'bitacoraIndex'])->name('bitacora.index');


/*Route::get('registrodiagnostico/table', [RegistroDiagnosticoController::class, 'getTableData'])->name('registrodiagnostico.table');

// Vista índice (listar todos los diagnósticos)
Route::get('registrodiagnostico', [RegistroDiagnosticoController::class, 'index'])->name('registrodiagnostico.index');

// Formulario para crear nuevo diagnóstico
Route::get('/diagnostico_create', [RegistroDiagnosticoController::class, 'create'])->name('registrodiagnostico.create');

// Guardar nuevo diagnóstico
Route::post('/diagnostico_store', [RegistroDiagnosticoController::class, 'store'])->name('registrodiagnostico.store');

// Editar diagnóstico
Route::get('/registrodiagnostico/{id}/edit', [RegistroDiagnosticoController::class, 'edit'])->name('registrodiagnostico.edit');

// Actualizar diagnóstico
Route::put('/registrodiagnostico/{id}', [RegistroDiagnosticoController::class, 'update'])->name('registrodiagnostico.update');

// Eliminar diagnóstico
Route::delete('/registrodiagnostico/{id}', [RegistroDiagnosticoController::class, 'destroy'])->name('registrodiagnostico.destroy');

// Mostrar detalles de diagnóstico
Route::get('registrodiagnostico/{id}', [RegistroDiagnosticoController::class, 'show'])->name('registrodiagnostico.show');
Route::resource('registrodiagnostico', RegistroDiagnosticoController::class);
*/

//RUTAS PDF
Route::get('/registro-diagnostico/{id}/pdf', [RegistroDiagnosticoController::class, 'generarPDF'])->name('registro_diagnostico.pdf');
Route::get('/diagnostico/{id}/vista-previa', function ($id) {
    $registro = RegistroDiagnostico::findOrFail($id);
    $pdf = Pdf::loadView('emails.reporte_diagnostico', compact('registro'));
    return $pdf->stream('reporte_diagnostico.pdf');
});

Route::post('/diagnostico/{id}/enviar-reporte', [RegistroDiagnosticoController::class, 'enviarReporte'])->name('diagnostico.enviar');
Route::get('/diagnostico/{id}/descargar', [RegistroDiagnosticoController::class, 'descargarPDF'])->name('diagnostico.descargar');
Route::get('/diagnostico/{id}/pdf', [RegistroDiagnosticoController::class, 'descargarPDF'])->name('diagnostico.pdf');

Route::post('/diagnostico/{id}/guardar-firma', [RegistroDiagnosticoController::class, 'guardarFirma'])->name('guardar.firma');

   
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
