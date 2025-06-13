<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroDiagnostico;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\MailManager;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use App\Helpers\BitacoraHelper;


class RegistroDiagnosticoController extends Controller
{
    // Constructor.
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar listado.
    public function index()
    {
        $registros = RegistroDiagnostico::paginate(10);
        return view('RegistroDiagnostico.RDIndex', compact('registros'));
    }

    // Obtener datos para datatable.
  public function getTableData()
{
   $registros = RegistroDiagnostico::with('empresa')->select(['id', 'fecha', 'equipo', 'modelo', 'marca', 'serie', 'descripcion', 'estado', 'foto_antes', 'foto_antes_camara', 'foto_despues', 'foto_despues_camara', 'empresa_id']);
    return datatables()->of($registros)
        ->filterColumn('empresa', function ($query, $keyword) {
        $query->whereHas('empresa', function ($q) use ($keyword) {
            $q->where('empresa', 'like', "%{$keyword}%");
        });
        })
        ->filterColumn('fecha', function ($query, $keyword) {
            $query->where('fecha', 'like', "%{$keyword}%");
        })
        ->addColumn('empresa', function ($registro) {
            return $registro->empresa->empresa ?? 'Sin empresa';
        })
         ->addColumn('fecha', function ($registro) {
            return $registro->fecha ? \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') : 'Sin fecha';
        })
  ->addColumn('foto_antes_img', function($registro) {
    $foto = $registro->foto_antes_camara ?: $registro->foto_antes;
    if ($foto) {
        $url = asset('img/post/' . $foto) . '?v=' . time(); // 👈 parámetro dinámico.
        return '<img src="'.$url.'" alt="Foto Antes" style="max-width:80px; max-height:60px; border-radius:6px;">';
    }
    return '';
})

->addColumn('foto_despues_img', function($registro) {
    $foto = $registro->foto_despues_camara ?: $registro->foto_despues;
    if ($foto) {
        $url = asset('img/post/' . $foto) . '?v=' . time(); // 👈 parámetro dinámico.
        return '<img src="'.$url.'" alt="Foto Después" style="max-width:80px; max-height:60px; border-radius:6px;">';
    }
    return '';
})

        ->addColumn('acciones', function($registro) {
             // Botones de acción.
            $ver = '<a href="'.route('registrodiagnostico.show', $registro->id).'" class="btn btn-info btn-sm" title="Ver"><i class="fas fa-eye"></i></a>';
            // Solo mostrar si NO es 'Visualizador'.
    if (Auth::user()->role !== 'Visualizador') {
            $editar = '<a href="'.route('registrodiagnostico.edit', $registro->id).'" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>';
            $eliminar = '<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'.$registro->id.'" title="Eliminar diagnóstico"><i class="fas fa-trash"></i></button>';          
            
         // Asunto común.
             $asunto = 'Reporte de Diagnóstico - Equipo: ' . $registro->equipo;
         // Gmail
            $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1'
        . '&su=' . urlencode($asunto);
         // Yahoo Mail.
             $yahooUrl = 'http://compose.mail.yahoo.com/?'
        . '&subj=' . urlencode($asunto);
        // Outlook (Outlook.com / Office 365 Web).
            $outlookUrl = 'https://outlook.live.com/mail/deeplink/compose?'
        . '&subject=' . urlencode($asunto);
        // Botones de correo.
             $gmailButton = '<a href="'.$gmailUrl.'" class="btn btn-danger btn-sm" target="_blank" title="Enviar por Gmail"><i class="fab fa-google"></i></a>';
             $yahooButton = '<a href="'.$yahooUrl.'" class="btn btn-primary btn-sm" target="_blank" title="Enviar por Yahoo"><i class="fab fa-yahoo"></i></a>';
             $outlookButton = '<a href="'.$outlookUrl.'" class="btn btn-info btn-sm" target="_blank" title="Enviar por Outlook"><i class="fab fa-microsoft"></i></a>';
              // Combina todos los botones.
    return '<div style="display:flex; gap:5px; justify-content:center;">'.$ver.' '.$editar.' '.$eliminar.' '.$gmailButton.' '.$yahooButton.' '.$outlookButton.'</div>';
        }

    // Si es Visualizador, solo mostrar botón de ver.
    return $ver;
})
         ->rawColumns(['foto_antes_img', 'foto_despues_img', 'acciones']) // 👈 Incluye también 'acciones' si usas HTML allí
    ->make(true);
}




