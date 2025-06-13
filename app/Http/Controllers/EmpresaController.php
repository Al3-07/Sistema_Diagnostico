<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Helpers\BitacoraHelper;
use App\Models\Bitacora;

class EmpresaController extends Controller
{
    /**
     * Mostrar listado de empresas (vista REIndex).
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresa.REIndex', compact('empresas'));
    }

    /**
     * Mostrar formulario de creación (vista RECreate).
     */
   public function create()
{
    $empresas = Empresa::all();  // Carga todas las empresas.
    return view('empresa.RECreate', compact('empresas')); // Envíalas a la vista.
    
}

    /**
     * Almacenar una nueva empresa.
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
        ]);

        $empresa = Empresa::create([
            'empresa' => $request->empresa,


        ]);
        // Registrar en bitácora.
    BitacoraHelper::registrar('Creó empresa', 'Empresa: ' . $empresa->empresa);
       
        return redirect()->route('empresa.index')->with('success', 'Empresa creada exitosamente.');
    }

    /**
     * Mostrar formulario de edición (vista REEdit).
     */
    public function edit($id)
{
    $empresa = Empresa::findOrFail($id);
    $empresas = Empresa::all(); // Enviar también la lista de empresas.
    return view('empresa.REEdit', compact('empresa', 'empresas'));
}


    /**
     * Actualizar empresa.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
        ]);

        $empresa = Empresa::findOrFail($id);
        $empresa->update([
            'empresa' => $request->empresa,
        ]);
        // Registrar en bitácora.
    BitacoraHelper::registrar('Editó empresa', 'Empresa ID: ' . $empresa->id);

        return redirect()->route('empresa.index')->with('success', 'Empresa actualizada correctamente.');
    }

    /**
     * Eliminar empresa.
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        // Registrar en bitácora.
    BitacoraHelper::registrar('Eliminó empresa', 'Empresa ID: ' . $id);

        return redirect()->route('empresa.index')->with('success', 'Empresa eliminada correctamente.');
    }
}
