<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiagnostico;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class RegistroDiagnosticoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar listado
    public function index()
    {
        $registros = RegistroDiagnostico::paginate(10);
        return view('RegistroDiagnostico.RDIndex', compact('registros'));
    }

    // Obtener datos para datatable
   public function getTableData()
{
    $registros = RegistroDiagnostico::select(['id', 'equipo', 'modelo', 'marca', 'serie', 'descripcion']);

    return datatables()->of($registros)
        ->addColumn('acciones', function($registro) {
            $ver = '<a href="'.route('registrodiagnostico.show', $registro->id).'" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>';
            $editar = '<a href="'.route('registrodiagnostico.edit', $registro->id).'" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>';
            $eliminar = '<button data-id="'.$registro->id.'" class="btn btn-danger btn-sm btn-eliminar" title="Eliminar"><i class="fas fa-trash-alt"></i></button>';
            return '<div style="display:flex; gap:5px; justify-content:center;">'.$ver.' '.$editar.' '.$eliminar.'</div>';
        })
        ->rawColumns(['acciones']) // permite renderizar el HTML
        ->make(true);
}




    // Mostrar formulario de creación
    public function create()
    {
        return view('RegistroDiagnostico.RDCreate');
    }

    // Guardar nuevo diagnóstico
public function store(Request $request)
{
    $registro = new RegistroDiagnostico;

    // Otros campos...
    $registro->equipo = $request->equipo;
    $registro->modelo = $request->modelo;
    $registro->marca = $request->marca;
    $registro->serie = $request->serie;
    $registro->descripcion = $request->descripcion;

    $registro->save();

    return redirect()->route('registrodiagnostico.index')->with('success', 'Diagnóstico guardado correctamente');
}


    // Mostrar formulario de edición
    public function edit($id)
    {
        $registro = RegistroDiagnostico::findOrFail($id);
        return view('RegistroDiagnostico.RDEdit', compact('registro'));
    }

    // Actualizar diagnóstico
   public function update(Request $request, $id)
{
    $request->validate([
        'equipo' => 'required|string|max:50',
        'modelo' => 'nullable|string|max:30',
        'marca' => 'nullable|string|max:30',
        'serie' => 'nullable|string|max:40',
        'descripcion' => 'nullable|string|max:300',
       
    ]);

    $registro = RegistroDiagnostico::findOrFail($id);

    $registro->fill($request->only(['equipo', 'modelo', 'marca', 'serie', 'descripcion']));


    $registro->save();

    return redirect()->route('registrodiagnostico.index')->with('success', 'Diagnóstico actualizado correctamente.');
}

    // Eliminar diagnóstico
    public function destroy($id)
    {
        try {
            $registro = RegistroDiagnostico::findOrFail($id);

            $registro->delete();

            return response()->json(['success' => true, 'message' => 'Registro eliminado correctamente']);
        } catch (\Exception $e) {
            \Log::error('Error al eliminar diagnóstico: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    // Mostrar detalles del diagnóstico
    public function show($id)
    {
        $registro = RegistroDiagnostico::findOrFail($id);
        return view('RegistroDiagnostico.RDShow', compact('registro'));
    }
}