    // Mostrar formulario de creación.
    public function create()
    {
        $empresas = Empresa::all(); // Trae todas las empresas.
        $ultimoId = DB::table('Equipo')->max('id') ?? 0;
        $correlativo = 'REP-' . str_pad($ultimoId + 1, 4, '0', STR_PAD_LEFT);
        return view('RegistroDiagnostico.RDCreate' , compact('empresas','correlativo'));
    }

    // Guardar nuevo diagnóstico.
public function store(Request $request)
{
    $request->validate([
        'fecha' => 'nullable|date', // Acepta una fecha o vacío.
            'equipo' => 'required|string|max:50',
            'modelo' => 'required|string|max:30',
            'marca' => 'required|string|max:30',
            'serie' => 'required|string|max:40',
            'descripcion' => 'nullable|string|max:1000',
            'estado' => 'required|string',
            'foto_antes' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
            'foto_despues' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
            'empresa_id' => 'required|exists:empresa,id',
            'foto_antes_camara' => 'nullable|string',
            'foto_despues_camara' => 'nullable|string',

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
    $registro->fecha = $request->fecha;  
    $registro->equipo = $request->equipo;
    $registro->modelo = $request->modelo;
    $registro->marca = $request->marca;
    $registro->serie = $request->serie;
    $registro->descripcion = $request->descripcion;
     $registro->estado = $request->estado;
     $registro->empresa_id = $request->empresa_id;

    // Subir foto_antes.
       // Imagen desde cámara (prioridad).
    if ($request->hasFile('foto_antes_camera')) {
        $archivo = $request->file('foto_antes_camera');
        $nombreArchivo = time() . '_camara_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img/post'), $nombreArchivo);
        $registro->foto_antes_camara = $nombreArchivo;
    }

    // Imagen desde archivo.
    if ($request->hasFile('foto_antes')) {
        $archivo = $request->file('foto_antes');
        $nombreArchivo = time() . '_archivo_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img/post'), $nombreArchivo);
        $registro->foto_antes = $nombreArchivo;
    }
        // Subir foto_despues.
        if ($request->hasFile('foto_despues')) {
            $imagen = $request->file('foto_despues');
            $nombre = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/post'), $nombre);
            $registro->foto_despues = $nombre;
        }
        // Procesar imagen de cámara: foto_antes_camara.    
if ($request->filled('foto_antes_camara')) {
    $data = $request->input('foto_antes_camara');
    $nombre = 'cam_antes_' . time() . '.png'; // Puedes usar otro formato si deseas.
    $ruta = public_path('img/post/' . $nombre);
    file_put_contents($ruta, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data)));
    $registro->foto_antes_camara = $nombre;
}

// Procesar imagen de cámara: foto_despues_camara.
if ($request->filled('foto_despues_camara')) {
    $data = $request->input('foto_despues_camara');
    $nombre = 'cam_despues_' . time() . '.png';
    $ruta = public_path('img/post/' . $nombre);
    file_put_contents($ruta, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data)));
    $registro->foto_despues_camara = $nombre;
}



    // Actualizar firmas si se envían nuevas.
if ($request->has('firma_realizado')) {
    $firma1 = str_replace('data:image/png;base64,', '', $request->firma_realizado);
    $firma1 = str_replace(' ', '+', $firma1);
    $firma1 = 'firma_realizado_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma1, base64_decode($firma1));

    // Eliminar firma antigua si existe.
    if ($registro->firma_realizado && Storage::disk('public')->exists('firmas/' . $registro->firma_realizado)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_realizado);
    }

    $registro->firma_realizado = $firma1;
}

