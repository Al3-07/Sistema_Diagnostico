<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiagnostico;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

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
    $registros = RegistroDiagnostico::select(['id', 'empresa','equipo', 'modelo', 'marca', 'serie', 'descripcion', 'estado', 'foto_antes', 'foto_despues']);

    return datatables()->of($registros)
        ->addColumn('foto_antes_img', function($registro) {
            if ($registro->foto_antes) {
                $url = asset('img/post/' . $registro->foto_antes);
                return '<img src="'.$url.'" alt="Foto Antes" style="max-width:80px; max-height:60px; border-radius:6px;">';
            }
            return '';
        })
        ->addColumn('foto_despues_img', function($registro) {
            if ($registro->foto_despues) {
                $url = asset('img/post/' . $registro->foto_despues);
                return '<img src="'.$url.'" alt="Foto Después" style="max-width:80px; max-height:60px; border-radius:6px;">';
            }
            return '';
        })
        ->addColumn('acciones', function($registro) {
            $ver = '<a href="'.route('registrodiagnostico.show', $registro->id).'" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>';
            $editar = '<a href="'.route('registrodiagnostico.edit', $registro->id).'" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>';
 $eliminar = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'.$registro->id.'" title="Eliminar diagnóstico"><i class="fas fa-trash"></i></button>';            return '<div style="display:flex; gap:5px; justify-content:center;">'.$ver.' '.$editar.' '.$eliminar.'</div>';
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
    $request->validate([
         'empresa' => 'required|string|max:150',
            'equipo' => 'required|string|max:50',
            'modelo' => 'required|string|max:30',
            'marca' => 'required|string|max:30',
            'serie' => 'required|string|max:40',
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|string',
            'foto_antes' => 'required|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
            'foto_despues' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
            ], [
        'foto_antes.required' => 'La imagen es obligatoria.',
        'foto_antes.file' => 'La imagen debe ser un archivo válido.',
        'foto_antes.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, png, gif, bmp, webp, svg.',
         'equipo.required' => 'El campo equipo es obligatorio.',
        'modelo.required' => 'El campo modelo es obligatorio.',
        'marca.required' => 'El campo marca es obligatorio.',
        'serie.required' => 'El campo serie es obligatorio.',



        ]);
    $registro = new RegistroDiagnostico;
    $registro->empresa = $request->empresa;
    $registro->equipo = $request->equipo;
    $registro->modelo = $request->modelo;
    $registro->marca = $request->marca;
    $registro->serie = $request->serie;
    $registro->descripcion = $request->descripcion;
     $registro->estado = $request->estado;

    // Subir foto_antes
        if ($request->hasFile('foto_antes')) {
            $imagen = $request->file('foto_antes');
            $nombre = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/post'), $nombre);
            $registro->foto_antes = $nombre;
        }
        // Subir foto_despues
        if ($request->hasFile('foto_despues')) {
            $imagen = $request->file('foto_despues');
            $nombre = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/post'), $nombre);
            $registro->foto_despues = $nombre;
        }
    

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
        'empresa' => 'required|string|max:150',
        'equipo' => 'required|string|max:50',
        'modelo' => 'required|string|max:30',
        'marca' => 'required|string|max:30',
        'serie' => 'required|string|max:40',
        'descripcion' => 'nullable|string|max:1000',
         'estado' => 'required|string',
        'foto_antes' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
            'foto_despues' => 'required|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',

         ],   [
        'foto_despues.required' => 'La imagen es obligatoria.',
        'foto_despues.file' => 'La imagen debe ser un archivo válido.',
        'foto_despues.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, png, gif, bmp, webp, svg.',
         'equipo.required' => 'El campo equipo es obligatorio.',
        'modelo.required' => 'El campo modelo es obligatorio.',
        'marca.required' => 'El campo marca es obligatorio.',
        'serie.required' => 'El campo serie es obligatorio.',
       
    ]);

    $registro = RegistroDiagnostico::findOrFail($id);
     $registro->empresa = $request->empresa;
    $registro->equipo = $request->equipo;
    $registro->modelo = $request->modelo;
    $registro->marca = $request->marca;
    $registro->serie = $request->serie;
    $registro->descripcion = $request->descripcion;
     $registro->estado = $request->estado;

    // Subir y reemplazar foto_antes si se envía una nueva imagen
    if ($request->hasFile('foto_antes')) {
        // Opcional: eliminar imagen anterior si existe
        if ($registro->foto_antes && file_exists(public_path('img/post/' . $registro->foto_antes))) {
            unlink(public_path('img/post/' . $registro->foto_antes));
        }
        $imagen = $request->file('foto_antes');
        $nombre = $imagen->getClientOriginalName();
        $imagen->move(public_path('img/post'), $nombre);
        $registro->foto_antes = $nombre;
    }
    // Subir y reemplazar foto_despues si se envía una nueva imagen
    if ($request->hasFile('foto_despues')) {
        // Opcional: eliminar imagen anterior si existe
        if ($registro->foto_despues && file_exists(public_path('img/post/' . $registro->foto_despues))) {
            unlink(public_path('img/post/' . $registro->foto_despues));
        }
        $imagen = $request->file('foto_despues');
        $nombre = $imagen->getClientOriginalName();
        $imagen->move(public_path('img/post'), $nombre);
        $registro->foto_despues = $nombre;
    }


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
    public function generarPDF($id)
{
    $registro = RegistroDiagnostico::findOrFail($id);

    $pdf = Pdf::loadView('registrodiagnostico.reporte', compact('registro'))->setPaper('letter');

    return $pdf->stream('diagnostico_' . $registro->id . '.pdf');
}
}
