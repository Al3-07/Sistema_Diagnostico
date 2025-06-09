<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistroDiagnosticoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroRolController;
use App\Http\Controllers\UserController;
use App\Models\RegistroDiagnostico;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ReporteController;


 /* Obtener datos para tabla (si lo necesitas para DataTables u otra tabla AJAX).
   Esa línea Route::resource automatiza 7 rutas esenciales del CRUD (crear, listar, editar, actualizar, borrar, etc.).*/
Route::middleware(['auth'])->group(function () {
    
    // R U T A S     D E      D I A G N Ó S T  I C O. 
Route::get('registrodiagnostico/table', [RegistroDiagnosticoController::class, 'getTableData'])->name('registrodiagnostico.table');
Route::resource('registrodiagnostico', RegistroDiagnosticoController::class);


//R U T A     D E     E M P R E S A. 
Route::resource('empresa', EmpresaController::class);


//R U T A     P A R A    B I T Á C O R A.
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
Route::get('/registro-diagnostico/{id}/pdf', [App\Http\Controllers\RegistroDiagnosticoController::class, 'generarPDF'])->name('registro_diagnostico.pdf');
Route::get('/diagnostico/{id}/vista-previa', function ($id) {
    $registro = RegistroDiagnostico::findOrFail($id);
    $pdf = Pdf::loadView('emails.reporte_diagnostico', compact('registro'));
    return $pdf->stream('reporte_diagnostico.pdf');
});

Route::post('/diagnostico/{id}/enviar-reporte', [RegistroDiagnosticoController::class, 'enviarReporte'])->name('diagnostico.enviar');
Route::get('/diagnostico/{id}/descargar', [RegistroDiagnosticoController::class, 'descargarPDF'])->name('diagnostico.descargar');
Route::get('/diagnostico/{id}/pdf', [RegistroDiagnosticoController::class, 'descargarPDF'])->name('diagnostico.pdf');

Route::post('/diagnostico/{id}/guardar-firma', [RegistroDiagnosticoController::class, 'guardarFirma'])->name('guardar.firma');

   
    // R U T A S     D  E    R O L. 
    Route::get('rol_table', [RegistroRolController::class, 'getData'])->name('registrorol.table');
    Route::get('/roles/{id}/editar', [RegistroRolController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}/editar', [RegistroRolController::class, 'update'])->name('roles.update');
    Route::put('/roles/{id}/editar', [RegistroRolController::class, 'update'])->name('roles.update');
    Route::get('/roles/data', [RegistroRolController::class, 'getData'])->name('registrorol.table');
    Route::post('/roles/toggleEstado', [RegistroRolController::class, 'toggleEstado'])->name('roles.toggleEstado');


    //R U T A S   D E    U S E R.
    Route::get('/user_table', [UserController::class, 'getTableData'])->name('user.table');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create'); // Nueva ruta para formulario de creación.
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

   

    // R U T A S       D E L      M E N Ú.
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');
    
   
});

//R U T A S     D E      I N I C I O    D E     S E S I Ó N    Y     R E G I S T R O.
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// R U T A S    D E    R E G I S T R O    (s o l o   p a r a   a d mi n i s t r a d o r e s).
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// R U T A S       D E     C E R R A R       S E S I Ó  N.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// R E D I R E C C I Ó N     P A R A    C U A L Q U I E R    R U T A     N O      D E F I N I D A.
Route::fallback(function () {
    if (auth()->check()) {
        return redirect()->route('menu');  // Redirecciona a menú si está autenticado.
    }
    return redirect()->route('login');  // Redirecciona a login si no está autenticado.
});

// R U T A S    P A R A     G E N E R A R    P D F     D E      R E P O R T E S .
Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('reportes/pdf', [ReporteController::class, 'downloadPdf'])->name('reportes.pdf');

// PDF de un solo registro.
Route::get('/reportes/{id}/pdf', [ReporteController::class, 'descargarPDFIndividual'])->name('reportes.pdf.individual');

// PDF de todos los registros por empresa.
Route::get('/reportes/empresa/{empresa}/pdf', [ReporteController::class, 'descargarPDFPorEmpresa'])->name('reportes.pdf.empresa');