if ($request->has('firma_supervisado')) {
    $firma2 = str_replace('data:image/png;base64,', '', $request->firma_supervisado);
    $firma2 = str_replace(' ', '+', $firma2);
    $firma2 = 'firma_supervisado_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma2, base64_decode($firma2));

    if ($registro->firma_supervisado && Storage::disk('public')->exists('firmas/' . $registro->firma_supervisado)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_supervisado);
    }

    $registro->firma_supervisado = $firma2;
}

if ($request->has('firma_recibido')) {
    $firma3 = str_replace('data:image/png;base64,', '', $request->firma_recibido);
    $firma3 = str_replace(' ', '+', $firma3);
    $firma3 = 'firma_recibido_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma3, base64_decode($firma3));

    if ($registro->firma_recibido && Storage::disk('public')->exists('firmas/' . $registro->firma_recibido)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_recibido);
    }

    $registro->firma_recibido = $firma3;
}


    $registro->save();
    // Aquí llamas al helper para registrar la bitácora
    BitacoraHelper::registrar('Creó diagnóstico',  ' Equipo: ' . $registro->equipo);

    return redirect()->route('registrodiagnostico.index')->with('success', 'Diagnóstico guardado correctamente');
}


    // Mostrar formulario de edición.
    public function edit($id)
    {
         $empresas = Empresa::all(); // Trae todas las empresas.
        $registro = RegistroDiagnostico::findOrFail($id);
        $correlativo = 'REP-' . str_pad($registro->id, 4, '0', STR_PAD_LEFT);
        return view('RegistroDiagnostico.RDEdit', compact('registro', 'correlativo','empresas'));
    }

    // Actualizar diagnóstico.
   public function update(Request $request, $id)
{
    $request->validate([
        'fecha' => 'nullable|date', // Acepta una fecha o vacío.
        'equipo' => 'required|string|max:50',
        'modelo' => 'required|string|max:30',
        'marca' => 'required|string|max:30',
        'serie' => 'required|string|max:40',
        'descripcion' => 'nullable|string|max:1000',
         'estado' => 'required|string',
        'foto_antes' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
        'foto_despues' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,webp,svg|max:2048',
        'foto_antes_camara' => 'nullable|string',
        'foto_despues_camara' => 'nullable|string',


         ],   [
        'foto_despues.nullable' => 'La imagen es obligatoria.',
        'foto_despues.file' => 'La imagen debe ser un archivo válido.',
        'foto_despues.mimes' => 'La imagen debe ser un archivo de tipo: jpg, jpeg, png, gif, bmp, webp, svg.',
         'equipo.required' => 'El campo equipo es obligatorio.',
        'modelo.required' => 'El campo modelo es obligatorio.',
        'marca.required' => 'El campo marca es obligatorio.',
        'serie.required' => 'El campo serie es obligatorio.',
       
    ]);

    $registro = RegistroDiagnostico::findOrFail($id);
    $registro->fecha = $request->fecha;  
    $registro->equipo = $request->equipo;
    $registro->modelo = $request->modelo;
    $registro->marca = $request->marca;
    $registro->serie = $request->serie;
    $registro->descripcion = $request->descripcion;
     $registro->estado = $request->estado;
     $registro->empresa_id = $request->empresa_id;
 // Subir foto_antes archivo normal.
    if ($request->hasFile('foto_antes')) {
        if ($registro->foto_antes && file_exists(public_path('img/post/' . $registro->foto_antes))) {
            unlink(public_path('img/post/' . $registro->foto_antes));
        }
        $archivo = $request->file('foto_antes');
        $nombre = time() . '_antes_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img/post'), $nombre);
        $registro->foto_antes = $nombre;
    }

    // Subir foto_despues archivo normal.
    if ($request->hasFile('foto_despues')) {
        if ($registro->foto_despues && file_exists(public_path('img/post/' . $registro->foto_despues))) {
            unlink(public_path('img/post/' . $registro->foto_despues));
        }
        $archivo = $request->file('foto_despues');
        $nombre = time() . '_despues_' . $archivo->getClientOriginalName();
        $archivo->move(public_path('img/post'), $nombre);
        $registro->foto_despues = $nombre;
    }

    // Subir foto_antes_camara (base64).
    if ($request->filled('foto_antes_camera')) {
        if ($registro->foto_antes_camara && file_exists(public_path('img/post/' . $registro->foto_antes_camara))) {
            unlink(public_path('img/post/' . $registro->foto_antes_camara));
        }
        $data = $request->input('foto_antes_camera');
        $base64_str = preg_replace('#^data:image/\w+;base64,#i', '', $data);
        $nombre = 'cam_antes_' . time() . '.png';
        file_put_contents(public_path('img/post/' . $nombre), base64_decode($base64_str));
        $registro->foto_antes_camara = $nombre;
    }

    // Subir foto_despues_camara (base64).
    if ($request->filled('foto_despues_camera')) {
        if ($registro->foto_despues_camara && file_exists(public_path('img/post/' . $registro->foto_despues_camara))) {
            unlink(public_path('img/post/' . $registro->foto_despues_camara));
        }
        $data = $request->input('foto_despues_camera');
        $base64_str = preg_replace('#^data:image/\w+;base64,#i', '', $data);
        $nombre = 'cam_despues_' . time() . '.png';
        file_put_contents(public_path('img/post/' . $nombre), base64_decode($base64_str));
        $registro->foto_despues_camara = $nombre;
    }

    // Actualizar firmas si se envían nuevas.
if ($request->has('firma_realizado')) {
    $firma1 = str_replace('data:image/png;base64,', '', $request->firma_realizado);
    $firma1 = str_replace(' ', '+', $firma1);
    $firma1 = 'firma_realizado_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma1, base64_decode($firma1));

    // Eliminar firma antigua si existe.
    if ($registro->firma_realizado && Storage::disk('public')->exists('firmas/' . $registro->firma_realizado)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_realizado);
    }

    $registro->firma_realizado = $firma1;
}

if ($request->has('firma_supervisado')) {
    $firma2 = str_replace('data:image/png;base64,', '', $request->firma_supervisado);
    $firma2 = str_replace(' ', '+', $firma2);
    $firma2 = 'firma_supervisado_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma2, base64_decode($firma2));

    if ($registro->firma_supervisado && Storage::disk('public')->exists('firmas/' . $registro->firma_supervisado)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_supervisado);
    }

    $registro->firma_supervisado = $firma2;
}

if ($request->has('firma_recibido')) {
    $firma3 = str_replace('data:image/png;base64,', '', $request->firma_recibido);
    $firma3 = str_replace(' ', '+', $firma3);
    $firma3 = 'firma_recibido_' . time() . '.png';
    Storage::disk('public')->put('firmas/' . $firma3, base64_decode($firma3));

    if ($registro->firma_recibido && Storage::disk('public')->exists('firmas/' . $registro->firma_recibido)) {
        Storage::disk('public')->delete('firmas/' . $registro->firma_recibido);
    }

    $registro->firma_recibido = $firma3;
}
    $registro->save();
    // Registro en bitácora.
    BitacoraHelper::registrar('Editó diagnóstico','Equipo: ' . $registro->equipo);

    return redirect()->route('registrodiagnostico.index')->with('success', 'Diagnóstico actualizado correctamente.');
}

    // Eliminar diagnóstico.
    public function destroy($id)
    {
        try {
            $registro = RegistroDiagnostico::findOrFail($id);

            $registro->delete();
              // Registro en bitácora.
    BitacoraHelper::registrar('Eliminó diagnóstico','Equipo: ' . $registro->equipo);

            return response()->json(['success' => true, 'message' => 'Registro eliminado correctamente']);
        } catch (\Exception $e) {
            \Log::error('Error al eliminar diagnóstico: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    // Mostrar detalles del diagnóstico.
    public function show($id)
    {
        $registro = RegistroDiagnostico::with('empresa')->findOrFail($id);
         $correlativo = 'REP-' . str_pad($registro->id, 4, '0', STR_PAD_LEFT);
        return view('RegistroDiagnostico.RDShow', compact('registro','correlativo'));
    }
    public function generarPDF($id)
{
    $registro = RegistroDiagnostico::findOrFail($id);

    // Función para convertir la firma a base64.
    function firmaBase64($ruta) {
        $path = public_path('storage/' . $ruta);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return null;
    }

    $firmaRealizado = $registro->firma_realizado ? firmaBase64($registro->firma_realizado) : null;
    $firmaSupervisado = $registro->firma_supervisado ? firmaBase64($registro->firma_supervisado) : null;
    $firmaRecibido = $registro->firma_recibido ? firmaBase64($registro->firma_recibido) : null;

    $pdf = PDF::loadView('emails.reporte_diagnostico', [
        'registro' => $registro,
        'firmaRealizado' => $firmaRealizado,
        'firmaSupervisado' => $firmaSupervisado,
        'firmaRecibido' => $firmaRecibido,
        'correlativo' => 'REP-' . str_pad($id, 4, '0', STR_PAD_LEFT)

    ]);

   return $pdf->stream('diagnostico.pdf');

}

// Descargar PDF.
public function descargarPDF($id)
{
   // Cargar registro con la relación empresa.
    $registro = RegistroDiagnostico::with('empresa')->findOrFail($id);
    // Generar correlativo para este registro.
    $correlativo = 'REP-' . str_pad($registro->id, 4, '0', STR_PAD_LEFT);

    function firmaBase64($ruta) {
        $path = public_path('storage/' . $ruta);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return null;
    }

    $firmaRealizado = $registro->firma_realizado ? firmaBase64($registro->firma_realizado) : null;
    $firmaSupervisado = $registro->firma_supervisado ? firmaBase64($registro->firma_supervisado) : null;
    $firmaRecibido = $registro->firma_recibido ? firmaBase64($registro->firma_recibido) : null;

    $pdf = Pdf::loadView('emails.reporte_diagnostico', [
        'registro' => $registro,
        'correlativo' => $correlativo, 
        'firmaRealizado' => $firmaRealizado,
        'firmaSupervisado' => $firmaSupervisado,
        'firmaRecibido' => $firmaRecibido,
    ]);

    return $pdf->download('diagnostico-' . $registro->id . '.pdf');
}

// Enviar PDF.
public function enviarReporte($id)
{
    $registro = \App\Models\RegistroDiagnostico::findOrFail($id);
    $pdf = Pdf::loadView('emails.reporte_diagnostico', compact('registro'));

    // Crear el mailer temporal con esta configuración.
    $mailManager = app()->make(MailManager::class);
    $customMailer = $mailManager->mailer('custom', fn () => $smtpConfig);

    $customMailer->send([], [], function ($message) use ($pdf, $correos, $registro) {
        $message->to($correos)
                ->subject('Reporte de Diagnóstico: ' . $registro->id)
                ->attachData($pdf->output(), 'reporte.pdf', [
                    'mime' => 'application/pdf',
                ])
                ->setBody('Se adjunta el reporte de diagnóstico correspondiente.', 'text/html');
    });

    return back()->with('success', 'Reporte enviado correctamente');
}

// Guardar firma.
public function guardarFirma(Request $request, $id)
{
    $registro = RegistroDiagnostico::findOrFail($id);

    $base64 = $request->input('firma');
    $tipo   = $request->input('tipo_firma');   // realizado / supervisado / recibido.

    if (!$base64 || !$tipo) {
        return back()->with('error','No se pudo guardar la firma.');
    }

    // Quitar cabecera data URI y espacios.
    $base64 = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
    $base64 = str_replace(' ', '+', $base64);

    $nombre = 'firma_'.$tipo.'_'.'.png';   // Punto antes de png.
    Storage::disk('public')->put('firmas/'.$nombre, base64_decode($base64));
    \Log::info('Guardé firma: '.$nombre);

    switch ($tipo) {
        case 'realizado':   $registro->firma_realizado  = 'firmas/'.$nombre; break;
        case 'supervisado': $registro->firma_supervisado = 'firmas/'.$nombre; break;
        case 'recibido':    $registro->firma_recibido    = 'firmas/'.$nombre; break;
        default:            return back()->with('error','Tipo de firma no válido.');
    }

    $registro->save();
    return back()->with('success','Firma guardada correctamente.');
}


}
